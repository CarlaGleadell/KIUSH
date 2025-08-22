<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_INTEGRANTES);
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
                            <input type="text" name="nombres" class="form-control" id="inputNombre" placeholder="Ingrese nombre/s" pattern="[A-Za-z0-9\s]+" required="">
                            <label for="inputApellido">Apellido/s</label>
                            <input type="text" name="apellidos" class="form-control" id="inputApellido" placeholder="Ingrese apellido/s" pattern="[A-Za-z0-9\s]+" required="">
                            <label for="inputDNI">DNI</label>
                            <input type="text" name="dni" class="form-control" id="inputDNI" placeholder="Ingrese DNI" pattern="\d{8}" maxlength="8" required="">
                            <label for="inputTitulo">Titulo de Grado y/o Posgrado</label>
                            <input type="text" name="titulo" class="form-control" id="inputTitulo" placeholder="Ingrese titulo de grado y/o posgrado" pattern="[A-Za-z0-9\s]+" required="">
                            
                            <script>
                            function soloAlfanumerico(e) {
                                const pattern = /^[a-zA-Z0-9\s]*$/;
                                const inputValue = e.target.value;
                                if (!pattern.test(inputValue)) {
                                    e.target.value = inputValue.replace(/[^a-zA-Z0-9\s]/g, '');
                                }
                            }
                            
                            
                            function soloNumerosPositivos(e) {
                                const value = e.target.value;
                                if (value < 0 || isNaN(value)) {
                                    e.target.value = '';
                                }
                            }
                            
                            document.addEventListener('DOMContentLoaded', function() {
                                const camposAlfanumericos = [
                                    'inputNombre', 'inputApellido', 'inputTitulo', 'inputInstituto', 
                                    'inputCategoriaDocente', 'inputDedicacion', 'inputCategoriaExtensionista',
                                    'inputOrganizacion', 'inputFuncion', 'inputNivelEstudios', 'inputOcupacion',
                                    'inputDireccion', 'inputDireccion_CodPostal', 'inputPais', 'inputProvincia',
                                    'inputLocalidad'
                                ];
                                
                                camposAlfanumericos.forEach(id => {
                                    const elemento = document.getElementById(id);
                                    if (elemento) {
                                        elemento.addEventListener('input', soloAlfanumerico);
                                        elemento.pattern = '[A-Za-z0-9\\s]+';
                                    }
                                });
                                
                                const inputDNI = document.getElementById('inputDNI');
                                if (inputDNI) {
                                    inputDNI.addEventListener('input', function(e) {
                                        this.value = this.value.replace(/\D/g, '').substring(0, 8);
                                    });
                                }
                                
                                const camposHoras = ['inputAfeccionHorasSemanales', 'inputAfeccionTotalHoras'];
                                camposHoras.forEach(id => {
                                    const elemento = document.getElementById(id);
                                    if (elemento) {
                                        elemento.type = 'number';
                                        elemento.min = '0';
                                        elemento.addEventListener('input', soloNumerosPositivos);
                                    }
                                });
                            });
                            
                            </script>

                            <label for="inputDireccion">Direccion</label>
                            <input type="text" name="direccion" class="form-control" id="inputDireccion" placeholder="Ingrese direccion: calle N°" pattern="[A-Za-z0-9\s]+">
                            <label for="inputDireccion_CodPostal">Código Postal</label>
                            <input type="text" name="direccion_CodPostal" class="form-control" id="inputDireccion_CodPostal" placeholder="Ingrese código postal" pattern="[A-Za-z0-9\s]+" required="">
                            <label for="inputPais">País</label>
                            <input type="text" name="pais" class="form-control" id="inputPais" placeholder="Ingrese pais de origen" pattern="[A-Za-z0-9\s]+" required="" >
                            <label for="inputProvincia">Provincia</label>
                            <input type="text" name="provincia" class="form-control" id="inputProvincia" placeholder="Ingrese provincia" pattern="[A-Za-z0-9\s]+" required="">
                            <label for="inputLocalidad">Localidad</label>
                            <input type="text" name="localidad" class="form-control" id="inputLocalidad" placeholder="Ingrese localidad" pattern="[A-Za-z0-9\s]+" required="">
                            
                            <label for="inputTelefono">Telfono de contacto</label>
                            <input type="text" name="telefono" class="form-control" id="inputTelefono" placeholder="Ingrese telefono de contacto" required="">
                            
                            <label for="inputEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Ingrese correo electronico" required="">
                             

                            <label for="inputTipo">Tipo</label>
                            <select name="tipo_id" class="form-control" id="inputTipo" >
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('form').addEventListener('submit', function(e) {
                    let tipo = document.getElementById('inputTipo').value;
                    let carrera = document.getElementById('inputCarrera_Cod').value;

                    // Si tipo es estudiante, docente o graduado, carrera es obligatoria
                    if (tipo === '1' || tipo === '2' || tipo === '5') {
                        if (carrera === '') {
                            e.preventDefault();
                            alert('Debe seleccionar una carrera para este tipo de integrante.');
                            document.getElementById('inputCarrera_Cod').focus();
                            return false;
                        }
                    }
                    let campos = [
                        {id: 'inputNombre', mensaje: 'El nombre debe ser como figura en el DNI', soloTexto: true},
                        {id: 'inputApellido', mensaje: 'El apellido debe ser como figura en el DNI', soloTexto: true},
                        {id: 'inputTitulo', mensaje: 'El título no deben ser solo numeros ni contener caracteres especiales', soloTexto: true},
                        {id: 'inputDNI', mensaje: 'El DNI deben se 8 numero sin puntos ni espacios'},
                        {id: 'inputDireccion_CodPostal', mensaje: 'El código postal es incorrecto'},
                        {id: 'inputTelefono', mensaje: 'El teléfono debe ser un número de 10 dígitos'},
                        {id: 'inputEmail', mensaje: 'El email debe tener la forma <nombre>@<dominio>'},
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
