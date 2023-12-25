<?php   

require_once '../dato/categoria.php';

class Ncategoria{

    public function nBucasCategoria($buscar){

        $ncategoria = new Categoria('','');
        return $ncategoria->buscar_categoria($buscar);
        
    }

    public function esNull(array $datos){
        foreach ($datos as $dato){
            if(strlen(trim($dato)) < 1){
                return true;
            }
        }
        return false;
    }


    public function nRegistrarCategoria($nombre){
        $res = true;
        $ncategoria = new Categoria($nombre);

        if($ncategoria->registrar_categoria()){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
    }


    public function nEliminarcategoria($id){

        $ncategoria = new Categoria("","");


        return $ncategoria->eliminar_categoria($id);

    }

    public function nEditarCategoria($nombre,$id){
        $ncategoria = new Categoria($nombre);
        return $ncategoria->editar_categoria($id);
    }


    public function nObtenerCategoria(){
        $ncategoria = new Categoria("");
        return $ncategoria->obtener_catgorias();

    }
}