<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$Datos = $_POST;
$id = $Datos['id'];

$query = "UPDATE integrante SET
    nombres = '{$Datos["nombres"]}',
    apellidos = '{$Datos["apellidos"]}',
    dni = '{$Datos["dni"]}',
    titulo = '{$Datos["titulo"]}',
    direccion = '{$Datos["direccion"]}',
    direccion_CodPostal = '{$Datos["direccion_CodPostal"]}',
    telefono = '{$Datos["telefono"]}',
    email = '{$Datos["email"]}',
    tipo_id = '{$Datos["tipo_id"]}',
    carrera_Cod = '{$Datos["carrera_Cod"]}'
    WHERE id = '{$id}'";
$consulta = BDConexion::getInstancia()->query($query);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <title>Modificar Integrante</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Modificar Integrante</h3>
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