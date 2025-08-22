<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/Integrante.Class.php';

$id = $_GET["id"];
$Integrante = new Integrante($id);
$tipo = $Integrante->getTipo_id();
$carrera = $Integrante->getCarrera_Cod();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar integrante</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="integrante.modificar.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Modificar <?= $Integrante->getNombres(); ?></h3>
                        <p>
                            Complete los campos a continuación. 
                            Luego, presione el botón <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el botón <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNombre">Nombre/s</label>
                            <input type="text" name="nombres" class="form-control" id="inputNombre" value="<?= $Integrante->getNombres(); ?>" required="">
                            <label for="inputApellido">Apellido/s</label>
                            <input type="text" name="apellidos" class="form-control" id="inputApellido" value="<?= $Integrante->getApellidos(); ?>" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" value="<?= $Integrante->getDni(); ?>" required="">
                            <label for="inputTitulo">Título de Grado y/o Posgrado</label>
                            <input type="text" name="titulo" class="form-control" id="inputTitulo" value="<?= $Integrante->getTitulo(); ?>" required="">
                            <label for="inputDireccion">Dirección</label>
                            <input type="text" name="direccion" class="form-control" id="inputDireccion" value="<?= $Integrante->getDireccion(); ?>">
                            <label for="inputDireccion_CodPostal">Código Postal</label>
                            <input type="text" name="direccion_CodPostal" class="form-control" id="inputDireccion_CodPostal" value="<?= $Integrante->getDireccion_CodPostal(); ?>">
                            <label for="inputTelefono">Teléfono de contacto</label>
                            <input type="text" name="telefono" class="form-control" id="inputTelefono" value="<?= $Integrante->getTelefono(); ?>" required="">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" value="<?= $Integrante->getEmail(); ?>" required="">
                            <label for="inputTipo">Tipo</label>
                            <select name="tipo_id" class="form-control" id="inputTipo" required="">
                                <option value="">Seleccione su condición</option>
                                <option value="1" <?php if ($tipo == 1) echo 'selected'; ?>>Estudiante de la UNPA-UARG</option>
                                <option value="2" <?php if ($tipo == 2) echo 'selected'; ?>>Docente de la UNPA-UARG</option>
                                <option value="3" <?php if ($tipo == 3) echo 'selected'; ?>>No docente de la UNPA-UARG</option>
                                <option value="4" <?php if ($tipo == 4) echo 'selected'; ?>>Externo a la UNPA-UARG</option>
                                <option value="5" <?php if ($tipo == 5) echo 'selected'; ?>>Graduado/a/e de la UNPA-UARG</option>
                            </select>
                            <label for="inputCarrera">Carrera</label>
                            <select name="carrera_Cod" class="form-control" id="inputCarrera" required="">
                                <option value="">Seleccione carrera</option>
                                <option value="001"<?php if ($carrera == 1) echo 'selected'; ?>>Profesorado en Letras</option>
                                <option value="003"<?php if ($carrera == 3) echo 'selected'; ?>>Profesorado en Historia</option>
                                <option value="004"<?php if ($carrera == 4) echo 'selected'; ?>>Profesorado en Geografía</option>
                                <option value="016"<?php if ($carrera == 16) echo 'selected'; ?>>Analista de Sistemas</option>
                                <option value="023"<?php if ($carrera == 23) echo 'selected'; ?>>Ingenieria en Recursos Naturales Renovables</option>
                                <option value="045"<?php if ($carrera == 45) echo 'selected'; ?>>Licenciatura en Psicopedagogía</option>
                                <option value="049"<?php if ($carrera == 49) echo 'selected'; ?>>Profesorado en Matemática</option>
                                <option value="060"<?php if ($carrera == 60) echo 'selected'; ?>>Licenciatura en Letras</option>
                                <option value="061"<?php if ($carrera == 61) echo 'selected'; ?>>Licenciatura en Turismo</option>
                                <option value="062"<?php if ($carrera == 62) echo 'selected'; ?>>Tecnicatura Universitaria en Turismo</option>
                                <option value="064"<?php if ($carrera == 64) echo 'selected'; ?>>Licenciatura en Geografía</option>
                                <option value="069"<?php if ($carrera == 69) echo 'selected'; ?>>Ingeniería Química</option>
                                <option value="072"<?php if ($carrera == 72) echo 'selected'; ?>>Licenciatura en Sistemas</option>
                                <option value="074"<?php if ($carrera == 74) echo 'selected'; ?>>Licenciatura en Trabajo Social</option>
                                <option value="076"<?php if ($carrera == 76) echo 'selected'; ?>>Tecnicatura Universitaria en Acompañamiento Terapéutico</option>
                                <option value="093"<?php if ($carrera == 93) echo 'selected'; ?>>Título intermedio Enfermero/a - Licenciatura en Enfermería</option>
                                <option value="096"<?php if ($carrera == 96) echo 'selected'; ?>>Licenciatura en Historia</option>
                                <option value="912"<?php if ($carrera == 912) echo 'selected'; ?>>Tecnicatura Universitaria en Gestión de Organizaciones</option>
                                <option value="913"<?php if ($carrera == 913) echo 'selected'; ?>>Licenciatura en Administración</option>
                                <option value="914"<?php if ($carrera == 914) echo 'selected'; ?>>Profesorado en Economía y Gestión de Organizaciones</option>
                                <option value="918"<?php if ($carrera == 918) echo 'selected'; ?>>Licenciatura en Comunicación Social</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $Integrante->getId(); ?>" >
                        <hr />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="integrantes.gestionar.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('form').addEventListener('submit', function(e) {
                    let tipo = document.getElementById('inputTipo').value;
                    let carrera = document.getElementById('inputCarrera').value;

                    // Si tipo es estudiante, docente o graduado, carrera es obligatoria
                    if (tipo === '1' || tipo === '2' || tipo === '5') {
                        if (carrera === '') {
                            e.preventDefault();
                            alert('Debe seleccionar una carrera para este tipo de integrante.');
                            document.getElementById('inputCarrera').focus();
                            return false;
                        }
                    }

                    let campos = [
                        {id: 'inputNombre', mensaje: 'El nombre no puede ser un espacio ni contener números', soloTexto: true},
                        {id: 'inputApellido', mensaje: 'El apellido no puede ser un espacio ni contener números', soloTexto: true},
                        {id: 'inputTitulo', mensaje: 'El título no puede ser un espacio ni contener números', soloTexto: true},
                        {id: 'inputDNI', mensaje: 'El DNI no puede ser un espacio'},
                        {id: 'inputDireccion_CodPostal', mensaje: 'El código postal no puede ser un espacio'},
                        {id: 'inputTelefono', mensaje: 'El teléfono no puede ser un espacio'},
                        {id: 'inputEmail', mensaje: 'El email no puede ser un espacio'},
                        {id: 'inputTipo', mensaje: 'Debe seleccionar un tipo de integrante válido'}
                    ];

                    for (let campo of campos) {
                        let elemento = document.getElementById(campo.id);
                        if (elemento) {
                            let valor = elemento.value.trim();
                            if (valor === '' || /^\s+$/.test(elemento.value)) {
                                e.preventDefault();
                                alert(campo.mensaje);
                                elemento.focus();
                                return false;
                            }
                            if (campo.soloTexto && /[0-9]/.test(valor)) {
                                e.preventDefault();
                                alert(campo.mensaje);
                                elemento.focus();
                                return false;
                            }
                            if (campo.id === 'inputTipo' && (elemento.value === '' || isNaN(elemento.value) || parseInt(elemento.value) < 1)) {
                                e.preventDefault();
                                alert(campo.mensaje);
                                elemento.focus();
                                return false;
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>