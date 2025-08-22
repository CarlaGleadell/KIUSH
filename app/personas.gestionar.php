<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/ColeccionPersonas.php';
include_once '../modelo/Cursos.Class.php';
$ColeccionPersonas = new ColeccionPersonas();

// Buscador por DNI
$dniBuscado = isset($_GET['busquedaDNI']) ? trim($_GET['busquedaDNI']) : '';
$personasFiltradasDNI = [];

if ($dniBuscado !== '') {
    foreach ($ColeccionPersonas->getPersonas() as $Persona) {
        if ($Persona->getDni() === $dniBuscado) {
            $personasFiltradasDNI[] = $Persona;
            break; // Solo uno, porque el DNI es único
        }
    }
}

// Buscador por nombre
$nombreBuscado = isset($_GET['busquedaNombre']) ? trim($_GET['busquedaNombre']) : '';
$personasFiltradasNombre = [];

if ($nombreBuscado !== '') {
    foreach ($ColeccionPersonas->getPersonas() as $Persona) {
        if (stripos($Persona->getNombre(), $nombreBuscado) !== false) {
            $personasFiltradasNombre[] = $Persona;
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Inscriptos</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Inscriptos</h3>
                </div>
                <div class="card-body">

                <p>
                    <a href="persona.crear.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Nuevo inscripto
                        </button>
                    </a>
                </p>

                <!-- Buscador por nombre -->
                <form class="d-flex mb-3" action="personas.gestionar.php" method="get">
                    <input name="busquedaNombre" class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar inscripto por nombre" aria-label="Buscar" value="<?= htmlspecialchars($nombreBuscado) ?>">
                    <button class="btn btn-outline-primary" type="submit">Buscar por nombre</button>
                </form>

                <!-- Buscador por DNI -->
                <form class="d-flex mb-4" action="personas.gestionar.php" method="get">
                    <input name="busquedaDNI" class="form-control me-2 flex-grow-1" type="search" placeholder="Buscar inscripto por DNI" aria-label="Buscar DNI" value="<?= htmlspecialchars($dniBuscado) ?>">
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
                        if (count($personasFiltradasDNI) > 0) {
                            foreach ($personasFiltradasDNI as $Persona) { ?>
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
                                        <a title="Eliminar" href="persona.eliminar.php?id=<?= $Persona->getId(); ?>">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo '<tr><td colspan="4" class="text-center text-muted">No se encontró ningún inscripto con ese DNI</td></tr>';
                        }
                    } elseif ($nombreBuscado !== '') {
                        // Si se buscó por nombre, mostrar esos resultados
                        if (count($personasFiltradasNombre) > 0) {
                            foreach ($personasFiltradasNombre as $Persona) { ?>
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
                                        <a title="Eliminar" href="persona.eliminar.php?id=<?= $Persona->getId(); ?>">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo '<tr><td colspan="4" class="text-center text-muted">No se encontró ningún inscripto con ese nombre</td></tr>';
                        }
                    } else {
                        // Si no se buscó por DNI ni por nombre, mostrar todos
                        foreach ($ColeccionPersonas->getPersonas() as $Persona) { ?>
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
                                    <a title="Eliminar" href="persona.eliminar.php?id=<?= $Persona->getId(); ?>">
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