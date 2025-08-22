<?php

include_once 'BDObjetoGenerico.Class.php';

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
    protected $imagen;

    public function getIntegrantes() {
        $query = "SELECT ci.*, i.nombre, i.apellido, i.email 
                  FROM curso_integrante ci 
                  JOIN integrante i ON ci.integrante_id = i.id 
                  WHERE ci.curso_id = '{$this->id}'";
        $result = BDConexion::getInstancia()->query($query);
        $integrantes = [];
        while ($row = $result->fetch_assoc()) {
            $integrantes[] = $row;
        }
        return $integrantes;
    }

   
    function __construct($id = NULL) {
        parent::__construct($id, "Curso");
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nomrbe = $nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

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
    
    
    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

}
