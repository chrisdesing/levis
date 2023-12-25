<?php

require_once '../dato/producto.php';

class Nproductos{


    public function nBuscarProducto($buscar){

        $nProducto = new Producto("","","","","","","","","","","","");
        $datos = $nProducto->buscar_producto($buscar);
        return $datos;
    }

    public function nCodigoProductoDuplicado($codigo){
        $nProducto = new Producto("","","","","","","","","","","","");
        return $nProducto->codigo_producto_duplicado($codigo);
    }
    
    public function nRegistrarProducto($codigo_producto,$nombre,$descripcion,$precio_venta,$precio_compra,$talla,$color,$existencia,$existencia_minima,$estado,$categoria_id,$imagen){
        $res = false;
        $codigo_duplicado = $this->nCodigoProductoDuplicado($codigo_producto);
        if (!$codigo_duplicado){
            $nProducto = new Producto($codigo_producto,$nombre,$descripcion,$precio_venta,$precio_compra,$talla,$color,$existencia,$existencia_minima,$estado,$categoria_id,$imagen);

            $res = $nProducto->registrar_producto();
        }
        

        return $res;
    }


    public function nEditarProducto($codigo_producto,$nombre,$descripcion,$precio_venta,$precio_compra,$talla,$color,$existencia,$existencia_minima,$estado,$categoria_id,$imagen,$id){
        $nProducto = new Producto($codigo_producto,$nombre,$descripcion,$precio_venta,$precio_compra,$talla,$color,$existencia,$existencia_minima,$estado,$categoria_id,$imagen);
      

        return $nProducto->editar_producto($id);
    }

    public function nEliminarProducto($id){
        $nProducto = new Producto("","","","","","","","","","","","");
        return $nProducto->eliminar_producto($id);
    }


    public function nMostrarProducto(){
        $nProducto = new Producto("","","","","","","","","","","","");
        return $nProducto->mostrar_producto();
    }
    public function nDetalleProducto_id($id){
        $nProducto = new Producto("","","","","","","","","","","","");
        return $nProducto->detalle_producto_id($id);
    }


    public function nMostrarProductoCarritoo($clave,$cantidad){
        $nProducto = new Producto("","","","","","","","","","","","");
        return $nProducto->mostrar_producto_carrito($clave,$cantidad);
    }

    public function nMostrarProductoCarrito($clave, $cantidad) {
        $nProducto = new Producto("","","","","","","","","","","","");
        $producto = $nProducto->mostrar_producto_carrito($clave, $cantidad);
    
        return $producto;
    }
    



    // public function nMostrarDetalleCarrito($id) {
    //     $nProducto = new Producto("","","","","","","","","","","","");
    //     $producto = $nProducto->detalle_carrito_id($id);
    
    //     return $producto;
    // }
}