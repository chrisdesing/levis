<?php
require_once '../dato/detalle_compra.php';

class Ndetalle_compra{

    public function NmostrarDetalleCompra($id_compra){
        $detalle = new Detalle_compra("","");
        return $detalle->mostrar_detalle_compra($id_compra);
    }
}