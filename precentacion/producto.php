<?php
require_once '../negocio/Nproductos.php';

if (!isset($_POST['buscar'])) {
    $_POST['buscar'] = trim("");
    $buscar = trim($_POST['buscar']);
}

$buscar = trim($_POST['buscar']);

$Producto = new Nproductos();
$productos = $Producto->nBuscarProducto($buscar);



if (isset($_POST['registrar_producto'])) {
    $codigo = strtoupper(trim($_POST['codigo_producto']));
    $nombre = strtoupper(trim($_POST['nombre']));
    $descripcion = strtoupper(trim($_POST['descripcion']));
    $precio_venta = trim($_POST['precio_venta']);
    $precio_comptra = trim($_POST['precio_compra']);
    $talla = strtoupper(trim($_POST['talla']));
    $color = strtoupper(trim($_POST['color']));
    $existencia = trim($_POST['existencia']);
    $existencia_minima = trim($_POST['existencia_minima']);
    $estado = "DISPONIBLE";
    $categoria_id = trim($_POST['categoria_id']);

    // $image = $_POST['image'];
    $image = $_FILES['image']['name'];

    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $filename = $nombreDelArchivo . "__" . $image;
    $location = "../public/images/" . $filename;


    if ($Producto->nRegistrarProducto($codigo, $nombre, $descripcion, $precio_venta, $precio_comptra, $talla, $color, $existencia,$existencia_minima, $estado, $categoria_id, $filename)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $location);
        header("Location: pProducto.php");
    } else {
        session_start();
        $_SESSION['error_producto'] = "Codigo duplicado";
        header("Location: pProducto.php");
        exit;
        // echo 'duplicacion de codigo';
    }
}

if(isset($_POST['editar_producto'])){
    $codigo = strtoupper(trim($_POST['codigo_producto']));
    $nombre = strtoupper(trim($_POST['nombre']));
    $descripcion = strtoupper(trim($_POST['descripcion']));
    $precio_venta = trim($_POST['precio_venta']);
    $precio_comptra = trim($_POST['precio_compra']);
    $talla = strtoupper(trim($_POST['talla']));
    $color = strtoupper(trim($_POST['color']));
    $existencia = trim($_POST['existencia']);
    $existencia_minima = trim($_POST['existencia_minima']);
    // $estado = strtoupper(trim($_POST['estado']));
    $categoria_id = trim($_POST['categoria_id']);
    $id_producto = $_POST['id_producto'];

    
  
    if($Producto->nEditarProducto($codigo,$nombre,$descripcion,$precio_venta,$precio_comptra,$talla,$color,$existencia,$existencia_minima,"",$categoria_id,"",$id_producto)){
        header("Location: pProducto.php");
    }
    else{
        echo 'Error';
    }


}
if (isset($_POST['eliminar_producto'])) {
    $id = $_POST['id_producto'];

    if ($Producto->nEliminarProducto($id)) {
        header("Location: pProducto.php");
    } else {
        echo 'Error';
    }
}
