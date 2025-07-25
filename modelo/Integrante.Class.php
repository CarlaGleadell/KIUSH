<?php

include_once 'BDObjetoGenerico.Class.php';

class Integrante extends BDObjetoGenerico {

    protected $id;
    protected $nombres;
    protected $apellidos;
    protected $dni;
    protected $titulo;
    protected $instituto;
    protected $categoriaDocente;
    protected $dedicación;
    protected $categoriaExtensionista;
    protected $direccion;
    protected $direccion_CodPostal;
    protected $telefono;
    protected $rol;
    protected $email;
    protected $organizacion;
    protected $funcion;
    protected $nivelEstudios;
    protected $ocupacion;
    protected $afeccionHorasSemanales;
    protected $afeccionTotalHoras;
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

    function getInstituto() {
        return $this->instituto;
    }

    function setInstituto($instituto) {
        $this->instituto = $instituto;
    }

    function getCategoriaDocente() {
        return $this->categoriaDocente;
    }

    function setCategoriaDocente($categoriaDocente) {
        $this->categoriaDocente = $categoriaDocente;

    }

    function getDedicacion() {
        return $this->dedicacion;
    }

    function setDedicacion($dedicacion) {
        $this->dedicacion = $dedicacion;
    }

    function getCategoriaExtensionista() {
        return $this->categoriaExtensionista;
    }

    function serCategoriaExtensionista($categoriaExtensionista) {
        $this->getCategoriaExtensionista = $categoriaExtensionista;
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

    function getRol() {
        return $this->rol;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getOrganizacion() {
        return $this->organizacion;
    }

    function setOrganizacion($organizacion) {
        $this->organizacion = $organizacion;
    }

    function getFuncion() {
        return $this->funcion;
    }

    function setFuncion($funcion) {
        $this->funcion = $funcion;
    }

    function getNivelEstudios() {
        return $this->nivelEstudios;
    }

    function setNivelEstudios($nivelEstudios) {
        $this->nivelEstudios = $nivelEstudios;
    }

    function getOcupacion() {
        return $this->ocupacion;
    }

    function setOcupacion($ocupacion) {
        $this->ocupacion = $ocupacion;
    }

    function getAfeccionHorasSemanales() {
        return $this->afeccionHorasSemanales;
    }

    function setAfeccionHorasSemanales($afeccionHorasSemanales) {
        $this->afeccionHorasSemanales = $afeccionHorasSemanales;
    }

    function getAfeccionTotalHoras() {
        return $this->afeccionTotalHoras;
    }

    function setAfeccionTotalHoras($afeccionTotalHoras) {
        $this->afeccionTotalHoras = $afeccionTotalHoras;
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
