<?php

require_once '../dato/asignar-roles.php';

class NasignarRolUsuario{

    public function nBuscarUsuario($buscar){
        // $res = true;
        $nAsignar = new AsignarRolUsuario("","");
        return $nAsignar->buscarUsuario($buscar);
    }



    public function nAsignarRoleUsuario($idPersona,$idRoles){
        $res = true;
        $nAsignar = new AsignarRolUsuario($idPersona,$idRoles);

        if($nAsignar->asignarRolUsuario($idPersona,$idRoles)){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }
}