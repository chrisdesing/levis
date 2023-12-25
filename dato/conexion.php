<?php

class Conexion{
    private $servidor;
    private $usuario;
    private $contrasena;
    private $bd;
    private $puerto;

    public function __construct() {
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->contrasena = "root";
        $this->bd = "levis";
        $this->puerto = "3306";
    }

    public function conectar(){
        $mysql = new mysqli(
            $this->servidor,
            $this->usuario,
            $this->contrasena,
            $this->bd,
            $this->puerto
        );
        return $mysql;
    }

}

?>
