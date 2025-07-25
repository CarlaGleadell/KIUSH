<?php

include_once 'BDObjetoGenerico.Class.php';

class Persona extends BDObjetoGenerico {

    protected $id;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $dni;
    protected $estado;
    protected $pago;
    protected $nota;
    protected $asistencia;
    protected $tipo_id;
    protected $carrera_Cod;

   
    function __construct($id = NULL) {
        parent::__construct($id, "persona");
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    function getApellido() {
        return $this->apellido;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getDni() {
        return $this->dni;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getPago() {
        return $this->pago;
    }

    function setPago($pago) {
        $this->pago = $pago;
    }


    function getNota() {
        return $this->nota;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }

    function getAsistencia() {
        return $this->asistencia;
    }

    function setAsistencia($asistencia) {
        $this->asistencia = $asistencia;
    }

    function getTipo_id() {
        return $this->tipo_id;
    }

    function setTipo_id($tipo_id) {
        $this->tipo_id = $tipo_id;
    }

    function getCarrera_Cod() {
        return $this->carrera_Cod;
    }

    function setCarrera_Cod($carrera_Cod) {
        $this->carrera_Cod = $carrera_Cod;
    }

}
