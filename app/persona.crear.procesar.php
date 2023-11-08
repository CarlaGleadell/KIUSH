<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

$estado = 0;
if (isset($_POST['estado'])) {
    $estado = $_POST['estado'];
}


$query = "INSERT INTO persona "
        . "VALUES (null,'{$DatosFormulario["nombre"]}','{$DatosFormulario["apellido"]}',
        '{$DatosFormulario["email"]}','{$DatosFormulario["dni"]}','{$estado}',
        null, null, null,'{$DatosFormulario["tipo"]}','{$DatosFormulario["carrera"]}')";
$consulta = BDConexion::getInstancia()->query($query);

if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
}
$idPersona = BDConexion::getInstancia()->insert_id;

BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);

$query = "INSERT INTO curso_persona "
        . "VALUES ('{$DatosFormulario["idCurso"]}', '{$idPersona}')";
$consulta = BDConexion::getInstancia()->query($query);

if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
}
$idPersona = BDConexion::getInstancia()->insert_id;

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

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Agregar Preinscripto</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="personas.php">
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