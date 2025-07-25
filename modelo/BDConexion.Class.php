<?php

class BDConexion extends mysqli {

    private $host, $usuario, $contrasenia, $schema;
    public static $instancia;
    
    function __construct() {
        $this->host = "localhost";
        $this->usuario = "root";
        $this->contrasenia = "";
        $this->schema = "bdkiush";

        parent::__construct($this->host, $this->usuario, $this->contrasenia, $this->schema);

        if ($this->connect_errno) {
            throw new Exception("Error de Conexion a la Base de Datos", $this->connect_errno);
        }
    }
   
      public static function getInstancia() {
        if (!self::$instancia instanceof self) {
            try {
                self::$instancia = new self;
            } catch (Exception $e) {
                die("Error de Conexion a la Base de Datos: " . $e->getCode() . ".");
            }
        }
        return self::$instancia;
    }

}
