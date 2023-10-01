<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
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
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Usuarios</title>
    </head>
    <body>

        <?php include_once '../gui/navbar_2.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Administracion de Cursos</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="curso.crear.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Nuevo Curso
                        </button>
                    </a>
                    </p>
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Cursos Cargados</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php foreach ($ColeccionCursos->getCurso() as $Cursos) {
                                ?>
                                <td style="width: 80%"><?= $Cursos->getNombre(); ?><br /><?= $Cursos->getDescripcion(); ?><br /><?= $Cursos->getEmail(); ?></td>
                                <td  style="width: 20%">
                                    <a title="Ver detalle" href="usuario.ver.php?id=<?= $Cursos->getId(); ?>">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button></a>
                                    <a title="Modificar" href="usuario.modificar.php?id=<?= $Cursos->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button></a>
                                    <a title="Eliminar" href="usuario.eliminar.php?id=<?= $Cursos->getId(); ?>">
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







<table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Usuario</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                        </tr>
                    </table>