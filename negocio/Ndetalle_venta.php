<?php
require_once '../dato/detalle_venta.php';

class Ndetalle_venta{

    public function NmostrarDetalleVenta($id_venta){
        $detalle = new Detalle_venta("","");
        return $detalle->mostrar_detalle_venta($id_venta);
    }
}