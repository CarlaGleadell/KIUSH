<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/Integrante.Class.php';

$Integrante = new Integrante($_GET["id"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> Integrantes</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Datos de Integrantes
                    </h3>
                </div>
                <div class="card-body">
                    <h4 class="card-text">Nombres</h4>
                        <p> <?= $Integrante->getNombres(); ?></p>
                    <hr />
                    <h4 class="card-text">Apellidos</h4>
                        <p> <?= $Integrante->getApellidos(); ?></p>
                    <hr />
                    <h4 class="card-text">DNI</h4>
                        <p> <?= $Integrante->getDni(); ?></p>
                    <hr />
                    <h4 class="card-text">Titulo</h4>
                        <p> <?= $Integrante->getTitulo(); ?></p>
                    <hr />
                    <h4 class="card-text">Instituto</h4>
                        <p> <?= $Integrante->getInstituto(); ?></p>
                    <hr />
                    <h4 class="card-text">Categoría docente</h4>
                        <p> <?= $Integrante->getCategoriaDocente(); ?></p>
                    <hr />
                    <h4 class="card-text">Dedicación</h4>
                        <p> <?= $Integrante->getDedicacion(); ?></p>
                    <hr />
                    <h4 class="card-text">Categoría extensionista</h4>
                        <p> <?= $Integrante->getCategoriaExtensionista(); ?></p>
                    <hr />
                    <h4 class="card-text">Dirección</h4>
                        <p> <?= $Integrante->getDireccion(); ?></p>
                    <hr />
                    <h4 class="card-text">Código Postal</h4>
                        <p> <?= $Integrante->getDireccion_CodPostal(); ?></p>
                    <hr />
                    <h4 class="card-text">Teléfono</h4>
                        <p> <?= $Integrante->getTelefono(); ?></p>
                    <hr />
                    <h4 class="card-text">Rol</h4>
                        <p> <?= $Integrante->getRol(); ?></p>
                    <hr />
                    <h4 class="card-text">Email</h4>
                        <p> <?= $Integrante->getEmail(); ?></p>
                    <hr />
                    <h4 class="card-text">Organización</h4>
                        <p> <?= $Integrante->getOrganizacion(); ?></p>
                    <hr />
                    <h4 class="card-text">Función</h4>
                        <p> <?= $Integrante->getFuncion(); ?></p>
                    <hr />
                    <h4 class="card-text">Nivel de estudios</h4>
                        <p> <?= $Integrante->getNivelEstudios(); ?></p>
                    <hr />
                    <h4 class="card-text">Ocupación</h4>
                        <p> <?= $Integrante->getOcupacion(); ?></p>
                    <hr />
                    <h4 class="card-text">Afección de horas semanales a la actividad</h4>
                        <p> <?= $Integrante->getAfeccionHorasSemanales(); ?></p>
                    <hr />
                    <h4 class="card-text">Afección total de horas a la actividad</h4>
                        <p> <?= $Integrante->getAfeccionTotalHoras(); ?></p>
                    <hr />                    
                    <h4 class="card-text">Tipo</h4>
                        <p> <?= $Integrante->getTipo_id(); ?></p>
                    <hr />
                    <h4 class="card-text">Carrera</h4>
                        <p> <?= $Integrante->getCarrera_Cod(); ?></p>
                    <hr />
                   
                    <h5 class="card-text">Opciones</h5>
                    <a href="integrantes.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Atras
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
