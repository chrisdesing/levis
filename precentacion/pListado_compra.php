<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';

?>

<style>
    .custom-card {
        border: 1px solid transparent;
        /* Inicialmente, todos los bordes son transparentes */
        border-top: 5px solid #8BC34A;
        /* Bordes superior en color verde lechuga */
        border-radius: 10px;
        /* Bordes redondeados en todos los lados */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Sombreado */
        background-color: #fff;
        /* Color de fondo de la tarjeta */
    }
</style>

<main class="mt-5 pt-5">



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Listado de Compra</h5>
                        <div class="card-body" style="display: block;">
                            <div class="table table-responsive">
                                <table class="table table-bordered table-striped table-sm" style="width: 100%;" id="listado_compra">
                                    <thead>
                                        <tr>
                                            <th>Cod</th>
                                            <!-- <th>Nro Compra</th> -->
                                            <th>Fecha de compra</th>
                                            <th>Importe</th>

                                            <th>Comprobante</th>
                                            <th>Empresa</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once '../negocio/Ncompra_2.php';
                                        $ncompra = new Ncompra_2();
                                        $compras = $ncompra->nMostrarCompra();

                                        foreach ($compras as $row) {

                                        ?>
                                            <tr>
                                                <td><?php echo $row['id_compra'] ?></td>

                                                <td><?php echo $row['fecha_compra'] ?></td>
                                                <td><?php echo $row['importe_compra']; ?></td>

                                                <td><?php echo $row['comprobante']; ?></td>
                                                <td><?php echo $row['nombre_empresa']; ?></td>
                                                <td><?php echo $row['usuario']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete-compra" data-bs-toggle="modal" data-bs-target="#eliminar">
                                                        <!-- <i class="fa-solid fa-trash"></i> -->
                                                        Eliminar compra
                                                    </button>

                                                    <a href="./pDetalle_compra.php?id_compra=<?php echo $row['id_compra'] ?>" class="btn btn-primary">Ver Compra</a>

                                                </td>
                                            </tr>


                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="eliminarLabel">Alerta</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" method="post" action="listado_compra.php">
                                            <input type="hidden" id="compra_id" name="id_compra">
                                            <h3>¿Seguro de eliminar la compra?</h3>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
                                                <button type="submit" name="eliminar_compra" class="btn btn-danger">Eliminar</button>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.delete-compra').on('click', function() {
            $tr = $(this).closest('tr')
            let datos = $tr.children("td").map(function() {
                return $(this).text();
            })
            $('#compra_id').val(datos[0]);
        })
    </script>





</main>
























<?php
require_once 'template/footer.php';
?>