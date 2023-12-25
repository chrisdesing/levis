<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
require_once '../negocio/Nproductos.php';

require_once '../negocio/Ncliente.php';

// session_destroy();
?>

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

<main class="mt-4 pt-5 ">





    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card custom-card">
                    <!-- Tabla 1 -->
                    <div class="card-body ">
                        <div class="" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title">Gestionar Venta</h5>
                            <!-- <div class="pt-3"> -->
                            <a href="pListado_venta.php" class="btn btn-outline-primary" type="button">Ver Listado de Venta</a>
                            <!-- </div> -->

                        </div>
                        <?php foreach ($_SESSION['nombre_rol'] as $rol) {
                            // var_dump($_SESSION['nombre_rol']);
                        ?>

                            <?php
                            if ($rol == 'ADMINISTRADOR' || $rol == 'CAJA') {
                            ?>


                                <div class="pb-4">
                                    <label for="" class="mt-3"><span>*</span>Cliente</label>
                                    <input list="clientes" name="cliente" id="cliente_id" oninput="obtenerCliente();">
                                    <datalist id="clientes">
                                        <?php
                                        $CargarCliente = new Ncliente();
                                        $clientes = $CargarCliente->nMostrarCliente();

                                        foreach ($clientes as $ro) :
                                        ?>
                                            <option value="<?php echo $ro['nombre']; ?>">

                                                <?php echo $ro['id_persona']; ?>
                                                <?php echo $ro['apellidoP']; ?>
                                                <?php echo $ro['ci']; ?>

                                            </option>

                                        <?php endforeach; ?>
                                    </datalist>

                                    <a href="pCliente.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>Registrar cliente</a>
                                </div>


                                <script>
                                    // variable global para almacenar el id_persona del cliente
                                    var id_personaa = null;

                                    function obtenerCliente() {
                                        const cliente_id = document.getElementById('cliente_id');
                                        const datalist = document.getElementById('clientes');
                                        let valor = cliente_id.value;
                                        // realizamos la busqueda del id_persona correspondiente en el arreglo de clientes
                                        let clientes = <?php echo json_encode($clientes); ?>;
                                        for (let i = 0; i < clientes.length; i++) {
                                            if (clientes[i].nombre === valor) {
                                                id_personaa = clientes[i].id_persona;


                                                break;
                                            }
                                        }
                                    }
                                    document.getElementById('cliente_id').addEventListener('input', obtenerCliente);
                                </script>

                                <div class="table-responsive">

                                    <table class="table table-bordered table-striped table-sm" id="tablaProductos">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Nombre</th>
                                                <th style="display: none;">Codigo</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Talla</th>
                                                <th>Imagen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $CargarProducto = new Nproductos();
                                            $productos = $CargarProducto->nMostrarProducto();
                                            foreach ($productos as $produ) {
                                                $id = $produ['id_producto'];
                                                $nombre = $produ['nombre'];
                                                $codigo = $produ['codigo_producto'];
                                                $precio = $produ['precio_venta'];
                                                $stock = $produ['existencia'];
                                                $talla = $produ['talla'];

                                            ?>

                                                <tr>
                                                    <td>
                                                        <button class="btn btn-outline-success" type="button" onclick="agregarProducto('<?php echo $produ['id_producto']; ?>','<?php echo $produ['nombre']; ?>', '<?php echo $produ['codigo_producto']; ?>', <?php echo $produ['precio_venta']; ?>, <?php echo $produ['existencia']; ?> , '<?php echo $produ['talla'] ?>')"><i class="fa-solid fa-cart-plus"></i></button>

                                                    </td>
                                                    <td><?php echo $nombre  ?></td>
                                                    <td style="display: none;"><?php echo $codigo ?></td>
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


            <div class="col-md-6 ">
                <!-- Tabla 2 -->
                <div class="card custom-card">
                    <div class="card-body ">
                        <h5 class="card-title">Agregar Producto/s</h5>
                        <div class="table-responsive pt-5">
                            <div class="container ">
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!-- Contenido de la primera columna -->
                        <div class="d-grid gap-1">
                            <button class="btn btn-primary" onclick="realizarVenta()">Registrar Venta</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Contenido de la segunda columna -->
                        <div class="form-group">
                            <label for="">Monto a Cancelar</label>
                            <p class="form-control" id="monto_cancelar" type="text" style="text-align: center; background-color: yellowgreen;"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Total pagado</label>
                                    <input type="text" id="total_pagado" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cambio</label>
                                    <input type="text" id="cambio" class="form-control" disabled>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</main>




<script>
    // variables para rastrear los productos seleccionados y el total
    let productosSeleccionados = [];
    let totalCompra = 0;
    // metodo para agregar un producto a la segunda tabla
    function agregarProducto(producto_id, nombre, codigo, precio_unitario, stock, talla) {

        let productoExistente = buscarProductoExistente(codigo)

        if (productoExistente) {
            if (productoExistente.cantidad + 1 > stock) {
                alert('Stock insuficiente de unidades de ' + nombre);
                return;
            }
            // en caso que producto ya existe aumenta la cantidad 
            productoExistente.cantidad++;
        } else {
            if (1 > stock) {
                // verificamos si la cantidad 1 supera el stock disponible
                alert('Stock insuficiente para agregar ' + nombre);
                return;
            }

            // si el producto no existe agrega un nuevo producto a la lista
            const cantidad = 1;
            productoExistente = {
                producto_id: producto_id,
                nombre: nombre,
                codigo: codigo,
                precio_unitario: precio_unitario,
                cantidad: cantidad,
                talla: talla
            };
            productosSeleccionados.push(productoExistente);
        }

        // calculamos el subtotal para el producto existente
        productoExistente.subtotal = parseFloat((productoExistente.cantidad * precio_unitario).toFixed(2));

        // actualizamos la variable totalCompra sumando el subtotal del producto agregado
        totalCompra = productosSeleccionados.reduce((total, producto) => total + producto.subtotal, 0);

        // actulizamos el elemento del HTML que muestra el total
        document.getElementById('totalCompra').textContent = totalCompra.toFixed(2);
        document.getElementById('monto_cancelar').textContent = totalCompra.toFixed(2);

        calcularCambio();
        actualizarTablaCompra();
    }

    function calcularCambio() {
        let totalCancelar = parseFloat(document.getElementById('monto_cancelar').textContent);
        let totalPagado = parseFloat(document.getElementById('total_pagado').value);

        let cambio = totalPagado - totalCancelar;

        document.getElementById('cambio').value = cambio.toFixed(2);
    }

    // agregamos el evento input al campo total_pagado
    document.getElementById('total_pagado').addEventListener('input', function() {
        calcularCambio();
    });



    function buscarProductoExistente(codigo) {
        return productosSeleccionados.find(producto => producto.codigo === codigo)
    }


    // metodo para actualizar la segunda tabla con los productos seleccionados
    function actualizarTablaCompra() {
        const table = document.getElementById('tablaCompra');
        const tbody = document.getElementById('insertar');

        // antes de inicializar el proceso de llenado limpiamos la tabla
        tbody.innerHTML = '';

        // agregamos sus respectivas filas para los productos seleccionados
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


            // agregamos el boton de eliminar
            const eliminarButton = document.createElement('button');
            eliminarButton.textContent = 'Eliminar';
            eliminarButton.onclick = function() {
                eliminarProducto(index);
            };
            eliminarButton.classList.add('btn', 'btn-danger');
            eliminarCell.appendChild(eliminarButton);
        });
    }

    // metodo para eliminar un producto de la segunda tabla
    function eliminarProducto(index) {

        totalCompra -= productosSeleccionados[index].subtotal;
        //  cambio -= productosSeleccionados[index].subtotal;
        // actulizamos el elemento HTML que muestra el total
        document.getElementById('totalCompra').textContent = totalCompra.toFixed(2);

        // eliminamos el producto de la lista
        productosSeleccionados.splice(index, 1);

        // Actualizaamos la segunda tabla
        // calcularCambio();
        actualizarTablaCompra();
        
    }





    function realizarVenta() {
        let totalVenta = totalCompra;
        let detalleVenta = productosSeleccionados;

        let id_usuario = '<?php echo $_SESSION['id_persona'] ?>';
        let id_cliente = id_personaa

        // verificamos si la lista de detalleVenta esta vacia
        if (detalleVenta.length === 0) {
            alert('Agrega algun producto antes de realizar la venta');
            return;
        }


        if (id_cliente === null) {
            alert('Selecciona un cliente antes de realizar la venta');
        } else {
            let url = "venta_2.php";
            $.post(url, {
                totalVenta: totalVenta,
                id_usuario: id_usuario,
                id_cliente: id_cliente,
                detalleVenta: JSON.stringify(detalleVenta)
            }, function(datos) {
                $('#respuesta').html(datos)

            })
        }
    }
</script>

<?php
                            } else {
                                echo 'No tienes acceso';
                            }
?>
<?php
                        }
?>
<?php
require_once 'template/footer.php';
?>