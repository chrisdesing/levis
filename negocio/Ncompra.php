<?php
require_once '../dato/compra.php';

class Ncompra{

    public function visualizarCompra(){
        $nCompra = new Compra('','','','','','','','');
        return $nCompra->visualizar_compra();
    }


    public function nRegistrarCompra($producto_id,$proveedor_id,$fecha_compra,$comprobante,$usuario_id,$precio_compra,$cantidad,$stockTotal){
        $nCompra = new Compra($producto_id,$proveedor_id,$fecha_compra,$comprobante,$usuario_id,$precio_compra,$cantidad);
        return $nCompra->resgistrar_compra($stockTotal);
    }

    public function nEliminarCompra($id){
        $nCompra = new Compra("","","","","","","");
        return $nCompra->eliminar_compra($id);
    }

    
}