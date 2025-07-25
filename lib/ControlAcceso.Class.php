<?php

session_start();
include_once 'Constantes.Class.php';
include_once '../modelo/BDColeccionGenerica.Class.php';

class PermisosSistema {

    const PERMISO_SALIR = "Salir";
    const PERMISO_LOGIN = "Ingresar";

    const PERMISO_USUARIOS = "Usuarios";
    const PERMISO_PERMISOS = "Permisos";
    const PERMISO_ROLES = "Roles";
    const PERMISO_CURSOS = "Cursos";
    const PERMISO_INTEGRANTES = "Integrantes";
    const PERMISO_PREINSCRIPTOS = "Preinscriptos";

    const ROL_ESTANDAR = 'Encargado Gestion Cursos';

}

class PermisoSesion {

    public $id;
    public $nombre;

    protected $datos;

}

class RolSesion {

    public $id;
    public $nombre;

    public $permisos = array();

    protected $datos;

    public function __construct() {
        $this->setPermisos();
    }

    public function setPermisos() {


        $this->datos = BDConexion::getInstancia()->query(""
                . "SELECT p.id, nombre "
                . "FROM " . Constantes::BD_USERS . ".permiso p "
                . "JOIN " . Constantes::BD_USERS . ".rol_permiso rp ON p.id = rp.id_permiso "
                . "WHERE rp.id_rol = {$this->id} ");

        if (!$this->datos) {
            throw new Exception(ObjetoDatos::getInstancia()->errno, ObjetoDatos::getInstancia()->error);
        }

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->permisos[] = $this->datos->fetch_object("PermisoSesion");
        }
    }

}

class UsuarioSesion {

    public $id;
    public $email;
    public $nombre;
    protected $datos;
    public $roles;

    function __construct($email_, $nombre_ = null) {
        $this->email = $email_;
        $this->nombre = $nombre_;

        echo "<script>console.log('Buscando usuario: " . $email_ . "');</script>";
        
        try {
            $this->id = $this->buscarUsuarioBd();
            echo "<script>console.log('Usuario encontrado ID: " . $this->id . "');</script>";
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), $ex->getCode());
        }
        
        if (!$this->id){
            echo "<script>console.log('Usuario NO encontrado en BD');</script>";
            try {
                echo "<script> alert('No Tienes permiso. Comunicate con Extension')
                    window.location= '../index.php'
                    </script>";
            } catch (Exception $ex) {
                throw new Exception($ex->getMessage(), $ex->getCode());
            }
        } else {
            echo "<script>console.log('Usuario SÍ encontrado, continuando...');</script>";
        }

        echo "<script>console.log('Obteniendo roles...');</script>";
        $this->setRoles();
        echo "<script>console.log('Roles obtenidos');</script>";
    }

    public function buscarUsuarioBd() {

        $this->datos = BDConexion::getInstancia()->query(""
                . "SELECT id "
                . "FROM " . Constantes::BD_USERS . ".usuario "
                . "WHERE email = '{$this->email}' ");

        if (!$this->datos) {
            throw new Exception(BDConexion::getInstancia()->error, BDConexion::getInstancia()->errno);
        }

        return $this->datos->fetch_assoc()['id'];
    }

    function registrarUsuario() {

        BDConexion::getInstancia()->autocommit(false);
        BDConexion::getInstancia()->begin_transaction();

        $this->datos = BDConexion::getInstancia()->query(""
                . "INSERT INTO " . Constantes::BD_USERS . ".usuario "
                . "VALUES (NULL, '{$this->nombre}', '{$this->email}')");

        if (!$this->datos) {
            BDConexion::getInstancia()->rollback();
            throw new Exception(BDConexion::getInstancia()->error, BDConexion::getInstancia()->errno);
        }
        $this->id = (Int) BDConexion::getInstancia()->insert_id;

        $this->datos = BDConexion::getInstancia()->query(""
                . "INSERT INTO " . Constantes::BD_USERS . ".usuario_rol "
                . "SELECT {$this->id}, id "
                . "FROM " . Constantes::BD_USERS . ".rol "
                . "WHERE nombre = '" . PermisosSistema::ROL_ESTANDAR . "'");

        if (!$this->datos) {
            BDConexion::getInstancia()->rollback();
            throw new Exception(BDConexion::getInstancia()->error, BDConexion::getInstancia()->errno);
        }

        BDConexion::getInstancia()->commit();
        BDConexion::getInstancia()->autocommit(true);
    }

    public function setRoles() {

        $this->datos = BDConexion::getInstancia()->query(""
                . "SELECT r.id, r.nombre "
                . "FROM " . Constantes::BD_USERS . ".usuario u "
                . "JOIN " . Constantes::BD_USERS . ".usuario_rol ur ON (u.id = ur.id_usuario) "
                . "JOIN " . Constantes::BD_USERS . ".rol r ON (r.id = ur.id_rol) "
                . "WHERE u.id = {$this->id} ");

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->roles[] = $this->datos->fetch_object("RolSesion");
        }
    }

}

