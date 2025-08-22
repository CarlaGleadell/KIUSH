<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/ColeccionCursos.php';
$Cursos = new ColeccionCursos();
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
            <form action="curso.crear.procesar.php" method="post" enctype="multipart/form-data">
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
                        <h4>Datos del curso</h4>
                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese el nombre del curso" required="">
                        </div>                                        
                        <div class="form-group">
                            <label for="inputDescripcion">Descripcion</label>
                            <textarea type="text" name="descripcion" class="form-control" id="inputDescripcion" rows="3" placeholder="Ingrese descripcion breve del curso" required></textarea>
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
                        </div>
                        <hr />
                        <h4>Imagen del curso </h4>
                        <div class="form-group">
                            <label for="inputImagen">Seleccione un archivo (opcional - si no ingresa una imagen se inserta una por defecto)</label>
                            <input type="file" name="imagen" class="form-control" id="inputImagen" accept=".jpg,.png,image/jpeg,image/png">
                        </div>
                        
                    </div>
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
                       
                    </div>
                </div>
            </form>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            var nombre = document.getElementById('inputNombre').value.trim();
            var descripcion = document.getElementById('inputDescripcion').value.trim();
            var fechasDictado = document.getElementById('inputFechasDictado').value.trim();
            var lugar = document.getElementById('inputLugar').value.trim();

            // Validación: mínimo 2 letras en cada campo
            function tieneMinimoDosLetras(texto) {
                return (texto.match(/[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]/g) || []).length >= 2;
            }

            if (!tieneMinimoDosLetras(nombre)) {
                alert('El nombre del curso debe tener al menos 2 letras.');
                e.preventDefault();
                return;
            }
            if (!tieneMinimoDosLetras(descripcion)) {
                alert('La descripción del curso debe tener al menos 2 letras.');
                e.preventDefault();
                return;
            }
            if (!tieneMinimoDosLetras(fechasDictado)) {
                alert('Los días y horarios deben tener al menos 2 letras.');
                e.preventDefault();
                return;
            }
            if (!tieneMinimoDosLetras(lugar)) {
                alert('El espacio de dictado debe tener al menos 2 letras.');
                e.preventDefault();
                return;
            }

            // Validación: no permitir solo números
            if (/^\d+$/.test(nombre)) {
                alert('El nombre del curso no puede ser únicamente números. Ingrese un nombre real, ya que se mostrará en el inicio del curso.');
                e.preventDefault();
                return;
            }
            if (/^\d+$/.test(descripcion)) {
                alert('La descripción del curso no puede ser únicamente números. Ingrese una descripción real.');
                e.preventDefault();
                return;
            }
            if (/^\d+$/.test(fechasDictado)) {
                alert('Los días y horarios no pueden ser únicamente números. Ingrese información real.');
                e.preventDefault();
                return;
            }
            if (/^\d+$/.test(lugar)) {
               alert('El espacio de dictado no puede ser únicamente números. Ingrese un nombre real del lugar.');
                e.preventDefault();
                return;
        }
        });
        </script>
    </body>
</html>
