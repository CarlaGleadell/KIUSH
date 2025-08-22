<?php
include_once '../lib/Constantes.Class.php';
include_once '../modelo/ColeccionCursos.php';
include_once '../modelo/ColeccionIntegrantes.php';
$ColeccionCursos = new ColeccionCursos();
$ColeccionIntegrantes = new ColeccionIntegrantes();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" />  
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Cursos Disponibles</title>
        <style>
            .dictantes-list {
                list-style: none;
                padding-left: 0;
                margin-bottom: 0;
            }
            .dictantes-list li {
                display: flex;
                align-items: center;
                margin-bottom: 4px;
                font-size: 0.98em;
                background: #e9ecef;
                border-radius: 12px;
                padding: 2px 10px;
                margin-right: 5px;
                margin-top: 2px;
            }
            .dictantes-list .oi {
                margin-right: 6px;
                color: #007bff;
                font-size: 1em;
            }
            .info-dictado {
                margin-top: 10px;
                padding: 8px 12px;
                background: #f8f9fa;
                border-radius: 10px;
                font-size: 0.97em;
                box-shadow: 0 1px 2px rgba(0,0,0,0.04);
            }
            .card-btns {
                display: flex;
                flex-direction: column;
                gap: 8px;
                margin-top: 12px;
            }
        </style>
    </head>
    <body>
        <?php include_once '../gui/navbar_visitante.php'; ?>
        
        <div class="container">
            <div class="card-header">
                <h3>Cursos Disponibles</h3>
            </div>
            <div class="row mb-4 mt-4">
                <div class="col-md-6 offset-md-3">
                    <input type="text" id="buscadorCurso" class="form-control" placeholder="Buscar curso por nombre...">
                </div>
            </div>
            <div class="container">
                <div class="row" id="cursosContainer">
                <?php foreach ($ColeccionCursos->getCursos() as $Curso) {
                    if ($Curso->getEstado() == '1') { 
                        $imagen = '../lib/img/'. $Curso->getImagen();
                        $nombreCurso = htmlspecialchars($Curso->getNombre());
                        $descripcionCurso = htmlspecialchars($Curso->getDescripcion());
                        $idCurso = $Curso->getId();
                        ?>
                        <div class="col-md-4 curso-tarjeta" data-nombre="<?= strtolower($nombreCurso) ?>" style="margin-bottom: 30px;">
                            <div class="card" style="margin: 15px; display: flex; flex-direction: column; height: 100%;">
                                <img src='<?php echo $imagen ?>' style="width:100%; height: 120px; object-fit:cover" class="card-img-top">
                                <div class="card-body" style="flex: 1; overflow: auto;">
                                    <h5 class="card-title" style="height: 3em; overflow: hidden;"><?= $nombreCurso ?></h5>

                                    <p class="card-text mb-1"><b>Dictantes</b></p>
                                    <?php
                                    $integrantesDelCurso = $ColeccionIntegrantes->getIntegrantesPorCurso($idCurso);
                                    if (count($integrantesDelCurso) > 0) {
                                        echo '<ul class="dictantes-list">';
                                        foreach ($integrantesDelCurso as $Integrante) {
                                            echo '<li><span class="oi oi-person"></span>' . htmlspecialchars($Integrante['nombres'] . " " . $Integrante['apellidos']) . '</li>';
                                        }
                                        echo '</ul>';
                                    } else {
                                        echo '<span class="text-muted">Sin dictantes asignados</span>';
                                    }
                                    ?>

                                    <div class="info-dictado">
                                        <div class="mb-2">
                                            <span class="oi oi-clock" style="margin-right:6px; color:#17a2b8; vertical-align:middle;"></span>
                                            <b>Horario:</b>
                                            <div style="margin-left:24px; margin-top:2px;">
                                                <?= htmlspecialchars($Curso->getFechasDictado()) ?>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="oi oi-map-marker" style="margin-right:6px; color:#17a2b8; vertical-align:middle;"></span>
                                            <b>Lugar:</b>
                                            <div style="margin-left:24px; margin-top:2px;">
                                                <?= htmlspecialchars($Curso->getLugar()) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-btns">
                                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalDescripcion<?= $idCurso ?>">
                                            <span class="oi oi-document"></span> Ver descripción
                                        </button>
                                        <a href="persona.crear.php?id=<?= $idCurso; ?>" class="btn btn-primary btn-block">Inscribirse</a>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <!-- Modal Descripción -->
                        <div class="modal fade" id="modalDescripcion<?= $idCurso ?>" tabindex="-1" role="dialog" aria-labelledby="modalDescripcionLabel<?= $idCurso ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalDescripcionLabel<?= $idCurso ?>">Descripción del curso</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <?= nl2br($descripcionCurso) ?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php 
                    }
                } ?>             
                </div>
            </div>
        </div>
        <footer class="footer">
            KIUSH
            <span class="oi oi-person"></span> 
            UNPA-UARG
        </footer>
        <script>
            // Buscador 
            document.getElementById('buscadorCurso').addEventListener('input', function() {
                var filtro = this.value.toLowerCase();
                var tarjetas = document.querySelectorAll('.curso-tarjeta');
                tarjetas.forEach(function(card) {
                    var nombre = card.getAttribute('data-nombre');
                    if (nombre.includes(filtro)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        </script>
    </body>
</html>