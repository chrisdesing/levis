<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
?>




<main class="mt-5 pt-4">




<?php
require_once '../negocio/Ndetalle_compra.php';
if (isset($_GET['id_compra'])) {
    $id_compra = $_GET['id_compra'];

    $pDetalleCompra = new Ndetalle_compra();
    $pDetalleCompras = $pDetalleCompra->NmostrarDetalleCompra($id_compra);


} else {

    header('Location: pListado_compra.php');
}
?>


<table class="table table-bordered table-striped table-sm mt-2 mx-2">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Talla</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($pDetalleCompras as $detalle) {
            $nombre_producto = $detalle['nombre'];
            $talla = $detalle['talla'];
            $precio_unitario = $detalle['precio_unitario'];
            $cantidad = $detalle['cantidad'];
        ?>
        <tr>


            <td><?php echo $nombre_producto ?> </td>
            <td><?php echo $talla  ?></td>
            <td><?php echo $precio_unitario ?> </td>
            <td><?php echo $cantidad ?> </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>



</main>


<?php
    require_once 'template/footer.php';
?>



