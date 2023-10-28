<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Integrante.Class.php';

class ColeccionIntegrantes extends BDColeccionGenerica {

    /**
     *
     * @var Integrante[]
     */
    private $integrantes;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("integrante","Integrante");
        $this->integrantes = $this->coleccion;
    }
    
     /**
     * 
     * @return array()
     */
    function getIntegrantes() {
        return $this->integrantes;
    }
}
