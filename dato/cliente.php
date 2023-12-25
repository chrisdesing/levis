<?php 
require_once 'conexion.php';
require_once 'persona.php';
class Cliente extends Persona{
    private $id_persona;
    // private $estado;

    public function __construct($id_persona,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero)
    {
        parent::__construct($ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero);
        $this->id_persona = $id_persona;
        // $this->estado = $estado;
    }

    public function getIdPersona()
    {
        return $this->id_persona;
    }

    // public function getEstado()
    // {
    //     return $this->estado;
    // }

    // metodo para mostrar los clientes en pVenta
    public function mostrar_cliente(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT clientes.id_persona, personas.ci, personas.nombre, personas.apellidoP, personas.apellidoM
                FROM personas
                JOIN clientes ON clientes.id_persona = personas.id_persona
                WHERE clientes.estado = 'ACTIVO'";
        $result = $connect->query($sql);
        $clientesss = array(); 
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $clientesss[] = $row; 
            }
        }
        $connect->close();
        return $clientesss; 
    }
    


    public function buscar_cliente($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT clientes.id_persona, personas.ci, personas.nombre, personas.apellidoP, personas.apellidoM, personas.telefono, personas.email, personas.direccion, personas.genero
        FROM personas
        JOIN clientes ON clientes.id_persona = personas.id_persona
        WHERE (personas.ci LIKE '%" . $buscar . "%' or personas.nombre LIKE '%". $buscar ."%' or personas.apellidoP LIKE '%" . $buscar . "%') and clientes.estado = 'ACTIVO' ORDER BY personas.id_persona DESC";

        $result = $connect->query($sql);
        $cliente = array();

        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $cliente[] = $row;
            }

        }
        $connect->close();
        return $cliente;
    }

    public function obtener_ci(){
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "SELECT 1
                FROM personas
                WHERE ci = ?";
        $stmt = $connect->prepare($sql);
        $ci = $this->getCi();
        $stmt->bind_param("s", $ci);
        $stmt->execute();
        $stmt->bind_result($duplicado_ci);
        $stmt->fetch();
        return $duplicado_ci;
    }

    public function obtener_email(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT 1
                FROM personas
                WHERE email = ?";
        $stmt = $connect->prepare($sql);
        $email = $this->getEmail();
        if (empty($email)) {
            return false; // Si el campo está vacío, no se busca en la base de datos
        }else{
            $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($duplicado_email);
        $stmt->fetch();
        return $duplicado_email;
        }
        
    }

    // public function emailExiste($email){
    //     $conn = new Conexion();
    //     $connect = $conn->conectar();
    //     $sql = "SELECT id_persona
    //             FROM personas
    //             WHERE email LIKE '%" . $email . "%'";
    //     $stmt = $connect->prepare($sql);
    //     $stmt->execute();
        

    // }

    public function registrar_cliente(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "CALL RegistrarCliente(?,?,?,?,?,?,?,?)";

        $stmt = $connect->prepare($sql);

        $ci = $this->getCi();
        $nombre = $this->getNombre();
        $apellidoP = $this->getApellidoP();
        $apellidoM = $this->getApellidoM();
        $telefono = $this->getTelefono();
        $email = $this->getEmail();
        $direccion = $this->getDireccion();
        $genero = $this->getGenero();
        $stmt->bind_param("ssssssss",$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }


    function validarEdicionCliente($id, $ci, $email) {
        $conn = new Conexion();
        $conect = $conn->conectar();
    
        //  si hay algun registro con la misma ci o email excluyendo el registro actual
        $sql = "SELECT 1 FROM personas WHERE (ci = ? OR (email = ? AND email <> '')) AND id_persona <> ?  " ;
        $stmt = $conect->prepare($sql);
        
        $stmt->bind_param("ssi", $ci, $email, $id);
    
        $stmt->execute();
        $stmt->bind_result($duplicado);
        $stmt->fetch();
    
        $conect->close();
    
        return $duplicado;
    }

    public function editar_cliente(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "call actualizar_persona_clientes(?,?,?,?,?,?,?,?,?)";

        $id_persona = $this->getIdPersona();
        $ci = $this->getCi();
        $nombre = $this->getNombre();
        $apellidoP = $this->getApellidoP();
        $apellidoM = $this->getApellidoM();
        $telefono = $this->getTelefono();
        $email = $this->getEmail();
        $direccion = $this->getDireccion();
        $genero = $this->getGenero();
        // $estado = $this->getEstado();
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("issssssss",
            $id_persona,
            $ci,
            $nombre,
            $apellidoP,
            $apellidoM,
            $telefono,
            $email,
            $direccion,
            $genero
            // $estado
        );
        
        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }

    public function eliminar_cliente(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        // $sql = "call eliminarUsuario(?)";
        $ss="UPDATE clientes SET estado = 'INACTIVO' WHERE id_persona = ?";
        $stmt = $connect->prepare($ss);

        $id = $this->getIdPersona();
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

?>