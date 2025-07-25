<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/ColeccionPersonas.php';
include_once '../modelo/Cursos.Class.php';
$ColeccionPersonas = new ColeccionPersonas();
$idCurso = $_GET['id'];
$Curso = new Curso($idCurso); 
$personasDelCurso = $ColeccionPersonas->getPersonasPorCurso($idCurso);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Preinscriptos</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Preinscriptos de <?= $Curso->getNombre(); ?></h3>
                </div>
                <div class="card-body">
                          
               <table class="table table-hover table-sm">
                   
                <?php
                    if(empty($personasDelCurso)) {
                        echo "<p style='color:gray; display: flex; justify-content: center;'>No hay preinscriptos en este curso</p>";
                    } else {  ?> 
                    <tr class="table-info">
                        <th>DNI</th>
                        <th>Nombre/s</th>
                        <th>Apellido/s</th>
                        <th>Opciones</th>
                    </tr>

                    <?php foreach ($personasDelCurso as $Persona) {
                        ?>
                        <tr>
                            <td><?= $Persona->getDni(); ?></td>
                            <td><?= $Persona->getNombre(); ?></td>
                            <td><?= $Persona->getApellido(); ?></td>
                            <td>
                                <a title="Ver detalle" href="persona.ver.php?id=<?= $Persona->getId(); ?>">
                                    <button type="button" class="btn btn-outline-info">
                                        <span class="oi oi-zoom-in"></span>
                                    </button>
                                </a>
                                <a title="Modificar" href="persona.modificar.php?id=<?= $Persona->getId(); ?>">
                                    <button type="button" class="btn btn-outline-warning">
                                        <span class="oi oi-pencil"></span>
                                    </button>
                                </a>
                                
                                <a title="Quitar de este curso" href="persona.curso.quitar.php?id=<?= $Persona->getId(); ?>&id_curso=<?= $Curso->getId(); ?>">
                                    <button type="button" class="btn btn-outline-danger">
                                        <span class="oi oi-minus"></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php } }?>
                </table>
                <div style="display: flex; justify-content: center;">
                    <a href="personas.php?id=<?= $idCurso; ?>">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-plus"></span> Agregar preinscriptos
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>

