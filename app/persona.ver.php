<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/Persona.Class.php';

$Persona = new Persona($_GET["id"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> Preinscriptos</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Datos de Preinscriptos
                    </h3>
                </div>
                <div class="card-body">
                    <h4 class="card-text">Nombres</h4>
                        <p> <?= $Persona->getNombre(); ?></p>
                    <hr />
                    <h4 class="card-text">Apellidos</h4>
                        <p> <?= $Persona->getApellido(); ?></p>
                    <hr />
                    <h4 class="card-text">Email</h4>
                        <p> <?= $Persona->getEmail(); ?></p>
                    <hr />
                    <h4 class="card-text">DNI</h4>
                        <p> <?= $Persona->getDni(); ?></p>
                    <hr />
                    <h4 class="card-text">Estado</h4>
                        <p> <?= $Persona->getEstado(); ?></p>
                    <hr />
                    <h4 class="card-text">Pago</h4>
                        <p> <?= $Persona->getPago(); ?></p>
                    <hr />
                    <h4 class="card-text">Tipo</h4>
                        <p> <?= $Persona->getTipo_id(); ?></p>
                    <hr />
                    <h4 class="card-text">Carrera</h4>
                        <p> <?= $Persona->getCarrera_Cod(); ?></p>
                    <hr />
                   
                    <h5 class="card-text">Opciones</h5>
                    <a href="personas.php">
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
