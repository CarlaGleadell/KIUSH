<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Cursos.Class.php';

class ColeccionCursos extends BDColeccionGenerica{
    
    /**
     *
     * @var Curso[]
     */
    private $cursos;
       
    function __construct() {
        parent::__construct();
        $this->setColeccion("cursos","Cursos");
        $this->cursos = $this->coleccion;
    }
    
     /**
     * 
     * @return array()
     */
    function getCurso() {
        return $this->cursos;
    }
}


