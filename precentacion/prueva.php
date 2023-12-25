<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}

require_once 'template/header.php';
require_once 'producto.php';
require_once "proveedor.php";
require_once '../negocio/Ncompra.php';

?>

<main class="mt-5 pt-3">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header text-secondary">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <h1 class="m-0" style="font-size: 2rem;">Registro de una nueva compra</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card text-white">
                                    <div class="card-header bg-primary">
                                        <h3 class="card-title">Llene los datos con cuidado</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body text-secondary" style="display: block;">
                                        <div style="display: flex;">
                                            <h5 style="font-size: 1.25rem;">Datos del producto</h5>
                                            <div style="width: 20px;"></div>


                                            <!-- modal para visualizar datos del producto -->
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-buscar_producto">
                                                <i class="fa fa-search"></i>
                                                Buscar producto
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-buscar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #1d36b6;">
                                                        <h5 class="modal-title" id="exampleModalLabel" style="color: wheat;">Busqueda de producto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="card-body" style="display: block;">
                                                            <div class="table-responsive">
                                                                <table id="exampl" class="table table-bordered table-striped table-sm" style="width:100%">
                                                                    <form class="d-flex ms-auto" action="pCategoria.php" method="post">
                                                                        <div class="input-group my-3 my-lg-4" style="width: 35%;">
                                                                            <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">
                                                                            <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search"></i></button>
                                                                        </div>
                                                                    </form>
                                                                    <thead>
                                                                        <tr>
                                                                            <!-- <th>id</th> -->
                                                                            <!-- <th>ID</th> -->
                                                                            <th>Seleccionar</th>
                                                                            <th>Codigo</th>

                                                                            <th>Nombre</th>
                                                                            <th>Imagen</th>
                                                                            <!-- <th>Descripcion</th> -->
                                                                            <th>Precio Venta</th>
                                                                            <th>Precio compra</th>
                                                                            <th>Talla</th>
                                                                            <th>Color</th>
                                                                            <th>Stock</th>
                                                                            <th>Estado</th>
                                                                            <!-- <th>Acciones</th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>


                                                                        <?php
                                                                        foreach ($productos as $producto) {
                                                                            // $id_prodcuto = $Producto['id_producto']; 
                                                                        ?>


                                                                            <tr>
                                                                                <td style="display:none;"><?php echo $producto['id_producto']; ?></td>

                                                                                <td>
                                                                                    <button href="" class="btn btn-info" id="btn_seleccionar<?php echo $producto['id_producto'] ?>">Seleccionar</button>
                                                                                    <script>
                                                                                        $('#btn_seleccionar<?php echo $producto['id_producto'] ?>').click(function() {
                                                                                            var id_producto = "<?php echo $producto['id_producto']; ?>";
                                                                                            $('#id_producto').val(id_producto)
                                                                                            var codigo_producto = "<?php echo $producto['codigo_producto']; ?>";
                                                                                            $('#codigo_producto').val(codigo_producto)
                                                                                            var nombre_producto = "<?php echo $producto['nombre']; ?>";
                                                                                            $('#nombre_producto').val(nombre_producto)
                                                                                            var precio_venta = "<?php echo $producto['precio_venta']; ?>"
                                                                                            $('#precio_venta').val(precio_venta)
                                                                                            var precio_compra = "<?php echo $producto['precio_compra']; ?>";
                                                                                            $('#precio_compra').val(precio_compra)
                                                                                            var talla = "<?php echo $producto['talla']; ?>"
                                                                                            $('#talla').val(talla)
                                                                                            var color = "<?php echo $producto['color']; ?>"
                                                                                            $('#color').val(color)
                                                                                            var existencia = "<?php echo $producto['existencia']; ?>"
                                                                                            $('#existencia').val(existencia)
                                                                                            var stock_actual = "<?php echo $producto['existencia']; ?>"
                                                                                            $('#stock_actual').val(stock_actual)
                                                                                            var existencia_minima = "<?php echo $producto['existencia_minima']; ?>"

                                                                                            var ruta_img = "<?php echo "../public/images/" . $producto['imagen']; ?>"
                                                                                            $('#imagen_producto').attr({
                                                                                                src: ruta_img
                                                                                            })
                                                                                            $('#modal-buscar_producto').modal('toggle')
                                                                                        })
                                                                                    </script>

                                                                                </td>
                                                                                <td><?php echo $producto['codigo_producto']; ?></td>
                                                                                <td><?php echo $producto['nombre']; ?></td>
                                                                                <td>
                                                                                    <img src="<?php echo "../public/images/" . $producto['imagen']; ?>" width="60px" alt="">
                                                                                </td>
                                                                                <td><?php echo $producto['precio_venta']; ?></td>
                                                                                <td><?php echo $producto['precio_compra']; ?></td>
                                                                                <td><?php echo $producto['talla']; ?></td>
                                                                                <td><?php echo $producto['color']; ?></td>
                                                                                <td><?php echo $producto['existencia']; ?></td>
                                                                                <td><?php echo $producto['estado']; ?></td>
                                                                                <td style="display:none;"><?php echo $producto['categoria_id']; ?></td>
                                                                            </tr>

                                                                            <!-- </tbody> -->
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="modal fade" id="modal-buscar_producto">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Busqueda del producto</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                        <span aria-hidden="true">*</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ">

                                                </div>
                                            </div>
                                        </div>
                                    </div> -->


                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">



                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="hidden" id="id_producto">
                                                                    <label for="">Códigoo</label>
                                                                    <input type="text" class="form-control" id="codigo_producto" disabled>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Categoría</label>
                                                            <div style="display: flex">
                                                                <input type="text" class="form-control" id="" disabled>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Nombre del producto</label>
                                                                    <input type="text" name="nombre" class="form-control" id="nombre_producto" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Usuario</label>
                                                                    <input type="text" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Talla</label>
                                                                    <input type="text" name="talla" id="talla" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Color</label>
                                                                    <input name="descripcion" id="color" cols="30" rows="2" class="form-control" disabled></input>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Stock:</label>
                                                                    <input type="number" name="existencia" id="existencia" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Stock mínimo:</label>
                                                                    <input type="number" name="existencia_minima" class="form-control" id="existencia_minima" disabled>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Precio compra:</label>
                                                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Precio venta:</label>
                                                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Fecha de ingreso:</label>
                                                                    <input type="date" name="fecha_ingreso" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Imagen del producto</label>
                                                            <center>
                                                                <img src="<?php echo $URL . "/almacen/img_productos/" . $imagen; ?>" id="imagen_producto" width="70%" alt="">
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- mostrando proveedor -->
                                                <div style="display: flex;">
                                                    <h5 style="font-size: 1.25rem;">Datos del proveedor</h5>
                                                    <div style="width: 20px;"></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-buscar_proveedor">
                                                        <i class="fa fa-search"></i>
                                                        Buscar proveedor
                                                    </button>


                                                    <div class="modal fade" id="modal-buscar_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #1d36b6;">
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: wheat;">Busqueda de proveedor</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="card-body" style="display: block;">
                                                                        <div class="table table-responsive">
                                                                            <table class="table table-bordered table-striped table-sm" style="width:100%">
                                                                                <form class="d-flex ms-auto" action="pCategoria.php" method="post">
                                                                                    <div class="input-group my-3 my-lg-4" style="width: 35%;">
                                                                                        <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">
                                                                                        <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search"></i></button>
                                                                                    </div>
                                                                                </form>
                                                                                <thead>
                                                                                    <tr>
                                                                                        <!-- <th>id</th> -->
                                                                                        <!-- <th>Cédula</th> -->
                                                                                        <th>Seleccionar</th>
                                                                                        <th>Nombre</th>
                                                                                        <!-- <th>A. Paterno</th> -->
                                                                                        <!-- <th>A. Materno</th> -->
                                                                                        <th>Celular</th>
                                                                                        <th>Correo Electronico</th>
                                                                                        <th>Direccion</th>
                                                                                        <th>Estado</th>
                                                                                        <th>Empresa</th>
                                                                                        <th>Teléfono</th>
                                                                                        <!-- <th>Clave</th> -->
                                                                                        <!-- <th>Estado</th> -->
                                                                                        <!-- <th>Acciones</th> -->
                                                                                    </tr>
                                                                                </thead>


                                                                                <?php
                                                                                foreach ($proveedores as $user) {
                                                                                    $id_persona = $user['id_persona'];
                                                                                ?>
                                                                                    <!-- <tbody id="bodyUser"> -->

                                                                                    <tr>
                                                                                        <!-- <td style="display: none;">
                                                                                            <?php echo $user['id_persona']; ?>
                                                                                        </td> -->
                                                                                        <td>
                                                                                            <button class="btn btn-info" id="btn_seleccionar_proveedor<?php echo $user['id_persona'] ?>">Seleccionar</button>

                                                                                            <script>
                                                                                                $('#btn_seleccionar_proveedor<?php echo $user['id_persona'] ?>').click(function() {

                                                                                                    var id_persona = '<?php echo $user['id_persona']; ?>'
                                                                                                    $('#id_provee').val(id_persona)

                                                                                                    var nombre_proveedor = '<?php echo $user['nombre']; ?>'
                                                                                                    $('#nombre_proveedor').val(nombre_proveedor)

                                                                                                    var celular = '<?php echo $user['telefono']; ?>'
                                                                                                    $('#telefono').val(celular)

                                                                                                    var nombre_empresa = '<?php echo $user['nombre_empresa'] ?>'
                                                                                                    $('#nombre_empresa').val(nombre_empresa)

                                                                                                    var direccion = '<?php echo $user['direccion']; ?>';
                                                                                                    $('#direccion').val(direccion)

                                                                                                    var email = '<?php echo $user['email']; ?>'
                                                                                                    $('#email').val(email)
                                                                                                    var telefono_empresa = '<?php echo $user['telefono_empresa'] ?>'
                                                                                                    $('#telefono_empresa').val(telefono_empresa)

                                                                                                    $('#modal-buscar_proveedor').modal('toggle')
                                                                                                })
                                                                                            </script>
                                                                                        </td>
                                                                                        <td><?php echo $user['nombre']; ?></td>

                                                                                        <td>
                                                                                            <a href="https://wa.me/591<?php echo $user['telefono']; ?>" target="_blank" class="btn btn-success">
                                                                                                <i class="fa-brands fa-whatsapp"></i>
                                                                                                <?php echo $user['telefono']; ?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td><?php echo $user['email']; ?></td>
                                                                                        <td><?php echo $user['direccion']; ?></td>
                                                                                        <td><?php echo $user['estado']; ?></td>
                                                                                        <td><?php echo $user['nombre_empresa'] ?></td>
                                                                                        <td><?php echo $user['telefono_empresa'] ?></td>


                                                                                    </tr>

                                                                                    <!-- </tbody> -->
                                                                                <?php } ?>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- cuerpo del proveedor -->
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" id="id_provee" >
                                                        <label for="nombre_proveedor" class="form-label">Nombre Completo</label>
                                                        <input type="text" id="nombre_proveedor" class="form-control" disabled>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="telefono" class="form-label">Celular</label>
                                                        <input type="text" id="telefono" class="form-control" disabled>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="nombre_empresa" class="form-label">Empresa</label>
                                                        <input type="text" id="nombre_empresa" class="form-control" disabled>

                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="direccion" class="form-label">Dirección</label>
                                                        <input type="text" id="direccion" class="form-control" disabled>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="email" class="form-label">Correo electronico</label>
                                                        <input type="email" id="email" class="form-control" disabled>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="telefono_empresa" class="form-label">Teléfono</label>
                                                        <input type="text" id="telefono_empresa" class="form-control" disabled>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>

                    </div>

                    <div class="col-md-3">
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $compras_datos = new Ncompra();
                                    $compras_datoss = $compras_datos->visualizarCompra();
                                    $contador_compra = 1;
                                    foreach ($compras_datoss as $compras_dato) {
                                        $contador_compra = $contador_compra + 1;
                                    }
                                    ?>
                                    <label for="">Numero de la compra</label>
                                    <input type="text" value="<?php echo $contador_compra ?>" class="form-control" style="text-align: center;" disabled>
                                    <input type="text" value="<?php echo $contador_compra ?>" id="numero_compra" hidden> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Fecha de la compra</label>
                                    <input type="date" id="fecha_compra" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Comprobante</label>
                                    <input type="text" class="form-control" id="comprobante">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Precio Compra</label>
                                    <input type="text" class="form-control" id="precio_compraa">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stock actual</label>
                                    <input type="text" id="stock_actual" style="background-color: yellowgreen;" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stock total</label>
                                    <input type="text" id="stock_total" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Cantidad de Compra</label>
                                    <input type="number" id="cantidad_compra" style="text-align: center;" class="form-control">
                                </div>
                                <script>
                                    $('#cantidad_compra').keyup(function() {
                                        // alert('Estamos presionando el input')
                                        var stock_actual = $('#stock_actual').val()
                                        var stock_compra = $('#cantidad_compra').val()

                                        var total = parseInt(stock_actual) + parseInt(stock_compra)
                                        $('#stock_total').val(total)
                                    })
                                </script>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" value="<?php echo $_SESSION['usuario'] ?>" class="form-control" disabled>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary block" id="btn_guardar_compra">Guardar compra</button>
                            </div>
                            <div id="respuesta_create">

                            </div>
                        </div>
                        <script>
                            $('#btn_guardar_compra').click(function(){
                                
                                var nro_compra = $('#numero_compra').val()
                                var id_producto = $('#id_producto').val();
                                var id_proveedor = $('#id_provee').val();
                                var fecha_compra = $('#fecha_compra').val()
                                var comprobante = $('#comprobante').val()
                                var id_usuario = '<?php echo $_SESSION['id_persona'] ?>'; 
                                // alert(id_usuario)  
                                var precio_compra = $('#precio_compraa').val()
                                var cantidad_compra = $('#cantidad_compra').val()

                                var stock_total = $('#stock_total').val();

                                if(id_producto == ""){
                                    $('#id_producto').focus()
                                    alert("Debe llenar los campos")
                                }else if(fecha_compra==""){
                                    $('#fecha_compra').focus()
                                    alert("Debe llenar los campos")
                                }else if(comprobante==""){
                                    $('#comprobante').focus()
                                    alert("Debe llenar los campos")
                                }else if(precio_compra==""){
                                    $('#precio_compraa').focus()
                                    alert("Debe llenar los campos")
                                }else if(cantidad_compra==""){
                                    $('#cantidad_compra').focus()
                                    alert("Debe llenar los campos")
                                }
                                else{
                                    
                                    var url = "compra.php"
                                    $.post(url,{nro_compra,id_producto,id_proveedor,fecha_compra,comprobante,id_usuario,precio_compra,cantidad_compra,stock_total},function(datos){
                                        $('#respuesta_create').html(datos)
                                    })
                                }

                            })
                        </script>
                    </div>
                </div>


                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
</main>
<?php
require_once 'template/footer.php'
?>