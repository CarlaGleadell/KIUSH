<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/ColeccionUsuarios.php';
$ColeccionUsuarios = new ColeccionUsuarios();
$valorBusqueda= $_GET['busquedaUsuario'];
$valor='0';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Usuarios</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Usuarios</h3>
                </div>
                
                <div class="card-body">
                    <p>
                        <a href="usuario.crear.php">
                            <button type="button" class="btn btn-success">
                                <span class="oi oi-plus"></span> Nuevo Usuario
                            </button>
                        </a>
                    </p>
                    

                    <form class="d-flex" action="usuario.buscar.php" method="get">
                        <input name ="busquedaUsuario" id="campoBusqueda" class="form-control me-2" type="search" placeholder="Buscar usuario por su nombre" aria-label="Buscar">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>


                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Usuario</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php foreach ($ColeccionUsuarios->getUsuarios() as $Usuario) {
                                if(stripos(strtolower($Usuario->getNombre()), $valorBusqueda) !== false){$valor=1?>
                                <td><?= $Usuario->getNombre(); ?><br /><?= $Usuario->getEmail(); ?></td>
                                <td>
                                    <a title="Ver detalle" href="usuario.ver.php?id=<?= $Usuario->getId(); ?>">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar" href="usuario.modificar.php?id=<?= $Usuario->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <a title="Eliminar" href="usuario.eliminar.php?id=<?= $Usuario->getId(); ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="oi oi-trash"></span>
                                        </button>
                                    </a>
                                </td>
                                </tr>
                            <?php }
                            }?>
                    </table>
                    <div><?php if($valor=='0') {echo '<h5 align="center" style="color:gray;">No se encontraron usuarios con ese nombre</h5>';}?></div>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>

