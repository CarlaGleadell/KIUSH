<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/ColeccionIntegrantes.php';
include_once '../modelo/Cursos.Class.php';
$ColeccionIntegrantes = new ColeccionIntegrantes();
$id = $_GET["id"];
$Curso = new Curso($id); 
$integrantesDelCurso = $ColeccionIntegrantes->getIntegrantesPorCurso($id);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Integrantes</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Integrantes de <?= $Curso->getNombre(); ?> </h3>
                </div>
                <div class="card-body" style="text-align: centrer;">
         
  
                <table class="table table-hover table-sm">
                   

                    <?php
                    if(empty($integrantesDelCurso)) {
                        echo "<p style='color:gray; display: flex; justify-content: center;'>No se encontraron integrantes en este curso</p>";
                    } else {  ?>                     
                    
                    <tr class="table-info">
                    <th>Rol</th>
                    <th>Nombre/s</th>
                    <th>Apellido/s</th>
                    <th>Opciones</th>
                    </tr>
                    <?php
                        foreach ($integrantesDelCurso as $Integrante) {
                    ?>
                        <tr>
                            <td><?= $Integrante->getRol(); ?></td>
                            <td><?= $Integrante->getNombres(); ?></td>
                            <td><?= $Integrante->getApellidos(); ?></td>
                            <td>
                                <a title="Ver detalle" href="integrante.ver.php?id<?= $Integrante->getId(); ?>">
                                    <button type="button" class="btn btn-outline-info">
                                        <span class="oi oi-zoom-in"></span>
                                    </button>
                                </a>
                                <a title="Modificar" href="integrante.modificar.php?id=<?= $Integrante->getId();?>">
                                    <button type="button" class="btn btn-outline-warning">
                                        <span class="oi oi-pencil"></span>
                                    </button>
                                </a>
                                
                                <a title="Quitar de este curso" href="integrante.curso.quitar.php?id=<?= $Integrante->getId(); ?>&id_curso=<?= $Curso->getId(); ?>">
                                    <button type="button" class="btn btn-outline-danger">
                                        <span class="oi oi-minus"></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } }?>
                    
                </table>
                <div style="display: flex; justify-content: center;">
                    <a href="integrantes.php?id=<?= $id; ?>">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-plus"></span> Agregar integrante
                        </button>
                    </a>
                </div>
                
            </div>
            <div><?php if(is_null($integrantesDelCurso)) {echo '<h5 align="center" style="color:gray;">No se encontraron integrantes con ese nombre</h5>';}?></div>
            </div>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>

