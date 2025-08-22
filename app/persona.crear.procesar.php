<?php
include_once '../lib/Constantes.Class.php';
include_once '../lib/ControlAcceso.Class.php';
include_once '../modelo/BDConexion.Class.php';
include_once '../modelo/Cursos.Class.php';

require_once 'C:/xampp/htdocs/KIUSH/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$controlAcceso = new ControlAcceso();
$Datos = $_POST;
$idCurso = isset($Datos['idCurso']) ? $Datos['idCurso'] : null;
$success = false;
$error_message = '';

try {
    $dni = $Datos["dni"];
    $nombre = $Datos["nombre"];
    $apellido = $Datos["apellido"];
    $email = $Datos["email"];
    $tipo_id = intval($Datos["tipo"]);
    $carrera_Cod = !empty($Datos["carrera"]) ? sprintf("%03d", intval($Datos["carrera"])) : null;

    // Verificar si el DNI ya existe
    $checkQuery = "SELECT id FROM persona WHERE dni = ?";
    $stmt = BDConexion::getInstancia()->prepare($checkQuery);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar datos
        $row = $result->fetch_assoc();
        $idPersona = $row['id'];
        $updateQuery = "UPDATE persona SET nombre = ?, apellido = ?, email = ?, tipo_id = ?, carrera_Cod = ? WHERE id = ?";
        $stmtUpdate = BDConexion::getInstancia()->prepare($updateQuery);
        $stmtUpdate->bind_param("sssisi", $nombre, $apellido, $email, $tipo_id, $carrera_Cod, $idPersona);
        $stmtUpdate->execute();
    } else {
        // Crear persona
        $insertQuery = "INSERT INTO persona (nombre, apellido, email, dni, tipo_id, carrera_Cod) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = BDConexion::getInstancia()->prepare($insertQuery);
        $stmtInsert->bind_param("ssssii", $nombre, $apellido, $email, $dni, $tipo_id, $carrera_Cod);
        $stmtInsert->execute();
        $idPersona = BDConexion::getInstancia()->insert_id;
    }

    // Si hay idCurso, asociar a curso_persona y enviar email
    if (!empty($idCurso)) {
        $curso = new Curso($idCurso);
        $estado = (isset($Datos["estado"]) && $Datos["estado"] == "1") ? 'Inscripto' : 'Preinscripto';

        // Verificar si ya está inscripto a ese curso
        $queryCheckCurso = "SELECT * FROM curso_persona WHERE curso_id = ? AND persona_id = ?";
        $stmtCheckCurso = BDConexion::getInstancia()->prepare($queryCheckCurso);
        $stmtCheckCurso->bind_param("ii", $idCurso, $idPersona);
        $stmtCheckCurso->execute();
        $resultCheckCurso = $stmtCheckCurso->get_result();

        if ($resultCheckCurso->num_rows == 0) {
            $queryCursoPersona = "INSERT INTO curso_persona (curso_id, persona_id, estado) VALUES (?, ?, ?)";
            $stmtCursoPersona = BDConexion::getInstancia()->prepare($queryCursoPersona);
            $stmtCursoPersona->bind_param("iis", $idCurso, $idPersona, $estado);
            $stmtCursoPersona->execute();
        }

        // Enviar email de confirmación
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cursoskiushunpa@gmail.com';
            $mail->Password = 'gpfn hvyr ykhu cmhe';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom(Constantes::EMAIL_SISTEMA);
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Inscripción a Curso - " . Constantes::NOMBRE_SISTEMA;

            $messageHTML = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { font-weight: bold; margin-bottom: 20px; }
                    .footer { margin-top: 30px; font-size: 12px; color: #777; }
                    .curso-info { margin: 20px 0; }
                    .curso-info p { margin: 5px 0; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        Estimado/a {$nombre} {$apellido},
                    </div>
                    <p>Se ha registrado su inscripción al curso \"{$curso->getNombre()}\".</p>
                    <div class='curso-info'>
                        <p><strong>Fechas de dictado:</strong> {$curso->getFechasDictado()}</p>
                        <p><strong>Lugar:</strong> {$curso->getLugar()}</p>
                    </div>
                    <p>¡Gracias por su participación!</p>
                    <div class='footer'>
                        UNPA - UARG<br>
                        " . Constantes::NOMBRE_SISTEMA . "
                    </div>
                </div>
            </body>
            </html>";

            $messageText = "Estimado/a {$nombre} {$apellido},\n\n";
            $messageText .= "Se ha registrado su inscripción al curso \"{$curso->getNombre()}\".\n";
            $messageText .= "Fechas de dictado: {$curso->getFechasDictado()}\n";
            $messageText .= "Lugar: {$curso->getLugar()}\n\n";
            $messageText .= "¡Gracias por su participación!\n";
            $messageText .= "UNPA - UARG\n";
            $messageText .= Constantes::NOMBRE_SISTEMA;

            $mail->Body = $messageHTML;
            $mail->AltBody = $messageText;

            $mail->send();
            $success = true;
        } catch (Exception $e) {
            $success = false;
            $error_message = "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    } else {
        $success = true;
    }
} catch (Exception $e) {
    $success = false;
    $error_message = $e->getMessage();
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar Preinscripto</title>
        <style>
            html, body { height: 100%; }
            body { display: flex; flex-direction: column; }
            .content-container { flex: 1 0 auto; padding-bottom: 20px; }
            footer { flex-shrink: 0; width: 100%; }
        </style>
    </head>
    <body>
        <?php 
        if ($controlAcceso->esVisitante()) {
            include_once '../gui/navbar_visitante.php';
        } else {
            include_once '../gui/navbar.php';
        }
        ?>
        <div class="content-container container">
            <p></p>
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Estado de la Inscripción</h3>
                </div>
                <div class="card-body">
                    <?php if ($success) { ?>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">¡Inscripción Exitosa!</h4>
                            <p>Su inscripción ha sido registrada correctamente.</p>
                            <?php if (!empty($idCurso)) { ?>
                                <p>Se ha enviado un correo de confirmación a: <?php echo htmlspecialchars($email); ?></p>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error en la Inscripción</h4>
                            <p>Ha ocurrido un error al procesar su inscripción.</p>
                            <?php if (isset($error_message)): ?>
                                <p>Detalle del error: <?php echo htmlspecialchars($error_message); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <?php if ($controlAcceso->esVisitante()) { ?> 
                        <a href="curso.inscribirse.php" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver a Cursos
                        </a>
                    <?php } else { ?>
                        <a href="personas.gestionar.php" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Atrás
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php 
        if ($controlAcceso->esVisitante()) {
            include_once '../gui/footer_visitante.php';
        } else {
            include_once '../gui/footer.php';
        }
        ?>
    </body>
</html>