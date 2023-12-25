<?php
require_once "../dato/usuario.php";

class Nusuario{



    public function nObtenerEstado($user){
        $nUsuario = new Usuario("","","","","","","","","",$user,"","");
        $res = true;
        // $status = $nUsuario->obtenerEstadoUsuario();
        if ($nUsuario->obtenerEstadoUsuario($user) === "HABILITADO"){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    public function ingresar($usuario,$clave){
        
        $dusuario = new Usuario("","","","","","","","","",$usuario,$clave,"");
        $hash = $dusuario->obtenerClave($usuario);
        // $status = $this->nObtenerEstado();
        if (password_verify($clave,$hash) ){
            return true;
        }else{
            return false;
        }
    }



    public function validarDuplicados($ci,$email,$telefono){
        $dusuario = new Usuario("",$ci,"","","",$telefono,$email,"","","","","");
        return $dusuario->obtenerCiEmail();
    }

    public function nbuscarUsuario($buscar){
        $dusuario = new Usuario("","","","","","","","","","","","");
        return $dusuario->buscar_usuario($buscar);
    }

    public function validarDupliUsuario($usuario){
        $nUsuario = new Usuario("","","","","","","","","","$usuario","","");
        return $nUsuario->obtener_usuario();
    }
    public function registrarUsuarioPersona($ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave){
        $res = false;
        // echo $ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave ;
        $duplicado = $this->validarDuplicados($ci,$telefono,$email);
        $duplicUsuario = $this->validarDupliUsuario($usuario);
        if(!$duplicado and !$duplicUsuario){
            $dusuario = new Usuario("",$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave,"");
            // echo $ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,$clave;
            $res = $dusuario->registrarUsuario();
        }
        return $res;
    }
    public function validarDuplicadosEdit($id,$ci,$telefono,$email){
        $dusuario = new Usuario($id,$ci,"","","","",$email,"","","","","");
        return $dusuario->validarEdicionUsuario($id, $ci,$telefono, $email);
    }
    

    public function nEditarUsurio($id,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario){
        $res = false;
        $duplicado = $this->validarDuplicadosEdit($id,$ci,$email,$telefono);
        // $res = false;
        if(!$duplicado){
            $nUsuario = new Usuario($id,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,$usuario,"","");
            $res = $nUsuario->editarUsuario($id);
        }
        return $res;
    }



    public function nEliminarUsuario($id){
        $res = true;
        $nUsuario = new Usuario($id,"","","","","","","","","","","");
        if($nUsuario->eliminarUsuario()){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }



    // public function nObtenerUsuarioId($id){

    //     $nUsuario = new Usuario("","","","","","","","","","","","");
    //     return $nUsuario->obtenerUsuarioId($id);
        
    // }


    public function nObtener_id($user){
        $nUsuario = new Usuario("","","","","","","","","","","","");
        return $nUsuario->obtener_Id($user);
    }


    public function nObtenerRolUsuario($user){
        $nUsuario = new Usuario("","","","","","","","","","","","");
        return $nUsuario->obtener_rol_usuario($user);
    }

}