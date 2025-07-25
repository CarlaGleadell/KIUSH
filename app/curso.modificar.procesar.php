<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CURSOS);
include_once '../modelo/BDConexion.Class.php';
$DatosFormulario = $_POST;
$idCurso = $DatosFormulario["id"];
BDConexion::getInstancia()->autocommit(false);
BDConexion::getInstancia()->begin_transaction();

$query = "SELECT imagen FROM curso WHERE id = {$idCurso}";
$resultado = BDConexion::getInstancia()->query($query);
$imagenActual = $resultado->fetch_assoc()['imagen'];

$nombreImagen = $imagenActual;

if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['tmp_name'])) {
    $imagen = $_FILES['imagen'];
    $destino = 'C:/xampp/htdocs/kiush/lib/img/';
    $nombreImagen = basename($imagen['name']);
    $destino .= $nombreImagen;
    
    if (move_uploaded_file($imagen['tmp_name'], $destino)) {
        echo "<script>console.log('Imagen subida: " . $nombreImagen . "');</script>";
    } else {
        $nombreImagen = $imagenActual;
        echo "<script>console.log('Error al subir imagen, manteniendo anterior');</script>";
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Actualizar curso</title>

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
    guardo el id del usuario que modifico el curso
    */
    
        $email_usuario=$_SESSION['usuario']->email;
        $id_usuario=0;
        $query = "SELECT id FROM bdkiush.usuario WHERE email = '{$email_usuario}'";
        $datos = BDConexion::getInstancia()->query($query);
        if ($datos->num_rows > 0) {
            $fila = $datos->fetch_assoc();
            $id_usuario= $fila['id'];
        } 


$query = "UPDATE curso "
        . "SET nombre = '{$DatosFormulario["nombre"]}', descripcion = '{$DatosFormulario["descripcion"]}',
        fechasDictado = '{$DatosFormulario["fechasDictado"]}', fechaInicioInscripcion = '{$DatosFormulario["fechaInicioInscripcion"]}',
        fechaFinInscripcion = '{$DatosFormulario["fechaFinInscripcion"]}', lugar = '{$DatosFormulario["lugar"]}', estado = '{$estado}',
        usuario_id= '{$id_usuario}', imagen= '{$nombreImagen}'"
        . "WHERE id = {$idCurso}";
$consulta = BDConexion::getInstancia()->query($query);
if (!$consulta) {
    BDConexion::getInstancia()->rollback();
    //arrojar una excepcion
    die(BDConexion::getInstancia()->errno);
}


BDConexion::getInstancia()->commit();
BDConexion::getInstancia()->autocommit(true);


?>

    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Actualizar curso</h3>
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
                            <span class="oi oi-account-logout"></span> Salir
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>
<?php }//cierro else ?>