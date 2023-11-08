<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Cursos.Class.php';

class ColeccionCursos extends BDColeccionGenerica{
    
    /**
     *
     * @var Curso[]
     */
    private $curso;
       
    function __construct() {
        parent::__construct();
        $this->setColeccion("curso","Curso");
        $this->curso = $this->coleccion;
    }
    
     /**
     * 
     * @return array()
     */
    function getCursos() {
        return $this->curso;
    }
}


