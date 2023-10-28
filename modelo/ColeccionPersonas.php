<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Persona.Class.php';

class ColeccionPersonas extends BDColeccionGenerica {

    /**
     *
     * @var Persona[]
     */
    private $personas;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("persona","Persona");
        $this->personas = $this->coleccion;
    }
    
     /**
     * 
     * @return array()
     */
    function getPersonas() {
        return $this->personas;
    }
}
