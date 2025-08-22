<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/ColeccionPersonas.php';
include_once '../modelo/Cursos.Class.php';
require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$idCurso = $_GET['id'];
$Curso = new Curso($idCurso);
$ColeccionPersonas = new ColeccionPersonas();
$personasDelCurso = $ColeccionPersonas->getPersonasPorCurso($idCurso);

// Verificar si hay inscriptos
if (empty($personasDelCurso)) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <title>No hay inscriptos</title>
        </head>
        <body>
            <div class="container mt-5">
                <div class="alert alert-info text-center">
                    <h4>No hay inscriptos a este curso</h4>
                </div>
                <div class="text-center">
                    <a href="curso.ver.php?id=<?= $idCurso ?>" class="btn btn-primary">Volver al curso</a>
                </div>
            </div>
        </body>
    </html>
    <?php
    exit;
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Nombre');
$sheet->setCellValue('B1', 'Apellido');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'DNI');
$sheet->setCellValue('E1', 'Nota');
$sheet->setCellValue('F1', 'Asistencia');
$sheet->setCellValue('G1', 'Tipo');
$sheet->setCellValue('H1', 'Carrera');

$row = 2;
foreach ($personasDelCurso as $persona) {
    $query = "SELECT nombre FROM tipo WHERE id = " . $persona->getTipo_id();
    $resultado = BDConexion::getInstancia()->query($query);
    $tipoNombre = "";
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $tipoNombre = $fila['nombre'];
    }

    $query = "SELECT Nombre FROM carrera WHERE Cod = " . $persona->getCarrera_Cod();
    $resultado = BDConexion::getInstancia()->query($query);
    $carrera = "";
    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $carrera = $fila['Nombre'];
    }

    $sheet->setCellValue('A' . $row, $persona->getNombre());
    $sheet->setCellValue('B' . $row, $persona->getApellido());
    $sheet->setCellValue('C' . $row, $persona->getEmail());
    $sheet->setCellValue('D' . $row, $persona->getDni());
    $sheet->setCellValue('E' . $row, $persona->getNota());
    $sheet->setCellValue('F' . $row, $persona->getAsistencia());
    $sheet->setCellValue('G' . $row, $tipoNombre);
    $sheet->setCellValue('H' . $row, $carrera);
    $row++;
}

foreach(range('A','H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_' . $Curso->getNombre() . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>