<?php
require_once '../negocio/Nventa.php';
session_start();
if (isset($_POST['total_value'])){
    $total = $_POST['total_value'];
    $usuario = $_POST['id_usuario'];
    $cliente = $_POST['id_cliente'];
    // echo $cliente . $usuario . $total;
    // $detalle = $_POST['detalles'];
    $detalles = json_decode($_POST['detalles'], true);
    $venta = new Nventa();
    // var_dump($detalles);
    if($venta->nRegistrarVentaa($total,$usuario, $cliente,$detalles)){

        ?>
        <script>
            location.href = "pVenta.php";
            
        </script>
        
    <?php
    unset($_SESSION['carrito']);
        
    }else {
        // Hubo un error al registrar la venta en la base de datos
        echo "Error al registrar la venta en la base de datos.";
    
    
    }
    
    
}