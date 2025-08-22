<?php

include_once 'BDObjetoGenerico.Class.php';

class Integrante extends BDObjetoGenerico {

    protected $id;
    protected $nombres;
    protected $apellidos;
    protected $dni;
    protected $titulo;
    protected $direccion;
    protected $direccion_CodPostal;
    protected $telefono;
    protected $email;
    protected $tipo_id;
    protected $carrera_Cod;

   
    function __construct($id = NULL) {
        parent::__construct($id, "integrante");
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getNombres() {
        return $this->nombres;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }


    function getApellidos() {
        return $this->apellidos;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    

    function getDni() {
        return $this->dni;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function getDireccion_CodPostal() {
        return $this->direccion_CodPostal;
    }

    function setDireccion_CodPostal($direccion_CodPostal) {
        $this->direccion_CodPostal = $direccion_CodPostal;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
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
