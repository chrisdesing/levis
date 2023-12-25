<?php 

require_once '../negocio/Ncompra.php';

// $nro_compra = $_POST['nro_compra'];
$id_producto = $_POST['id_producto'];
$id_proveedor = $_POST['id_proveedor'];
$fecha_compra = $_POST['fecha_compra'];
$comprobante = strtoupper(trim($_POST['comprobante']));
$id_usuario = $_POST['id_usuario'];
$precio_compra = $_POST['precio_compra'];
$cantidad_compra = $_POST['cantidad_compra'];

$stock_total = $_POST['stock_total'];


$compra = new Ncompra();
if($compra->nRegistrarCompra($id_producto,$id_proveedor,$fecha_compra,$comprobante,$id_usuario,$precio_compra,$cantidad_compra,$stock_total)){
    
    ?>
        <script>
            location.href = "pCompra.php";
        </script>
    <?php

}








