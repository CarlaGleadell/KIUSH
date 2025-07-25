<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Permiso.Class.php';

class ColeccionPermisos extends BDColeccionGenerica {

    private $permisos;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("permiso","Permiso");
        $this->permisos = $this->coleccion;
    }

    function getPermisos() {
        return $this->permisos;
    }


}