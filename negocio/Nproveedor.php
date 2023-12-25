<?php

require_once '../dato/Proveedor.php';

class Nproveedor{


    public function buscarProveedor($buscar){
        $nproveedor = new Proveedor("","","","","","","","","","","");
        return $nproveedor->buscar_proveedor($buscar);
    }

    public function duplicadoTelefono($telefono){
        $nproveedor = new Proveedor("","",$telefono,"","","");
        return $nproveedor->obtenerTelefono();
    }


    public function registrarProveedor($nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa){
       $res = false;
        $duplicado  = $this->duplicadoTelefono($telefono);

        if(!$duplicado){
            $nproveedor = new Proveedor("",$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa);
            $res = $nproveedor->registrar_proveedor();
        }
        
        return $res;
    }

    public function validarEditproveedor($id,$telefono){
        $nproveedor = new Proveedor($id,"",$telefono,"","","");
        return $nproveedor->validartelefonoEdit($id,$telefono);
    }

    public function editarProveedot($id,$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa){
        $res = false;
        $duplicado = $this->validarEditproveedor($id,$telefono);

        if(!$duplicado){
            $nproveedor = new Proveedor($id,$nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa);
            $res = $nproveedor->editar_proveedor($id);
        }
       return $res;
    }


    public function eliminarProveedor($id){
        $nproveedor = new Proveedor("","","","","","");
        return $nproveedor->eliminar_proveedor($id);
    }

    public function nMostrarProveedor(){
        $nproveedor = new Proveedor("","","","","","");
        return $nproveedor->mostrar_proveedor();
    }
    
}