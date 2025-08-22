<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/BDConexion.Class.php';

$idIntegrante = $_GET['id_integrante'];
$idCurso = $_GET['id_curso'];
$query = "SELECT * FROM curso_integrante WHERE integrante_id = '{$idIntegrante}' AND curso_id = '{$idCurso}'";
$result = BDConexion::getInstancia()->query($query);
$datos = $result->fetch_assoc();
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <title>Modificar datos del integrante en el curso</title>
    <script>
    function mostrarCamposPorRol() {
        var rol = document.getElementById('rol').value;
        document.getElementById('camposDocente').style.display = (rol === 'Director' || rol === 'Co-director' || rol === 'Integrante') ? 'block' : 'none';
        document.getElementById('camposExterno').style.display = (rol === 'Integrante externo') ? 'block' : 'none';
    }
    function validarFormulario(e) {
        var rol = document.getElementById('rol').value;
        var afeccionTotal = document.getElementById('afeccionTotalHoras').value.trim();
        if (!rol) {
            alert('El campo Rol es obligatorio.');
            e.preventDefault();
            return false;
        }
        if (!afeccionTotal) {
            alert('El campo Afección total horas es obligatorio.');
            e.preventDefault();
            return false;
        }
        // Validaciones específicas por rol
        if (rol === 'Director' || rol === 'Co-director' || rol === 'Integrante') {
            var instituto = document.getElementById('instituto').value.trim();
            var categoriaDocente = document.getElementById('categoriaDocente').value.trim();
            var dedicacion = document.getElementById('dedicacion').value.trim();
            var categoriaExtensionista = document.getElementById('categoriaExtensionista').value.trim();
            if (!instituto || !categoriaDocente || !dedicacion || !categoriaExtensionista) {
                alert('Debe completar todos los campos de datos docentes.');
                e.preventDefault();
                return false;
            }
        }
        if (rol === 'Integrante externo') {
            var organizacion = document.getElementById('organizacion').value.trim();
            var funcion = document.getElementById('funcion').value.trim();
            var nivelEstudios = document.getElementById('nivelEstudios').value.trim();
            var ocupacion = document.getElementById('ocupacion').value.trim();
            if (!organizacion || !funcion || !nivelEstudios || !ocupacion) {
                alert('Debe completar todos los campos de datos de integrante externo.');
                e.preventDefault();
                return false;
            }
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        mostrarCamposPorRol();
        document.getElementById('rol').addEventListener('change', mostrarCamposPorRol);
        document.querySelector('form').addEventListener('submit', validarFormulario);
    });
    </script>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container">
        <form action="integrante.curso.modificar.procesar.php" method="post">
            <input type="hidden" name="id_integrante" value="<?= $idIntegrante ?>">
            <input type="hidden" name="id_curso" value="<?= $idCurso ?>">
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Modificar datos del integrante en el curso</h3>
                </div>
                <div class="card-body">
                    <label for="rol">Rol <span class="text-danger">*</span></label>
                    <select name="rol" id="rol" class="form-control" required>
                        <option value="">Seleccione el rol</option>
                        <option value="Director" <?= $datos['rol']=='Director'?'selected':'' ?>>Director</option>
                        <option value="Co-director" <?= $datos['rol']=='Co-director'?'selected':'' ?>>Co-director</option>
                        <option value="Integrante" <?= $datos['rol']=='Integrante'?'selected':'' ?>>Integrante</option>
                        <option value="Integrante externo" <?= $datos['rol']=='Integrante externo'?'selected':'' ?>>Integrante externo</option>
                    </select>
                    <label for="afeccionHorasSemanales">Afección horas semanales</label>
                    <input type="number" name="afeccionHorasSemanales" id="afeccionHorasSemanales" class="form-control" min="0" value="<?= htmlspecialchars($datos['afeccionHorasSemanales']) ?>">
                    <label for="afeccionTotalHoras">Afección total horas <span class="text-danger">*</span></label>
                    <input type="number" name="afeccionTotalHoras" id="afeccionTotalHoras" class="form-control" min="0" required value="<?= htmlspecialchars($datos['afeccionTotalHoras']) ?>">
                    <div id="camposDocente" style="display:none;">
                        <label for="instituto">Instituto <span class="text-danger">*</span></label>
                        <input type="text" name="instituto" id="instituto" class="form-control" value="<?= htmlspecialchars($datos['instituto']) ?>">
                        <label for="categoriaDocente">Categoría docente <span class="text-danger">*</span></label>
                        <input type="text" name="categoriaDocente" id="categoriaDocente" class="form-control" value="<?= htmlspecialchars($datos['categoriaDocente']) ?>">
                        <label for="dedicacion">Dedicación <span class="text-danger">*</span></label>
                        <input type="text" name="dedicacion" id="dedicacion" class="form-control" value="<?= htmlspecialchars($datos['dedicacion']) ?>">
                        <label for="categoriaExtensionista">Categoría extensionista <span class="text-danger">*</span></label>
                        <input type="text" name="categoriaExtensionista" id="categoriaExtensionista" class="form-control" value="<?= htmlspecialchars($datos['categoriaExtensionista']) ?>">
                    </div>
                    <div id="camposExterno" style="display:none;">
                        <label for="organizacion">Organización <span class="text-danger">*</span></label>
                        <input type="text" name="organizacion" id="organizacion" class="form-control" value="<?= htmlspecialchars($datos['organizacion']) ?>">
                        <label for="funcion">Función <span class="text-danger">*</span></label>
                        <input type="text" name="funcion" id="funcion" class="form-control" value="<?= htmlspecialchars($datos['funcion']) ?>">
                        <label for="nivelEstudios">Nivel de estudios <span class="text-danger">*</span></label>
                        <input type="text" name="nivelEstudios" id="nivelEstudios" class="form-control" value="<?= htmlspecialchars($datos['nivelEstudios']) ?>">
                        <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                        <input type="text" name="ocupacion" id="ocupacion" class="form-control" value="<?= htmlspecialchars($datos['ocupacion']) ?>">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                    <a href="integrantes.curso.php?id=<?= $idCurso ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>