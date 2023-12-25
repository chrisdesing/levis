<?php
require_once 'conexion.php';

class Ventas
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





   


    public function registrar_ventas($detalleVenta)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
    
        // iniciamos con la transacción
        $connect->begin_transaction();
    
        $importe = $this->getImporte();
        $usuario_id = $this->getUsuarioId();
        $cliente_id = $this->getClienteId();
    
        $stmt_venta = null;
        $stmt_detalle = null;
    
        try {
            // se inserta la venta principal
            $sql_venta = "INSERT INTO ventas (importe, usuario_id, cliente_id) VALUES (?, ?, ?)";
            $stmt_venta = $connect->prepare($sql_venta);
            $stmt_venta->bind_param("dii", $importe, $usuario_id, $cliente_id);
    
            // verificamos si execute devuelve true o false
            if ($stmt_venta->execute()) {
                // obtenemos el ID de la venta recién registrada
                $venta_id = $stmt_venta->insert_id;
    
                // insertamos los detalles de la venta en la tabla detalle_venta
                foreach ($detalleVenta as $detalle) {
                    $producto_id = $detalle['producto_id'];
                    $precio_unitario = $detalle['precio_unitario'];
                    $cantidad = $detalle['cantidad'];
                    $talla = $detalle['talla'];
                    $sql_detalle = "INSERT INTO detalle_venta (venta_id, producto_id, precio_unitario, cantidad) VALUES (?, ?, ?, ?)";
                    $stmt_detalle = $connect->prepare($sql_detalle);
                    $stmt_detalle->bind_param("iidi", $venta_id, $producto_id, $precio_unitario, $cantidad);
    
                    // verificamos si execute devuelve true o false
                    if (!$stmt_detalle->execute()) {
                        $res = false;
                        break; 
                    }
                }
            } else {
                $res = false;
            }
    
            // confirmamos la transacción si todo salió bien
            if ($res) {
                $connect->commit();
            } else {
                $connect->rollback();
            }
        } finally {
            // cerramos las declaraciones preparadas si están definidas
            if ($stmt_venta !== null) {
                $stmt_venta->close();
            }
            if ($stmt_detalle !== null) {
                $stmt_detalle->close();
            }
            $connect->close();
        }
    
        return $res;
    }

    // nObtenerVentaPorId

    public function obtener_venta_id($id_venta)
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT
        v.id_venta,
        u.usuario,
        c.nombre,
        c.apellidoP,
        c.ci,
        v.importe,
        v.fecha_venta
        FROM ventas v
        INNER JOIN usuarios u ON v.usuario_id = u.id_persona
        INNER JOIN personas c ON v.cliente_id = c.id_persona
        WHERE v.estado_venta = 'ACTIVO' and  v.id_venta = ?
        ORDER BY v.fecha_venta DESC";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id_venta);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $ventasUser = array();
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    $ventasUser[] = $row;
                }
            }
        }
        $stmt->close();
        $connect->close();
        return $ventasUser;
    }


    public function mostrar_venta_user($usuario)
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT
                v.id_venta,
                u.usuario,
                c.nombre,
                c.ci,
                v.importe,
                Date_FORMAT(v.fecha_venta,'%d %b %Y %H:%i:%s') as fecha_venta
                FROM ventas v
                INNER JOIN usuarios u ON v.usuario_id = u.id_persona
                INNER JOIN personas c ON v.cliente_id = c.id_persona
                WHERE v.estado_venta = 'ACTIVO' and u.usuario = ?
                ORDER BY v.fecha_venta DESC";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $usuario);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $ventasUser = array();
            if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                    $ventasUser[] = $row;
                }
            }
        }
        $stmt->close();
        $connect->close();
        return $ventasUser;
    }
    public function mostrar_venta()
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT
        v.id_venta,
        u.usuario,
        c.nombre,
        c.ci,
        v.importe,
        Date_FORMAT(v.fecha_venta,'%d %b %Y %H:%i:%s') as fecha_venta
        FROM ventas v
        INNER JOIN usuarios u ON v.usuario_id = u.id_persona
        INNER JOIN personas c ON v.cliente_id = c.id_persona
        WHERE v.estado_venta = 'ACTIVO' 
        ";

        $result = $connect->query($sql);
        $ventas = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
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


    // parte del importe: generando en total del importe
    public function total_ventas(){
        $conn = new Conexion();
        $connect = $conn->conectar();

        $sql = "SELECT SUM(importe) AS total_ventas FROM ventas WHERE DATE(fecha_venta) = CURRENT_DATE AND estado_venta = 'ACTIVO'; 
        ";
        $result = $connect->query($sql);
        if($result){
            $row = $result->fetch_assoc();
            $totalVentas = $row['total_ventas'];
            $connect->close();

            return $totalVentas;
        }
    }


    public function total_Ventas_Fecha($fecha) {
        $conn = new Conexion();
        $connect = $conn->conectar();
    
        $sql = "SELECT SUM(importe) AS total_ventas FROM ventas WHERE DATE(fecha_venta) = ? AND estado_venta = 'ACTIVO'";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $stmt->bind_result($totalVentas);
    
        $stmt->fetch();
    
        $stmt->close();
        $connect->close();
    
        return $totalVentas;
    }
    
    public function total_venta_fecha_user($fecha,$usuario){
        $conn = new Conexion();
        $connect = $conn->conectar();
    
        $sql = "SELECT SUM(importe) AS total_ventas FROM ventas WHERE DATE(fecha_venta) = ? AND estado_venta = 'ACTIVO' AND usuario_id = ?;";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("si", $fecha,$usuario);
        $stmt->execute();
        $stmt->bind_result($total_por_producto);
    
        // $totalVentas = array();
    
        // while ($stmt->fetch()) {
        //     // $totalVentas[] = [
                
        //         'total_por_producto' => $total_por_producto
        //     // ];
        // }
    
        $stmt->fetch();
        $stmt->close();
        $connect->close();
    
        return $total_por_producto;
    }

   
    public function venta_dia_total($fecha) {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT V.id_venta, P.nombre, DV.cantidad, P.precio_venta, (DV.cantidad * P.precio_venta) AS total_por_producto
                FROM ventas V
                JOIN detalle_venta DV ON V.id_venta = DV.venta_id
                JOIN productos P ON DV.producto_id = P.id_producto
                WHERE DATE(V.fecha_venta) = ?  AND V.estado_venta = 'ACTIVO' ";
    
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $stmt->bind_result($id_venta, $nombre, $cantidad, $precio_venta, $total_por_producto);
    
        $ventaXdiaT = array();
    
        while ($stmt->fetch()) {
            $ventaXdiaT[] = [
                'id_venta' => $id_venta,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio_venta' => $precio_venta,
                'total_por_producto' => $total_por_producto
            ];
        }
    
        $stmt->close();
        $connect->close();
    
        return $ventaXdiaT;
    }

    public function venta_dia($fecha,$userr) {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT V.id_venta, P.nombre, DV.cantidad, P.precio_venta, (DV.cantidad * P.precio_venta) AS total_por_producto
                FROM ventas V
                JOIN detalle_venta DV ON V.id_venta = DV.venta_id
                JOIN productos P ON DV.producto_id = P.id_producto
                WHERE DATE(V.fecha_venta) = ? AND V.usuario_id = ? AND V.estado_venta = 'ACTIVO' ";
    
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("si", $fecha,$userr);
        $stmt->execute();
        $stmt->bind_result($id_venta, $nombre, $cantidad, $precio_venta, $total_por_producto);
    
        $ventaXdia = array();
    
        while ($stmt->fetch()) {
            $ventaXdia[] = [
                'id_venta' => $id_venta,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'precio_venta' => $precio_venta,
                'total_por_producto' => $total_por_producto
            ];
        }
    
        $stmt->close();
        $connect->close();
    
        return $ventaXdia;
    }
    
}
