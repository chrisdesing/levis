<?php
require_once 'config.php';

require_once '../negocio/Nproductos.php';
$producto = new Nproductos();


$id = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';


if ($id == '' ) {
    echo 'Error al procesar la petición';
    exit;
} else {

        $productos = $producto->nDetalleProducto_id($id);
        foreach ($productos as $row) {
            $imagen = $row['imagen'];
            $nombre = $row['nombre'];
            $precio = $row['precio_venta'];
            $color = $row['color'];
            $talla = $row['talla'];
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
                    <!-- ocultando la parte de carrito -->
                    <a href="checkout.php" class="btn btn-primary" >
                        Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1 img">
                    <!-- <img src="../public/images/productos/3/principal.jpg" alt="" class="detalle-img"> -->
                    <img src="<?php echo "../public/images/" . $imagen ?>" style="width: 80%;" alt="">
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>
                    <h2><?php echo MONEDA . $precio; ?></h2>
                    <div style="border-radius: 50%; background-color: <?php echo $color; ?>;  "><?php echo $color; ?>

                    </div>
                    <div class="">
                        Talla
                        <h2><?php echo $talla; ?></h2>
                    </div>

                    <!-- active el hidden -->
                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button" >Comprar ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                    </div>

                </div>
            </div>
    </main>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script>
        function addProducto(id, token) {
            let url = '../clases/carrito.php'
            let formData = new FormData()
            formData.append('id',id)
            formData.append('token',token)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
            .then(data => {
                if(data.ok){
                    let elemento = document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
        }
    </script>

</body>

</html>