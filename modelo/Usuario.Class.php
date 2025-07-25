<?php

include_once 'BDObjetoGenerico.Class.php';
include_once 'Rol.Class.php';

class Usuario extends BDObjetoGenerico {

    protected $email;

    private $roles;

    function __construct($id = null) {
        parent::__construct($id, "usuario");
        $this->setRoles("usuario_rol", "rol", "id_usuario", "id_rol", "Rol");
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setRoles($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion) {
        $this->setColeccionElementos($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion);
        $this->roles = $this->getColeccionElementos();
    }

    function getRoles() {
        return $this->roles;
    }

    function buscarRolPorId($id) {
        foreach ($this->getRoles() as $RolUsuario) {
            if ($id == $RolUsuario->getId()) {
                return true;
            }
        }
        return false;
    }

}
