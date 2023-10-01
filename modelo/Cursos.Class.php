<?php

include_once 'BDObjetoGenerico.Class.php';
include_once 'Rol.Class.php';

class Cursos extends BDObjetoGenerico {

    protected $email;
    protected $nombre;

    /**
     *
     * @var Rol[]
     */
    private $roles;

    function __construct($id = NULL) {
        parent::__construct($id, "Cursos");
        //$this->setRoles("nombre", "descripcion", "email",);
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getNombre() {
        return $this->nombre;
    }
    function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * 
     * @param type $tablaVinculacion
     * @param type $tablaElementos
     * @param type $idObjetoContenedor
     * @param type $atributoFKElementoColeccion
     * @param type $claseElementoColeccion
     * 
     */
    function setRoles($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion) {
        $this->setColeccionElementos($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion);
        $this->roles = $this->getColeccionElementos();
    }

    function getRoles() {
        return $this->roles;
    }

    /**
     * 
     * @param int $id
     * @return boolean
     */
    function buscarRolPorId($id) {
        foreach ($this->getRoles() as $RolUsuario) {
            if ($id == $RolUsuario->getId()) {
                return true;
            }
        }
        return false;
    }

}
