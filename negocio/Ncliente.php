<?php


require_once '../dato/cliente.php';

class Ncliente{



    // public function esNull(array $datos){
    //     foreach ($datos as $dato){
    //         if(strlen(trim($dato)) < 1){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    
    // function is_email($email){
    //     if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    //         return true;
    //     }
    //     return false;
    // }
    


    public function emailExiste($email){
        $ncliente = new Cliente("","","","","","",$email,"","","");
        return $ncliente->obtener_email($email);
    }
    public function nBuscarCliente($buscar){
        $ncliente = new Cliente("","","","","","","","","","");
        return $ncliente->buscar_cliente($buscar);
    }

    public function nMostrarCliente(){
        $nMostrarCliente = new Cliente("","","","","","","","","","");
        return $nMostrarCliente->mostrar_cliente();
    }

    public function nRegistrarCliente($ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero){
        $res = false;
        $ncliente = new Cliente("",$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero,"");

        $duplicado_ci = $ncliente->obtener_ci();
        $duplicado_email = $ncliente->obtener_email();
        if(!$duplicado_ci){
            if(!$duplicado_email){
                $res = $ncliente->registrar_cliente();
            }
        }
        return $res;
    }

    public function duplicadoEditCliente($id,$ci,$email){
        $ncliente = new Cliente($id,$ci,"","","","",$email,"","");

        return $duplicadoCliente = $ncliente->validarEdicionCliente($id,$ci,$email);

    }

    public function nEditarCliente($id_persona,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero){
        $res = false;
        $duplicadoClient = $this->duplicadoEditCliente($id_persona,$ci,$email);
        if($duplicadoClient!=1){
            $ncliente = new Cliente($id_persona,$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero);

            $res = $ncliente->editar_cliente();
        }

        

        return $res;
    }



    public function nEliminarCliente($id){
        $res = true;
        $nCliente = new Cliente($id,"","","","","","","","","");
        if($nCliente->eliminar_cliente()){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }

    // public function frecuente(){
    //     $ncliente = new Cliente("","","","","","","","","","");
    //     return $ncliente->frecuencia();
    // }

  
}