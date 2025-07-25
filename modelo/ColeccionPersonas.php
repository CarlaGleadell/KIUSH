<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Persona.Class.php';

class ColeccionPersonas extends BDColeccionGenerica {

    private $personas;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("persona","Persona");
        $this->personas = $this->coleccion;
    }

    function getPersonas() {
        return $this->personas;
    }

    function getPersonasPorCurso($idCurso) {
        $this->query = "SELECT persona.* FROM persona 
                        JOIN curso_persona ON persona.id = curso_persona.persona_id
                        WHERE curso_persona.curso_id = {$idCurso}";
        $this->datos = BDConexion::getInstancia()->query($this->query);
        $personas = array();
        while ($fila = $this->datos->fetch_object('Persona')) {
            $personas[] = $fila;
        }
        return $personas;
    }

}
