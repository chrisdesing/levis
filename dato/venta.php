<?php
require_once 'conexion.php';

class Venta
{
    private $importe;
    private $usuario_id;
    private $cliente_id;


    public function __construct($importe, $usuario_id, $cliente_id)
    {
        $this->importe = $importe;
        $this->usuario_id = $usuario_id;
        $this->cliente_id = $cliente_id;
    }



    public function getImporte()
    {
        return $this->importe;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }


    public function getClienteId()
    {
        return $this->cliente_id;
    }






    public function registrar_venta($detalles)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        // inicializamos con la transaccion
        $connect->begin_transaction();
    
        $importe = $this->getImporte();
        $usuario_id = $this->getUsuarioId();
        $cliente_id = $this->getClienteId();
    
        try {
            // hacemos el respectivos insert
            $sql_venta = "INSERT INTO ventas (importe, usuario_id, cliente_id) VALUES (?, ?, ?)";
            $stmt_venta = $connect->prepare($sql_venta);
            $stmt_venta->bind_param("dii", $importe, $usuario_id, $cliente_id);
    
            if (!$stmt_venta->execute()) {
                throw new Exception("Error al insertar la venta");
            }
            // con esto obtenemos el id de la venta recien registrada
            $venta_id = $stmt_venta->insert_id; 
    
            // insertamos los detalles de la venta en la tabla "detalle_venta"
            // mediante un arrayf
            foreach ($detalles as $detalle) {
                $producto_id = $detalle['producto_id'];
                $precio_unitario = $detalle['precio_unitario'];
                $cantidad = $detalle['cantidad'];
    
                $sql_detalle = "INSERT INTO detalle_venta (venta_id, producto_id, precio_unitario, cantidad) VALUES (?, ?, ?, ?)";
                $stmt_detalle = $connect->prepare($sql_detalle);
                $stmt_detalle->bind_param("iidi", $venta_id, $producto_id, $precio_unitario, $cantidad);
    
                if (!$stmt_detalle->execute()) {
                    throw new Exception("Error al insertar los detalles de la venta");
                }
            }
    
            // confirmamosla transacción
            $connect->commit();
        } catch (Exception $e) {
            // En caso de error hacemos un rollback para deshacer cualquier cambio en la base de datos
            $connect->rollback();
            $res = false;
        } finally {
            $stmt_venta->close();
            $connect->close();
        }
    
        return $res;
    }
    
    


    public function mostrar_venta()
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT
        v.id_venta,
        u.usuario,
        c.nombre,
        v.importe,
        v.fecha_venta
        FROM ventas v
        INNER JOIN usuarios u ON v.usuario_id = u.id_persona
        INNER JOIN personas c ON v.cliente_id = c.id_persona
        WHERE v.estado_venta = 'ACTIVO'
        ORDER BY v.fecha_venta DESC";

        $result = $connect->query($sql);
        $ventas = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $ventas[] = $row;
            }
        }
        $connect->close();
        return $ventas;
    }



    public function eliminar_venta($id)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE ventas SET estado_venta = 'INACTIVO' WHERE id_venta = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }
}
