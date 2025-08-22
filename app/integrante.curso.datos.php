<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
$idIntegrante = $_GET['id_integrante'];
$idCurso = $_GET['id_curso'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <title>Asignar datos al integrante en el curso</title>
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
        <form action="integrante.curso.datos.procesar.php" method="post">
            <input type="hidden" name="id_integrante" value="<?= $idIntegrante ?>">
            <input type="hidden" name="id_curso" value="<?= $idCurso ?>">
            <div class="card mt-4">
                <div class="card-header">
                    <h3>Datos del integrante en el curso</h3>
                </div>
                <div class="card-body">
                    <label for="rol">Rol <span class="text-danger">*</span></label>
                    <select name="rol" id="rol" class="form-control" required>
                        <option value="">Seleccione el rol</option>
                        <option value="Director">Director</option>
                        <option value="Co-director">Co-director</option>
                        <option value="Integrante">Integrante</option>
                        <option value="Integrante externo">Integrante externo</option>
                    </select>
                    <label for="afeccionHorasSemanales">Afección horas semanales</label>
                    <input type="number" name="afeccionHorasSemanales" id="afeccionHorasSemanales" class="form-control" min="0">
                    <label for="afeccionTotalHoras">Afección total horas <span class="text-danger">*</span></label>
                    <input type="number" name="afeccionTotalHoras" id="afeccionTotalHoras" class="form-control" min="0" required>
                    <div id="camposDocente" style="display:none;">
                        <label for="instituto">Instituto <span class="text-danger">*</span></label>
                        <input type="text" name="instituto" id="instituto" class="form-control">
                        <label for="categoriaDocente">Categoría docente <span class="text-danger">*</span></label>
                        <input type="text" name="categoriaDocente" id="categoriaDocente" class="form-control">
                        <label for="dedicacion">Dedicación <span class="text-danger">*</span></label>
                        <input type="text" name="dedicacion" id="dedicacion" class="form-control">
                        <label for="categoriaExtensionista">Categoría extensionista <span class="text-danger">*</span></label>
                        <input type="text" name="categoriaExtensionista" id="categoriaExtensionista" class="form-control">
                    </div>
                    <div id="camposExterno" style="display:none;">
                        <label for="organizacion">Organización <span class="text-danger">*</span></label>
                        <input type="text" name="organizacion" id="organizacion" class="form-control">
                        <label for="funcion">Función <span class="text-danger">*</span></label>
                        <input type="text" name="funcion" id="funcion" class="form-control">
                        <label for="nivelEstudios">Nivel de estudios <span class="text-danger">*</span></label>
                        <input type="text" name="nivelEstudios" id="nivelEstudios" class="form-control">
                        <label for="ocupacion">Ocupación <span class="text-danger">*</span></label>
                        <input type="text" name="ocupacion" id="ocupacion" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Confirmar</button>
                    <a href="integrantes.curso.php?id=<?= $idCurso ?>" class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <?php include_once '../gui/footer.php'; ?>
</body>
</html>