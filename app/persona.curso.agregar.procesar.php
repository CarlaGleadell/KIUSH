<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../lib/Constantes.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$DatosFormulario = $_POST;
$idPersona = $_GET["id_persona"];
$idCurso = $_GET["id_curso"];

// Obtener el nombre de la persona
$queryPersona = "SELECT CONCAT(nombre, ' ', apellido) as nombre_completo FROM persona WHERE id = ?";
$stmtPersona = BDConexion::getInstancia()->prepare($queryPersona);
$stmtPersona->bind_param("i", $idPersona);
$stmtPersona->execute();
$resultPersona = $stmtPersona->get_result();
$persona = $resultPersona->fetch_assoc();
$nombrePersona = $persona['nombre_completo'];

// Obtener el nombre del curso
$queryCurso = "SELECT nombre FROM curso WHERE id = ?";
$stmtCurso = BDConexion::getInstancia()->prepare($queryCurso);
$stmtCurso->bind_param("i", $idCurso);
$stmtCurso->execute();
$resultCurso = $stmtCurso->get_result();
$curso = $resultCurso->fetch_assoc();
$nombreCurso = $curso['nombre'];

// Verificar si la persona ya está inscrita en el curso
$queryVerificar = "SELECT * FROM curso_persona WHERE curso_id = ? AND persona_id = ?";
$stmtVerificar = BDConexion::getInstancia()->prepare($queryVerificar);
$stmtVerificar->bind_param("ii", $idCurso, $idPersona);
$stmtVerificar->execute();
$resultVerificar = $stmtVerificar->get_result();

$yaInscripto = $resultVerificar->num_rows > 0;
$success = false;

if (!$yaInscripto) {
    BDConexion::getInstancia()->autocommit(false);
    BDConexion::getInstancia()->begin_transaction();

    $query = "INSERT INTO curso_persona (curso_id, persona_id, estado, pago, nota, asistencia) 
              VALUES (?, ?, 'Preinscripto', null, null, null)";
    $stmt = BDConexion::getInstancia()->prepare($query);
    $stmt->bind_param("ii", $idCurso, $idPersona);
    $success = $stmt->execute();

    if (!$success) {
        BDConexion::getInstancia()->rollback();
        die(BDConexion::getInstancia()->errno);
    }

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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar preinscripto</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Agregar preinscripto a curso</h3>
                </div>
                <div class="card-body">
                    <?php if ($yaInscripto) { ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo htmlspecialchars($nombrePersona) ?> ya se encuentra preinscripto/a al curso <?php echo htmlspecialchars($nombreCurso) ?>.
                        </div>
                    <?php } else if ($success) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="personas.php?id=<?= $idCurso;?>">
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