<?php

require_once 'conexion.php';
class Roles{
    private $id_roles;
    private $nombre_rol;
    private $descripcion;
    private $estado_rol;

    public function __construct($id_roles,$nombre_rol,$descripcion,$estado_rol)
    {
        $this->id_roles = $id_roles;
        $this->nombre_rol = $nombre_rol;
        $this->descripcion = $descripcion;
        $this->estado_rol = $estado_rol;
    }
    public function getIdRoles()
    {
        return $this->id_roles;
    }

    public function getNombreRol()
    {
        return $this->nombre_rol;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getEstadoRol(){
        return $this->estado_rol;
    }


    public function buscar_rol($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT roles.id_roles, roles.nombre_rol, roles.descripcion, 
        DATE_FORMAT(roles.fecha_creacion, '%d %b %Y %H:%i:%s') AS fecha_creacion_formateado
        FROM roles WHERE (roles.nombre_rol LIKE '%" . $buscar . "%') and roles.estado_rol = 'HABILITADO' ORDER BY roles.id_roles DESC";

        // $sql = "SELECT roles.id_roles, roles.nombre_rol, roles.descripcion, roles.estado_rol, 
        // DATE_FORMAT(roles.fecha_creacion, '%d %b %Y') as roles.fecha_creacion_formatted
        // FROM roles WHERE roles.nombre_rol LIKE '%" . $buscar . "%'";
        // Realizamos una consulta en la base de datos
        $result = $connect->query($sql);
        // creamos una varible de tipo array con el fin de almacenar el resultado
        $roles = array();
        // verificamos si el resultado encontro resultados(fila)
        if($result->num_rows > 0){
            // realizamos un bucle y alaves lo almazenamos  en rows
            while ($rows = $result->fetch_assoc()){
                // en cada bucle el valor de rows lo almacenamos en el array q se definimos
                $roles[] = $rows;
            }
            
        }
        return  $roles;
        
    }
    public function obtener_rol(){
        $conn = new Conexion();
        $conect = $conn->conectar();
        $sql = "select 1 from roles where nombre_rol = ?";
        $stmt = $conect->prepare($sql);
        $nombre_rol = $this->getNombreRol();
        $stmt->bind_param("s",$nombre_rol);
        $stmt->execute();
        $stmt-> bind_result($duplicados);
        $stmt->fetch();
        // $conect->close();
        return $duplicados;
    }

    public function registrar_roles(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "insert into roles (nombre_rol, descripcion) values (?,?)";

        $stmt = $connect->prepare($sql);

        $nombre_rol = $this->getNombreRol();
        $descripcion = $this->getDescripcion();
        // $estado_rol = $this->getEstadoRol();
        $stmt->bind_param("ss", $nombre_rol,$descripcion);

        $result = $stmt->execute();

        $stmt->close();
        $connect->close();
    
        return $result;

    }


    public function eliminar_roles($id){
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "UPDATE roles set estado_rol = 'INHABILITADO'
        WHERE id_roles = ?";

        $stmt = $connect->prepare($sql);

        // $estado_rol = $this->getEstadoRol();
        $stmt->bind_param("i",$id);

        
        $result = $stmt->execute();

        $stmt->close();
        $connect->close();
    
        return $result;

    }


    function validarEdicionRol($id ,$nombre_rol) {
        $conn = new Conexion();
        $conect = $conn->conectar();
    
        //  si hay algun registro con la misma ci o email excluyendo el registro actual
        $sql = "SELECT 1 FROM roles WHERE nombre_rol = ? AND id_roles <> ?";
        $stmt = $conect->prepare($sql);
        
        $stmt->bind_param("si", $nombre_rol, $id);
    
        $stmt->execute();
        $stmt->bind_result($duplicado);
        $stmt->fetch();
    
        $conect->close();
    
        return $duplicado;
    }

    public function editar_roles($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "UPDATE roles
                SET nombre_rol = ?,
                    descripcion = ?
                    
                WHERE id_roles = ?";
        
        $stmt = $connect->prepare($sql);

        $nombre_rol = $this->getNombreRol();
        $descripcion = $this->getDescripcion();
        // $estado_rol = $this->getEstadoRol();
        $id_rol = $id;

        $stmt->bind_param("ssi",$nombre_rol,$descripcion,$id_rol);

        if ($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        
        return $res;
    }


    
    public function mostrar_rol(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT id_roles, nombre_rol
                FROM roles
                WHERE estado_rol = 'HABILITADO'
                ";
        $result  = $connect->query($sql);

        $roles = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $roles[] = $row;
            }
        }
        $connect->close();
        return $roles;
    }



    
    
}