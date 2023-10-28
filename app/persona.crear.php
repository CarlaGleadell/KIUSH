<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ROLES);
include_once '../modelo/ColeccionPersonas.php';
$Personas = new ColeccionPersonas();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar Preinscripto</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="persona.crear.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Agregar Preinscripto</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Datos</h4>
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese nombre/s" required="">
                            <label for="inputApellido">Apellido</label>
                            <input type="texte" name="apellido" class="form-control" id="inputApellido" placeholder="Ingrese apellido/s" required="">
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Ingrese correo electronico" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" placeholder="Ingrese DNI" pattern="\d{8}" required="">
                            <label for="inputTipo">Tipo</label>
                            <select name="tipo" class="form-control" id="inputTipo" required="">
                                <option value="">Seleccione su condicion</option>
                                <option value="1">Estudiante de la UNPA-UARG</option>
                                <option value="2">Docente de la UNPA-UARG</option>
                                <option value="3">No docente de la UNPA-UARG</option>
                                <option value="4">Externo a la UNPA-UARG</option>
                                <option value="5">Graduado/a/e de la UNPA-UARG</option>
                            </select>
                            <label for="inputCarrera">Carrera</label>
                            
                            <select name="carrera" class="form-control" id="inputCarrera" >
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
                            <div class="form-check">
                                <input name= "estado" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">    
                                <label class="form-check-label" for="flexCheckDefault">Aceptado como inscripto 
                                </label>
                            </div>
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
