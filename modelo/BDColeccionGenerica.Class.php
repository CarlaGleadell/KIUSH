<?php

include_once 'BDModeloGenerico.Class.php';

class BDColeccionGenerica extends BDModeloGenerico {

    protected $coleccion;

    function getColeccion() {
        return $this->coleccion;
    }

    function setColeccion($tablaBD_, $nombreClase) {
        $this->query = "SELECT * FROM {$tablaBD_}";
        $this->datos = BDConexion::getInstancia()->query($this->query);
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object($nombreClase));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

}
