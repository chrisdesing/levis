<?php
require_once 'conexion.php';

class Detalle_compra
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

    public function mostrar_detalle_compra($id_compra)
    {
        $conn = new Conexion();
        $connect = $conn->conectar();
        $sql = "SELECT DC.id_detalle_compra, P.nombre, P.talla, DC.precio_unitario, DC.cantidad
                FROM detalle_compra DC JOIN productos P ON DC.producto_id = P.id_producto
                WHERE DC.compra_id = ? ";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $id_compra);

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
