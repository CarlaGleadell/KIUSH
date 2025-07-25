<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$imagen=$_FILES['imagen'];
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

$destino = 'C:/xampp/htdocs/kiush/lib/img/';
$nombreImagen='';
if (file_exists($imagen['tmp_name'])) {
  $destino .= basename($imagen['name']);
  $nombreImagen = basename($imagen['name']);
} else {
  $destino .= 'cursoDefecto.png';
  $nombreImagen = 'cursoDefecto.jpg';
}
if (move_uploaded_file($imagen['tmp_name'], $destino)) {
  //se cargo
}else{
  //no se cargo
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Curso</title>
        
<?php 

/*
    Valido que la fecha de inicio de inscripciones
    sea previa a la fecha de fin de inscripciones
    */
$fechaInicio = strtotime($DatosFormulario["fechaInicioInscripcion"]);
$fechaFin = strtotime($DatosFormulario["fechaFinInscripcion"]);
$fechaActual = strtotime(date("Y-m-d"));
if ($fechaInicio > $fechaFin) { ?>
<div class="modal fade" id="myModal" tabindex="-1" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fecha no válida</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        La fecha de inicio de las inscripciones no puede ser despues de la fecha fin
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="aceptar">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
   $('#myModal').modal('show');
   
   $('#aceptar').click(function(){
       window.history.back();
   });
});
</script>

<?php
} else {
    /*
    Asigno el estado del curso en 1 (habilitado) 
    si la fecha actual se encutra dentro de 
    la fecha inicio y la fecha fin
    */
    
    $estado=0;
    if (($fechaActual >= $fechaInicio) && ($fechaActual <= $fechaFin)) {
       $estado=1;
    }
/*
guardo el id del usuario que creó el curso
*/

    $email_usuario=$_SESSION['usuario']->email;
    $id_usuario=0;
    $query = "SELECT id FROM bdkiush.usuario WHERE email = '{$email_usuario}'";
    $datos = BDConexion::getInstancia()->query($query);
    if ($datos->num_rows > 0) {
        $fila = $datos->fetch_assoc();
        $id_usuario= $fila['id'];
    } 
    
    $query = "INSERT INTO curso (id, nombre, descripcion, fechasDictado, 
            fechaInicioInscripcion, fechaFinInscripcion, lugar, estado, usuario_id, imagen) "
            . "VALUES ( null,
            '{$DatosFormulario["nombre"]}',
            '{$DatosFormulario["descripcion"]}',
            '{$DatosFormulario["fechasDictado"]}',
            '{$DatosFormulario["fechaInicioInscripcion"]}',
            '{$DatosFormulario["fechaFinInscripcion"]}',
            '{$DatosFormulario["lugar"]}', {$estado},{$id_usuario}, 
            '{$nombreImagen}')";
    $consulta = BDConexion::getInstancia()->query($query);

    if (!$consulta) {
        BDConexion::getInstancia()->rollback();
        //arrojar una excepcion
        die(BDConexion::getInstancia()->errno);
    }

    BDConexion::getInstancia()->commit();
    BDConexion::getInstancia()->autocommit(true);

  
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
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Crear Curso</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="cursos.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver al Menú
                        </button>
                    </a>
                    <a href="integrantes.curso.php?id=<?= $Curso->getId(); ?>"  >
                            <button type="button" class="btn btn-outline-primary">
                                Gestionar Integrantes
                            </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
<?php }//cierro else ?>