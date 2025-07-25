<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="index_2.php">
        <img src="../lib/img/Logo-UNPA-UARG-azul.png" width="30" height="30" class="d-inline-block align-top" alt="">
        UNPA - UARG
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="toggle navigation">
        <span class="navbar-toggler-icon"></span>   
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_USUARIOS)) { ?>    
                <li class="nav-item">
                    <a class="nav-link" href="../app/usuarios.php">
                        <span class="oi oi-person" />
                        Usuarios
                    </a>
                </li>
            <?php } ?>

            <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_CURSOS)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../app/cursos.php">
                        <span class="oi oi-book" />
                        Cursos
                    </a>
                </li>
            <?php } ?>



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

                <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_INTEGRANTES)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../app/integrantes.gestionar.php">
                        <span class="oi oi-person" />
                        Integrantes
                    </a>
                </li>
                <?php } ?>

                <?php if (ControlAcceso::verificaPermiso(PermisosSistema::PERMISO_PREINSCRIPTOS)) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="../app/personas.gestionar.php">
                        <span class="oi oi-people" />
                        Inscriptos
                    </a>
                </li>
                <?php } ?>

                
                
                <li class="nav-item">
                    <a class="nav-link" href="../app/salir.php">
                        <span class="oi oi-account-logout" /> 
                        Salir
                    </a>
                </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="KIUSH.php">
                        <img src="../lib/img/elefantekiush.png" width="110" height="30" class="d-inline-block align-top" alt="">
                    </a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        Ud. est&aacute; conectad@ como <strong><?= $_SESSION['usuario']->nombre; ?></strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>