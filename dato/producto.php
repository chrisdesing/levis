<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

require_once 'conexion.php';

class Producto{
    private $codigo_producto;
    private $nombre;
    private $descripcion;
    private $precio_venta;
    private $precio_compra;
    private $talla;
    private $color;
    private $existencia;
    private $existencia_minima;
    private $estado;
    
    private $categoria_id;
    private $imagen;

    public function __construct($codigo_producto,$nombre,$descripcion,$precio_venta,$precio_compra,$talla,$color,$existencia,$existencia_minima,$estado,$categoria_id,$imagen)
    {
        $this->codigo_producto = $codigo_producto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio_venta = $precio_venta;
        $this->precio_compra = $precio_compra;
        $this->talla = $talla;
        $this->color = $color;
        $this->existencia = $existencia;
        $this->existencia_minima = $existencia_minima;
        $this->estado = $estado;
        $this->categoria_id = $categoria_id;
        $this->imagen = $imagen;
    }

   
    public function getCodigoProducto()
    {
        return $this->codigo_producto;
    }

  
    public function getNombre()
    {
        return $this->nombre;
    }

  
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecioVenta()
    {
        return $this->precio_venta;
    }

   
    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }

    public function getTalla()
    {
        return $this->talla;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getExistencia()
    {
        return $this->existencia;
    }
    public function getExistenciaMinima()
    {
        return $this->existencia_minima;
    }

    public function getEstado()
    {
        return $this->estado;
    }


    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function buscar_producto($buscar){
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "SELECT id_producto, codigo_producto,nombre,descripcion,precio_venta,precio_compra,talla,color,existencia,existencia_minima,estado,categoria_id, imagen
                FROM productos
                WHERE (codigo_producto LIKE '%" . $buscar . "%' or nombre LIKE '%" . $buscar . "%' or precio_venta LIKE '%" . $buscar . "%' or color LIKE '%" . $buscar . "%' or estado LIKE '%" . $buscar . "%') and estado = 'DISPONIBLE'";

        $result = $connect->query($sql);
        $productos = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $productos[] = $row; 
            }
        }
        $connect->close();
        return $productos;
    }

    public function codigo_producto_duplicado($codigo){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT 1 FROM productos WHERE codigo_producto = ? ";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s",$codigo);
        $stmt->execute();
        $stmt->bind_result($duplicado);
        $stmt->fetch();
        return $duplicado;
    }
    
    public function registrar_producto(){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "INSERT INTO productos (codigo_producto,nombre,descripcion,precio_venta,precio_compra,talla,color,existencia,existencia_minima,estado, categoria_id, imagen) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $connect->prepare($sql);

        $codigo_producto = $this->getCodigoProducto();
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio_venta = $this->getPrecioVenta();
        $precio_compra = $this->getPrecioCompra();
        $talla = $this->getTalla();
        $color = $this->getColor();
        $existencia = $this->getExistencia();
        $existencia_minima = $this->getExistenciaMinima();
        $estado = $this->getEstado();
        $categoria_id = $this->getCategoriaId();
        $imagen = $this->getImagen();

        $stmt->bind_param("sssddssiisis",
        $codigo_producto,
        $nombre,
        $descripcion,
        $precio_venta,
        $precio_compra,
        $talla,
        $color,
        $existencia,
        $existencia_minima,
        $estado,
        $categoria_id,
        $imagen
        );

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }

    public function editar_producto($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE productos
                set codigo_producto = ?,
                    nombre = ?,
                    descripcion = ?,
                    precio_venta  = ?,
                    precio_compra = ?,
                    talla = ?,
                    color = ?,
                    existencia = ?,
                    existencia_minima = ?,
                    
                    categoria_id = ?
                WHERE id_producto = ?";

        $stmt = $connect->prepare($sql);
        $codigo_producto = $this->getCodigoProducto();
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $precio_venta = $this->getPrecioVenta();
        $precio_compra = $this->getPrecioCompra();
        $talla = $this->getTalla();
        $color = $this->getColor();
        $existencia = $this->getExistencia();
        // $estado = $this->getEstado();
        $categoria_id = $this->getCategoriaId();
        $id_categoria = $id; 

        $stmt->bind_param("sssddssiiii",
        $codigo_producto,
        $nombre,
        $descripcion,
        $precio_venta,
        $precio_compra,
        $talla,
        $color,
        $existencia,
        $this->existencia_minima,
        $categoria_id,
        $id_categoria
        );

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }

        $stmt->close();
        $connect->close();
 
        return $res;
    }


    public function eliminar_producto($id){
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "UPDATE productos SET estado = 'AGOTADO' WHERE id_producto = ?";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i",$id);

        if($stmt->execute()){
            $res = true;
        }else{
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }

    

// metodo para mostrar los productos en pCompras
    public function mostrar_producto(){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT id_producto, codigo_producto, nombre,precio_venta,precio_compra,talla,color,existencia,estado,imagen
        FROM productos WHERE estado= 'DISPONIBLE' ";
        $result = $connect->query($sql);
        $productos = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $productos[] = $row;
            }
        }
        $connect->close();
        return $productos;

    }
    
// para mostrar en el catalogo
    public function detalle_producto_id($id){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT nombre,precio_venta,talla,color,existencia, estado,imagen
        FROM productos
        WHERE id_producto = $id";
        
        $result = $connect->query($sql);
        $productos = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $productos[] = $row;
            }
        }
        $connect->close();
        return $productos;

        
    }

// esta es la funcion apropieda para acceder mediante un array desde otro archivo
    public function mostrar_producto_carrito($clave,$cantidad){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT id_producto, nombre, precio_venta, talla, color, existencia, estado, imagen
                FROM productos
                WHERE id_producto = '$clave' ";
    
        $result = $connect->query($sql);
        $producto_carrito = null;
    
        if($result->num_rows > 0){
            $producto_carrito = $result->fetch_assoc();
            // Agregar la cantidad al resultado
            $producto_carrito['cantidad'] = $cantidad;
        }
    
        $connect->close();
        return $producto_carrito;
    }
    


    public function detalle_carrito_id($id){
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT precio_venta
        FROM productos
        WHERE id_producto = $id LIMIT 1";
        
        $result = $connect->query($sql);
        // $productos = array();
        $producto_carrito = null;
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $producto_carrito = $row;
            }
        }
        $connect->close();
        return $producto_carrito;

        
    }
    

    
}
