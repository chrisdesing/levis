<?php
require_once '../negocio/Ncompra_2.php';
if(isset($_POST['eliminar_compra'])){
    $id = $_POST['id_compra'];

    $compra = new Ncompra_2();
    
    // echo $id;
    if($compra->nEliminarCompra($id)){
        header('Location: pListado_compra.php');
    }else{
        echo 'Error en eliminar';
    }
}