class ControlAcceso {

    public $datos;
    public $ubicacion;

    function __construct() {

        $this->ubicacion = Constantes::SERVER . $_SERVER["PHP_SELF"];


        if ($this->ubicacion != Constantes::HOMEURL) {
            unset($_SESSION["HTTP_REFERER"]);
            self::verificaLogin();
        } else {
            $_SESSION["HTTP_REFERER"] = Constantes::HOMEURL;
        }

        if (isset($_SESSION["HTTP_REFERER"]) && $_SESSION["HTTP_REFERER"] == Constantes::HOMEURL && isset($_POST['email'])) {
            try {
                $this->creaSesion($_POST['email'], $_POST['nombre']);
            } catch (Exception $e) {
                echo "<script>alert('{$e->getMessage()}');</script>";
                die($e->getMessage());
            }
            $this->redireccionaIndex();
        }

        if (
                ($this->ubicacion == Constantes::HOMEURL) &&
                (isset($_SESSION['usuario'])) &&
                (is_a($_SESSION['usuario'], 'UsuarioGoogle'))
        ) {
            $this->redireccionaIndex();
        }
    }


    static function requierePermiso($permiso_) {
        if (!self::verificaPermiso($permiso_, $_SESSION['usuario'])) {
            header("Location: " . Constantes::HOMEURL);
        }
    }

    static function verificaPermiso($permiso_) {
        $Usuario = $_SESSION['usuario'];
        if ($Usuario == null) {
            return false;
        }
        foreach ($Usuario->roles as $Rol) {
            foreach ($Rol->permisos as $Permiso) {
                if ($permiso_ == $Permiso->nombre) {
                    return true;
                }
            }
        }
        return false;
    }

    static function verificaLogin() {
    $currentPage = basename($_SERVER['PHP_SELF']);
    $allowedPages = ['persona.crear.php', 'persona.crear.procesar.php', 'curso.inscribirse.php'];
    
    if (in_array($currentPage, $allowedPages)) {
        return true;
    }
    
    if (!isset($_SESSION['usuario']) || (!is_a($_SESSION['usuario'], "UsuarioSesion"))) {
        header("Location: " . Constantes::HOMEURL);
    }
}

    function creaSesion($email_, $nombre_ = null) {
        try {
            $Usuario = new UsuarioSesion($email_, $nombre_);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        $_SESSION['usuario'] = $Usuario;
    }

    function redireccionaIndex() {
        echo "<script>console.log('Ejecutando redireccionaIndex...');</script>";
    
        $email=$_SESSION['usuario']->email;
        echo "<script>console.log('Email usuario: " . $email . "');</script>";

        $consulta="SELECT rol.nombre FROM `usuario_rol` "
            . "INNER JOIN usuario ON (usuario_rol.id_usuario=usuario.id) "
            . "INNER JOIN rol ON (usuario_rol.id_rol=rol.id) "
            . "WHERE usuario.email='$email'";
        
        echo "<script>console.log('Consulta SQL: " . $consulta . "');</script>";
        
        $this->datos=BDConexion::getInstancia()->query($consulta);
        echo "<script>console.log('Resultado consulta roles: ', " . json_encode($this->datos->fetch_all()) . ");</script>";
        
        $this->datos=BDConexion::getInstancia()->query($consulta);
        
        foreach ($this->datos as $v){
            echo "<script>console.log('Rol encontrado: " . $v['nombre'] . "');</script>";
            
            switch ($v['nombre']){
                case "Encargado Gestion Cursos":
                    echo "<script>console.log('Redirigiendo a index_2.php');</script>";
                    header("Location: ../app/index_2.php");
                    break;
                case "Administrador":
                    echo "<script>console.log('Redirigiendo a index_2.php');</script>";
                    header("Location: ../app/index_2.php");
                    break;
            }
        }
    }

    function esVisitante(){
        return !isset($_SESSION['usuario']) || !is_a($_SESSION['usuario'], "UsuarioSesion");
    }

}

$ControlAcceso = new ControlAcceso();
