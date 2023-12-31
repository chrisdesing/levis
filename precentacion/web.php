<?php
    
    require_once '../negocio/Nproductos.php';
    require_once 'config.php';
    $producto = new Nproductos();
    $productos = $producto->nMostrarProducto();
    // session_destroy();
    // print_r($_SESSION);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levi's Store</title>

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
                  
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                    foreach($productos as $row){
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                     
                        <img src="<?php echo "../public/images/" . $row['imagen']; ?>" alt="" >
                       <!-- <img src="<?php echo $row['imagen'] ?>" alt=""> -->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre'] ?></h5>
                            <p class="card-text">Bs <?php  echo $row['precio_venta'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="detalles_producto.php?id_producto=<?php echo $row['id_producto']; ?>" class="btn btn-primary">Detalles</a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>