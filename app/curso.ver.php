<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/Cursos.Class.php';
$Curso = new Curso($_GET["id"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Datos del Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Datos del Curso</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-text">Nombre</h4>
                    <p> <?= $Curso->getNombre(); ?></p>
                    
                    <h4 class="card-text">Descripcion</h4>
                    <p> <?= $Curso->getDescripcion(); ?></p>
                    <hr />
                    <h4 class="card-text">Días y Horarios en que se dictará</h4>
                    <p> <?= $Curso->getFechasDictado(); ?></p>
                    <hr />
                    <h4 class="card-text">Espacio de dictado de dictadopcion</h4>
                    <p> <?= $Curso->getLugar(); ?></p>
                    <hr />
                    <h4 class="card-text">Inicio de las inscripciones</h4>
                    <p> <?= $Curso->getFechaInicioInscripcion(); ?></p>
                    <hr />
                    <h4 class="card-text">Cierre de las inscripciones</h4>
                    <p> <?= $Curso->getFechaFinInscripcion(); ?></p>
                    <hr />
                    <h4 class="card-text">Estado del curso</h4>
                    <?php /**en esta parte debera mostrarse inscrpciones abiertas o cerradas
                     * de acuerdo con la fechaInicioInscripcion y fechaFinInscripcion */ ?>
                    <p> <?= $Curso->getEstado(); ?></p>
                    <hr />
                    <h4 class="card-text">Publicado por el usuario</h4>
                    <?php /*En esta parte se debera concatenar las tablas de usuario y curso
                    para poder mostrar el nombre del usuario que publica el curso*/?>
                    <p> <?= $Curso->getUsuario_id(); ?></p>
                    <input type="hidden" name="id" class="form-control" id="id" value="<?= $Curso->getId(); ?>" >
                    <hr />
                    


                    <div class="card-footer" style="display: flex; justify-content: space-between;">
                        <div style="display:flex;">
                            <a href="cursos.php">
                                <button type="button" class="btn btn-primary">
                                    <span class="oi oi-account-logout"></span> Atrás
                                </button>
                            </a>
                        </div>
                        <a href="integrante.ver.php" >
                            <button type="button" class="btn btn-outline-primary">
                                Ver Integrantes
                            </button>
                        </a>
                    </div>

                    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
