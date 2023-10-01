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
        
            <div class="card-header">
                    <h3>Sistemas de Inscripcion de Cursos- KIUSH</h3>
                    
            </div>
            <p>
                    <a href="usuarios.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Configuracion de Usuarios
                        </button>
                    </a>
            </p>



            <p>
                    <a href="curso.crear.php">
                        <button type="button" class="btn btn-success">
                            <span class="oi oi-plus"></span> Crear Curso
                        </button>
                    </a>
            </p>
            <p>
                        <a href="curso_nuevo.php">
                        <button type="button" class="btn btn-success">Administracion de cursos</button>
                        </button>
                    </a>
            </p>
            

            <div class="row">

            </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between row">
                        <a class="navbar-brand col-3" href="curso.inscripcion.php">
                          <img src="../lib/img/Curso_1.png" width="300" height="300">
                        </a>
                         <a class="navbar-brand col-3" href="https://www.uarg.unpa.edu.ar/index.php/component/jevents/eventodetalle/1176/19/primeras-jornadas-violencia-y-corporalidades?Itemid=164">
                            <img src="../lib/img/Curso_2.png" width="300" height="300">
                        </a>
                        <a class="navbar-brand col-3" href="#">
                            <img src="../lib/img/Curso_3.png" width="300" height="300">
                        </a>
                        <a class="navbar-brand col-3" href="#">
                            <img src="../lib/img/Curso_4.png" width="300" height="300">
                        </a>
                    </div>
                    
                </div>
            <div class="card">
 
                
                
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
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
