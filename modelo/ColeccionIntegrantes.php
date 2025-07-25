<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Integrante.Class.php';

class ColeccionIntegrantes extends BDColeccionGenerica {

    private $integrantes;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("integrante","Integrante");
        $this->integrantes = $this->coleccion;
    }

    function getIntegrantes() {
        return $this->integrantes;
    }

    function getIntegrantesPorCurso($idCurso) {
        $this->query = "SELECT integrante.* FROM integrante 
                        JOIN curso_integrante ON integrante.id = curso_integrante.integrante_id
                        WHERE curso_integrante.curso_id = {$idCurso}";
        $this->datos = BDConexion::getInstancia()->query($this->query);
        $integrantes = array();
        while ($fila = $this->datos->fetch_object('Integrante')) {
            $integrantes[] = $fila;
        }
        return $integrantes;
    }
}
