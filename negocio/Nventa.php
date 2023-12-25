<?php


require_once '../dato/venta.php';

require_once '../dato/venta_2.php';
class Nventa{


    public function nRegistrarVentaa($importe, $usuario_id,$cliente_id,$detalles){
        $nVenta = new Venta($importe, $usuario_id,$cliente_id);
        return $nVenta->registrar_venta($detalles);

    }


    public function nMostrarVentaUser($usuario){
        $nVenta = new Ventas("","","");
        return $nVenta->mostrar_venta_user($usuario);
    }


    public function nObtenerVentaPorId($id_venta){
        $nVenta = new Ventas("","","");
        return $nVenta->obtener_venta_id($id_venta);
    }

    public function nMostrarVenta(){
        $nVenta = new Ventas("","","");
        return $nVenta->mostrar_venta();
    }
    

    public function nRegistrarVentas($importe, $usuario_id,$cliente_id,$detalles){
        $nVenta = new Ventas($importe, $usuario_id,$cliente_id);
        return $nVenta->registrar_ventas($detalles);

    }

    public function nEliminarVenta($id){
        $nVenta = new Ventas("","","");
        return $nVenta->eliminar_venta($id);

    }

// metodos para el reporte de vendtas por dia
    public function nTotal_ventas(){
        $nVenta = new Ventas("","","");
        return $nVenta->total_ventas();
    }



    public function nVentasXdia($fecha,$userr){
        $nVenta = new Ventas("","","");
        return $nVenta->venta_dia($fecha,$userr);
    }
    public function nVentasXdiaT($fecha){
        $nVenta = new Ventas("","","");
        return $nVenta->venta_dia_total($fecha);
    }


    public function nTotalVentas($fecha){
        $nVenta = new Ventas("","","");
        return $nVenta->total_Ventas_Fecha($fecha);
    }

    public function nTotalVentaFechaUser($fecha,$usuario){
        $nVenta = new Ventas("","","");
        return $nVenta->total_venta_fecha_user($fecha,$usuario);
    }

    
        
}