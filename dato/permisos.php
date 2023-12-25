<?php

require_once 'conexion.php';
class Permisos{

    private $nombre;
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function obtener_permiso_usuario($usuario){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT p.nombre_permiso
        FROM usuarios u
        JOIN asignar_rol_usuario aru ON u.id_persona = aru.persona_id
        JOIN roles r ON aru.roles_id = r.id_roles
        JOIN roles_permisos rp ON r.id_roles = rp.roles_id
        JOIN permisos p ON rp.permiso_id = p.id_permiso
        WHERE u.usuario = '$usuario'; ";

        $result = $connect->query($sql);
        $permisos = array();

        if($result->num_rows> 0){
            while($row = $result->fetch_assoc()){
                $permisos[] = $row['nombre_permiso'];
            }
        }

        $connect->close();
        return $permisos;
    }

}
