<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/BDConexion.Class.php';

$DatosFormulario = $_POST;
$imagen = $_FILES['imagen'];
$confirmar = isset($_POST['confirmar']) ? $_POST['confirmar'] : null;

// Validación de curso existente por nombre
$nombreCurso = $DatosFormulario["nombre"];
$queryCurso = "SELECT id FROM curso WHERE nombre = '{$nombreCurso}'";
$resultCurso = BDConexion::getInstancia()->query($queryCurso);

if ($resultCurso && $resultCurso->num_rows > 0 && $confirmar !== 'si') {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
            <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
            <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Crear Curso</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            Ya existe un curso llamado <b><?= htmlspecialchars($nombreCurso) ?></b>.<br>
                            ¿Desea guardar este curso como uno nuevo de todas formas?
                        </div>
                        <form action="curso.crear.procesar.php" method="post" enctype="multipart/form-data">
                            <?php
                            foreach ($DatosFormulario as $key => $value) {
                                if ($key !== 'confirmar') {
                                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                }
                            }
                            ?>
                            <input type="hidden" name="confirmar" value="si">
                            <button type="submit" class="btn btn-success">Sí</button>
                        </form>
                        <form action="curso.crear.php" method="post">
                            <?php
                            foreach ($DatosFormulario as $key => $value) {
                                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                            }
                            ?>
                            <button type="submit" class="btn btn-danger">No</button>
                        </form>
                        <div class="mt-2 text-muted">
                            <small>Si vuelve a editar, deberá seleccionar la imagen nuevamente.</small>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once '../gui/footer.php'; ?>
        </body>
    </html>
    <?php
    exit;
}

BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

// Manejo de imagen
$destino = 'C:/xampp/htdocs/KIUSH/lib/img/';
$nombreImagen = 'cursoDefecto.jpg';

if (isset($imagen['tmp_name']) && !empty($imagen['name']) && file_exists($imagen['tmp_name'])) {
    $destino .= basename($imagen['name']);
    $nombreImagen = basename($imagen['name']);
    move_uploaded_file($imagen['tmp_name'], $destino);
}

// Validación de fechas
$fechaInicio = strtotime($DatosFormulario["fechaInicioInscripcion"]);
$fechaFin = strtotime($DatosFormulario["fechaFinInscripcion"]);
$fechaActual = strtotime(date("Y-m-d"));

if ($fechaInicio > $fechaFin) { ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
            <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
            <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <div class="modal fade show" id="myModal" tabindex="-1" role="document" aria-labelledby="exampleModalLabel" aria-modal="true" style="display:block;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Fecha no válida</h5>
                                <button type="button" class="close" onclick="window.history.back();" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                La fecha de inicio de las inscripciones no puede ser después de la fecha fin.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once '../gui/footer.php'; ?>
        </body>
    </html>
<?php
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    exit;
}

// Estado del curso
$estado = 0;
if (($fechaActual >= $fechaInicio) && ($fechaActual <= $fechaFin)) {
    $estado = 1;
}

// Obtener id del usuario creador
$email_usuario = $_SESSION['usuario']->email;
$id_usuario = 0;
$query = "SELECT id FROM bdkiush.usuario WHERE email = '{$email_usuario}'";
$datos = BDConexion::getInstancia()->query($query);
if ($datos->num_rows > 0) {
    $fila = $datos->fetch_assoc();
    $id_usuario = $fila['id'];
}

// Insertar curso
$query = "INSERT INTO curso (id, nombre, descripcion, fechasDictado, 
        fechaInicioInscripcion, fechaFinInscripcion, lugar, estado, usuario_id, imagen) "
    . "VALUES (null,
        '{$DatosFormulario["nombre"]}',
        '{$DatosFormulario["descripcion"]}',
        '{$DatosFormulario["fechasDictado"]}',
        '{$DatosFormulario["fechaInicioInscripcion"]}',
        '{$DatosFormulario["fechaFinInscripcion"]}',
        '{$DatosFormulario["lugar"]}', {$estado}, {$id_usuario}, 
        '{$nombreImagen}')";
$consulta = BDConexion::getInstancia()->query($query);

if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
            <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <div class="alert alert-danger mt-4" role="alert">
                    Ha ocurrido un error al guardar el curso.
                </div>
                <a href="curso.crear.php" class="btn btn-primary">Volver</a>
            </div>
            <?php include_once '../gui/footer.php'; ?>
        </body>
    </html>
    <?php
    exit;
}

BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Crear Curso</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        Operación realizada con éxito.
                    </div>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="cursos.php" class="btn btn-primary">
                        <span class="oi oi-account-logout"></span> Volver al Menú
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>