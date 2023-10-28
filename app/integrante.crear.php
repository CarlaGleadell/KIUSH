<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ROLES);
include_once '../modelo/ColeccionIntegrantes.php';
$Integrantes = new ColeccionIntegrantes();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar Integrante</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="integrante.crear.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Agregar Integrante</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Datos</h4>
                        <div class="form-group">
                            <label for="inputNombre">Nombre/s</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese nombre/s" required="">
                            <label for="inputApellido">Apellido/s</label>
                            <input type="texte" name="apellido" class="form-control" id="inputApellido" placeholder="Ingrese apellido/s" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" placeholder="Ingrese DNI" pattern="\d{8}" required="">
                            <label for="inputTitulo">Titulo de Grado y/o Posgrado</label>
                            <input type="text" name="titulo" class="form-control" id="inputTitulo" placeholder="Ingrese titulo de grado y/o posgrado" required="">
                            
                            <?php /*si su rol es director, codirector o integrante pedir instituto, categoria docente, y dedicacion*/
                            /*si es integrante externo no pedir organizacion (de corresponder)*/?>
                            <label for="inputInstituto">Instituto</label>
                            <input type="text" name="instituto" class="form-control" id="inputInstituto" placeholder="Ingrese instituto">
                            <label for="inputCategoriaDocente">Categoría docente</label>
                            <input type="text" name="categoriaDocente" class="form-control" id="inputCategoriaDocente" placeholder="Ingrese categoría docente">
                            <label for="inputDedicacion">Dedicación</label>
                            <input type="text" name="dedicacion" class="form-control" id="inputDedicación" placeholder="Ingrese dedicacion">
                            <label for="inputCategoriaExtensionista">Categoría Extensionista</label>
                            <input type="text" name="categoriaExtensionista" class="form-control" id="inputCategoriaExtensionista" placeholder="Ingrese categoria extensionista">
                            
                            <label for="inputDireccion">Direccion</label>
                            <input type="text" name="direccion" class="form-control" id="inputDireccion" placeholder="Ingrese direccion: calle N°">
                            <label for="inputDireccion_CodPostal">Código Postal</label>
                            <input type="text" name="direccion_CodPostal" class="form-control" id="inputDireccion_CodPostal" placeholder="Ingrese código postal">
                            <label for="inputPais">País</label>
                            <input type="text" name="pais" class="form-control" id="inputPais" placeholder="Ingrese pais de origen" required="">
                            <label for="inputProvincia">Provincia</label>
                            <input type="text" name="provincia" class="form-control" id="inputProvincia" placeholder="Ingrese provincia" required="">
                            <label for="inputLocalidad">Localidad</label>
                            <input type="text" name="localidad" class="form-control" id="inputLocalidad" placeholder="Ingrese localidad" required="">
                            
                            <label for="inputTelefono">Telfono de contacto</label>
                            <input type="text" name="telefono" class="form-control" id="inputTelefono" placeholder="Ingrese telefono de contacto" required="">
                            <label for="inputRol">Rol integrante</label>
                            <select name="rol" class="form-control" id="inputRol" required="">
                                <option value="">Seleccione el rol del integrante</option>
                                <option value="1">Director</option>
                                <option value="2">Co-Director</option>
                                <option value="3">Integrante</option>
                                <option value="4">Integrante Externo</option>
                            </select>
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Ingrese correo electronico" required="">
                             

                            <?php /*si su rol es integrante externo agregar el campo organizacion*/
                            /*si cumple otro rol no agregarlo*/?>
                            <label for="inputOrganizacion">Organización</label>
                            <input type="text" name="organizacion" class="form-control" id="inputOrganizacion" placeholder="Ingrese organización">
                            <label for="inputFuncion">Función</label>
                            <input type="text" name="funcion" class="form-control" id="inputFuncion" placeholder="Ingrese función">
                            <label for="inputNivelEstudios">Nivel de Estudios</label>
                            <input type="text" name="nivelEstudios" class="form-control" id="inputNivelEstudios" placeholder="Ingrese nivel de estudios">
                            <label for="inputOcupacion">Ocupación</label>
                            <input type="text" name="ocupacion" class="form-control" id="inputOcupacion" placeholder="Ingrese ocupación">
                            
                            <label for="inputAfeccionHorasSemanales">Afección de horas semanales a la actividad</label>
                            <input type="text" name="afeccionHorasSemanales" class="form-control" id="inputAfeccionHorasSemanales" placeholder="Ingrese afección de horas semanales a la actividad">
                            <label for="inputAfeccionTotalHoras">Afección total de horas a la actividad</label>
                            <input type="text" name="afeccionTotalHoras" class="form-control" id="inputAfeccionTotalHoras" placeholder="Ingrese afección total de horas a la actividad">
                            <label for="inputTipo">Tipo</label>
                            <select name="tipo" class="form-control" id="inputTipo" >
                                <option value="">Seleccione el tipo de integrante</option>
                                <option value="1">Estudiante de la UNPA-UARG</option>
                                <option value="2">Docente de la UNPA-UARG</option>
                                <option value="3">No docente de la UNPA-UARG</option>
                                <option value="4">Externo a la UNPA-UARG</option>
                                <option value="5">Graduado/a de la UNPA-UARG</option>
                            </select>
                            <label for="inputCarrera_Cod">Carrera</label>
                            <select name="carrera_Cod" class="form-control" id="inputCarrera_Cod" >
                                <option value="">En caso de ser estudiante, docente o graduado/a/e indique su carrera</option>
                                <option value="001">Profesorado en Letras</option>
                                <option value="003">Profesorado en Historia</option>
                                <option value="004">Profesorado en Geografía</option>
                                <option value="016">Analista de Sistemas</option>
                                <option value="023">Ingenieria en Recursos Naturales Renovables</option>
                                <option value="045">Licenciatura en Psicopedagogía</option>
                                <option value="049">Profesorado en Matemática</option>
                                <option value="060">Licenciatura en Letras</option>
                                <option value="061">Licenciatura en Turismo</option>
                                <option value="062">Tecnicatura Universitaria en Turismo</option>
                                <option value="064">Licenciatura en Geografía</option>
                                <option value="069">Ingeniería Química</option>
                                <option value="072">Licenciatura en Sistemas</option>
                                <option value="074">Licenciatura en Trabajo Social</option>
                                <option value="076">Tecnicatura Universitaria en Acompañamiento Terapéutico</option>
                                <option value="093">Título intermedio Enfermero/a - Licenciatura en Enfermería</option>
                                <option value="096">Licenciatura en Historia</option>
                                <option value="912">Tecnicatura Universitaria en Gestión de Organizaciones</option>
                                <option value="913">Licenciatura en Administración</option>
                                <option value="914">Profesorado en Economía y Gestión de Organizaciones</option>
                                <option value="918">Licenciatura en Comunicación Social</option>
                            </select>
                            
                        </div>
                        <hr />
                        
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="personas.php">
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
