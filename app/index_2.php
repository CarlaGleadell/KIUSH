<?php
include_once '../lib/ControlAcceso.Class.php'; 
include_once '../modelo/ColeccionCursos.php';
include_once '../modelo/ColeccionIntegrantes.php';
$ColeccionCursos = new ColeccionCursos();
$ColeccionIntegrantes = new ColeccionIntegrantes();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Menu Principal</title>
        <style>
            .dictantes-list {
                list-style: none;
                padding-left: 0;
                margin-bottom: 0;
            }
            .dictantes-list li {
                display: flex;
                align-items: center;
                margin-bottom: 4px;
                font-size: 0.98em;
                background: #e9ecef;
                border-radius: 12px;
                padding: 2px 10px;
                margin-right: 5px;
                margin-top: 2px;
            }
            .dictantes-list .oi {
                margin-right: 6px;
                color: #007bff;
                font-size: 1em;
            }
            .info-dictado {
                margin-top: 10px;
                padding: 8px 12px;
                background: #f8f9fa;
                border-radius: 10px;
                font-size: 0.97em;
                box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            }
            .info-dictado .oi {
                margin-right: 6px;
                color: #17a2b8;
            }
            .info-dictado span {
                display: block;
                margin-bottom: 2px;
            }
        </style>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>
        
        <div class="container">
            <div class="card-header">
                <h3>Sistemas de inscripción a cursos </h3>
            </div>
            <div class="container">
                <div class="row">
                <?php foreach ($ColeccionCursos->getCursos() as $Curso) {
                $imagen = '../lib/img/'. $Curso->getImagen();
                ?>
                    <div class="col-md-4" style="margin-bottom: 30px;">
                        <div class="card" style="margin: 15px; display: flex; flex-direction: column; height: 100%;">
                        <a style="text-decoration: none; color: inherit;">
                            <img src='<?php echo $imagen ?>' style="width:100%; height: 120px; object-fit:cover" class="card-img-top">
                            <div class="card-body" style="flex: 1; overflow: auto;">
                                <h5 class="card-title" style="height: 3em; overflow: hidden;"><?php echo $Curso->getNombre(); ?></h5>
                                
                                <p class="card-text mb-1"><b>Dictantes</b></p>
                                <?php
                                $integrantesDelCurso = $ColeccionIntegrantes->getIntegrantesPorCurso($Curso->getId());
                                if (count($integrantesDelCurso) > 0) {
                                    echo '<ul class="dictantes-list">';
                                    foreach ($integrantesDelCurso as $Integrante) {
                                        echo '<li><span class="oi oi-person"></span>' . htmlspecialchars($Integrante['nombres'] . " " . $Integrante['apellidos']) . '</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo '<span class="text-muted">Sin dictantes asignados</span>';
                                }
                                ?>
                                
                                <div class="info-dictado">
                                    <div class="mb-2">
                                        <span class="oi oi-clock" style="margin-right:6px; color:#17a2b8; vertical-align:middle;"></span>
                                        <b>Horario:</b>
                                        <div style="margin-left:24px; margin-top:2px;">
                                            <?= htmlspecialchars($Curso->getFechasDictado()) ?>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="oi oi-map-marker" style="margin-right:6px; color:#17a2b8; vertical-align:middle;"></span>
                                        <b>Lugar:</b>
                                        <div style="margin-left:24px; margin-top:2px;">
                                            <?= htmlspecialchars($Curso->getLugar()) ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_CURSOS)) { ?>
                                        <button type="button" class="btn btn-outline-success btn-block mb-2" style="width:100%;" onclick="window.location.href='curso.modificar.php?id=<?= $Curso->getId(); ?>'">
                                            Editar
                                        </button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-outline-primary btn-block" style="width:100%;" onclick="window.location.href='persona.crear.php?id=<?= $Curso->getId(); ?>'">
                                        Inscribirse
                                    </button>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>  
                    <?php } ?>             
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>