<?php

require_once 'conexion.php';

class AsignarRolUsuario{
    private $persona_id;
    private $roles_id;

    public function __construct($persona_id,$roles_id) {
        $this->persona_id = $persona_id;
        $this->roles_id = $roles_id;
    }

    public function getPersonaId()
    {
        return $this->persona_id;
    }

    public function getRolesId()
    {
        return $this->roles_id;
    }

    public function buscarUsuario($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();   

        $sql = "SELECT u.id_persona, u.usuario, r.nombre_rol, DATE_FORMAT(fecha_asignar, '%d %b %Y %H:%i:%s') AS fecha_asignar_formateado
        FROM usuarios u
        LEFT JOIN asignar_rol_usuario a ON u.id_persona = a.persona_id
        LEFT JOIN roles r ON a.roles_id = r.id_roles
        WHERE (u.usuario LIKE '%" . $buscar . "%') AND u.estado = 'HABILITADO' 
        ORDER BY fecha_asignar DESC";

        $result = $connect->query($sql);
        $user = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $user[] = $row;
            }
        }
        $connect->close();
        return $user;
    }

    public function asignarRolUsuario($persona_id,$roles_id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "INSERT INTO asignar_rol_usuario (persona_id, roles_id)
                VALUES (?, ?)";
        
        $stmt = $connect->prepare($sql);

        $personaId = $persona_id;
        $rolesId = $roles_id;

        $stmt->bind_param("ii",$personaId,$rolesId);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        return $res;

    }
}
    