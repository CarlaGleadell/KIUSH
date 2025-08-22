<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$Datos = $_POST;
$id = $Datos['id'];

$query = "UPDATE curso_integrante SET
    rol = '{$Datos["rol"]}',
    afeccionHorasSemanales = '{$Datos["afeccionHorasSemanales"]}',
    afeccionTotalHoras = '{$Datos["afeccionTotalHoras"]}',
    instituto = '{$Datos["instituto"]}',
    categoriaDocente = '{$Datos["categoriaDocente"]}',
    dedicacion = '{$Datos["dedicacion"]}',
    categoriaExtensionista = '{$Datos["categoriaExtensionista"]}',
    organizacion = '{$Datos["organizacion"]}',
    funcion = '{$Datos["funcion"]}',
    nivelEstudios = '{$Datos["nivelEstudios"]}',
    ocupacion = '{$Datos["ocupacion"]}'
    WHERE id = '{$id}'";
$consulta = BDConexion::getInstancia()->query($query);
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <title>Modificar datos del integrante en el curso</title>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h3>Modificar datos del integrante en el curso</h3>
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
                <a href="integrantes.curso.php?id=<?= $Datos['curso_id'] ?>" class="btn btn-primary">Volver a integrantes del curso</a>
            </div>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>