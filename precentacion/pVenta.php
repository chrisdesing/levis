<?php

require_once 'config.php';
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
require_once '../negocio/Nproductos.php';

require_once '../negocio/Ncliente.php';
$producto = new Nproductos();
$productos = $producto->nMostrarProducto();
// session_destroy();
?>



<main class="mt-4 pt-5">


    <?php
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


    <div>
        <label for="" class="mt-3 mx-3"><span>*</span>Cliente</label>
        <input list="clientes" name="cliente" id="cliente_id" oninput="capturarIdPersona();">
        <datalist id="clientes">
            <?php
            $cliente = new Ncliente();
            $clientes = $cliente->nMostrarCliente();

            foreach ($clientes as $ro) :
            ?>
                <option value="<?php echo $ro['nombre']; ?>">

                    <?php echo $ro['id_persona']; ?>
                    <?php echo $ro['apellidoP']; ?>
                    <?php echo $ro['ci']; ?>

                </option>

            <?php endforeach; ?>
        </datalist>

        <a href="pCliente.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i>Agregar</a>
    </div>

    <a href="pVenta.php" class="btn btn-success" style="margin-left: auto; margin-right: auto; display: block; width: 10%;">Actualizar</a>

    <script>
        var id_personaa = null; // Variable global para almacenar el id_persona del cliente

        function capturarIdPersona() {
            const cliente_id = document.getElementById('cliente_id');
            const datalist = document.getElementById('clientes');
            let valor = cliente_id.value;
            // Buscar el id_persona correspondiente en el arreglo de clientes
            let clientes = <?php echo json_encode($clientes); ?>;
            for (let i = 0; i < clientes.length; i++) {
                if (clientes[i].nombre === valor) {
                    id_personaa = clientes[i].id_persona;


                    break;
                }
            }
        }
        document.getElementById('cliente_id').addEventListener('input', capturarIdPersona);
    </script>



    <!-- Agrega este campo de búsqueda arriba de tu tabla -->
    <input type="text" class="form-control mx-3" style="width: 18em;" id="searchInput" placeholder="Realize su Busqueda...">

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

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Tabla 1 -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="example">
                            <!-- Contenido de la primera tabla aquí -->
                            <thead>
                                <tr>
                                    <th>Opcion</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($productos as $produ) {
                                    $id = $produ['id_producto'];
                                    $nombre = $produ['nombre'];
                                    $codigo = $produ['codigo_producto'];
                                    $precio = $produ['precio_venta'];
                                    $stock = $produ['existencia'];

                                ?>

                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-success" type="button" onclick="addProducto('<?php echo $id; ?>')"><i class="fa-solid fa-cart-plus"></i></button>
                                        </td>
                                        <td><?php echo $nombre  ?></td>
                                        <td><?php echo $codigo ?></td>
                                        <td><?php echo $precio ?></td>
                                        <td><?php echo $stock ?></td>
                                        <td><img src="<?php echo "../public/images/" . $produ['imagen']; ?>" alt="" style="max-width: 50px; height: 50px;"></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <script>
                function addProducto(id) {
                    let url = './carrito.php'
                    let formData = new FormData()
                    formData.append('id', id)
                    fetch(url, {
                            method: 'POST',
                            body: formData,
                            mode: 'cors'
                        }).then(response => response.json())
                        .then(data => {
                            if (data.ok) {

                                let elemento = document.getElementById("num_cart")
                                elemento.innerHTML = data.numero

                                
                            }
                         
                        })
                    window.location.href = 'pVenta.php';
                }
            </script>


            <div class="col-md-6">
                <!-- Tabla 2 -->
                <div class="card-body ">
                    <div class="table-responsive">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table">
                                    <!-- Contenido de la segunda tabla aquí -->
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="insertar">
                                        <?php
                                        $total = 0;
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
                                                    <td style="display: none;"><?php echo $_id  ?></td>
                                                    <td><?php echo $nombre ?></td>
                                                    <td><?php echo MONEDA . number_format($precio, 2, '.', ',') ?></td>
                                                    <td>
                                                        <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidadd(this.value, <?php echo $_id; ?>)">
                                                    </td>
                                                    <td>
                                                        <div id="subtotal_<?php echo $_id ?>" name="subtotal[]"><?php echo MONEDA . number_format($subTotal, 2, '.', ',') ?></div>
                                                    </td>
                                                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                                                </tr>
                                            <?php } ?>

                                            
                                            <tr>
                                                <!-- <td colspan="3"></td> -->
                                                <td colspan="2">
                                                    <p class="h3" id="total"><?php echo  MONEDA . number_format($total, 2, '.', ',') ?></p>
                                                    <!-- <div id="total_value" hidden><?php echo $total ?> </div> -->
                                                </td>
                                            </tr>
                                    </tbody>
                                <?php } ?>

                                </table>
                            </div>


                            <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea eliminar el producto de la lista?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="button" id="btn-elimina" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Contenido de la primera columna -->
                                    <div class="d-grid gap-1">
                                        <button id="realizar_venta" class="btn btn-primary btn-lg">Realizar Venta</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Contenido de la segunda columna -->
                                    <div class="form-group">
                                        <label for="">Monto a Cancelar</label>
                                        <p class="form-control" id="monto_cancelar" type="text" style="text-align: center; background-color: yellowgreen;"><?php echo $total ?></p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Total pagado</label>
                                                <input type="text" id="total_pagado" class="form-control">

                                                <script>
                                                    $('#total_pagado').keyup(function() {
                                                        let total_cancelar = parseFloat($('#monto_cancelar').text());
                                                        let total_pagado = parseFloat($('#total_pagado').val());

                                                        let cambio = parseFloat(total_pagado) - parseFloat(total_cancelar)
                                                        $('#cambio').val(cambio)
                                                    })
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Cambio</label>
                                                <input type="text" id="cambio" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="respuesta_create">
                                        <!-- Contenido de la segunda columna -->
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>

        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('show.bs.modal', function(event){
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
            buttonElimina.value = id
        })

        function actualizarCantidadd(cantidad, id) {
            let url = './actulizar_carrito.php'
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

                        for (let i = 0; i < lista.length; i++) {
                            total += parseFloat(lista[i].innerHTML.replace(/[Bs,]/g, ''))
                        }

                        total = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2
                        }).format(total)
                        document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
                        document.getElementById('monto_cancelar').innerHTML = total
                    }
                })
        }

        function eliminar() {
            
            let botonElimina = document.getElementById('btn-elimina')
            let id = botonElimina.value
            let url = './actulizar_carrito.php'
            let formData = new FormData()
            formData.append('action', 'eliminar')
            formData.append('id', id)


            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        location.reload()
                    }
                })
        }
    </script>



    <script>
        $('#realizar_venta').click(function() {
            // var total_value = $('#total').text();
            var total_value = $('#total').text().replace(/[^\d.-]/g, '');


            var id_usuario = '<?php echo $_SESSION['id_persona'] ?>';
            var id_cliente = id_personaa; // Usa la variable id_persona que capturaste

            // Verifica si id_cliente no es null antes de realizar la venta
            if (id_cliente === null) {
                alert('Selecciona un cliente antes de realizar la venta.');
            } else {


                var detalles = [];
                var table = document.getElementById("insertar");
                var rows = table.getElementsByTagName("tr");

                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].getElementsByTagName("td");
                    // Asegurarse de que la fila tenga al menos una columna
                    if (cells.length == 6) {
                        let producto_id = cells[0].textContent;
                        let precio_unitario = parseFloat(cells[2].textContent.replace(/[^\d.-]/g, ''));
                        let cantidad = parseInt(cells[3].getElementsByTagName("input")[0].value);

                        detalles.push({
                            producto_id: producto_id,
                            precio_unitario: precio_unitario,
                            cantidad: cantidad
                        });
                    }
                }

                // Realiza la venta

                var url = "venta.php";
                $.post(url, {
                    total_value: total_value,
                    id_usuario: id_usuario,
                    id_cliente: id_cliente,
                    // convierte el arraoy en una cadena sjon
                    detalles: JSON.stringify(detalles)
                }, function(datos) {
                    $('#respuesta_create').html(datos);
                });
            }
        });
    </script>



</main>



















<?php

require_once 'template/footer.php';
?>