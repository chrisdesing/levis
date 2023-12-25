<?php
require_once "conexion.php";
require_once "persona.php";

// TODO: la clase usuario hereda de la clase persona
class Usuario extends Persona{
    private $id_persona;
    private $usuario;
    private $clave;
    private $estado;

    public function __construct($id_persona,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave,$estado) {
        // TODO: obtenemos los atributos de la clase base
        parent::__construct ($ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero);
        $this->id_persona = $id_persona;
        $this->usuario = $usuario;
        $this->clave = password_hash($clave, PASSWORD_DEFAULT) ;
        $this->estado = $estado;
    }
    

    public function getIdPersona()
    {
        return $this->id_persona;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getEstado()
    {
        return $this->estado;
    }


    public function obtenerClave($usuario){
        // TODO: Instanciamos la clase conexion
        $conn = new Conexion();
        // TODO: obtenemos el metodo conectar
        $conect = $conn->conectar();

        $sql = "SELECT clave from usuarios where usuario = ?";
        // TODO: realizamos la preparacion de la sentencia sql para su ejecucion
        $stmt = $conect->prepare($sql);
        // TODO: realizamos la vinculacion respectiva de la declaracicon preparada
        $stmt->bind_param("s",$usuario);
        // TODO: realiza la ejecucion de la sentencia preparada
        $stmt->execute();
        // TODO: enlazamos en una variable el resultado de la ejecuacion
        $stmt->bind_result($valor);
        // Obtenermos el valor
        $stmt->Fetch();

        $stmt->close();
        $conect->close();
        return $valor;
    }

    public function obtenerCiEmail(){
        $conn = new Conexion();
        $conect = $conn->conectar();

        $sql= "select 1 from personas where ci = ? or telefono = ? or email = ? ";

        $stmt = $conect->prepare($sql);

        $ci = $this->getCi();
        $email = $this->getEmail();
        $telefono = $this->getTelefono();
        $stmt->bind_param("sss",$ci,$email,$telefono);

        $stmt->execute();
        $stmt-> bind_result($duplicado);
        $stmt->fetch();
        // $conect->close();
        return $duplicado;

    }
    

  

    
    
    public function obtener_usuario(){
        $conn = new Conexion();
        $conect = $conn->conectar();
        $sql = "select 1 from usuarios where usuario = ?";
        $stmt = $conect->prepare($sql);
        $usuario = $this->getUsuario();
        $stmt->bind_param("s",$usuario);
        $stmt->execute();
        $stmt-> bind_result($duplicados);
        $stmt->fetch();
        // $conect->close();
        return $duplicados;
    }

    


    public function obtenerEstadoUsuario($user){
        $conn = new Conexion();
        $connect = $conn->conectar();
         
        $sql = "SELECT estado
                FROM usuarios
                WHERE usuario = ?";
        
        $stmt = $connect->prepare($sql);

        // $id_persona = $this->getIdPersona();

        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->bind_result($status);
        $stmt->fetch();

        $stmt->close();
        $connect->close();
        return $status;
    }

    function validarEdicionUsuario($id, $ci, $email, $telefono) {
        $conn = new Conexion();
        $conect = $conn->conectar();
    
        //  si hay algun registro con la misma ci o email excluyendo el registro actual
        $sql = "SELECT 1 FROM personas WHERE (ci = ? OR email = ? OR telefono = ?) AND id_persona <> ?";
        $stmt = $conect->prepare($sql);
        
        $stmt->bind_param("sssi", $ci, $email, $telefono, $id);
    
        $stmt->execute();
        $stmt->bind_result($duplicado);
        $stmt->fetch();
    
        $conect->close();
    
        return $duplicado;
    }



    // public function obtenerTelefono(){
    //     $conn = new Conexion();
    //     $conect = $conn->conectar();

    //     $sql= "select 1 from personas where telefono = ?";

    //     $stmt = $conect->prepare($sql);

    //     $telefono = $this->getTelefono();
    //     $stmt->bind_param("s",$telefono);

    //     $stmt->execute();
    //     $stmt-> bind_result($duplicado);
    //     $stmt->fetch();
    //     return $duplicado;

    // }
 

    public function buscar_usuario($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $ssql = "SELECT usuarios.id_persona, personas.ci, personas.nombre, personas.apellidoP, personas.apellidoM, personas.telefono, personas.email, personas.direccion, personas.genero, usuarios.usuario, usuarios.clave, usuarios.estado
        FROM personas
        JOIN usuarios ON usuarios.id_persona = personas.id_persona 
        WHERE (personas.id_persona LIKE '%" . $buscar . "%' OR usuarios.usuario LIKE '%" . $buscar . "%' OR personas.ci LIKE '%" . $buscar . "%' OR personas.apellidoP LIKE '%" . $buscar . "%') and usuarios.estado = 'HABILITADO' ORDER BY personas.id_persona DESC";

        $result = $connect->query($ssql);
        $usuario = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                // $usuario[] = array(
                //     "id_persona"=>$row["id_persona"],
                //     "ci"=>$row["ci"],
                //     "nombre"=> $row["nombre"],
                //     "apellidop"=>$row["apellidoP"],
                //     "apellidom"=>$row["apellidoM"],
                //     "telefono"=>$row["telefono"],
                //     "email"=> $row["email"],
                //     "direccion"=>$row["direccion"],
                //     "genero"=>$row["genero"],
                //     "user"=>$row["usuario"],
                //     "estado"=>$row["estado"]
                // );
                $usuario[] = $row;

            }
        }
        // $jsostring = json_encode($usuario);
        $connect->close();
        return $usuario;
        // echo $jsostring;
    }

    public function registrarUsuario(){
        $res = true;
        $conn = new Conexion();
        $conect = $conn->conectar();
        $sql = "CALL InsetarPersonaUsuario(?,?,?,?,?,?,?,?,?,?)";

        $stmt = $conect->prepare($sql);

        $ci = $this->getCi();
        $nombre = $this->getNombre();
        $apellidoP = $this->getApellidoP();
        $apellidoM = $this->getApellidoM();
        $telefono = $this->getTelefono();
        $email = $this->getEmail();
        $direccion = $this->getDireccion();
        $genero = $this->getGenero();
        // $id_persona = $this->getIdPersona();
        $usuario = $this->getUsuario();
        $clave = $this->getClave();
        $stmt->bind_param("ssssssssss",
            $ci,
            $nombre,
            $apellidoP,
            $apellidoM,
            $telefono,
            $email,
            $direccion,
            $genero,
            $usuario,
            $clave
        );
        // echo $ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave;
        if($stmt->execute()){
            // $conect->commit();
            $res = true;
        }else{
            // $conect->rollback();
            $res = false;
        }

        // return $stmt->execute();
        // $conect->close();
        $stmt->close();
        $conect->close();
        return $res;
    }

    public function editarUsuario(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "CALL actualizar_persona_usuari(?,?,?,?,?,?,?,?,?,?)";
        // preparamos la sentecica sql
        $stmt = $connect->prepare($sql);
        $id_persona = $this->getIdPersona();
        $ci = $this->getCi();
        $nombre = $this->getNombre();
        $apellidoP = $this->getApellidoP();
        $apellidoM = $this->getApellidoM();
        $telefono = $this->getTelefono();
        $email = $this->getEmail();
        $direccion = $this->getDireccion();
        $genero = $this->getGenero();
        $usuario = $this->getUsuario();
        // $clave = $this->getClave();
        // $estado = $this->getEstado();

        $stmt->bind_param("isssssssss",
            $id_persona,
            $ci,
            $nombre,
            $apellidoP,
            $apellidoM,
            $telefono,
            $email,
            $direccion,
            $genero,
            $usuario,
            // $clave,
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
  
   
    public function eliminarUsuario(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "call eliminarUsuario(?)";
        // $ss="UPDATE usuarios SET estado =INHABILITADO WHERE id_persona = ?;
        // ";
        $stmt = $connect->prepare($sql);

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



    public function obtenerUsuarioId($id){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT personas.ci, personas.nombre, personas.apellidoP, personas.apellidoM, personas.telefono, personas.email, personas.direccion, personas.genero, usuarios.usuario, usuarios.estado
        FROM personas
        JOIN usuarios ON personas.id_persona = usuarios.id_persona
        WHERE personas.id_persona = ?";
        
        $stmt = $connect->prepare($sql);

        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = array();
        if($result->num_rows > 0){
           $usuario = $result->fetch_assoc();
        }
        $connect->close();
        // echo $usuario;
        return $usuario;

    }




    public function obtener_Id($user){
        // TODO: Instanciamos la clase conexion
        $conn = new Conexion();
        // TODO: obtenemos el metodo conectar
        $conect = $conn->conectar();

        $sql = "select id_persona from usuarios where usuario = ?";
        // TODO: realizamos la preparacion de la sentencia sql para su ejecucion
        $stmt = $conect->prepare($sql);
        // TODO: realizamos la vinculacion respectiva de la declaracicon preparada
        $stmt->bind_param("s",$user);
        // TODO: realiza la ejecucion de la sentencia preparada
        $stmt->execute();
        // TODO: enlazamos en una variable el resultado de la ejecuacion
        $stmt->bind_result($valor);
        // Obtenermos el valor
        $stmt->Fetch();

        $stmt->close();
        $conect->close();
        return $valor;
    }


    public function obtener_rol_usuario($user){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT r.nombre_rol
        FROM usuarios u
        JOIN asignar_rol_usuario aru ON u.id_persona = aru.persona_id
        JOIN roles r ON aru.roles_id = r.id_roles
        WHERE u.usuario = '$user'";

        $result = $connect->query($sql);
        $roles = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $roles[] = $row['nombre_rol'];
            }
        }
        $connect->close();
        return $roles;


    }
  
}