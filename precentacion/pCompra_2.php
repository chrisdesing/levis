<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
require_once '../negocio/Nproductos.php';


$producto = new Nproductos();
$productos = $producto->nMostrarProducto();
// session_destroy();
?>



<main class="mt-4 pt-5">



    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();

                $('table tbody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    <style>
        .custom-card {
            border: 1px solid transparent;
            /* Inicialmente, todos los bordes son transparentes */
            border-top: 5px solid #24527a;
            /* Bordes superior en color verde lechuga */
            border-radius: 10px;
            /* Bordes redondeados en todos los lados */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Sombreado */
            background-color: #fff;
            /* Color de fondo de la tarjeta */
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Tabla 1 -->
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Gestionar Compra</h5>

                        <?php foreach ($_SESSION['nombre_rol'] as $rol) {
                            // var_dump($_SESSION['nombre_rol']);
                        ?>

                            <?php
                            if ($rol == 'ADMINISTRADOR') {
                            ?>


                                <!-- seleccionando al proveedor -->
                                <div style="display: flex;  align-items: center;">
                                    <label for="id_proveedor" class="form-label mt-3 mx-3">PROVEEDOR</label>
                                    <select class=" form-select mt-3 mx-3" style="width: 15rem;" id="id_proveedor" name="roles_id">

                                        <?php

                                        require_once '../negocio/Nproveedor.php';
                                        $proveedor = new Nproveedor();
                                        $proveedoress = $proveedor->nMostrarProveedor();
                                        ?>
                                        <?php foreach ($proveedoress as $pro) : ?>

                                            <option value="<?php echo $pro['id_persona']; ?>">
                                                <?php echo $pro['nombre_empresa']; ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                    <div class="">
                                        <a href="pProveedor.php" class="btn btn-success">
                                            <!-- <i class="fa-solid fa-circle-plus"></i>s -->
                                            Registrar_Proveedor
                                        </a>
                                    </div>

                                </div>

                                <div class="form-group mt-3 mx-3 d-flex" style="gap: 1rem;">
                                    <label for="" class="form-label ">Comprobante</label>
                                    <input type="text" class="form-control" id="comprobanteCompra" placeholder="Comprobante" style="width: 13rem;">
                                </div>


                                <div class="mt-2 mb-2" style="display: flex; justify-content: space-between;">
                                    <a href="pProducto.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>Registrar Producto</a>
                                    <a href="pListado_compra.php" class="btn btn-outline-primary" type="button">Ver Listado de Compra</a>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="tablaProductos">
                                        <thead>
                                            <tr>
                                                <th>Opcion</th>
                                                <th>Nombre</th>
                                                <th>Codigo</th>
                                                <th>P.Compra</th>
                                                <th>Stock</th>
                                                <th>Talla</th>
                                                <th>Imagen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($productos as $produ) {
                                                $id = $produ['id_producto'];
                                                $nombre = $produ['nombre'];
                                                $codigo = $produ['codigo_producto'];
                                                $precio = $produ['precio_compra'];
                                                $stock = $produ['existencia'];
                                                $talla = $produ['talla'];
                                            ?>

                                                <tr>
                                                    <td>
                                                        <button class="btn btn-outline-success" type="button" onclick="agregarProducto('<?php echo $produ['id_producto']; ?>','<?php echo $produ['nombre']; ?>', '<?php echo $produ['codigo_producto']; ?>', <?php echo $produ['precio_compra']; ?>, <?php echo $produ['existencia']; ?> , '<?php echo $produ['talla'] ?>')"><i class="fa-solid fa-cart-plus"></i></button>

                                                    </td>
                                                    <td><?php echo $nombre  ?></td>
                                                    <td><?php echo $codigo ?></td>
                                                    <td><?php echo $precio ?></td>
                                                    <td><?php echo $stock ?></td>
                                                    <td><?php echo $talla ?></td>
                                                    <td><img src="<?php echo "../public/images/" . $produ['imagen']; ?>" alt="" style="max-width: 50px; height: 50px;"></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <!-- Tabla 2 -->
                <div class="card custom-card">
                <div class="card-body ">
                
                    <div class="table-responsive">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table" id="tablaCompra">
                                    <thead>
                                        <tr>
                                            <th>n°</th>
                                            <th>Producto</th>
                                            <th>Talla</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th>Opcion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="insertar">




                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="h3">Total:</td>
                                            <td class="h3" id="totalCompra">0.00</td>
                                        </tr>

                                    </tfoot>


                                </table>
                                <!-- <div class="text-right">
                                    <button class="btn btn-primary" onclick="realizarVenta()">Realizar Venta</button>
                                </div> -->
                                <div id="respuesta">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" mt-3>
                        <!-- Contenido de la primera columna -->
                        <div class="d-grid gap-1">
                            <button class="btn btn-primary" onclick="registrarCompra()">Registrar Compra</button>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>

    </div>
</main>




<script>
    let productosSeleccionados = [];
    let totalCompra = 0;

    function agregarProducto(producto_id, nombre, codigo, precio_unitario, stock, talla) {

        let productoExistente = buscarProductoExistente(codigo);

        if (productoExistente) {
            // si el producto ya existe aumentamos la cantidad sin cambiar el precio
            productoExistente.cantidad++;
        } else {
            // si el producto no existe pedimos el precio al usuario 
            const cantidad = parseInt(prompt(`Introduce la cantidad para ${nombre}:`, 1));

            // verificamos si el usuario ingreso un valor válido
            if (!isNaN(cantidad) && cantidad > 0) {
                productoExistente = {
                    producto_id: producto_id,
                    nombre: nombre,
                    codigo: codigo,
                    precio_unitario: parseFloat(prompt(`Introduce el precio de compra para ${nombre}:`, precio_unitario)),
                    cantidad: cantidad,
                    talla: talla
                };

                // verificamos si el usuario ingreso un valor valido para el precio
                if (isNaN(productoExistente.precio_unitario) || productoExistente.precio_unitario <= 0) {
                    // si el usuario cancela o ingresa un valor no valido no se realiza ninguna accion
                    return;
                }

                productosSeleccionados.push(productoExistente);
            } else {
                // si el usuario cancela o ingresa un valor no valido, no se realiza ninguna accion
                return;
            }
        }

        // calculamos el subtotal para el producto existente
        productoExistente.subtotal = parseFloat((productoExistente.cantidad * productoExistente.precio_unitario).toFixed(2));

        // actualizamos la variable totalCompra sumando el subtotal del producto recién agregado
        totalCompra = productosSeleccionados.reduce((total, producto) => total + producto.subtotal, 0);

        // actualizamos el elemento HTML que muestra el total
        document.getElementById('totalCompra').textContent = totalCompra.toFixed(2);

        // actualizar la segunda tabla
        actualizarTablaCompra();
    }


    function buscarProductoExistente(codigo) {
        return productosSeleccionados.find(producto => producto.codigo === codigo)
    }


    // metodo para actualizar la segunda tabla con los productos seleccionados
    function actualizarTablaCompra() {
        const table = document.getElementById('tablaCompra');
        const tbody = document.getElementById('insertar');

        // limiamos la tabla actual para evitar duplicados
        tbody.innerHTML = '';

        // agregamos filas para los productos seleccionados
        productosSeleccionados.forEach((producto, index) => {

            const row = tbody.insertRow();
            const id_productoCell = row.insertCell(0);
            id_productoCell.style.display = "none";
            const nombreCell = row.insertCell(1);
            const tallaCell = row.insertCell(2); // Agregamos la celda de la talla
            const precioCell = row.insertCell(3);
            const cantidadCell = row.insertCell(4);
            const subtotalCell = row.insertCell(5);
            const eliminarCell = row.insertCell(6);

            id_productoCell.textContent = producto.producto_id;
            nombreCell.textContent = producto.nombre;
            tallaCell.textContent = producto.talla;
            precioCell.textContent = producto.precio_unitario.toFixed(2);
            cantidadCell.textContent = producto.cantidad;
            subtotalCell.textContent = producto.subtotal.toFixed(2);


            // agregamos boton de eliminar
            const eliminarButton = document.createElement('button');
            // creamos un elemento i para el icono
            const eliminarIcon = document.createElement('i');
            // creamos la clase para el icono usando font asowwe
            eliminarIcon.className = 'fas fa-trash-alt';
            eliminarButton.appendChild(eliminarIcon);
            eliminarButton.classList.add('btn', 'btn-danger');


            // agregamos un evento para el botón de eliminar
            eliminarButton.addEventListener('click', () => {
                eliminarProducto(index);
            });
            eliminarCell.appendChild(eliminarButton);


        });
    }

    // metodo para eliminar un producto de la segunda tabla
    function eliminarProducto(index) {

        totalCompra -= productosSeleccionados[index].subtotal;

        // actulizamos el elemento HTML que muestra el total
        document.getElementById('totalCompra').textContent = totalCompra.toFixed(2);

        // eliminamos el producto de la lista
        productosSeleccionados.splice(index, 1);

        // actulizamos la segunda tabla
        actualizarTablaCompra();
    }






    function registrarCompra() {

        let total_compra = totalCompra;
        let detalleCompra = productosSeleccionados;


        let id_usuario = '<?php echo $_SESSION['id_persona'] ?>';
        let id_proveedor = document.getElementById('id_proveedor').value;
        let comprobanteCompra = document.getElementById('comprobanteCompra').value



        if (comprobanteCompra === '' || detalleCompra.length === 0) {
            alert('Ingresa un comprobante o productos antes de registrar la compra');

        } else {

            let url = "compra_2.php";
            $.post(url, {
                total_compra: total_compra,
                comprobanteCompra: comprobanteCompra,
                id_usuario: id_usuario,
                id_proveedor: id_proveedor,
                detalleCompra: JSON.stringify(detalleCompra)
            }, function(datos) {
                $('#respuesta').html(datos)
                // productosSeleccionados = [];
                // totalCompra = 0;
                // actualizarTablaCompra();
            })
        }
    }
</script>


<?php
 } else {
    echo 'No tienes acceso';
    // header('Location: pCompra_2.php');
 }
?>
<?php
}
?>
<?php
require_once 'template/footer.php';
?>
