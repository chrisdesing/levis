<?php
require_once 'conexion.php';
class Compra
{
    // private $nro_compra;
    private $producto_id;
    private $proveedor_id;
    private $fecha_compra;
    private $comprobante;
    private $usuario_id;
    private $precio_compra;
    private $cantidad;

    public function __construct($producto_id, $proveedor_id, $fecha_compra, $comprobante, $usuario_id, $precio_compra, $cantidad)
    {
        // $this->nro_compra = $nro_compra;
        $this->producto_id = $producto_id;
        $this->proveedor_id = $proveedor_id;
        $this->fecha_compra = $fecha_compra;
        $this->comprobante = $comprobante;
        $this->usuario_id = $usuario_id;
        $this->precio_compra = $precio_compra;
        $this->cantidad = $cantidad;
    }

    // public function getNroCompra()
    // {
    //     return $this->nro_compra;
    // }

    public function getProductoId()
    {
        return $this->producto_id;
    }

    public function getProveedorId()
    {
        return $this->proveedor_id;
    }
    public function getFechaCompra()
    {
        return $this->fecha_compra;
    }

    public function getComprobante()
    {
        return $this->comprobante;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    public function getPrecioCompra()
    {
        return $this->precio_compra;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function visualizar_compra()
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT c.id_compra, p.codigo_producto, p.nombre AS nombre_producto,
        pr.nombre_empresa AS nombre_proveedor, u.usuario AS nombre_usuario,
        c.precio_compra, c.cantidad, c.comprobante, c.fecha_compra
        FROM
            compras c
        JOIN
            productos p ON c.producto_id = p.id_producto
        JOIN
            provedores pr ON c.provedor_id = pr.id_persona
        JOIN
            usuarios u ON c.usuario_id = u.id_persona WHERE c.estado = 'ACTIVO' ORDER BY
        c.fecha_compra DESC ";

        $result = $connect->query($sql);
        $compra = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $compra[] = $row;
            }
        }
        $connect->close();
        return $compra;
    }
    // realizamos la parte trasaccional con dos sentencia: uno registra y el otro actuliza otra tabla.
    public function resgistrar_compra($stockTotal)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();

        // Iniciar la transacción
        $connect->begin_transaction();

        $sql = "INSERT INTO compras (producto_id,provedor_id,fecha_compra,comprobante,usuario_id,precio_compra,cantidad) VALUES (?,?,?,?,?,?,?);";

        $stmt = $connect->prepare($sql);
        // $nro_compra = $this->getNroCompra();
        $producto_id = $this->getProductoId();
        $proveedor_id = $this->getProveedorId();
        $fecha_compra = $this->getFechaCompra();
        $comprobante = $this->getComprobante();
        $usuario_id = $this->getUsuarioId();
        $precio_compra = $this->getPrecioCompra();
        $cantidad = $this->getCantidad();

        $stmt->bind_param(
            "iissidi",
            $producto_id,
            $proveedor_id,
            $fecha_compra,
            $comprobante,
            $usuario_id,
            $precio_compra,
            $cantidad
        );

        if ($stmt->execute()) {
            $sqlp = "UPDATE productos
                    SET existencia = ?
                    WHERE id_producto = ?
                    ";

            $stmt->prepare($sqlp);

            $id_producto = $this->getProductoId();
            $stmt->bind_param("ii", $stockTotal, $id_producto);

            if ($stmt->execute()) {
                // Confirmar la transacción
                $connect->commit();
            } else {
                // Revertir la transacción si la segunda operación falla
                $connect->rollback();
                $res = false;
            }
        } else {
            // Revertir la transacción si la primera operación falla
            $connect->rollback();
            $res = false;
        }

        return $res;
    }

    public function eliminar_compra($id)
    {
        $res = true;
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "UPDATE compras SET estado = 'INACTIVO' WHERE id_compra = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $res = true;
        } else {
            $res = false;
        }
        $stmt->close();
        $connect->close();
        return $res;
    }
}
