<?php
require_once '../negocio/Nventa.php';
session_start();
if (isset($_POST['totalVenta'])){
    $total = $_POST['totalVenta'];
    $usuario = $_POST['id_usuario'];
    $cliente = $_POST['id_cliente'];
    // echo $cliente . $usuario . $total;
    // $detalle = $_POST['detalles'];
    $detalles = json_decode($_POST['detalleVenta'], true);
    $dventa = new Nventa();
    // var_dump($detalles);
    if($dventa->nRegistrarVentas($total,$usuario, $cliente,$detalles)){

        ?>
        <script>
            location.href = "pVenta_2.php";
            
        </script>
        
    <?php
        
    }else {
        echo "Error al registrar la venta en la base de datos.";
    
    
    }
    
    
}

// if(isset($_POST['eliminar_venta'])){
//     $id = $_POST['id_venta'];
//     // echo $id;
//     $dventa = new Nventa();
//     if($dventa->nEliminarVenta($id)){
//         header("Location: pVenta_2.php");
//     }
// }