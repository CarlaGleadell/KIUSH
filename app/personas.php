<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);

include_once '../modelo/BDConexion.Class.php';
include_once '../lib/Constantes.Class.php';

$idCurso = isset($_GET["id_curso"]) ? intval($_GET["id_curso"]) : 0;
$busquedaNombre = isset($_GET["busquedaNombre"]) ? trim($_GET["busquedaNombre"]) : '';

// Validar curso
$nombreCurso = null;
if ($idCurso > 0) {
    $stmtCurso = BDConexion::getInstancia()->prepare("SELECT nombre FROM curso WHERE id = ?");
    $stmtCurso->bind_param("i", $idCurso);
    $stmtCurso->execute();
    $resCurso = $stmtCurso->get_result();
    if ($fila = $resCurso->fetch_assoc()) {
        $nombreCurso = $fila['nombre'];
    }
    $stmtCurso->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
    <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
    <title><?= Constantes::NOMBRE_SISTEMA; ?> - Personas</title>
</head>
<body>
<?php include_once '../gui/navbar.php'; ?>

<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">Personas</h3>
            <?php if ($idCurso > 0): ?>
                <small class="text-muted">Curso: <?= htmlspecialchars($nombreCurso ?: ('ID '.$idCurso)) ?></small>
            <?php endif; ?>
        </div>

        <div class="card-body">

            <?php if ($idCurso <= 0 || !$nombreCurso): ?>
                <div class="alert alert-danger" role="alert">
                    El curso seleccionado no existe.
                </div>
                <a href="personas.curso.php?id=<?= $idCurso ?>" class="btn btn-outline-secondary">
                    <span class="oi oi-account-logout"></span> Volver
                </a>
            <?php else: ?>

                <!-- Buscador estilo integrantes.php (d-flex), SOLO por nombre/apellido -->
                <form class="d-flex mb-3" action="personas.php" method="get">
                    <input type="hidden" name="id_curso" value="<?= $idCurso ?>">
                    <input
                        name="busquedaNombre"
                        class="form-control mr-2"
                        type="search"
                        placeholder="Buscar persona (Nombre y/o Apellido)"
                        aria-label="Buscar"
                        value="<?= htmlspecialchars($busquedaNombre) ?>">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>

                <?php
                // Consulta: listar personas + flag si ya están en el curso
                $sql = "SELECT p.id, p.dni, p.nombre, p.apellido,
                               CASE WHEN cp.persona_id IS NULL THEN 0 ELSE 1 END AS yaInscripto
                        FROM persona p
                        LEFT JOIN curso_persona cp
                          ON cp.persona_id = p.id AND cp.curso_id = ?
                        WHERE 1=1";

                $params = [$idCurso];
                $types = "i";

                if ($busquedaNombre !== '') {
                    $sql .= " AND (CONCAT(p.nombre, ' ', p.apellido) LIKE ? OR CONCAT(p.apellido, ' ', p.nombre) LIKE ?)";
                    $like = "%".$busquedaNombre."%";
                    $params[] = $like;
                    $params[] = $like;
                    $types   .= "ss";
                }

                $sql .= " ORDER BY p.apellido, p.nombre LIMIT 300";

                $stmt = BDConexion::getInstancia()->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>

                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th style="width: 15%;">DNI</th>
                            <th style="width: 30%;">Nombre</th>
                            <th style="width: 30%;">Apellido</th>
                            <th class="text-center" style="width: 25%;">Acciones</th>
                        </tr>

                        <?php if ($result->num_rows === 0): ?>
                            <tr><td colspan="4" class="text-center">No se encontraron personas.</td></tr>
                        <?php else: ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['dni']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><?= htmlspecialchars($row['apellido']) ?></td>
                                    <td class="text-center">
                                        <!-- Ver -->
                                        <a title="Ver detalle" href="persona.ver.php?id=<?= $row['id'] ?>">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-zoom-in"></span>
                                            </button>
                                        </a>

                                        <!-- Modificar -->
                                        <a title="Modificar" href="persona.modificar.php?id=<?= $row['id'] ?>">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>

                                        <!-- Agregar al curso -->
                                        <?php if (intval($row['yaInscripto'])): ?>
                                            <span class="badge badge-secondary">Ya está en el curso</span>
                                        <?php else: ?>
                                            <a title="Agregar" href="persona.curso.agregar.procesar.php?id_curso=<?= $idCurso ?>&id_persona=<?= $row['id'] ?>">
                                                <button type="button" class="btn btn-outline-primary">
                                                    <span class="oi oi-plus"></span>
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </table>
                </div>

                <a href="personas.curso.php?id=<?= $idCurso ?>" class="btn btn-outline-secondary">
                    <span class="oi oi-account-logout"></span> Volver al curso
                </a>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once '../gui/footer.php'; ?>
</body>
</html>
