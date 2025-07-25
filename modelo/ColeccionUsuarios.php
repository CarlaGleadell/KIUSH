<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Usuario.Class.php';

class ColeccionUsuarios extends BDColeccionGenerica{

    private $usuarios;
       
    function __construct() {
        parent::__construct();
        $this->setColeccion("usuario","Usuario");
        $this->usuarios = $this->coleccion;
    }

    function getUsuarios() {
        return $this->usuarios;
    }
}


