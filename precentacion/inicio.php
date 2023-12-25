<?php
require_once '../negocio/Nusuario.php';

session_start();
$nusuario = new Nusuario();
if (!isset($_SESSION['usuario'])) {

    header('Location: index.php');
    exit;
}
require_once 'template/header.php';
require_once '../negocio/Nventa.php';
?>


<main class="mt-5 pt-4 ">


    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'CAJA') {
        ?>

            <?php

            $ventasXdia = array();
            // fecha predeterminada
            $fecha = date("Y-m-d");

            if (isset($_POST['buscarVentas'])) {
                if (isset($_POST['fecha_venta'])) {
                    $fecha = $_POST['fecha_venta'];
                    $userr = $_SESSION['id_persona'];
                }

                $nventas = new Nventa();
                $ventasXdia = $nventas->nVentasXdia($fecha, $userr);
                // $totalVentasUSer = $dventas->nTotalVentaFechaUser($fecha,$userr);

            }

            // ahora calculamos el total de ventas
            require_once '../negocio/Nventa.php';
            $dventas = new Nventa();
            $totalVentas = $dventas->nTotalVentas($fecha);
            ?>

            <div class="row mx-3 pt-3">
                <form method="POST" style="display: flex;  align-items: center;">
                    <div class="form-group mx-3">
                        <label class="form-label " for="fecha">Seleccione la Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha_venta">

                    </div>
                    <!-- <div class="form-group mx-3">
                        <input type="date" class="form-control" id="fecha" name="<?php echo $_SESSION['usuario']  ?>">

                    </div> -->

                    <div class="">

                        <button class="btn btn-success mt-3" type="submit" name="buscarVentas">Buscar reporte</button>

                    </div>

                </form>

                <script>
                    // se obtine la fecha actual con la zona horaria de La Paz Bolivia
                    const fechaActual = new Date();
                    const options = {
                        timeZone: 'America/La_Paz',
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit'
                    };
                    const fechaFormateada = fechaActual.toLocaleDateString('es-BO', options);

                    // Formatea la fecha en el formato aaaa-mm-dd
                    const [day, month, year] = fechaFormateada.split('/');
                    const fechaAaaaMmDd = `${year}-${month}-${day}`;

                    // Establece la fecha formateada en el campo de fecha
                    document.getElementById('fecha').value = fechaAaaaMmDd;
                </script>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="text-center">

                            <?php

                            require_once '../negocio/Nventa.php';
                            $dventas = new Nventa();
                            $totalVentas = 0;

                            // $totalVentas = $dventas->nTotalVentas($fecha);
                            $userrr = $_SESSION['id_persona'];
                            $totalVentasUSer = $dventas->nTotalVentaFechaUser($fecha, $userrr);

                            ?>
                            <p style=" font-size: 1.6em; font-weight: 800; ">Venta de hoy</p>
                            <h3><?php echo  "Bs " .  $totalVentasUSer ?></h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-6">

                    <table class="table table-bordered" id="reportTable">
                        <thead>
                            <tr>
                                <th>Venta</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>P.U.</th>
                                <th>Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($ventasXdia as $venta) : ?>
                                <tr>
                                    <td><?php echo $venta['id_venta'] ?></td>
                                    <td><?php echo $venta['nombre']; ?></td>
                                    <td style="text-align: center;"><?php echo $venta['cantidad']; ?></td>
                                    <td><?php echo $venta['precio_venta']; ?></td>
                                    <td style="text-align: center;"><?php echo $venta['total_por_producto'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>





            </div>




        <?php
        } else if ($rol == 'ADMINISTRADOR') {
            // echo 'No tienes acceso';


            $ventasXdiaT = array();
            // fecha predeterminada
            $fecha = date("Y-m-d");

            if (isset($_POST['buscarVentas'])) {
                if (isset($_POST['fecha_venta'])) {
                    $fecha = $_POST['fecha_venta'];
                }

                $nventas = new Nventa();
                $ventasXdiaT = $nventas->nVentasXdiaT($fecha);
            }


        ?>

<div class="row mx-3 pt-3">
    <div class="col-lg-3 col-6">
        <form method="POST" style="display: flex; align-items: center;">
            <div class="form-group mx-3">
                <label class="form-label" for="fecha">Seleccione la Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha_venta">
                <div>
                    <button class="btn btn-success mt-3" type="submit" name="buscarVentas">Buscar reporte</button>
                </div>
            </div>
        </form>
        <div class="small-box bg-warning">
            <div class="text-center">
                <?php
                require_once '../negocio/Nventa.php';
                $dventas = new Nventa();
                $totalVentas = 0;
                $totalVentas = $dventas->nTotalVentas($fecha);
                ?>
                <p style="font-size: 1.6em; font-weight: 800;">Venta de hoy</p>
                <h3><?php echo "Bs " . $totalVentas ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-6">
        <table class="table table-bordered" id="reportTable">
            <thead>
                <tr>
                    <th>Venta</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>P.U.</th>
                    <th>Sub total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($ventasXdiaT)) {
                    foreach ($ventasXdiaT as $vent) : ?>
                        <tr>
                            <td><?php echo $vent['id_venta'] ?></td>
                            <td><?php echo $vent['nombre']; ?></td>
                            <td style="text-align: center;"><?php echo $vent['cantidad']; ?></td>
                            <td><?php echo $vent['precio_venta']; ?></td>
                            <td style="text-align: center;"><?php echo $vent['total_por_producto'] ?></td>
                        </tr>
                    <?php endforeach;
                } else {
                    echo "<tr><td colspan='5'>No hay ventas para mostrar</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

        <?php

        }
        ?>
    <?php
    }
    ?>
</main>
<?php
require_once "template/footer.php";

?>