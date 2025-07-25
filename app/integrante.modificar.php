<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
include_once '../modelo/Integrante.Class.php';
include_once '../modelo/ColeccionPermisos.php';
$id = $_GET["id"];
$Integrante = new Integrante($id);
$PermisosSistema = new ColeccionPermisos();
$tipo = $Integrante->getTipo_id();
$carrera = $Integrante->getCarrera_Cod(); 

$codPostal = $Integrante->getDireccion_CodPostal();
$query = "SELECT País, Provincia, Localidad FROM bdkiush.direccion WHERE CodPostal = '{$codPostal}'";
$resultado = BDConexion::getInstancia()->query($query);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $pais = $fila['País'];
    $provincia = $fila['Provincia'];
    $localidad = $fila['Localidad'];
}
                  


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
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" value="<?= $Integrante->getNombres(); ?>" placeholder="Ingrese el nombre del integrante" required="">
                            <label for="inputApellido">Apellido</label>
                            <input type="texte" name="apellido" class="form-control" id="inputApellido" value="<?= $Integrante->getApellidos(); ?>" placeholder="Ingrese apellido/s" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" value="<?= $Integrante->getDni(); ?>" placeholder="Ingrese DNI" pattern="\d{8}" required="">
                            <label for="inputTitulo">Titulo de Grado y/o Posgrado</label>
                            <input type="text" name="titulo" class="form-control" id="inputTitulo" value="<?= $Integrante->getTitulo(); ?>"placeholder="Ingrese titulo de grado y/o posgrado" required="">
                            <label for="inputRol">Rol</label>
                            <select name="rol" class="form-control" id="inputRol" required="">
                                <option value="">Seleccione el rol del integrante</option>
                                <option value="1" <?php if ($tipo == 1) echo 'selected'; ?>>Director</option>
                                <option value="2" <?php if ($tipo == 2) echo 'selected'; ?>>Co-Director</option>
                                <option value="3" <?php if ($tipo == 3) echo 'selected'; ?>>Integrante</option>
                                <option value="4" <?php if ($tipo == 4) echo 'selected'; ?>>Integrante Externo</option>
                            </select>
                            
                            <!-- campos para director, codirector e integrantes -->
                            <label for="inputInstituto">Instituto</label>
                            <input type="text" name="instituto" class="form-control" id="inputInstituto" value="<?= $Integrante->getInstituto(); ?>" placeholder="Ingrese instituto">
                            <label for="inputCategoriaDocente">Categoría docente</label>
                            <input type="text" name="categoriaDocente" class="form-control" id="inputCategoriaDocente" value="<?= $Integrante->getCategoriaDocente(); ?>"placeholder="Ingrese categoría docente">
                            <label for="inputDedicacion">Dedicación</label>
                            <input type="text" name="dedicacion" class="form-control" id="inputDedicacion" value="<?= $Integrante->getDedicacion(); ?>" placeholder="Ingrese dedicacion">
                            <label for="inputCategoriaExtensionista">Categoría Extensionista</label>
                            <input type="text" name="categoriaExtensionista" class="form-control" id="inputCategoriaExtensionista" value="<?= $Integrante->getCategoriaExtensionista(); ?>" placeholder="Ingrese categoria extensionista">
                            <!-- campos para integrantes externos-->
                            <label for="inputOrganizacion">Organización</label>
                            <input type="text" name="organizacion" class="form-control" id="inputOrganizacion" value="<?= $Integrante->getOrganizacion(); ?>" placeholder="Ingrese organización">
                            <label for="inputFuncion">Función</label>
                            <input type="text" name="funcion" class="form-control" id="inputFuncion" value="<?= $Integrante->getFuncion(); ?>" placeholder="Ingrese función">
                            <label for="inputNivelEstudios">Nivel de Estudios</label>
                            <input type="text" name="nivelEstudios" class="form-control" id="inputNivelEstudios" value="<?= $Integrante->getNivelEstudios(); ?>" placeholder="Ingrese nivel de estudios">
                            <label for="inputOcupacion">Ocupación</label>
                            <input type="text" name="ocupacion" class="form-control" id="inputOcupacion" value="<?= $Integrante->getOcupacion(); ?>" placeholder="Ingrese ocupación">
                            

                            <style>.hidden { display: none; }</style>
                            <script>
                            window.onload = function() {
                                var rolSelect = document.getElementById('inputRol');
                                var campos = ['inputInstituto', 'inputCategoriaDocente', 'inputDedicacion', 'inputCategoriaExtensionista'];
                                var campos2 = ['inputOrganizacion','inputFuncion', 'inputNivelEstudios', 'inputOcupacion'];
                                // Oculta los campos al cargar la página
                                for (var i = 0; i < campos.length; i++) {
                                    var campo = document.getElementById(campos[i]);
                                    var label = document.querySelector('label[for="' + campos[i] + '"]');
                                    campo.classList.add('hidden');
                                    label.classList.add('hidden');
                                    }
                                for (var i = 0; i < campos2.length; i++) {
                                    var campo = document.getElementById(campos2[i]);
                                    var label = document.querySelector('label[for="' + campos2[i] + '"]');
                                    campo.classList.add('hidden');
                                    label.classList.add('hidden');
                                }
                                // Muestra u oculta los campos cuando se cambia el valor del select
                                rolSelect.addEventListener('change', function() {
                                    var rol = this.value;
                                    for (var i = 0; i < campos.length; i++) {
                                        var campo = document.getElementById(campos[i]);
                                        var label = document.querySelector('label[for="' + campos[i] + '"]');
                                        if (rol == '1' || rol == '2' || rol == '3') {
                                            campo.classList.remove('hidden'); // Muestra el campo
                                            label.classList.remove('hidden'); // Muestra la etiqueta
                                        } else {
                                            campo.classList.add('hidden'); // Oculta el campo
                                            label.classList.add('hidden'); // Oculta la etiqueta
                                            }
                                    }
                                    for (var i = 0; i < campos2.length; i++) {
                                        var campo = document.getElementById(campos2[i]);
                                        var label = document.querySelector('label[for="' + campos2[i] + '"]');
                                        if (rol == '4') {
                                            campo.classList.remove('hidden'); // Muestra el campo
                                            label.classList.remove('hidden'); // Muestra la etiqueta
                                            } else {
                                            campo.classList.add('hidden'); // Oculta el campo
                                            label.classList.add('hidden'); // Oculta la etiqueta
                                        }
                                    }
                                });
                            }
                            </script>

                            <label for="inputDireccion">Direccion</label>
                            <input type="text" name="direccion" class="form-control" id="inputDireccion" value="<?= $Integrante->getDireccion(); ?>" placeholder="Ingrese direccion: calle N°">
                            <label for="inputDireccion_CodPostal">Código Postal</label>
                            <input type="text" name="direccion_CodPostal" class="form-control" id="inputDireccion_CodPostal" value="<?= $Integrante->getDireccion_CodPostal(); ?>" placeholder="Ingrese código postal">
                            <label for="inputPais">País</label>
                            <input type="text" name="pais" class="form-control" id="inputPais" value="<?= $pais; ?>" placeholder="Ingrese pais de origen" required="">
                            <label for="inputProvincia">Provincia</label>
                            <input type="text" name="provincia" class="form-control" id="inputProvincia" value="<?= $provincia; ?>" placeholder="Ingrese provincia" required="">
                            <label for="inputLocalidad">Localidad</label>
                            <input type="text" name="localidad" class="form-control" id="inputLocalidad" value="<?= $localidad; ?>" placeholder="Ingrese localidad" required="">
                            
                            <label for="inputTelefono">Telfono de contacto</label>
                            <input type="text" name="telefono" class="form-control" id="inputTelefono" value="<?= $Integrante->getTelefono(); ?>" placeholder="Ingrese telefono de contacto" required="">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" value="<?= $Integrante->getEmail(); ?>" placeholder="Ingrese correo electronico" required="">
                            
                            <label for="inputAfeccionHorasSemanales">Afección de horas semanales a la actividad</label>
                            <input type="text" name="afeccionHorasSemanales" class="form-control" id="inputAfeccionHorasSemanales" value="<?= $Integrante->getAfeccionHorasSemanales(); ?>" placeholder="Ingrese afección de horas semanales a la actividad">
                            <label for="inputAfeccionTotalHoras">Afección total de horas a la actividad</label>
                            <input type="text" name="afeccionTotalHoras" class="form-control" id="inputAfeccionTotalHoras" value="<?= $Integrante->getAfeccionTotalHoras(); ?>" placeholder="Ingrese afección total de horas a la actividad">
                            

                            
                            <label for="inputTipo">Tipo</label>
                            <select name="tipo" class="form-control" id="inputTipo" required="">
                                <option value="">Seleccione su condicion</option>
                                <option value="1" <?php if ($tipo == 1) echo 'selected'; ?>>Estudiante de la UNPA-UARG</option>
                                <option value="2" <?php if ($tipo == 2) echo 'selected'; ?>>Docente de la UNPA-UARG</option>
                                <option value="3" <?php if ($tipo == 3) echo 'selected'; ?>>No docente de la UNPA-UARG</option>
                                <option value="4" <?php if ($tipo == 4) echo 'selected'; ?>>Externo a la UNPA-UARG</option>
                                <option value="5" <?php if ($tipo == 5) echo 'selected'; ?>>Graduado/a/e de la UNPA-UARG</option>
                            </select>
                            <label for="inputCarrera">Carrera</label>
                            <select name="carrera" class="form-control" id="inputCarrera" required="">
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
                        <input type="hidden" name="id" class="form-control" id="id" value="<?= $Integrante->getId(); ?>" >
                        <hr />
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="roles.php">
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