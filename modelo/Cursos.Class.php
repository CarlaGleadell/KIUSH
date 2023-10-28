<?php

include_once 'BDObjetoGenerico.Class.php';
<<<<<<< HEAD
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
=======

class Curso extends BDObjetoGenerico {

    protected $id;
    protected $nombre;
    protected $descripcion;
    protected $fechasDictado;
    protected $fechaInicioInscripcion;
    protected $fechaFinInscripcion;
    protected $lugar;
    protected $estado;
    protected $usuario_id;

   
    function __construct($id = NULL) {
        parent::__construct($id, "Curso");
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    }

    function getNombre() {
        return $this->nombre;
    }
<<<<<<< HEAD
=======

    function setNombre($nombre) {
        $this->nomrbe = $nombre;
    }

>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    function getDescripcion() {
        return $this->descripcion;
    }

<<<<<<< HEAD
=======
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function getFechasDictado() {
        return $this->fechasDictado;
    }

    function setFechasDictado($fechasDictado) {
        $this->fechasDictado = $fechasDictado;
    }

    function getFechaInicioInscripcion() {
        return $this->fechaInicioInscripcion;
    }

    function setFechaInicioInscripcion($fechaInicioInscripcion) {
        $this->fechaInicioInscripcion = $fechaInicioInscripcion;
    }


    function getFechaFinInscripcion() {
        return $this->fechaFinInscripcion;
    }

    function setFechaFinInscripcion($fechaFinInscripcion) {
        $this->fechaFinInscripcion = $fechaFinInscripcion;
    }

    function getLugar() {
        return $this->lugar;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }


>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)
    /**
     * 
     * @param type $tablaVinculacion
     * @param type $tablaElementos
     * @param type $idObjetoContenedor
     * @param type $atributoFKElementoColeccion
     * @param type $claseElementoColeccion
     * 
     */
<<<<<<< HEAD
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
=======
    
>>>>>>> 010b2d3 (version mostrada el martes 24 octubre)

}
