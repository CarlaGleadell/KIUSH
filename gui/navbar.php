<!-- Los estilos de navbar son definidos en la libreria css de Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

<<<<<<< HEAD
    <a class="navbar-brand" href="#">
        <img src="../lib/img/Logo-UNPA-UARG-azul.png" width="30" height="30" class="d-inline-block align-top" alt="">
        UARGFlow
=======
    <a class="navbar-brand" href="index_2.php">
        <img src="../lib/img/Logo-UNPA-UARG-azul.png" width="30" height="30" class="d-inline-block align-top" alt="">
        UNPA - UARG
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
        <span class="navbar-toggler-icon"></span>   
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="../app/usuarios.php">
                    <span class="oi oi-person" />
                    Usuarios
                </a>
            </li>

<<<<<<< HEAD
=======

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_PERMISOS)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../app/cursos.php">
                        <span class="oi oi-book" />
                        Cursos
                    </a>
                </li>
                <?php } ?>



>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_ROLES)) { ?>
                <li class = "nav-item">
                    <a class = "nav-link" href = "../app/roles.php">
                        <span class = "oi oi-graph" />
                        Roles
                    </a>
                </li>
            <?php } ?>

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_PERMISOS)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../app/permisos.php">
                        <span class="oi oi-lock-locked" />
                        Permisos
                    </a>
                </li>
                <?php } ?>
<<<<<<< HEAD
=======

                
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
                
                <li class="nav-item">
                    <a class="nav-link" href="../app/salir.php">
                        <span class="oi oi-account-logout" /> 
                        Salir
                    </a>
                </li>
<<<<<<< HEAD
=======
                </ul>

                <ul class="navbar-nav mr-auto">
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="KIUSH.php">
                        <img src="../lib/img/elefantekiush.png" width="110" height="30" class="d-inline-block align-top" alt="">
                    </a>
                </li>

>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
            </ul>
        </div>
    </nav>


    <div class="alert alert-info alert-dismissible fade show" role="alert">
        Ud. est&aacute; conectad@ como <strong><?= $_SESSION['usuario']->nombre; ?></strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>