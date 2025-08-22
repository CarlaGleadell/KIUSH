<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PREINSCRIPTOS);
include_once '../modelo/Persona.Class.php';
include_once '../modelo/ColeccionPermisos.php';
$id = $_GET["id"];
$Persona = new Persona($id);
$PermisosSistema = new ColeccionPermisos();
$tipo = $Persona->getTipo_id();
$carrera = $Persona->getCarrera_Cod(); 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Actualizar Preinscripto</title>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function manejarCampoCarrera() {
                    var tipoSeleccionado = document.getElementById('inputTipo').value;
                    var campoCarrera = document.getElementById('inputCarrera');
                    var divCarrera = document.getElementById('divCarrera');
                    
                    if (tipoSeleccionado === '4' || tipoSeleccionado === '3') { 
                        campoCarrera.removeAttribute('required');
                        campoCarrera.value = '';
                        divCarrera.style.display = 'none';
                    } else {
                        campoCarrera.setAttribute('required', '');
                        divCarrera.style.display = 'block';
                    }
                }
                
                document.getElementById('inputTipo').addEventListener('change', manejarCampoCarrera);
                manejarCampoCarrera();
                document.querySelector('form').addEventListener('submit', function(e) {
                    var tipoSeleccionado = document.getElementById('inputTipo').value;
                    var campoCarrera = document.getElementById('inputCarrera');
                    
                    if (tipoSeleccionado === '4' || tipoSeleccionado === '3') {
                        campoCarrera.removeAttribute('required');
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="persona.modificar.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Actualizar Preinscripto</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" value="<?= $Persona->getNombre(); ?>" placeholder="Ingrese nombre/s" required="">
                            <label for="inputApellido">Apellido</label>
                            <input type="texte" name="apellido" class="form-control" id="inputApellido" value="<?= $Persona->getApellido(); ?>" placeholder="Ingrese apellido/s" required="">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" value="<?= $Persona->getEmail(); ?>" placeholder="Ingrese correo electronico" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" value="<?= $Persona->getDni(); ?>" placeholder="Ingrese DNI" pattern="\d{8}" required="">
                            <label for="inputTipo">Tipo</label>
                            <select name="tipo" class="form-control" id="inputTipo" required="">
                                <option value="">Seleccione su condicion</option>
                                <option value="1" <?php if ($tipo == 1) echo 'selected'; ?>>Estudiante de la UNPA-UARG</option>
                                <option value="2" <?php if ($tipo == 2) echo 'selected'; ?>>Docente de la UNPA-UARG</option>
                                <option value="3" <?php if ($tipo == 3) echo 'selected'; ?>>No docente de la UNPA-UARG</option>
                                <option value="4" <?php if ($tipo == 4) echo 'selected'; ?>>Externo a la UNPA-UARG</option>
                                <option value="5" <?php if ($tipo == 5) echo 'selected'; ?>>Graduado de la UNPA-UARG</option>
                            </select>
                            <div id="divCarrera">
                                <label for="inputCarrera">Carrera</label>
                                <select name="carrera" class="form-control" id="inputCarrera" <?php if ($tipo != 4 && $tipo != 3) echo 'required=""'; ?>>
                                    <option value="">Seleccione carrera</option>
                                    <option value="001" <?php if ($carrera == 1) echo 'selected'; ?>>Profesorado en Letras</option>
                                    <option value="003" <?php if ($carrera == 3) echo 'selected'; ?>>Profesorado en Historia</option>
                                    <option value="004" <?php if ($carrera == 4) echo 'selected'; ?>>Profesorado en Geografía</option>
                                    <option value="016" <?php if ($carrera == 16) echo 'selected'; ?>>Analista de Sistemas</option>
                                    <option value="023" <?php if ($carrera == 23) echo 'selected'; ?>>Ingenieria en Recursos Naturales Renovables</option>
                                    <option value="045" <?php if ($carrera == 45) echo 'selected'; ?>>Licenciatura en Psicopedagogía</option>
                                    <option value="049" <?php if ($carrera == 49) echo 'selected'; ?>>Profesorado en Matemática</option>
                                    <option value="060" <?php if ($carrera == 60) echo 'selected'; ?>>Licenciatura en Letras</option>
                                    <option value="061" <?php if ($carrera == 61) echo 'selected'; ?>>Licenciatura en Turismo</option>
                                    <option value="062" <?php if ($carrera == 62) echo 'selected'; ?>>Tecnicatura Universitaria en Turismo</option>
                                    <option value="064" <?php if ($carrera == 64) echo 'selected'; ?>>Licenciatura en Geografía</option>
                                    <option value="069" <?php if ($carrera == 69) echo 'selected'; ?>>Ingeniería Química</option>
                                    <option value="072" <?php if ($carrera == 72) echo 'selected'; ?>>Licenciatura en Sistemas</option>
                                    <option value="074" <?php if ($carrera == 74) echo 'selected'; ?>>Licenciatura en Trabajo Social</option>
                                    <option value="076" <?php if ($carrera == 76) echo 'selected'; ?>>Tecnicatura Universitaria en Acompañamiento Terapéutico</option>
                                    <option value="093" <?php if ($carrera == 93) echo 'selected'; ?>>Título intermedio Enfermero/a - Licenciatura en Enfermería</option>
                                    <option value="096" <?php if ($carrera == 96) echo 'selected'; ?>>Licenciatura en Historia</option>
                                    <option value="912" <?php if ($carrera == 912) echo 'selected'; ?>>Tecnicatura Universitaria en Gestión de Organizaciones</option>
                                    <option value="913" <?php if ($carrera == 913) echo 'selected'; ?>>Licenciatura en Administración</option>
                                    <option value="914" <?php if ($carrera == 914) echo 'selected'; ?>>Profesorado en Economía y Gestión de Organizaciones</option>
                                    <option value="918" <?php if ($carrera == 918) echo 'selected'; ?>>Licenciatura en Comunicación Social</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" class="form-control" id="id" value="<?= $Persona->getId(); ?>" >
                        <hr />
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="personas.gestionar.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>