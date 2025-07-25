<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/Cursos.Class.php';
$Curso = new Curso($_GET["id"]);
$imagen = '../lib/img/' . $Curso->getImagen();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Datos del Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Curso: <?= $Curso->getNombre(); ?></h3>
                </div>
                <div class="card-body">
                    <p class="card-text"><strong>Nombre</strong></p>
                    <p> <?= $Curso->getNombre(); ?></p>
                    
                    <p class="card-text"><strong>Descripcion</strong></p>
                    <p> <?= $Curso->getDescripcion(); ?></p>
                    <hr />
                    <p class="card-text"><strong>Días y Horarios en que se dictará</strong></p>
                    <p> <?= $Curso->getFechasDictado(); ?></p>
                    <hr />
                    <p class="card-text"><strong>Espacio de dictado de dictadopcion</strong></p>
                    <p> <?= $Curso->getLugar(); ?></p>
                    <hr />
                    <p class="card-text"><strong>Inicio de las inscripciones</strong></p>
                    <p> <?= $Curso->getFechaInicioInscripcion(); ?></p>
                    <hr />
                    <p class="card-text"><strong>Cierre de las inscripciones</strong></p>
                    <p> <?= $Curso->getFechaFinInscripcion(); ?></p>
                    <hr />
                    <p class="card-text"><strong>Estado</strong></p>
                    <p> 
                    <?php 
                    $estado = $Curso->getEstado();
                    if ($estado == 0) {
                        echo "Inscripciones deshabilitadas";
                    } else {
                        if ($estado == 1) {
                            echo "Inscripciones habilitadas";
                        }
                    }
                    ?>
                    </p>
                    <hr />
                    <p class="card-text"><strong>Publicado por:</strong></p>
                    <p> 
                    <?php
                    $id_usuario = $Curso->getUsuario_id();
                    $query = "SELECT nombre FROM bdkiush.usuario WHERE id = {$id_usuario}";
                    $resultado = BDConexion::getInstancia()->query($query);
                    if ($resultado->num_rows > 0) {
                        $fila = $resultado->fetch_assoc();
                        echo $fila['nombre'];
                    }
                    ?>
                    </p>
                    <input type="hidden" name="id" class="form-control" id="id" value="<?= $Curso->getId(); ?>" >
                    <hr />
                    
                    <div style="display:flex;">
                        <img src="<?= $imagen ?>" style="width:50%;">
                    </div>

                    <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <a href="cursos.php">
                                <button type="button" class="btn btn-primary">
                                    <span class="oi oi-account-logout"></span> Atrás
                                </button>
                            </a>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="viewDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Ver
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="viewDropdown">
                                <li><a class="dropdown-item" href="integrantes.curso.php?id=<?= $Curso->getId(); ?>">Integrantes</a></li>
                                <li><a class="dropdown-item" href="personas.curso.php?id=<?= $Curso->getId(); ?>">Preinscriptos</a></li>
                            </ul>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="downloadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Descargar
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                                <li><a class="dropdown-item" href="curso.inscriptos.descargar.php?id=<?= $Curso->getId(); ?>">Listado de inscriptos</a></li>
                                <li><a class="dropdown-item" href="curso.csv.descargar.php?id=<?= $Curso->getId(); ?>">Archivo CSV</a></li>
                            </ul>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
