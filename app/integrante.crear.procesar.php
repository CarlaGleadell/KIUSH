<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$Datos = $_POST;
$tipo_id = isset($Datos["tipo_id"]) ? $Datos["tipo_id"] : '';
if ($tipo_id == '3' || $tipo_id == '4') {
    $carreraCod = "NULL";
} else {
    $carreraCod = (isset($Datos["carrera_Cod"]) && trim($Datos["carrera_Cod"]) !== '') ? "'{$Datos["carrera_Cod"]}'" : "NULL";
}

$query = "INSERT INTO integrante (
    nombres, apellidos, dni, titulo, direccion, direccion_CodPostal, telefono, email, tipo_id, carrera_Cod
) VALUES (
    '{$Datos["nombres"]}',
    '{$Datos["apellidos"]}',
    '{$Datos["dni"]}',
    '{$Datos["titulo"]}',
    '{$Datos["direccion"]}',
    '{$Datos["direccion_CodPostal"]}',
    '{$Datos["telefono"]}',
    '{$Datos["email"]}',
    '{$Datos["tipo_id"]}',
    $carreraCod
)";
$consulta = BDConexion::getInstancia()->query($query);

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
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Agregar Integrante</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operación realizada con éxito.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                        </div>
                    <?php } ?>
                    <a href="integrantes.gestionar.php" class="btn btn-primary">Volver a integrantes</a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>