<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$idPersona = $DatosFormulario["id"];

$tipo = isset($DatosFormulario["tipo"]) ? $DatosFormulario["tipo"] : '';
$carrera = isset($DatosFormulario["carrera"]) ? $DatosFormulario["carrera"] : '';

if ($tipo == '4' || $tipo == '3') {
    $carrera = 'NULL';
} else {
    $carrera = "'".$carrera."'";
}

BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

$query = "UPDATE persona "
        . "SET nombre = '".trim($DatosFormulario["nombre"])."', "
        . "apellido = '".trim($DatosFormulario["apellido"])."', "
        . "email = '".trim($DatosFormulario["email"])."', "
        . "dni = '".trim($DatosFormulario["dni"])."', " 
        . "tipo_id = '".$tipo."', "
        . "carrera_Cod = ".$carrera." "
        . "WHERE id = ".$idPersona;

$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    $error = BDConexion::getInstancia()->error;
    BDConexion::getInstancia()->autocommit(true);
} else {
    BDConexion::getInstancia()->commit();
    BDConexion::getInstancia()->autocommit(true);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Actualizar Inscripto</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Actualizar Inscripto</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($consulta) && $consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error: <?php echo isset($error) ? $error : 'Error desconocido'; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="personas.php">
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