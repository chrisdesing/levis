<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
// require_once 'template/header.php';

?>


<?php
require_once '../negocio/Nventa.php';
if(isset($_POST['eliminar_venta'])){
    $id = $_POST['id_venta'];
    // echo $id;
    $dventa = new Nventa();
    if($dventa->nEliminarVenta($id)){
        header("Location: pVenta_2.php");
        exit();
    }
}
?>


<?php
require_once 'template/header.php';

?>
<style>
    .custom-card {
        border: 1px solid transparent;
        border-top: 5px solid #8BC34A;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }
</style>


<main class="mt-5 pt-5">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <h5 class="card-title">Listado de Venta</h5>


                        <?php
                        foreach ($_SESSION['nombre_rol'] as $rol) {
                            if ($rol == 'CAJA') {


                        ?>
                                <div class="card-body" style="display: block;">
                                    <div class="table table-responsive">

                                        <table id="lista_ventas" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Cod</th>
                                                    <!-- <th>Nro Compra</th> -->
                                                    <th>Fecha de Venta</th>
                                                    <th>Importe</th>
                                                    <th>Cedula Identidad</th>
                                                    <th>Cliente</th>
                                                    <th>Usuario</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                require_once '../negocio/Nventa.php';
                                                $CargarVenta = new Nventa();
                                                $ventas = $CargarVenta->nMostrarVentaUser($_SESSION['usuario']);
                                                foreach ($ventas as $row) {

                                                ?>


                                                    <tr>
                                                        <td> <?php echo $row['id_venta']; ?></td>
                                                        <td><?php echo $row['fecha_venta']; ?></td>
                                                        <td><?php echo $row['importe']; ?></td>
                                                        <td><?php echo $row['ci']; ?></td>
                                                        <td><?php echo $row['nombre']; ?></td>
                                                        <td><?php echo $row['usuario']; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-eliminar-venta" data-bs-toggle="modal" data-bs-target="#eliminarVenta">
                                                                <!-- <i class="fa-solid fa-trash"></i> -->
                                                                Eliminar Venta
                                                            </button>

                                                            <a href="./pDetalle_venta.php?id_venta=<?php echo $row['id_venta']; ?>" class="btn btn-primary">
                                                                Ver Venta
                                                            </a>
                                                            <!-- <button class="btn btn-primary" onclick="imprimirListadoVenta()">Imprimir Listado</button> -->

                                                        </td>
                                                    </tr>


                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            <?php

                            } else if ($rol == 'ADMINISTRADOR') {
                            ?>
                                <div class="card-body" style="display: block;">
                                    <div class="table table-responsive">

                                        <table id="lista_ventas" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Cod</th>
                                                    <!-- <th>Nro Compra</th> -->
                                                    <th>Fecha de Venta</th>
                                                    <th>Importe</th>
                                                    <th>Cedula Identidad</th>
                                                    <th>Cliente</th>
                                                    <th>Usuario</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php

                                                require_once '../negocio/Nventa.php';
                                                $CargarVenta = new Nventa();
                                                $ventas = $CargarVenta->nMostrarVenta();
                                                foreach ($ventas as $row) {

                                                ?>


                                                    <tr>
                                                        <td><?php echo $row['id_venta']; ?></td>
                                                        <td><?php echo $row['fecha_venta']; ?></td>
                                                        <td><?php echo $row['importe']; ?></td>
                                                        <td><?php echo $row['ci']; ?></td>
                                                        <td><?php echo $row['nombre']; ?></td>
                                                        <td><?php echo $row['usuario']; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-eliminar-venta" data-bs-toggle="modal" data-bs-target="#eliminarVenta">
                                                                <!-- <i class="fa-solid fa-trash"></i> -->
                                                                Eliminar Venta
                                                            </button>


                                                            <!-- <div class="pt-3"> -->
                                                            <a href="./pDetalle_venta.php?id_venta=<?php echo $row['id_venta']; ?>" class="btn btn-warning" type="button"> Ver Venta</a>
                                                            <!-- </div> -->

                                                        </td>
                                                    </tr>


                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>


        </div>






        <!-- modal para eliminar una venta -->
        <div class="modal fade" id="eliminarVenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Venta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Contenido de la ventana modal -->
                        <h4>¿Estas seguro de Eliminar la Venta?</h4>
                        <form id="form-eliminar" class="row g-3" role="form" method="POST" action="pListado_venta.php">
                            <input type="hidden" name="id_venta" id="eliminar_id">
                            <div class="modal-footer col-md-12">
                                <button type="submit" class="btn btn-primary" name="eliminar_venta">Elimininar venta</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('.btn-eliminar-venta').on('click', function() {
                $tr = $(this).closest('tr')
                let datos = $tr.children("td").map(function() {
                    return $(this).text();
                })
                $('#eliminar_id').val(datos[0]);
            })
        </script>





</main>

<?php
require_once 'template/footer.php';

?>