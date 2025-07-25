<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$idIntegrante = $DatosFormulario["id"];


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



$query = "UPDATE integrante "
        . "SET nombres = '{$DatosFormulario["nombre"]}', apellidos = '{$DatosFormulario["apellido"]}',
         dni = '{$DatosFormulario["dni"]}', titulo = '{$DatosFormulario["titulo"]}', instituto = '{$DatosFormulario["instituto"]}',
         categoriaDocente = '{$DatosFormulario["categoriaDocente"]}', dedicacion = '{$DatosFormulario["dedicacion"]}',
         categoriaExtensionista = '{$DatosFormulario["categoriaExtensionista"]}', direccion = '{$DatosFormulario["direccion"]}', 
         direccion_CodPostal = '{$DatosFormulario["direccion_CodPostal"]}', telefono = '{$DatosFormulario["telefono"]}',
         rol ='{$rolNombre}', email = '{$DatosFormulario["email"]}', organizacion = '{$DatosFormulario["organizacion"]}',
         funcion = '{$DatosFormulario["funcion"]}', nivelEstudios = '{$DatosFormulario["nivelEstudios"]}', ocupacion = '{$DatosFormulario["ocupacion"]}',
         afeccionHorasSemanales = '{$DatosFormulario["afeccionHorasSemanales"]}', afeccionTotalHoras = '{$DatosFormulario["afeccionTotalHoras"]}',
         tipo_id = '{$DatosFormulario["tipo"]}',  carrera_Cod = '{$DatosFormulario["carrera"]}'"
        . "WHERE id = {$idIntegrante}";
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar integrante</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Modificar integrante <?php{$DatosFormulario["nombre"]}?> </h3>
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
                    <a href="integrantes.gestionar.php">
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
