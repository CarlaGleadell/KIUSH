<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/Persona.Class.php';
include_once '../modelo/Cursos.Class.php';

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$idCurso = isset($_GET["id_curso"]) ? intval($_GET["id_curso"]) : 0;

$Persona = new Persona($id);
$Curso = new Curso($idCurso);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title>Quitar preinscripto</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <form action="persona.curso.quitar.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Quitar preinscripto</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning" role="alert">
                            ¿Está seguro de quitar a <strong><?= htmlspecialchars($Persona->getNombre().' '.$Persona->getApellido()); ?></strong>
                            del curso <strong><?= htmlspecialchars($Curso->getNombre()); ?></strong>?
                        </div>

                        <!-- IMPORTANTES: estos ocultos por POST -->
                        <input type="hidden" name="id" id="id" value="<?= $Persona->getId(); ?>">
                        <input type="hidden" name="id_curso" id="id_curso" value="<?= $Curso->getId(); ?>">

                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Sí, deseo eliminar
                        </button>

                        <a href="personas.curso.php?id=<?= $Curso->getId(); ?>" class="btn btn-outline-danger">
                            <span class="oi oi-x"></span> NO (Salir de esta pantalla)
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
