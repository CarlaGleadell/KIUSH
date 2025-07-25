<?php
include_once '../lib/Constantes.Class.php';
include_once '../modelo/ColeccionCursos.php';
include_once '../modelo/ColeccionIntegrantes.php';
$ColeccionCursos = new ColeccionCursos();
$ColeccionIntegrantes = new ColeccionIntegrantes();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" />  
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Cursos Disponibles</title>
    </head>
    <body>
        <?php include_once '../gui/navbar_visitante.php'; ?>
        
        <div class="container">
            <div class="card-header">
                <h3>Cursos Disponibles</h3>
            </div>
                
            <div class="container">
                <div class="row">
                <?php foreach ($ColeccionCursos->getCursos() as $Curso) {
                    if ($Curso->getEstado() == '1') { 
                        $imagen = '../lib/img/'. $Curso->getImagen();?>
                        <div class="col-md-4" style="margin-bottom: 30px;">
                            <div class="card" style="margin: 15px; display: flex; flex-direction: column; height: 100%;">
                                <img src='<?php echo $imagen ?>' style="width:100%; height: 120px; object-fit:cover" class="card-img-top">
                                <div class="card-body" style="flex: 1; overflow: auto;">
                                    <h5 class="card-title" style="height: 3em; overflow: hidden;"><?php echo $Curso->getNombre(); ?></h5>

                                    <p class="card-text">Dictantes</p>
                                    <?php
                                    $integrantesDelCurso = $ColeccionIntegrantes->getIntegrantesPorCurso($Curso->getId());
                                    foreach ($integrantesDelCurso as $Integrante) { ?>
                                        <span class="badge bg-primary"><?php echo $Integrante->getNombres() . " " . $Integrante->getApellidos();?></span>
                                    <?php } ?>
                                    
                                    <p class="card-text" style="height: 3em; overflow: hidden;"><?php echo $Curso->getFechasDictado(); ?></p>
                                    <div style="display: flex;">                         
                                        <a href="persona.crear.php?id=<?= $Curso->getId(); ?>" class="btn btn-outline-primary">Inscribirse</a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    <?php 
                    }
                } ?>             
                </div>
            </div>
        </div>
        <footer class="footer">
            KIUSH
            <span class="oi oi-person"></span> 
            UNPA-UARG
        </footer>
    </body>
</html>
