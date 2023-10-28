<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Cursos.Class.php';

class ColeccionCursos extends BDColeccionGenerica{
    
    /**
     *
     * @var Curso[]
     */
<<<<<<< HEAD
    private $cursos;
       
    function __construct() {
        parent::__construct();
        $this->setColeccion("cursos","Cursos");
        $this->cursos = $this->coleccion;
=======
    private $curso;
       
    function __construct() {
        parent::__construct();
        $this->setColeccion("curso","Curso");
        $this->curso = $this->coleccion;
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    }
    
     /**
     * 
     * @return array()
     */
<<<<<<< HEAD
    function getCurso() {
        return $this->cursos;
=======
    function getCursos() {
        return $this->curso;
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    }
}


