<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/BDConexion.Class.php';

$idCurso = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);

if (!$idCurso) {
    die('Error: No se recibió el ID del curso.');
}

// Elimina los registros relacionados en curso_integrante
$queryIntegrantes = "DELETE FROM curso_integrante WHERE curso_id = {$idCurso}";
$consultaIntegrantes = BDConexion::getInstancia()->query($queryIntegrantes);

// Elimina los registros relacionados en curso_persona
$queryPersonas = "DELETE FROM curso_persona WHERE curso_id = {$idCurso}";
$consultaPersonas = BDConexion::getInstancia()->query($queryPersonas);

// Elimina el curso
$queryCurso = "DELETE FROM curso WHERE id = {$idCurso}";
$consulta = BDConexion::getInstancia()->query($queryCurso);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Eliminar Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Eliminar Curso</h3>
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
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="cursos.php">
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