<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

<<<<<<< HEAD
$query = "INSERT INTO Cursos "
        . "VALUES ( '{ [id]},
        '{$DatosFormulario["nombre"]}',
        '{$DatosFormulario["descripcion"]}',
        '{$DatosFormulario["email"]}
        ')";
=======
/*
Al insertar en la base de datos se debe insertar
estado :  va a depender de fechaIncioInscripcion y fechaFinInscripcion
id_usuario : debe obtenerse del usuario que tiene la sesion iniciada en el momento
FALTA REALIZAR ESO
PROVISORIAMENTE SE ENVIA 0 Y 2
*/


$query = "INSERT INTO curso "
        . "VALUES ( null,
        '{$DatosFormulario["nombre"]}',
        '{$DatosFormulario["descripcion"]}',
        '{$DatosFormulario["fechasDictado"]}',
        '{$DatosFormulario["fechaInicioInscripcion"]}',
        '{$DatosFormulario["fechaFinInscripcion"]}',
        '{$DatosFormulario["lugar"]}', '0','2')";
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
$consulta = BDConexion::getInstancia()->query($query);

if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
}
<<<<<<< HEAD
/*$idUsuario = BDConexion::getInstancia()->insert_id;
foreach ($DatosFormulario["rol"] as $idRol) {
    $query = "INSERT INTO usuario_rol "
            . "VALUES ({$idUsuario}, {$idRol})";
    $consulta = BDConexion::getInstancia()->query($query);
    if (!$consulta) {
        BDConexion::getInstancia()->rollback();
        //arrojar una excepcion
        die(BDConexion::getInstancia()->errno);
    }
}*/
=======

>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
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
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Crear Curso</h3>
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
                    <a href="index_2.php">
                        <button type="button" class="btn btn-primary">
<<<<<<< HEAD
                            <span class="oi oi-account-logout"></span> Volver Menu
=======
                            <span class="oi oi-account-logout"></span> Volver al Menú
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
