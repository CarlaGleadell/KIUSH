<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/BDConexion.Class.php';

$DatosFormulario = $_POST;
$mail = $DatosFormulario["mail"];
$nombre = $DatosFormulario["nombre"];
$idRol = $DatosFormulario["rol"];

BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

// Validación de dominio Google
$dominiosGoogle = [
    'gmail.com',
    'googlemail.com',
    'uarg.unpa.edu.ar'
];
$dominioCorreo = strtolower(substr(strrchr($mail, "@"), 1));
if (!in_array($dominioCorreo, $dominiosGoogle)) {
    $mensaje = [
        'tipo' => 'danger',
        'texto' => 'El correo debe pertenecer a un dominio de Google Mail (ejemplo: @gmail.com, @uarg.unpa.edu.ar).'
    ];
    mostrarMensaje($mensaje);
    exit;
}

// Validación de correo existente
$queryMail = "SELECT id FROM usuario WHERE email = '{$mail}'";
$resultMail = BDConexion::getInstancia()->query($queryMail);
if ($resultMail && $resultMail->num_rows > 0) {
    $mensaje = [
        'tipo' => 'danger',
        'texto' => 'El correo ingresado ya está registrado. Por favor, ingrese uno diferente.'
    ];
    mostrarMensaje($mensaje);
    exit;
}

// Inserción de usuario
$query = "INSERT INTO usuario VALUES (null,'{$nombre}','{$mail}')";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    $mensaje = [
        'tipo' => 'danger',
        'texto' => 'Ha ocurrido un error al crear el usuario.'
    ];
    mostrarMensaje($mensaje);
    exit;
}
$idUsuario = BDConexion::getInstancia()->insert_id;

// Inserción de rol
$queryRol = "INSERT INTO usuario_rol VALUES ({$idUsuario}, {$idRol})";
$consultaRol = BDConexion::getInstancia()->query($queryRol);
if (!$consultaRol) {
    BDConexion::getInstancia()->rollback();
    BDConexion::getInstancia()->autocommit(true);
    $mensaje = [
        'tipo' => 'danger',
        'texto' => 'Ha ocurrido un error al asignar el rol.'
    ];
    mostrarMensaje($mensaje);
    exit;
}

BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);

$mensaje = [
    'tipo' => 'success',
    'texto' => 'Operación realizada con éxito.'
];
mostrarMensaje($mensaje);

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
            <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Usuario</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3>Crear Usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-<?= $mensaje['tipo']; ?>" role="alert">
                            <?= $mensaje['texto']; ?>
                        </div>
                        <hr />
                        <h5 class="card-text">Opciones</h5>
                        <a href="<?= ($mensaje['tipo'] === 'success') ? 'usuarios.php' : 'usuario.crear.php'; ?>">
                            <button type="button" class="btn btn-primary">
                                <span class="oi oi-arrow-left"></span> Volver
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