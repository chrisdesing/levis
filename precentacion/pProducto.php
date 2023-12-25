<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

require_once 'template/header.php';
require_once 'producto.php';
?>

<main class="mt-5 pt-4">

    <?php
    if (isset($_SESSION['error_producto'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_producto'] . '</div>';
        unset($_SESSION['error_producto']);
    }
    ?>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de producto</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="register" class="row g-3" role="form" onsubmit="return validadProducto()" method="POST" action="producto.php" enctype="multipart/form-data">
                        <!-- <div class="row col-md"> -->
                        <div class="col-md-4">
                            <label for="codigo" class="form-label"><span class="text-danger">*</span>Codigo de producto</label>
                            <input type="text" id="codigo" class="form-control " name="codigo_producto" placeholder="Ingrese el codigo del producto">
                            <small style="color: red; display: none" id="lbl_codigo">Campo invalido</small>
                        </div>
                        <div class="col-md-4">
                            <label for="nombre_produc" class="form-label">Nombre producto</label>
                            <input type="text" id="nombre_produc" class="form-control" name="nombre">
                            <small style="color: red; display: none" id="lbl_nombre_produc">Campo invalido</small>
                        </div>
                        <div class="col-md-4">
                            <label for="file" class="form-label">Imagen</label>
                            <input type="file" name="image" id="file" class="form-control">
                            <output id="list"></output>
                            <br>
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files;
                                    // Obtenemos la imagen del campo file
                                    for (var i = 0, f; f = files[i]; i++) {
                                        //Solo admitimos imagenes
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }
                                        var reader = new FileReader();
                                        reader.onload = (function(theFile) {
                                            return function(e) {
                                                // Insertamos la imagen
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
                                            };
                                        })(f);
                                        reader.readAsDataURL(f);
                                    }
                                }
                                document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                        </div>

                        <div class="col-md-4">
                            <label for="descripcion_pro" class="form-label">descripcion</label>
                            <input type="text" id="descripcion_pro" class="form-control" name="descripcion" placeholder="Opcional">
                        </div>


                        <div class="col-md-3">
                            <label for="precio_venta" class="form-label">Precio-Venta</label>
                            <input type="number" step="0.01" id="precio_venta" class="form-control" name="precio_venta">
                            <small style="color: red; display: none" id="lbl_precio_venta">Campo obligatorio</small>
                        </div>

                        <div class="col-md-3">
                            <label for="precio_compra" class="form-label">Precio-Compra</label>
                            <input type="number" step="0.01" name="precio_compra" id="precio_compra" class="form-control">
                            <small style="color: red; display: none" id="lbl_precio_compra">Campo obligatorio</small>
                        </div>

                        <div class="mb-1 col-md-2">
                            <label for="talla" class="form-label">Talla</label>
                            <select class="form-select" id="talla" name="talla">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="X">X</option>
                                <option value="2XL">2XL</option>
                                <option value="28">28</option>
                                <option value="30">30</option>
                                <option value="32">32</option>
                                <option value="34">34</option>
                                <option value="36">36</option>
                                <option value="38">38</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" id="color" class="form-control" name="color">
                            <small style="color: red; display: none" id="lbl_color">Campo invalido</small>
                        </div>
                        <div class="col-md-2">
                            <label for="existencia" class="form-label">Existencia</label>
                            <input type="number" id="existencia" class="form-control" name="existencia">
                            <small style="color: red; display: none" id="lbl_existencia">Campo obligatorio</small>
                        </div>

                        <div class="col-md-2">
                            <label for="existencia_minima" class="form-label">Stock minimo</label>
                            <input type="number" id="existencia_minima" class="form-control" name="existencia_minima">
                            <small style="color: red; display: none" id="lbl_existencia_minima">Campo obligatorio</small>
                        </div>

                        <div class="mb-1 col-md-4">
                            <label for="categoria_id" class="form-label">Categoria</label>
                            <select class="form-select" id="categoria_id" name="categoria_id">

                                <?php
                                require_once '../negocio/Ncategoria.php';
                                $pCategoria = new Ncategoria();
                                $categorias = $pCategoria->nObtenerCategoria();
                                ?>

                                <?php
                                foreach ($categorias as $dato) {

                                ?>
                                    <option value="<?php echo $dato['id_categoria']; ?>">
                                        <?php
                                        echo $dato['nombre_categoria'];
                                        ?>
                                    </option>


                                <?php
                                }
                                ?>

                            </select>
                        </div>


                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-primary" name="registrar_producto">Registrar_Producto</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>















    <div class="col-md-12">
        <div class="card custom-cardd">
            <!-- Tabla 1 -->

            <div class="card-body">
                <h5 class="card-title" style="text-align: center;">Administrar Productos</h5>

                <?php
                foreach ($_SESSION['nombre_rol'] as $rol) {
                ?>

                    <?php
                    if ($rol == 'ADMINISTRADOR') {
                    ?>
                        <button type="button" class="btn btn-primary px-4 " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-plus"></i>
                            Registrar_producto
                        </button>
                    <?php
                    }
                    ?>

                <?php
                }
                ?>
                <form class="d-flex ms-auto" action="pProducto.php" method="post">
                    <div class="input-group my-3 my-lg-4" style="width: 35%;">
                        <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search"></i>Buscar_producto</button>
                    </div>
                </form>
                <div class="table table-responsive">

                    <table id="lista_productos" class="table table-bordered table-striped table-sm">

                        <thead>
                            <tr>


                                <!-- <th>id</th> -->
                                <th style="display: none;">ID</th>
                                <th style="display: none;">Codigo</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <!-- <th>Descripcion</th> -->
                                <th>Precio Venta</th>

                                <th style="text-align: center;">Ulti-Precio compra</th>

                                <th>Talla</th>
                                <th>Color</th>
                                <th>Stock</th>
                                <th>Stock minimo</th>
                                <!-- <th>Estado</th> -->

                                <th>Acciones</th>

                            </tr>

                        </thead>
                        <tbody>


                            <?php
                            foreach ($productos as $producto) { ?>

                                <tr>
                                    <td style="display:none;"><?php echo $producto['id_producto']; ?></td>
                                    <td style="display: none;"><?php echo $producto['codigo_producto']; ?></td>
                                    <td><?php echo $producto['nombre']; ?></td>
                                    <td>
                                        <img src="<?php echo "../public/images/" . $producto['imagen']; ?>" width="60px" alt="">
                                    </td>
                                    <td style="text-align: center;"><?php echo $producto['precio_venta']; ?></td>


                                    <td style="text-align: center;"><?php echo $producto['precio_compra']; ?></td>



                                    <td><?php echo $producto['talla']; ?></td>
                                    <td><?php echo $producto['color']; ?></td>
                                    <?php
                                    $stock_actual = $producto['existencia'];
                                    $stock_minimo = $producto['existencia_minima'];

                                    if ($stock_actual < $stock_minimo) { ?>
                                        <td style="background-color: #ee868b;"><?php echo $producto['existencia']; ?></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td><?php echo $producto['existencia']; ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td style=" text-align: center; background-color: $ee868b;"><?php echo $producto['existencia_minima']; ?></td>
                                    <td style="display:none;"><?php echo $producto['categoria_id']; ?></td>
                                    <?php
                                    if ($rol == 'ADMINISTRADOR') {
                                    ?>
                                        <td>

                                            <button type="button" class="btn btn-danger delete_producto" data-bs-toggle="modal" data-bs-target="#eliminar" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto">
                                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                                eliminar producto
                                            </button>


                                            <button type="button" class="btn btn-warning editar_producto" data-bs-toggle="modal" data-bs-target="#editar">
                                                <!-- <i class="fa-solid fa-pen"></i> -->
                                                editar_producto
                                            </button>
                                        </td>
                                    <?php
                                    }
                                    ?>


                                </tr>

                                <!-- </tbody> -->
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!-- -- Modal para la edicion de productos -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edicion de producto</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editar_producto" class="row g-3" role="form" method="POST" action="producto.php" onsubmit="return validarEditProduct()">
                        <input type="hidden" id="id_product" name="id_producto">
                        <div class="col-md-6">
                            <label for="codigo_producto" class="form-label">Codigo de producto</label>
                            <input type="text" id="codigo_producto" class="form-control " name="codigo_producto" readonly>
                            <small style="color: red; display: none" id="lbl_codigoo">Campo obligatorio</small>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_producto" class="form-label">Nombre producto</label>
                            <input type="text" id="nombre_producto" class="form-control" name="nombre">
                            <small style="color: red; display: none" id="lbl_nombre_producto">Campo invalido</small>
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <input type="text" id="descripcion" class="form-control" name="descripcion" >

                        </div> -->

                        <div class="col-md-6">
                            <label for="precio-venta" class="form-label">Precio-Venta</label>
                            <input type="number" id="precio-venta" class="form-control" name="precio_venta">
                            <small style="color: red; display: none" id="lbl_precio-venta">Campo obligatorio</small>

                        </div>

                        <div class="col-md-6">
                            <label for="precio-compra" class="form-label">Precio-Compra</label>
                            <input type="number" name="precio_compra" id="precio-compra" class="form-control">
                            <small style="color: red; display: none" id="lbl_precio-compra">Campo obligatorio</small>
                        </div>

                        <div class="mb-1 col-md-6">
                            <label for="talla_producto" class="form-label">Talla</label>
                            <select class="form-select" id="talla_producto" name="talla">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="X">X</option>
                                <option value="2XL">2XL</option>
                                <option value="28">28</option>
                                <option value="30">30</option>
                                <option value="32">32</option>
                                <option value="34">34</option>
                                <option value="36">36</option>
                                <option value="38">38</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="color_producto" class="form-label">Color</label>
                            <input type="text" id="color_producto" class="form-control" name="color">
                            <small style="color: red; display: none" id="lbl_color_producto">Campo invalido</small>
                        </div>
                        <div class="col-md-6">
                            <label for="existencia_producto" class="form-label">Stock</label>
                            <input type="number" id="existencia_producto" class="form-control" name="existencia">
                            <small style="color: red; display: none" id="lbl_existencia_producto">Campo obligatorio</small>
                        </div>
                        <div class="col-md-6">
                            <label for="stock_minimo" class="form-label">Stock minimo</label>
                            <input type="number" id="estock_minimo" class="form-control" name="existencia_minima">
                            <small style="color: red; display: none" id="lbl_estock_minimo">Campo obligatorio</small>
                        </div>
                        <!-- <div class="mb-1 col-md-6">
                            <label for="estado_producto" class="form-label">Estado</label>
                            <select class="form-select" id="estado_producto" name="estado">
                                <option value="DISPONIBLE">DISPONIBLE</option>
                                <option value="AGOTADO">AGOTADO</option>
                            </select>
                        </div> -->

                        <div class="mb-1 col-md-6">
                            <label for="categori_id" class="form-label">Categoria</label>
                            <select class="form-select" id="categori_id" name="categoria_id">
                                <?php
                                require_once '../negocio/Ncategoria.php';
                                $categoria = new Ncategoria();
                                $categorias = $categoria->nObtenerCategoria();
                                ?>
                                <?php foreach ($categorias as $cate) : ?>

                                    <option value="<?php echo $cate['id_categoria']; ?>">
                                        <?php echo $cate['nombre_categoria']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-primary" name="editar_producto">Editar_Producto</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>







    <!-- Modal eliminar producto -->

    <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenido de la ventana modal -->
                    <h4>¿Esta seguro de eliminar el producto?</h4>
                    <form id="form-eliminar" class="row g-3" role="form" method="POST" action="producto.php">
                        <input type="hidden" name="id_producto" id="eliminar_id">
                        <div class="modal-footer col-md-12">
                            <button type="submit" class="btn btn-primary" name="eliminar_producto">Eliminar Producto</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</main>














<?php
require_once 'template/footer.php';
?>