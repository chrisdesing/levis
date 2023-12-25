<?php

use PSpell\Config;

require_once 'conexion.php';

class Categoria{
    // private $id_categoria;
    private $nombre_categoria;

    public function __construct($nombre_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;
    }



    public function getNombreCategoria()
    {
        return $this->nombre_categoria;
    }


    public function buscar_categoria($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();
            $sql = "SELECT id_categoria, nombre_categoria,fecha_creacion
                    FROM categorias
                    WHERE (nombre_categoria LIKE '%" . $buscar . "%' or estado LIKE '%" . $buscar . "%') and estado = 'ACTIVO'";
            
            $result = $connect->query($sql);
            $categoria = array();

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $categoria[] = $row;
                }
            }
            $connect->close();
            return $categoria;
       
    }

    

    public function registrar_categoria(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "INSERT INTO categorias (nombre_categoria) VALUES(?)";

        $stmt = $connect->prepare($sql);

        $nombre_categoria = $this->getNombreCategoria();
        $stmt->bind_param("s",$nombre_categoria);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }

    public function eliminar_categoria($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE categorias
                set estado = 'INACTIVO'
                WHERE id_categoria = ?";
        $stmt = $connect->prepare($sql);

        $id_categoria = $id;
        $stmt->bind_param("i",$id_categoria);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }

    public function editar_categoria($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "UPDATE categorias
                SET nombre_categoria = ?
                WHERE id_categoria = ?";

        $stmt = $connect->prepare($sql);

        $nombre_categoria = $this->getNombreCategoria();

        $stmt->bind_param("si",$nombre_categoria,$id);
        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    // metodo  para tener las categorias para productos
    public function obtener_catgorias(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT id_categoria, nombre_categoria
                FROM categorias
                WHERE estado = 'ACTIVO'
                ";

        $result = $connect->query($sql);
        $categoria = array();
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $categoria[] = $row;
            }
        }
        $connect->close();
            return $categoria;
    }
    
    
}