<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();



$query = "INSERT IGNORE INTO direccion "
        . "VALUES ('{$DatosFormulario["pais"]}','{$DatosFormulario["provincia"]}', 
        '{$DatosFormulario["localidad"]}','{$DatosFormulario["direccion_CodPostal"]}')";


$consulta = BDConexion::getInstancia()->query($query);

if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
}

$rol = $DatosFormulario["rol"];
$rolNombre = '';
switch ($rol) {
    case 1:
        $rolNombre = 'Director';
        break;
    case 2:
        $rolNombre = 'Co-director';
        break;
    case 3:
        $rolNombre = 'Integrante';
        break;
    case 4:
        $rolNombre = 'Integrante externo';
        break;
}

$query = "INSERT INTO integrante "
        . "VALUES (null,'{$DatosFormulario["nombre"]}','{$DatosFormulario["apellido"]}',
        '{$DatosFormulario["dni"]}','{$DatosFormulario["titulo"]}','{$DatosFormulario["instituto"]}',
        '{$DatosFormulario["categoriaDocente"]}','{$DatosFormulario["dedicacion"]}',
        '{$DatosFormulario["categoriaExtensionista"]}','{$DatosFormulario["direccion"]}',
        '{$DatosFormulario["direccion_CodPostal"]}', '{$DatosFormulario["telefono"]}',
        '{$rolNombre}', '{$DatosFormulario["email"]}','{$DatosFormulario["organizacion"]}',
        '{$DatosFormulario["funcion"]}','{$DatosFormulario["nivelEstudios"]}','{$DatosFormulario["ocupacion"]}',
        '{$DatosFormulario["afeccionHorasSemanales"]}','{$DatosFormulario["afeccionTotalHoras"]}',
        '{$DatosFormulario["tipo"]}','{$DatosFormulario["carrera_Cod"]}')";

$idIntegrante = BDConexion::getInstancia()->insert_id;
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
                <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar Integrante</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Agregar Integrante</h3>
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
                    <a href="integrantes.php">
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