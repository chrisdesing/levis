<?php
require_once 'conexion.php';

class Detalle_venta
{
    private $precio_unitario;
    private $cantidad;

    public function __construct($precio_unitario, $cantidad)
    {
        $this->precio_unitario = $precio_unitario;
        $this->cantidad = $cantidad;
    }

    public function getPrecioUnitario()
    {
        return $this->precio_unitario;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function mostrar_detalle_venta($id_venta)
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT DV.id_detal_venta, P.nombre, P.talla, DV.precio_unitario, DV.cantidad
                FROM detalle_venta DV
                JOIN productos P ON DV.producto_id = P.id_producto
                WHERE DV.venta_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id_venta);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $detalles = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $detalles[] = $row;
                }
            }
        }

        $connect->close();
        return $detalles;
    }
}
