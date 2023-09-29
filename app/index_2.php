<?php include_once '../lib/ControlAcceso.Class.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Menu Principal</title>
    </head>
    <body>

        <?php include_once '../gui/navbar_2.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Bienvenido al Sistema De Gestion de Inscripciones de Cursos de Extension- KIUSH</h3>
                    
                </div>
                <div class="card-header">
                    <h3>Bienvenido al Sistema De Gestion de Inscripciones de Cursos de Extension- KIUSH</h3>
                    
                </div>

                <div class="card-body">
                    <a class="navbar-brand" href="https://www.uarg.unpa.edu.ar/index.php/component/jevents/eventodetalle/1175/19/curso-carpinteria-avanzada-para-adultos?Itemid=164">
                        <img src="../lib/img/Curso_1.png" width="300" height="100" class="d-inline-block align-top" alt="">
                    </a>
                    <a class="navbar-brand" href="curso.inscripcion.php">
                        <img src="../lib/img/Curso_2.png" width="300" height="100" class="d-inline-block align-top" alt="">
                    </a>
                    <a class="navbar-brand" href="">
                        <img src="../lib/img/Curso_3.png" width="300" height="100" class="d-inline-block align-top" alt="">
                    </a>
                    <a class="navbar-brand" href="">
                        <img src="../lib/img/Curso_4.png" width="300" height="100" class="d-inline-block align-top" alt="">
                    </a>
                </div>

                
                <div class="aside">
                    <p>
                        <a href="usuarios.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Administracion de Usuarios
                        </button>
                    </a>
                    </p>
                    <p>
                        <a href="curso.crear.php">
                        <button type="button" class="btn btn-success"></button>
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Agregar un Nuevo Curso
                        </button>
                    </a>
                    </p>
                    <p>
                        <a href="curso.crear.php">
                        <button type="button" class="btn btn-success"></button>
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Buscar
                        </button>
                    </a>
                    </p>
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Usuario</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                        </tr>
                    </table>
                </div>
            </div>
             
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
