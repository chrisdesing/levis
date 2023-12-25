<?php
require_once '../negocio/Ncompra_2.php';
session_start();
if (isset($_POST['total_compra'])){
    $total = $_POST['total_compra'];
    $comprobanteCompra = $_POST['comprobanteCompra'];
    $usuario = $_POST['id_usuario'];
    $proveedor = $_POST['id_proveedor'];
    // echo $cliente . $usuario . $total;
    // $detalle = $_POST['detalles'];
    $detalles = json_decode($_POST['detalleCompra'], true);
    $dcompra = new Ncompra_2();
    if($dcompra->nRegistrarCompra($total,$comprobanteCompra,$usuario, $proveedor,$detalles)){

        ?>
        <script>
            location.href = "pCompra_2.php";
            
        </script>
        
    <?php
        
    }else {
        // echo "Error al registrar la venta en la base de datos.";
        header('Location: pCompra_2.php');
    
    }
    
    
}
?>