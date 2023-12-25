<?php 

require_once 'conexion.php';
require_once 'persona.php';
class Proveedor extends Persona{
    private $id_persona;
    // private $estado;
    private $nombre_empresa;
    private $telefono_empresa;


    public function __construct($id_persona,$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa)
    {
        parent::__construct("",$nombre,"","",$telefono,"",$direccion,"");
        $this->id_persona = $id_persona;
        // $this->estado = $estado;
        $this->nombre_empresa = $nombre_empresa;
        $this->telefono_empresa = $telefono_empresa;
    }

    // public function getEstado()
    // {
    //     return $this->estado;
    // }
    public function getIdPersona()
    {
        return $this->id_persona;
    }

    public function getNombreEmpresa()
    {
        return $this->nombre_empresa;
    }

    public function getTelefonoEmpresa()
    {
        return $this->telefono_empresa;
    }




    public function obtenerTelefono(){
        $conn = new Conexion();
        $conect = $conn->conectar();

        $sql= "select 1 from personas where telefono = ?";

        $stmt = $conect->prepare($sql);

        $telefono = $this->getTelefono();
        $stmt->bind_param("s",$telefono);

        $stmt->execute();
        $stmt-> bind_result($duplicado);
        $stmt->fetch();
        // $conect->close();
        return $duplicado;

    }

    function validartelefonoEdit($id,$telefono) {
        $conn = new Conexion();
        $conect = $conn->conectar();
    
        //  si hay algun registro con la misma ci o email excluyendo el registro actual
        $sql = "SELECT 1 FROM personas WHERE telefono = ? AND id_persona <> ?";
        $stmt = $conect->prepare($sql);
        
        $stmt->bind_param("si",$telefono, $id);
    
        $stmt->execute();
        $stmt->bind_result($duplicado);
        $stmt->fetch();
    
        $conect->close();
    
        return $duplicado;
    }

    public function buscar_proveedor($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT provedores.id_persona, personas.nombre, personas.telefono,personas.direccion,provedores.estado, provedores.nombre_empresa,provedores.telefono_empresa
        FROM personas
        JOIN provedores ON provedores.id_persona = personas.id_persona
        WHERE (personas.nombre LIKE '%". $buscar ."%') and estado = 'ACTIVO'";

        $result = $connect->query($sql);
        $proveedor = array();
        if($result->num_rows > 0){
            while( $row = $result->fetch_assoc()){
                $proveedor[] = $row;
            }
        }
        $connect->close();
        return $proveedor;
    }

    
    public function mostrar_proveedor(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT id_persona, nombre_empresa
                FROM provedores
                WHERE estado = 'ACTIVO'
                ";

        $result = $connect->query($sql);
        $proveedor = array();
        if($result->num_rows > 0){
            while( $row = $result->fetch_assoc()){
                $proveedor[] = $row;
            }
        }
        $connect->close();
        return $proveedor;
    }
 
    public function registrar_proveedor(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "CALL InsertarPersonaYProveedor(?,?,?,?,?)";

        $stmt = $connect->prepare($sql);
        $nombre = $this->getNombre();
        $telefono = $this->getTelefono();
        $direccion = $this->getDireccion();
        
        $nombre_empresa = $this->getNombreEmpresa();
        $telefono_empresa = $this->getTelefonoEmpresa();
        $stmt->bind_param("sssss",$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa);
        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;

    }


    public function editar_proveedor($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "CALL ActualizarPersonaYProveedor(?,?,?,?,?,?)";
        $stmt = $connect->prepare($sql);
        $nombre = $this->getNombre();
        $telefono = $this->getTelefono();
        // $correo = $this->getEmail();
        $direccion = $this->getDireccion();
        $nombre_empresa = $this->getNombreEmpresa();
        $telefono_empresa = $this->getTelefonoEmpresa();
        $stmt->bind_param("isssss",$id,$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;

    }


    public function eliminar_proveedor($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE provedores set estado = 'INACTIVO' WHERE id_persona = ? ";
        $stmt = $connect->prepare($sql);

        $stmt->bind_param("i",$id);
        
        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }
    

  

   
}