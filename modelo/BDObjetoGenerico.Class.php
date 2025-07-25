<?php
include_once 'BDModeloGenerico.Class.php';

class BDObjetoGenerico extends BDModeloGenerico {
    
    protected $id;
    protected $nombre;
    
    protected $coleccionElementos;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function __construct($id, $nombreTabla) {
        
        parent::__construct();
        $this->id = $id ? : $this->id;
        $this->query = "SELECT * FROM {$nombreTabla} WHERE id = {$this->id}";
        
        $this->datos = BDConexion::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        
        foreach($this->datos as $atributo => $valor){
            $this->{$atributo} = $valor;
        }
        
        unset($this->query);
        unset($this->datos);
        
    }

    function setColeccionElementos($tablaVinculacion, $tablaElementos, $idObjetoContenedor, $atributoFKElementoColeccion, $claseElementoColeccion) {

        $this->coleccionElementos = null;

        $this->query = "SELECT TablaElementos.* "
                . "FROM {$tablaElementos} TablaElementos, {$tablaVinculacion} TablaFK "
                . "WHERE TablaElementos.id = TablaFK.{$atributoFKElementoColeccion} "
                . "AND TablaFK.{$idObjetoContenedor} = {$this->id}";

        $this->datos = BDConexion::getInstancia()->query($this->query);
        if(!$this->datos) {
            print_r($this->BD->error);
        }
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->coleccionElementos[] = $this->datos->fetch_object($claseElementoColeccion);
        }

        unset($this->query);
        unset($this->datos);
    }
    
    function getColeccionElementos() {
        return $this->coleccionElementos;
    }


    
    
}
