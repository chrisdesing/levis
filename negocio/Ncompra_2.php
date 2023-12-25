<?php


require_once '../dato/compra_2.php';

class Ncompra_2{


    public function nRegistrarCompra($importe, $comprobante, $usuario_id,$proveedor_id,$detalles){
        $nCompra = new Nota_compra($importe, $comprobante, $usuario_id,$proveedor_id);
        return $nCompra->registrar_compra($detalles);

    }


    public function nMostrarCompra(){
        $nCompra = new Nota_compra("","","","");
        return $nCompra->mostrar_compra();
    }


    public function nEliminarCompra($id){
        $nCompra = new Nota_compra("","","","");
        return $nCompra->eliminar_compra($id);
    }



}