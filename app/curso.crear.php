<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
<<<<<<< HEAD
include_once '../modelo/ColeccionRoles.php';
$Roles = new ColeccionRoles();
=======
include_once '../modelo/ColeccionCursos.php';
$Cursos = new ColeccionCursos();
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="curso.crear.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Curso</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
<<<<<<< HEAD
                        <h4>Propiedades</h4>
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese el nombre del Curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputDescripcion">descripcion</label>
                            <input type="text" name="descripcion" class="form-control" id="inputDescripcion" placeholder="Descripcion del Curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputMail">Email</label>
                            <input type="email" name="mail" class="form-control" id="inputMail" placeholder="Ingrese el email del Instructor a cargo de dictar el curso" required="">
=======
                        <h4>Datos curso</h4>
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese el nombre del curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputDescripcion">Descripcion</label>
                            <input type="text" name="descripcion" class="form-control" id="inputDescripcion" placeholder="Ingrese descripcion del curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputFechasDictado">Días y Horarios en que se dictará</label>
                            <input type="text" name="fechasDictado" class="form-control" id="inputFechasDictado" placeholder="Ingrese días y horarios en que se dictará el curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputLugar">Espacio de dictado</label>
                            <input type="text" name="lugar" class="form-control" id="inputLugar" placeholder="Ingrese la institucion, sector, aula en que se dictará el curso" required="">
                        </div>
                        <h4>Fechas de inscripción</h4>
                        <div class="form-group">
                            <label for="inputMail">Inicio de las inscripciones</label>
                            <input type="date" name="fechaInicioInscripcion" class="form-control" id="inputMail" placeholder="Ingrese el email del Instructor a cargo de dictar el curso" required="">
                        </div>
                        <div class="form-group">
                            <label for="inputMail">Cierre de las inscripciones</label>
                            <input type="date" name="fechaFinInscripcion" class="form-control" id="inputMail" placeholder="Ingrese el email del Instructor a cargo de dictar el curso" required="">
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
                        </div>
                        <hr />
                        
                    </div>
<<<<<<< HEAD
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="index_2.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
=======
                    <div class="card-footer" style="display: flex; justify-content: space-between;">
                        <div style="display:flex;">
                            <button type="submit" class="btn btn-outline-success" style="margin-right: 10px;">
                                <span class="oi oi-check"></span> Confirmar
                            </button>
                            <a href="index_2.php">
                                <button type="button" class="btn btn-outline-danger">
                                    <span class="oi oi-x"></span> Cancelar
                                </button>
                            </a>
                        </div>
                        <a href="integrantes.php" >
                            <button type="button" class="btn btn-outline-primary">
                                Gestionar Integrantes
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
