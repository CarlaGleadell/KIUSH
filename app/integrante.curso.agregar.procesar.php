<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$idIntegrante = $_GET["id_integrante"];
$idCurso = $_GET["id_curso"];
$consulta = false;
$error = null;
$yaExiste = false;
if (!$yaExiste) {
    header("Location: integrante.curso.datos.php?id_integrante={$idIntegrante}&id_curso={$idCurso}");
    exit;
}
$queryVerificar = "SELECT * FROM curso_integrante WHERE curso_id = '{$idCurso}' AND integrante_id = '{$idIntegrante}'";
$resultadoVerificar = BDConexion::getInstancia()->query($queryVerificar);
$yaExiste = $resultadoVerificar->num_rows > 0;

if (!$yaExiste) {
    BDConexion::getInstancia()->autocommit(false);
    BDConexion::getInstancia()->begin_transaction();

    $query = "INSERT INTO curso_integrante (curso_id, integrante_id)" 
    . "VALUES ('{$idCurso}', '{$idIntegrante}')";
    $consulta = BDConexion::getInstancia()->query($query);

    if (!$consulta) {
        BDConexion::getInstancia()->rollback();
        $error = BDConexion::getInstancia()->errno;
        BDConexion::getInstancia()->autocommit(true);
    } else {
        BDConexion::getInstancia()->commit();
        BDConexion::getInstancia()->autocommit(true);
    }
}
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
                    <h3>Agregar integrante a curso</h3>
                </div>
                <div class="card-body">
                    <?php if ($yaExiste) { ?>
                        <div class="alert alert-warning" role="alert">
                            Este integrante ya pertenece al curso.
                        </div>
                    <?php } else if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. <?php echo $error ? $error : ''; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="integrantes.curso.php?id=<?php echo $idCurso; ?>">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver a lista de integrantes
                        </button>
                    </a>
                    <a href="cursos.php">
                        <button type="button" class="btn btn-secondary">
                            <span class="oi oi-account-logout"></span> Volver a cursos
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>