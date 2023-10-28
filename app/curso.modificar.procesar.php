<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ROLES);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$idCurso = $DatosFormulario["id"];

BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();


/*
Al insertar en la base de datos se debe insertar
estado :  va a depender de fechaIncioInscripcion y fechaFinInscripcion
id_usuario : debe obtenerse del usuario que tiene la sesion iniciada en el momento
FALTA REALIZAR ESO
PROVISORIAMENTE SE ENVIA 0 Y 2
*/

$query = "UPDATE curso "
        . "SET nombre = '{$DatosFormulario["nombre"]}', descripcion = '{$DatosFormulario["descripcion"]}',
        fechasDictado = '{$DatosFormulario["fechasDictado"]}', fechaInicioInscripcion = '{$DatosFormulario["fechaInicioInscripcion"]}',
        fechaFinInscripcion = '{$DatosFormulario["fechaFinInscripcion"]}', lugar = '{$DatosFormulario["lugar"]}', estado = '0', usuario_id= '2'"
        . "WHERE id = {$idCurso}";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Actualizar curso</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Actualizar curso</h3>
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
                    <a href="cursos.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Salir
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>
