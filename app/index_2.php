<?php include_once '../lib/ControlAcceso.Class.php'; 
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
                            <div class="card-body"style="flex: 1; overflow: auto;">
                                <h5 class="card-title" style="height: 3em; overflow: hidden;"><?php echo $Curso->getNombre(); ?></h5>
                                
                                <p class="card-text" >Dictantes</p>
                                <?php
                                $integrantesDelCurso = $ColeccionIntegrantes->getIntegrantesPorCurso($Curso->getId());
                                foreach ($integrantesDelCurso as $Integrante) { ?>
                                    <span class="badge bg-primary"><?php echo $Integrante->getNombres() . " " . $Integrante->getApellidos();?></span>
                                <?php } ?>
                                
                                
                                <p class="card-text" style="height: 3em; overflow: hidden;"><?php echo $Curso->getFechasDictado(); ?></p>
                                <div style="display: flex;">         
                                    <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_CURSOS)) { ?>
                                        <button type="button" class="btn btn-outline-success" onclick="window.location.href='curso.modificar.php?id=<?= $Curso->getId(); ?>'" style="margin-right: 10px;">Editar</button>
                                    <?php } ?>
                                    
                                    <button type="button" class="btn btn-outline-primary" onclick="window.location.href='persona.crear.php?id=<?= $Curso->getId(); ?>'">Inscribirse</button>
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
