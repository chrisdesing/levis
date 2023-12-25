<?php

require_once '../negocio/Nproductos.php';
require_once 'config.php';


$productoss = (isset($_SESSION['carrito']['productos'])) ? $_SESSION['carrito']['productos'] : null;
// print_r($_SESSION);
// $producto= array();
$lista_carrito = array();
if ($productoss != null) {
    foreach ($productoss as $clave => $cantidad) {
        $producto = new Nproductos();
        $lista_carrito[] = $producto->nMostrarProductoCarrito($clave, $cantidad);
    }
}

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>




    <header>

        <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>Tienda Levi's Store</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">Contacto</a>
                        </li>
                    </ul>
                    <!-- ocultando CARRITO -->
                    <a href="../clases/carrito.php" class="btn btn-primary" >
                        Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                        } else {
                            $total = 0;
                            foreach ($lista_carrito as $productArray) {
                                // foreach ($productArray as $product) {
                                    $_id = $productArray['id_producto'];
                                    $nombre = $productArray['nombre'];
                                    $precio = $productArray['precio_venta'];
                                    $cantidad = $productArray['cantidad'];
                                    $subTotal = $cantidad * $precio;
                                    $total += $subTotal;
                                // }
                            
                        ?>



                                <tr>
                                    <td><?php echo $nombre ?></td>
                                    <td><?php echo MONEDA . number_format($precio, 2, '.', ',') ?></td>
                                    <td>
                                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $_id ?>" name="subtotal[]"><?php echo MONEDA . number_format($subTotal, 2, '.', ',') ?></div>
                                    </td>
                                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id ?>" data-bs-toggle="modal" data-bs-target="eliminaModal" >Eliminar</a></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ',') ?></p>
                                </td>
                            </tr>
                    </tbody>
                <?php } ?>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2" >
                    <!-- TODO: oculatando el buton realizar pago -->
                    
                    <button class="btb btn-primary btn-lg" >Realizar pago</button>
                </div>
            </div>

        </div>
    </main>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>



    <script>
        function actualizarCantidad(cantidad, id) {
            let url = '../clases/actulizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'agregar')
            formData.append('id', id)
            formData.append('cantidad', cantidad)
            

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {

                        let divsubtotal = document.getElementById('subtotal_' + id)
                        divsubtotal.innerHTML = data.sub

                        let total = 0.00;
                        let lista = document.getElementsByName('subtotal[]')

                        for(let i = 0; i < lista.length; i++){
                            total += parseFloat(lista[i].innerHTML.replace(/[Bs,]/g, ''))
                        }

                        total = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2
                        }).format(total)
                        document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total

                    }
                })
        }
    </script>
</body>

</html>