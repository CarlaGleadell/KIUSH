<?php

include_once 'BDObjetoGenerico.Class.php';
include_once 'Permiso.Class.php';

class Rol extends BDObjetoGenerico {

    private $permisos;

    function __construct($id = null) {
        parent::__construct($id, "rol");
        $this->setPermisos("rol_permiso", "permiso", "id_rol", "id_permiso", "Permiso");
    }

    function getPermisos() {
        return $this->permisos;
    }

    function setPermisos($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion) {

        $this->setColeccionElementos($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion);
        $this->permisos = $this->getColeccionElementos();
        
    }
    
    function buscarPermisoPorId($id) {
        foreach ($this->getPermisos() as $PermisoRol) {
            if ($id == $PermisoRol->getId()) {
                return true;
            }
        }
        return false;
    }
}
