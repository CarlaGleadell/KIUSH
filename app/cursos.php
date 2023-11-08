<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/ColeccionCursos.php';
$ColeccionCursos = new ColeccionCursos();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Cursos</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Cursos</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="curso.crear.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Nuevo Curso
                        </button>
                    </a>
                    <form class="d-flex" action="curso.buscar.php" method="get">
                        <input name ="busquedaCurso" class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar curso por nombre" aria-label="Buscar">
                        <button  class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                    </p>

                    
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Cursos Cargados</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php foreach ($ColeccionCursos->getCursos() as $Curso) {
                                ?>
                                <td style="width: 80%"><?= $Curso->getNombre(); ?><br /><?= $Curso->getDescripcion(); ?></td>
                                <td  style="width: 20%">
                                    <a title="Ver detalle" href="curso.ver.php?id=<?= $Curso->getId(); ?>">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button></a>
                                    <a title="Modificar" href="curso.modificar.php?id=<?= $Curso->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button></a>
                                    <a title="Eliminar" href="curso.eliminar.php?id=<?= $Curso->getId(); ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="oi oi-trash"></span>
                                        </button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>


