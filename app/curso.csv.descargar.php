<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/Cursos.Class.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_GET["id"])) {
    header("Location: cursos.php");
    exit();
}

$curso = new Curso($_GET["id"]);
$nombreCurso = $curso->getNombre();
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
    <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
    <title>Generar archivo CSV</title>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Generar archivo CSV para el curso <?= $nombreCurso ?></h3>
            </div>
            <div class="card-body">
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">Convierte el archivo Excel completado a formato CSV</h5>
                    </div>
                    <button class="btn btn-outline-info btn-sm" type="button" data-toggle="collapse" data-target="#ayudaProceso" aria-expanded="false">
                        <span class="oi oi-question-mark"></span> ¿Necesitas ayuda?
                    </button>
                </div>

                <!-- Desarrollo de la sección "¿Necesitas ayuda?" -->
                <div class="collapse" id="ayudaProceso">
                    <div class="bg-light border rounded p-4 my-4">
                        <h6><span class="oi oi-info"></span> ¿Cómo funciona este proceso?</h6>
                        <p class="mb-3">Para generar los certificados, necesitas subir el archivo Excel <strong>con las notas y asistencias completadas</strong>. Este archivo se convertirá automáticamente a formato CSV para el sistema de certificados.</p>
                        
                        <h6>Procedimiento completo:</h6>
                        
                        <div class="d-flex align-items-start mb-3 p-3 bg-white rounded border" style="border-left: 4px solid #007bff !important;">
                            <span class="badge badge-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 30px; height: 30px;">1</span>
                            <div class="flex-fill">
                                <h6>Descargar listado de inscriptos</h6>
                                <p class="mb-2">Descarga el archivo Excel con la lista de estudiantes inscriptos.</p>
                                <a href="curso.inscriptos.descargar.php?id=<?= $curso->getId(); ?>" 
                                   class="btn btn-outline-primary btn-sm" target="_blank">
                                    <span class="oi oi-cloud-download"></span> Descargar listado
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-white rounded border" style="border-left: 4px solid #007bff !important;">
                            <span class="badge badge-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 30px; height: 30px;">2</span>
                            <div class="flex-fill">
                                <h6>Completar notas y asistencias</h6>
                                <p class="mb-0">El dictante debe abrir el archivo Excel descargado y completar las columnas de <strong>"Nota"</strong> y <strong>"Asistencia"</strong> para cada estudiante.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-3 p-3 bg-white rounded border" style="border-left: 4px solid #007bff !important;">
                            <span class="badge badge-primary rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 30px; height: 30px;">3</span>
                            <div class="flex-fill">
                                <h6>Subir archivo completado</h6>
                                <p class="mb-0">Sube el archivo Excel con las notas y asistencias completadas para generar el CSV de certificados (formulario abajo).</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin de la sección "¿Necesitas ayuda?" -->

                <div class="mt-4">
                    
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="oi oi-warning mr-2"></span>
                            <div>
                                <strong>Importante:</strong> Sube el archivo Excel que ya tenga las notas y asistencias completadas.
                                <div class="mt-1">
                                    <small>¿No tienes el archivo? <a href="curso.inscriptos.descargar.php?id=<?= $curso->getId(); ?>" target="_blank">Descárgalo aquí</a> y complétalo primero.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="uploadForm" action="procesar.csv.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="curso_id" value="<?= $_GET["id"] ?>">
                        
                        <div class="form-group">
                            <label for="excelFile">
                                <h5>Seleccionar archivo Excel</h5>
                                <small class="form-text text-muted mb-2"> Archivo esperado: <code>Listado_<?= $nombreCurso ?>.xlsx</code> </small>
                            </label>
                            <input type="file" 
                                   class="form-control-file border p-2 rounded" 
                                   id="excelFile" 
                                   name="excelFile" 
                                   accept=".xlsx" 
                                   required>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="curso.ver.php?id=<?= $_GET["id"] ?>" class="btn btn-secondary">
                                <span class="oi oi-arrow-left"></span> Volver al curso
                            </a>
                            <button type="submit" class="btn btn-success">
                                <span class="oi oi-cloud-upload"></span> Generar archivo CSV
                            </button>
                        </div>
                    </form>
                </div>
                
                <div id="mensaje" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#ayudaProceso').on('show.bs.collapse', function () {
            $('button[data-target="#ayudaProceso"]').html('<span class="oi oi-minus"></span> Ocultar ayuda');
        });
        
        $('#ayudaProceso').on('hide.bs.collapse', function () {
            $('button[data-target="#ayudaProceso"]').html('<span class="oi oi-question-mark"></span> ¿Necesitas ayuda?');
        });

        $('#excelFile').on('change', function() {
            var fileName = this.files[0] ? this.files[0].name : '';
            var expectedFileName = 'Listado_<?= $nombreCurso ?>.xlsx';
            
            if (fileName) {
                if (fileName === expectedFileName) {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#fileHelp').remove();
                    $(this).after('<small id="fileHelp" class="form-text text-success">✓ Archivo correcto seleccionado</small>');
                } else {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $('#fileHelp').remove();
                    $(this).after('<small id="fileHelp" class="form-text text-danger">⚠ El archivo debe llamarse "' + expectedFileName + '"</small>');
                }
            }
        });

        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            
            var fileInput = $('#excelFile')[0];
            if (!fileInput.files[0]) {
                $('#mensaje').html('<div class="alert alert-danger">Por favor selecciona un archivo.</div>');
                return false;
            }

            var fileName = fileInput.files[0].name;
            var expectedFileName = 'Listado_<?= $nombreCurso ?>.xlsx';
            
            if (fileName !== expectedFileName) {
                $('#mensaje').html('<div class="alert alert-danger"><strong>Error:</strong> El archivo debe llamarse exactamente "<strong>' + expectedFileName + '</strong>"</div>');
                return false;
            }

            var formData = new FormData(this);
            
            $('#mensaje').html(`
                <div class="alert alert-info">
                    <div class="d-flex align-items-center">
                        <div class="spinner-border spinner-border-sm mr-2" role="status">
                            <span class="sr-only">Cargando...</span>
                        </div>
                        <div>Procesando archivo y generando CSV, por favor espera...</div>
                    </div>
                </div>
            `);

            $('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: 'procesar.csv.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(result) {
                    console.log('Respuesta del servidor:', result);
                    if (result.success) {
                        $('#mensaje').html(`
                            <div class="alert alert-success">
                                <h6><span class="oi oi-check"></span> ¡Éxito!</h6>
                                <p class="mb-0">${result.message}</p>
                                <small class="text-muted d-block mt-2">El archivo CSV se ha descargado automáticamente. Puedes cerrar esta ventana o generar otro CSV.</small>
                            </div>
                        `);
                        
                        // Crear y descargar el archivo CSV
                        var csvContent = atob(result.csvContent);
                        var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                        var link = document.createElement('a');
                        if (link.download !== undefined) {
                            var url = URL.createObjectURL(blob);
                            link.setAttribute('href', url);
                            link.setAttribute('download', result.fileName);
                            link.style.visibility = 'hidden';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }
                        
                        $('button[type="submit"]').prop('disabled', false);
                    } else {
                        $('#mensaje').html('<div class="alert alert-danger"><strong>Error:</strong> ' + result.message + '</div>');
                        $('button[type="submit"]').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error AJAX:', error);
                    console.error('Estado:', status);
                    console.error('Respuesta:', xhr.responseText);
                    $('#mensaje').html(`
                        <div class="alert alert-danger">
                            <strong>Error:</strong> No se pudo procesar el archivo. 
                            <button class="btn btn-link btn-sm p-0" type="button" data-toggle="collapse" data-target="#errorDetails">
                                Ver detalles técnicos
                            </button>
                            <div class="collapse mt-2" id="errorDetails">
                                <small><code>${xhr.responseText}</code></small>
                            </div>
                        </div>
                    `);
                    $('button[type="submit"]').prop('disabled', false);
                }
            });
        });
    });
    </script>
</body>
</html>