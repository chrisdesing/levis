<?php

require_once "../dato/roles.php";
class Nroles{


    function nBuscarRoles($buscar){
        
        $nRoles = new Roles("","","","");
        return $nRoles->buscar_rol($buscar);
    }


    public function rolDuplicado($nombre_rol){
        $nRoles = new Roles("",$nombre_rol,"","");
        return $nRoles->obtener_rol();
    }

    public function nRegistrarRol($nombre_rol,$descripcion){
        $res = false;
        $rolDuplicad = $this->rolDuplicado($nombre_rol);

        if(!$rolDuplicad){
            $nRoles = new Roles("",$nombre_rol,$descripcion,"");

            $res =  $nRoles->registrar_roles();
        }
        return $res;
    }


    public function nEliminar_roles($id){
        $nRoles = new Roles($id,"","","");

        return $nRoles->eliminar_roles($id);
    }


    public function validarRolEdit( $id,$nombre_rol){
        $nRoles = new Roles($id,$nombre_rol,"","");
        return $nRoles->validarEdicionRol($id,$nombre_rol);
    }


    public function nEditar_roles($id, $nombre_rol,$descripcion){
        $res = false;
        $duplicado = $this->validarRolEdit($id,$nombre_rol);
        if(!$duplicado){
            $nroles = new Roles($id,$nombre_rol,$descripcion,"");

            $res = $nroles->editar_roles($id);
        }

        return $res;
    }


    public function nMostrarRol(){
        $nroles = new Roles("","","","");
        return $nroles->mostrar_rol();
    }

}