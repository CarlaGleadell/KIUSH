<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/BDConexion.Class.php';

$DatosFormulario = $_POST;
$idUsuario = $DatosFormulario["id"];
$nombre = $DatosFormulario["nombre"];
$email = $DatosFormulario["email"];
$idRol = $DatosFormulario["rol"];

// Validación de nombre vacío
if (trim($nombre) === "") {
    mostrarMensaje([
        'tipo' => 'danger',
        'texto' => 'El nombre no puede estar vacío.'
    ]);
    exit;
}

BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

// Validación de correo existente en otro usuario
$queryMail = "SELECT id FROM usuario WHERE email = '{$email}' AND id <> {$idUsuario}";
$resultMail = BDConexion::getInstancia()->query($queryMail);
if ($resultMail && $resultMail->num_rows > 0) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    mostrarMensaje([
        'tipo' => 'danger',
        'texto' => 'El correo ingresado ya está registrado en otro usuario. Por favor, ingrese uno diferente.'
    ]);
    exit;
}

// Actualización de usuario
$query = "UPDATE usuario SET nombre = '{$nombre}', email = '{$email}' WHERE id = {$idUsuario}";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    mostrarMensaje([
        'tipo' => 'danger',
        'texto' => 'Ha ocurrido un error al actualizar el usuario.'
    ]);
    exit;
}

// Actualización de rol
$query = "DELETE FROM usuario_rol WHERE id_usuario = {$idUsuario}";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    mostrarMensaje([
        'tipo' => 'danger',
        'texto' => 'Ha ocurrido un error al actualizar el rol.'
    ]);
    exit;
}

$query = "INSERT INTO usuario_rol VALUES ({$idUsuario}, {$idRol})";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    mostrarMensaje([
        'tipo' => 'danger',
        'texto' => 'Ha ocurrido un error al asignar el rol.'
    ]);
    exit;
}

BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);

mostrarMensaje([
    'tipo' => 'success',
    'texto' => 'Operación realizada con éxito.'
]);

// Función para mostrar mensajes y opciones
function mostrarMensaje($mensaje) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
            <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
            <title><?= Constantes::NOMBRE_SISTEMA; ?> - Actualizar Usuario</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Actualizar Usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-<?= $mensaje['tipo']; ?>" role="alert">
                            <?= $mensaje['texto']; ?>
                        </div>
                        <hr />
                        <h5 class="card-text">Opciones</h5>
                        <a href="usuarios.php">
                            <button type="button" class="btn btn-primary">
                                <span class="oi oi-account-logout"></span> Atrás
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <?php include_once '../gui/footer.php'; ?>
        </body>
    </html>
    <?php
}
