<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$Datos = $_POST;
$idIntegrante = $Datos['id_integrante'];
$idCurso = $Datos['id_curso'];

$query = "INSERT INTO curso_integrante 
    (curso_id, integrante_id, rol, afeccionHorasSemanales, afeccionTotalHoras, instituto, categoriaDocente, dedicacion, categoriaExtensionista, organizacion, funcion, nivelEstudios, ocupacion)
    VALUES (
        '{$idCurso}', '{$idIntegrante}', 
        '{$Datos["rol"]}', '{$Datos["afeccionHorasSemanales"]}', '{$Datos["afeccionTotalHoras"]}', 
        '{$Datos["instituto"]}', '{$Datos["categoriaDocente"]}', '{$Datos["dedicacion"]}', 
        '{$Datos["categoriaExtensionista"]}', '{$Datos["organizacion"]}', '{$Datos["funcion"]}', 
        '{$Datos["nivelEstudios"]}', '{$Datos["ocupacion"]}'
    )";
$consulta = BDConexion::getInstancia()->query($query);
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <title>Asignar datos al integrante en el curso</title>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h3>Agregar integrante al curso</h3>
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
                <a href="integrantes.curso.php?id=<?= $idCurso ?>" class="btn btn-primary">Volver a integrantes del curso</a>
            </div>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>