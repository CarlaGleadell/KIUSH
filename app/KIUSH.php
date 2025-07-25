<?php include_once '../lib/Constantes.Class.php'; ?>  
<html>     
    <head>     
        <meta charset="UTF-8">         
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />         
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />         
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>         
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>                 
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?></title>      
        <style>
            .body-content {
                flex: 1; 
                display: flex;
                flex-direction: column;
                justify-content: center; 
                align-items: center;
                text-align: center;
                background-image: url('../lib/img/fondo_kiush.png');
                background-size: cover;
                background-position: center;
                color: white;
                padding: 50px 20px;
            }
           
            .body-content h2 {
                font-size: 3em;
                margin-bottom: 30px;
            }
            .body-content p {
                font-size: 1.3em;
                margin-bottom: 40px;
            }
            .body-content a {
                color: white;
                text-decoration: underline;
            }
            .icon-links img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }
            .icon-links a {
                color: white;
                text-decoration: none;
                font-size: 1.3em;
            }
            .kiush-info {
                margin-top: 5px;
                margin-left: auto;  
                margin-right: auto; 
                width: 1000;       
                max-width: 100%; 
            }
            .kiush-info img {
                width: 662px;
                height: 176px;
            }
            .yy-info {
                margin-left: auto;  
                margin-right: auto; 
                width: 1000;       
                max-width: 100%; 
            }
            .yy-info img {
                width: 200px;
                height: 200px;
            }
            
        
        </style>
    </head>  

    <body>          
    <?php include_once '../gui/navbar_visitante.php'; ?>

        <div class="body-content">
            <div class= "kiush-info">
                <img src="../lib/img/logo_kiush_blanco.png" alt="Logo kiush">
                <br>
                <h2>Sistema de gestión de cursos de extensión</h2> 
                <p>
                    El sistema KIUSH  facilita la gestión de las inscripciones a los cursos de extensión de la Universidad Nacional de la Patagonia Austral,
                    Unidad Académica Río Gallegos, obteniendo un registro unificado de todos los datos de los cursos y sus respectivos inscriptos, 
                    agilizando así la creación de informes estadísticos dentro del área de extensión de la UNPA-UARG, y reduciendo el tiempo necesario
                    para la emision de certificados a través del sistema <a href="https://www.uarg.unpa.edu.ar/gedic/" target="_blank">Ge.Di.C.</a>
                </p>
            </div>
            

            
            <div class="yy-info">
                <p>
                    KIUSH fue desarrollado por el equipo de desarrollo <strong>Yield Yielders</strong>.
                    <br>
                    Somos Bahamonde Yohana y Gleadell Carla, alumnas avanzadas de la carrera Licenciatura en Sistemas
                    y Analista de Sistemas de la Universidad Nacional de la Patagonia Austral. 
                    <br>
                    Este sistema es el resultado de nuestro proyecto final de la materia Laboratorio de Desarrollo de Software
                    la cual consiste en desarrollar un sistema completo empleando un proceso iterativo incremental y metodologías ágiles.
                </p>
                <img src="../lib/img/circulo_blanco.png" alt="Logo del equipo">
            </div>

            <div class="icon-links">
                
                <a href="https://github.com/CarlaGleadell/KIUSH.git" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                    </svg>
                    Repositorio
                </a>
                <br>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=carlagleadell@gmail.com,yohanabahamonde7@gmail.com&su=Consulta%20sobre%20KIUSH&body=Hola,%20tengo%20una%20consulta%20sobre%20el%20sistema%20KIUSH." target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                    </svg>
                    Contáctenos
                </a>
                
    

            </div>
        </div>
    
        <?php include_once '../gui/footer_visitante.php'; ?>
   
    </body> 
</html>


