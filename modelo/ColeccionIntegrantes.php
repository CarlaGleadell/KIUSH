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

    public function getIntegrantesPorCurso($idCurso) {
        $query = "SELECT ci.*, i.nombres, i.apellidos, i.email 
              FROM curso_integrante ci 
              JOIN integrante i ON ci.integrante_id = i.id 
              WHERE ci.curso_id = '{$idCurso}'";
        $result = BDConexion::getInstancia()->query($query);
        $integrantes = [];
        while ($row = $result->fetch_assoc()) {
            $integrantes[] = $row;
        }
        return $integrantes;
    }
}
