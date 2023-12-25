<?php

require_once 'conexion.php';

class Nota_compra
{
    private $importe_compra;
    private $comprobante;
    private $usuario_id;
    private $proveedor_id;


    public function __construct($importe_compra, $comprobante, $usuario_id, $proveedor_id)
    {
        $this->importe_compra = $importe_compra;
        $this->comprobante = $comprobante;
        $this->usuario_id = $usuario_id;
        $this->proveedor_id = $proveedor_id;
    }


    public function getImporteCompra()
    {
        return $this->importe_compra;
    }

    public function getComprobante()
    {
        return $this->comprobante;
    }


    public function getUsuarioId()
    {
        return $this->usuario_id;
    }


    public function getProveedorId()
    {
        return $this->proveedor_id;
    }



    public function registrar_compra($detalleCompra)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        // Iniciamos con la transacción
        $connect->begin_transaction();

        $importe = $this->getImporteCompra();
        $comprobante = $this->getComprobante();
        $usuario_id = $this->getUsuarioId();
        $proveedor_id = $this->getProveedorId();

        $stmt_compra = null;
        $stmt_detalle = null;

        try {
            // Insertamos la compra principal
            $sql_compra = "INSERT INTO nota_compra (importe_compra,comprobante, usuario_id, proveedor_id) VALUES (?, ?, ?, ?)";
            $stmt_compra = $connect->prepare($sql_compra);
            $stmt_compra->bind_param("dsii", $importe, $comprobante, $usuario_id, $proveedor_id);

            if (!$stmt_compra->execute()) {
                throw new Exception("Error al insertar la compra");
            }

            // se obtiene el id de la compra recién registrada
            $compra_id = $stmt_compra->insert_id;

            // insertamos los detalles de la compra en la tabla detalle_venta
            foreach ($detalleCompra as $detalle) {
                $producto_id = $detalle['producto_id'];
                $precio_unitario = $detalle['precio_unitario'];
                $cantidad = $detalle['cantidad'];

                $sql_detalle = "INSERT INTO detalle_compra (compra_id, producto_id, precio_unitario, cantidad) VALUES (?, ?, ?, ?)";
                $stmt_detalle = $connect->prepare($sql_detalle);
                $stmt_detalle->bind_param("iidi", $compra_id, $producto_id, $precio_unitario, $cantidad);

                if (!$stmt_detalle->execute()) {
                    throw new Exception("Error al insertar los detalles de la venta");
                }
            }

            // se confirma la transaccion
            $connect->commit();
        } catch (Exception $e) {
            // en caso de error se realiza un rollback para deshacer cualquier cambio en la base de datos
            $connect->rollback();
            $res = false;
            // echo "Error: " . $e->getMessage();

        } finally {
            // Cerramos las declaraciones preparadas si están definidas
            if ($stmt_compra !== null) {
                $stmt_compra->close();
            }
            if ($stmt_detalle !== null) {
                $stmt_detalle->close();
            }
            $connect->close();
        }

        return $res;
    }





    public function mostrar_compra()
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT
        v.id_compra,
        v.comprobante,
        u.usuario,
        c.nombre_empresa,
        v.importe_compra,
        Date_FORMAT(v.fecha_compra,'%d %b %Y %H:%i:%s') as fecha_compra
        FROM nota_compra v
        INNER JOIN usuarios u ON v.usuario_id = u.id_persona
        INNER JOIN provedores c ON v.proveedor_id = c.id_persona
        WHERE v.estado_compra = 'ACTIVO';
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


    public function eliminar_compra($id)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE nota_compra SET estado_compra = 'INACTIVO' WHERE id_compra = ?";
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
