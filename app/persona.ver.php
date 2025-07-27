<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
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
                    <?php
                    $estado = "Preinscripto";
                    if($Persona->getEstado() > 0){
                        $estado = "Inscripto";
                    }
                    ?>
                    <h4 class="card-text">Estado</h4>
                        <p> <?= $estado ?></p>
                    <hr />
                    <?php
                    $pago = "No pagó";
                    if($Persona->getPago() > 0){
                        $pago = "Si pagó";
                    }
                    ?>
                    <h4 class="card-text">Pago</h4>
                        <p> <?= $pago ?></p>
                    <hr />

                    <?php
                    $tipo = $Persona->getTipo_id();
                    $tipoNombre = '';
                    switch ($tipo) {
                        case 1:
                            $tipoNombre = 'Estudiante de la UNPA-UARG';
                            break;
                        case 2:
                            $tipoNombre = 'Docente de la UNPA-UARG';
                            break;
                        case 3:
                            $tipoNombre = 'No docente de la UNPA-UARG';
                            break;
                        case 4:
                            $tipoNombre = 'Externo a la UNPA-UARG';
                            break;
                        case 5:
                            $tipoNombre = 'Graduado de la UNPA-UARG';
                            break;
                    }
                    ?>  
                    
                    <h4 class="card-text">Tipo</h4>
                        <p> <?= $tipoNombre; ?></p>
                    <hr />
                    <?php
                    $carrera = $Persona->getCarrera_Cod();
                    $carreraNombre = '';
                    switch ($carrera) {
                        case '001':
                            $carreraNombre = 'Profesorado en Letras';
                            break;
                        case '003':
                            $carreraNombre = 'Profesorado en Historia';
                            break;
                        case '004':
                            $carreraNombre = 'Profesorado en Geografía';
                            break;
                        case '016':
                            $carreraNombre = 'Analista de Sistemas';
                            break;
                        case '023':
                            $carreraNombre = 'Ingenieria en Recursos Naturales Renovables';
                            break;
                        case '045':
                            $carreraNombre = 'Licenciatura en Psicopedagogía';
                            break;
                        case '049':
                            $carreraNombre = 'Profesorado en Matemática';
                            break;
                        case '060':
                            $carreraNombre = 'Licenciatura en Letras';
                            break;
                        case '061':
                            $carreraNombre = 'Licenciatura en Turismo';
                            break;
                        case '062':
                            $carreraNombre = 'Tecnicatura Universitaria en Turismo';
                            break;
                        case '064':
                            $carreraNombre = 'Licenciatura en Geografía';
                            break;
                        case '069':
                            $carreraNombre = 'Ingeniería Química';
                            break;
                        case '072':
                            $carreraNombre = 'Licenciatura en Sistemas';
                            break;
                        case '074':
                            $carreraNombre = 'Licenciatura en Trabajo Social';
                            break;
                        case '076':
                            $carreraNombre = 'Tecnicatura Universitaria en Acompañamiento Terapéutico';
                            break;
                        case '093':
                            $carreraNombre = 'Título intermedio Enfermero/a - Licenciatura en Enfermería';
                            break;
                        case '096':
                            $carreraNombre = 'Licenciatura en Historia';
                            break;
                        case '912':
                            $carreraNombre = 'Tecnicatura Universitaria en Gestión de Organizaciones';
                            break;
                        case '913':
                            $carreraNombre = 'Licenciatura en Administración';
                            break;
                        case '914':
                            $carreraNombre = 'Profesorado en Economía y Gestión de Organizaciones';
                            break;
                        case '918':
                            $carreraNombre = 'Licenciatura en Comunicación Social';
                            break;
                    }
                    ?>  

                    <h4 class="card-text">Carrera</h4>
                        <p> <?= $carreraNombre; ?></p>
                    <hr />
                   
                   
                    
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
