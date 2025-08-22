<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/ColeccionIntegrantes.php';
include_once '../modelo/Cursos.Class.php';
$ColeccionIntegrantes = new ColeccionIntegrantes();

// Buscador por DNI
$dniBuscado = isset($_GET['busquedaDNI']) ? trim($_GET['busquedaDNI']) : '';
$integrantesFiltradosDNI = [];
if ($dniBuscado !== '') {
    foreach ($ColeccionIntegrantes->getIntegrantes() as $Integrante) {
        if ($Integrante->getDni() === $dniBuscado) {
            $integrantesFiltradosDNI[] = $Integrante;
            break; // Solo uno, porque el DNI es único
        }
    }
}

// Buscador por nombre
$nombreBuscado = isset($_GET['busquedaNombre']) ? trim($_GET['busquedaNombre']) : '';
$integrantesFiltradosNombre = [];
if ($nombreBuscado !== '') {
    foreach ($ColeccionIntegrantes->getIntegrantes() as $Integrante) {
        if (stripos($Integrante->getNombres(), $nombreBuscado) !== false) {
            $integrantesFiltradosNombre[] = $Integrante;
        }
    }
}
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
                    <h3>Integrantes</h3>
                </div>
                <div class="card-body">
                <p>
                    <a href="integrante.crear.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Nuevo Integrante
                        </button>
                    </a>
                </p>
                
                <!-- Buscador por nombre -->
                <form class="d-flex mb-3" action="integrantes.gestionar.php" method="get">
                    <input name="busquedaNombre" class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar integrante por nombre" aria-label="Buscar" value="<?= htmlspecialchars($nombreBuscado) ?>">
                    <button class="btn btn-outline-primary" type="submit">Buscar por nombre</button>
                </form>

                <!-- Buscador por DNI -->
                <form class="d-flex mb-4" action="integrantes.gestionar.php" method="get">
                    <input name="busquedaDNI" class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar integrante por DNI" aria-label="Buscar DNI" value="<?= htmlspecialchars($dniBuscado) ?>">
                    <button class="btn btn-outline-primary" type="submit">Buscar por DNI</button>
                </form>

                <table class="table table-hover table-sm">
                    <tr class="table-info">
                        <th>DNI</th>
                        <th>Nombre/s</th>
                        <th>Apellido/s</th>
                        <th>Opciones</th>
                    </tr>

                    <?php
                    // Prioridad: si se buscó por DNI, mostrar solo ese resultado
                    if ($dniBuscado !== '') {
                        if (count($integrantesFiltradosDNI) > 0) {
                            foreach ($integrantesFiltradosDNI as $Integrante) { ?>
                                <tr>
                                    <td><?= $Integrante->getDni(); ?></td>
                                    <td><?= $Integrante->getNombres(); ?></td>
                                    <td><?= $Integrante->getApellidos(); ?></td>
                                    <td>
                                        <a title="Ver detalle" href="integrante.ver.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-zoom-in"></span>
                                            </button>
                                        </a>
                                        <a title="Modificar" href="integrante.modificar.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>
                                        <a title="Eliminar" href="integrante.eliminar.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo '<tr><td colspan="4" class="text-center text-muted">No se encontró ningún integrante con ese DNI</td></tr>';
                        }
                    } elseif ($nombreBuscado !== '') {
                        // Si se buscó por nombre, mostrar esos resultados
                        if (count($integrantesFiltradosNombre) > 0) {
                            foreach ($integrantesFiltradosNombre as $Integrante) { ?>
                                <tr>
                                    <td><?= $Integrante->getDni(); ?></td>
                                    <td><?= $Integrante->getNombres(); ?></td>
                                    <td><?= $Integrante->getApellidos(); ?></td>
                                    <td>
                                        <a title="Ver detalle" href="integrante.ver.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-zoom-in"></span>
                                            </button>
                                        </a>
                                        <a title="Modificar" href="integrante.modificar.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>
                                        <a title="Eliminar" href="integrante.eliminar.php?id=<?= $Integrante->getId(); ?>">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo '<tr><td colspan="4" class="text-center text-muted">No se encontró ningún integrante con ese nombre</td></tr>';
                        }
                    } else {
                        // Si no se buscó por DNI ni por nombre, mostrar todos
                        foreach ($ColeccionIntegrantes->getIntegrantes() as $Integrante) { ?>
                            <tr>
                                <td><?= $Integrante->getDni(); ?></td>
                                <td><?= $Integrante->getNombres(); ?></td>
                                <td><?= $Integrante->getApellidos(); ?></td>
                                <td>
                                    <a title="Ver detalle" href="integrante.ver.php?id=<?= $Integrante->getId(); ?>">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar" href="integrante.modificar.php?id=<?= $Integrante->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <a title="Eliminar" href="integrante.eliminar.php?id=<?= $Integrante->getId(); ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="oi oi-trash"></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>