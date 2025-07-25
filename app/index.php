<?php include_once '../lib/ControlAcceso.Class.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Login</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="../lib/img/Logo-UNPA-UARG-azul.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <?php echo Constantes::NOMBRE_SISTEMA; ?> - Cursos de extensión de la UNPA - UARG
                </a>
            </div>
        </nav>
        
        <div class="container">
            <section id="main-content">
                <article>
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-center">
                            <h3> Inscripciones a cursos</h3>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5>Ingreso al Sistema KIUSH</h5>
                            <p>Haga click en el siguiente botón para ver los cursos disponibles y completar su inscripción:</p>
                            <a href="curso.inscribirse.php" id="btnVisitante" class="btn btn-primary">
                                Ver cursos disponibles
                            </a>
                        </div>
                    </div>
                </article>
            </section>
        </div>

        <div class="container">
            <section id="main-content">
                <article>
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-center">
                            <h3> Ingreso como administrador</h3>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <h5>Ingreso al Sistema con UARGFlow BS</h5>
                            <p>Ud. puede ingresar el sistema si est&aacute; conectado a su e-mail. Por favor haga click en el bot&oacute;n a continuaci&oacute;n y elija su cuenta o realice el login.</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <div class="row vertical-align">
                                            <div class="col-11">
                                                <strong>Importante:</strong> Debe ingresar con un correo de <a href="http://www.gmail.com" target="_blank">GMail</a>.
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                            </div>
                            <div id="googleSignInButton"></div>
                        </div>
                    </div>
                </article>
            </section>
        </div>

        <footer class="footer">
            UARGFlow BS 
            <span class="oi oi-globe"></span> 
            UNPA-UARG
        </footer>

        <script src="https://accounts.google.com/gsi/client" async defer></script>
        <script type="text/javascript">
            function handleCredentialResponse(response) {
                console.log("Google response received:", response);
                
                try {
                    const responsePayload = JSON.parse(atob(response.credential.split('.')[1]));
                    
                    console.log("Email:", responsePayload.email);
                    console.log("Name:", responsePayload.name);
                    
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = './index.php';
                    
                    const emailField = document.createElement('input');
                    emailField.type = 'hidden';
                    emailField.name = 'email';
                    emailField.value = responsePayload.email;
                    form.appendChild(emailField);
                    
                    const nameField = document.createElement('input');
                    nameField.type = 'hidden';
                    nameField.name = 'nombre';
                    nameField.value = responsePayload.name;
                    form.appendChild(nameField);
                    
                    const imageField = document.createElement('input');
                    imageField.type = 'hidden';
                    imageField.name = 'imagen';
                    imageField.value = responsePayload.picture || '';
                    form.appendChild(imageField);
                    
                    const googleidField = document.createElement('input');
                    googleidField.type = 'hidden';
                    googleidField.name = 'googleid';
                    googleidField.value = responsePayload.sub;
                    form.appendChild(googleidField);
                    
                    document.body.appendChild(form);
                    console.log("Enviando formulario...");
                    form.submit();
                    
                } catch (error) {
                    console.error("Error:", error);
                }
            }

            window.onload = function () {
                console.log("Inicializando Google Sign-In...");
                
                if (typeof google !== 'undefined') {
                    google.accounts.id.initialize({
                        client_id: "356408280239-7airslbg59lt2nped9l4dtqm2rf25aii.apps.googleusercontent.com",
                        callback: handleCredentialResponse
                    });

                    google.accounts.id.renderButton(
                        document.getElementById("googleSignInButton"),
                        { 
                            theme: "outline", 
                            size: "large",
                            text: "signin_with",
                            shape: "rectangular"
                        }
                    );
                    console.log("Google Sign-In inicializado correctamente");
                } else {
                    console.error("Google API no se cargó");
                }
            }
        </script>
    </body>
</html>
