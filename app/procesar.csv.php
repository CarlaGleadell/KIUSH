<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/Cursos.Class.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

header('Content-Type: application/json');

if (!isset($_POST['curso_id']) || !isset($_FILES['excelFile'])) {
    echo json_encode(['success' => false, 'message' => 'Parámetros inválidos']);
    exit();
}

$curso_id = $_POST['curso_id'];
$curso = new Curso($curso_id);
$nombreCurso = $curso->getNombre();

try {
    if ($_FILES['excelFile']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Error en la subida del archivo: ' . $_FILES['excelFile']['error']);
    }

    $inputFileName = $_FILES['excelFile']['tmp_name'];
    
    if (!file_exists($inputFileName)) {
        throw new Exception('No se pudo acceder al archivo temporal');
    }
    
    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();
    
    $data = $worksheet->toArray();
    
    $expectedHeaders = ['Nombre', 'Apellido', 'Email', 'DNI', 'Nota', 'Asistencia', 'Tipo', 'Carrera'];
    $headers = $data[0];
    
    if ($headers !== $expectedHeaders) {
        throw new Exception('El formato del archivo no es correcto. Verifique las columnas.');
    }
    
    $csvData = [];
    
    BDConexion::getInstancia()->begin_transaction();
    
    for ($i = 1; $i < count($data); $i++) {
        $row = $data[$i];
        if (empty($row[3])) continue;
        
        $dni = trim($row[3]);
        $nota = !empty($row[4]) ? strval($row[4]) : null;
        $asistencia = !empty($row[5]) ? trim($row[5]) : null;
        $apellido = trim($row[1]);
        $nombre = trim($row[0]);
        $email = trim($row[2]);
        
        // Buscar persona por DNI
        $stmt = BDConexion::getInstancia()->prepare("SELECT persona.* FROM persona WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $persona = $result->fetch_assoc();
            $persona_id = $persona['id'];
            
            // Verificar si ya existe en curso_persona
            $stmt = BDConexion::getInstancia()->prepare("SELECT * FROM curso_persona WHERE curso_id = ? AND persona_id = ?");
            $stmt->bind_param("ii", $curso_id, $persona_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $stmt = BDConexion::getInstancia()->prepare("UPDATE curso_persona SET nota = ?, asistencia = ? WHERE curso_id = ? AND persona_id = ?");
                $stmt->bind_param("ssii", $nota, $asistencia, $curso_id, $persona_id);
            } else {
                $stmt = BDConexion::getInstancia()->prepare("INSERT INTO curso_persona (curso_id, persona_id, nota, asistencia) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiss", $curso_id, $persona_id, $nota, $asistencia);
            }
            $stmt->execute();
            
            $csvData[] = [$apellido . ', ' . $nombre, $dni, $email, $nota !== null ? $nota : 'Sin nota'];
        }
    }
    
    BDConexion::getInstancia()->commit();
    
    // Genera el archivo CSV
    $csvFileName = 'datos_' . $nombreCurso . '.csv';
    $output = fopen('php://temp', 'r+');
    fputcsv($output, ['Apellido y Nombre', 'DNI', 'MAIL', 'NOTA'], ';');
    foreach ($csvData as $row) {
        fputcsv($output, $row, ';');
    }
    rewind($output);
    $csvContent = stream_get_contents($output);
    fclose($output);
    
    echo json_encode([
        'success' => true,
        'message' => 'Archivo procesado correctamente. Las notas y asistencias han sido actualizadas.',
        'csvContent' => base64_encode($csvContent),
        'fileName' => $csvFileName
    ]);
    
} catch (Exception $e) {
    if (isset($conn)) BDConexion::getInstancia()->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Error al procesar el archivo: ' . $e->getMessage()
    ]);
}
?>