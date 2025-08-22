<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$idCurso = $_GET['id'];
$query = "SELECT ci.rol, i.nombres, i.apellidos, i.email, ci.integrante_id, ci.curso_id
          FROM curso_integrante ci 
          JOIN integrante i ON ci.integrante_id = i.id 
          WHERE ci.curso_id = '{$idCurso}'";
$result = BDConexion::getInstancia()->query($query);
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
    <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
    <title>Integrantes del curso</title>
    <style>
        .table-responsive { margin-top: 20px; }
        .card { margin-top: 30px; }
    </style>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>
                    <span class="oi oi-people"></span> Integrantes del curso
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <?php if ($result->num_rows > 0) { ?>
                    <table class="table table-hover table-sm">
                        <thead class="table-info">
                            <tr>
                                <th>Nombre/s</th>
                                <th>Apellido/s</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nombres']) ?></td>
                                <td><?= htmlspecialchars($row['apellidos']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['rol']) ?></td>
                                <td>
                                    <div style="display: flex; gap: 4px;">
                                        <a title="Modificar" href="integrante.curso.modificar.php?id_integrante=<?= $row['integrante_id'] ?>&id_curso=<?= $row['curso_id'] ?>">
                                            <button type="button" class="btn btn-outline-warning btn-sm">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>
                                        <a title="Quitar de este curso" href="integrante.curso.quitar.procesar.php?id_integrante=<?= $row['integrante_id'] ?>&id_curso=<?= $row['curso_id'] ?>" onclick="return confirm('¿Está seguro de quitar este integrante del curso?');">
                                            <button type="button" class="btn btn-outline-danger btn-sm">
                                                <span class="oi oi-minus"></span>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-info text-center">No hay integrantes asignados a este curso.</div>
                <?php } ?>
                </div>
                <div style="display: flex; justify-content: center; margin-top: 20px;">
                    <a href="integrantes.php?id=<?= $idCurso; ?>">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-plus"></span> Agregar integrantes
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <a href="cursos.php">
                <button type="button" class="btn btn-secondary">
                    <span class="oi oi-arrow-left"></span> Volver a cursos
                </button>
            </a>
        </div>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>