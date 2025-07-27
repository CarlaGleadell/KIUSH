<?php
include_once '../lib/Constantes.Class.php';
include_once '../lib/ControlAcceso.Class.php';
include_once '../modelo/BDConexion.Class.php';
include_once '../modelo/Cursos.Class.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'C:/xampp/htdocs/KIUSH/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$DatosFormulario = $_POST;
$idCurso = isset($_POST['idCurso']) ? $_POST['idCurso'] : null;
$curso = new Curso($idCurso);
$controlAcceso = new ControlAcceso();
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

$estado = 0;
if (isset($_POST['estado'])) {
    $estado = $_POST['estado'];
}

try {
    $dni = $DatosFormulario["dni"];
    $nombre = $DatosFormulario["nombre"];
    $apellido = $DatosFormulario["apellido"];
    $email = $DatosFormulario["email"];
    $tipo_id = intval($DatosFormulario["tipo"]);
    $carrera_Cod = !empty($DatosFormulario["carrera"]) ? sprintf("%03d", intval($DatosFormulario["carrera"])) : null;

    $checkQuery = "SELECT id FROM persona WHERE dni = ?";
    $stmt = BDConexion::getInstancia()->prepare($checkQuery);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si la persona ya existe, solo se actualizar
        $row = $result->fetch_assoc();
        $idPersona = $row['id'];

        $updateQuery = "UPDATE persona SET nombre = ?, apellido = ?, email = ?, tipo_id = ?, carrera_Cod = ? WHERE id = ?";
        $stmt = BDConexion::getInstancia()->prepare($updateQuery);
        $stmt->bind_param("sssisi", $nombre, $apellido, $email, $tipo_id, $carrera_Cod, $idPersona);
        $stmt->execute();
    } else {
        // Si la persona no existe, se crea una nueva
        $insertQuery = "INSERT INTO persona (nombre, apellido, email, dni, tipo_id, carrera_Cod) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = BDConexion::getInstancia()->prepare($insertQuery);
        $stmt->bind_param("ssssii", $nombre, $apellido, $email, $dni, $tipo_id, $carrera_Cod);
        $stmt->execute();
        $idPersona = BDConexion::getInstancia()->insert_id;
    }


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
        $mail->addAddress($DatosFormulario["email"]);

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
                    Estimado/a {$DatosFormulario["nombre"]} {$DatosFormulario["apellido"]},
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
        
        $messageText = "Estimado/a {$DatosFormulario["nombre"]} {$DatosFormulario["apellido"]},\n\n";
        $messageText .= "Se ha registrado su inscripción al curso \"{$curso->getNombre()}\".\n";
        $messageText .= "Fechas de dictado: {$curso->getFechasDictado()}\n";
        $messageText .= "Lugar: {$curso->getLugar()}\n\n";
        $messageText .= "¡Gracias por su participación!\n";
        $messageText .= "UNPA - UARG\n";
        $messageText .= Constantes::NOMBRE_SISTEMA;
        
        $mail->Body = $messageHTML;
        $mail->AltBody = $messageText;

        $mail->send();
        BDConexion::getInstancia()->commit();
        $success = true;
    } catch (Exception $e) {
        BDConexion::getInstancia()->rollback();
        $success = false;
        $error_message = "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
    }
} catch (Exception $e) {
    BDConexion::getInstancia()->rollback();
    $success = false;
    $error_message = $e->getMessage();
}

BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);
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
            html, body {
                height: 100%;
            }
            body {
                display: flex;
                flex-direction: column;
            }
            .content-container {
                flex: 1 0 auto;
                padding-bottom: 20px;
            }
            footer {
                flex-shrink: 0;
                width: 100%;
            }
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
            <div class="card">
                <div class="card-header">
                    <h3>Estado de la Inscripción</h3>
                </div>
                <div class="card-body">
                    <?php if ($success) { ?>
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">¡Inscripción Exitosa!</h4>
                            <p>Su inscripción al curso ha sido registrada correctamente.</p>
                            <p>Se ha enviado un correo de confirmación a: <?php echo htmlspecialchars($DatosFormulario["email"]); ?></p>
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
                    <?php if ($controlAcceso->esVisitante()): ?> 
                        <a href="curso.inscribirse.php" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver a Cursos
                        </a>
                    <?php else: ?>
                        <a href="personas.gestionar.php" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Atrás
                        </a>
                    <?php endif; ?>
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