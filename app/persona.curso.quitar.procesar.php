<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/BDConexion.Class.php';
include_once '../lib/Constantes.Class.php';

// 1) Tomar POST y, si no hay, fallback a GET (evita Undefined array key)
$idPersona = isset($_POST["id"]) ? intval($_POST["id"]) :
            (isset($_GET["id"]) ? intval($_GET["id"]) : 0);

$idCurso   = isset($_POST["id_curso"]) ? intval($_POST["id_curso"]) :
            (isset($_GET["id_curso"]) ? intval($_GET["id_curso"]) : 0);

// 2) Validaciones tempranas
$ok = false;
$err = null;

if ($idPersona <= 0 || $idCurso <= 0) {
    $err = "Datos insuficientes para eliminar la preinscripción (id_persona o id_curso ausentes).";
} else {
    // 3) Eliminar SOLO del curso actual (prepared)
    BDConexion::getInstancia()->autocommit(false);
    BDConexion::getInstancia()->begin_transaction();
    try {
        $stmt = BDConexion::getInstancia()->prepare(
            "DELETE FROM curso_persona WHERE curso_id = ? AND persona_id = ?"
        );
        $stmt->bind_param("ii", $idCurso, $idPersona);
        $ok = $stmt->execute();

        if ($ok) {
            BDConexion::getInstancia()->commit();
        } else {
            BDConexion::getInstancia()->rollback();
            $err = "No se pudo eliminar la preinscripción.";
        }
    } catch (Exception $e) {
        BDConexion::getInstancia()->rollback();
        $ok = false;
        $err = "Error: " . $e->getMessage();
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Quitar preinscripto</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Quitar preinscripto</h3>
                </div>
                <div class="card-body">
                    <?php if ($ok): ?>
                        <div class="alert alert-success" role="alert">
                            Operación realizada con éxito.
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($err ?: 'Ha ocurrido un error.'); ?>
                        </div>
                    <?php endif; ?>

                    <a href="personas.curso.php?id=<?= $idCurso ?: 0; ?>" class="btn btn-outline-secondary">
                        <span class="oi oi-account-logout"></span> Volver al curso
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
