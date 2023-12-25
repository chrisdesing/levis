<?php


session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
include 'asignar-roles.php';
?>



<main class=" mt-5 pt-4">

    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR') {

        ?>

            <?php
            if (isset($_SESSION['error_asignar'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error_asignar'] . '</div>';
                unset($_SESSION['error_asignar']);
            }
            ?>
<!-- 
            <form class="d-flex ms-auto" action="pAsignarRolUsuario.php" method="post">
                <div class="input-group my-3 my-lg-4" style="width: 35%;">
                    <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">

                    <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search">Buscar</i></button>
                </div>
            </form> -->



            <div class="col-md-11" style="margin: 0 auto; ">
                <div class="card custom-cardd">
                    <!-- Tabla 1 -->
                    <div class="card-body ">
                        <h5 class="card-title" style="text-align: center;">Asignar Rol a Usuario</h5>
                        <div class="table table-responsive">
                            <table style="margin: 0 auto; " id="asignar_rol" class="table table-bordered table-striped table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Fecha Asignación</th>
                                        <th>Aciones</th>
                                    </tr>
                                </thead>

                                <?php

                                foreach ($asignarRol as $user) {
                                ?>
                                    <tr>

                                        <td style="display: none;"><?php echo $user['id_persona']; ?></td>
                                        <td><?php echo $user['usuario']; ?></td>
                                        <td><?php echo $user['nombre_rol']; ?></td>
                                        <td><?php echo $user['fecha_asignar_formateado']; ?></td>
                                        <td>
                                            <button type="button" class="btn  asignarbtn" data-bs-toggle="modal" data-bs-target="#asignar" style="background-color: #288fb4; color: #fff;">
                                                Asignar Rol Usuario
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



            <!-- MODAL ASIGNAR -->
            <div class="modal fade" id="asignar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Seleccione el cargo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido de la ventana modal -->
                            <form id="form-asignar" class="row g-3" role="form" method="POST" action="asignar-roles.php">
                                <input type="hidden" name="persona_id" id="asignar-id">

                                <div class="col-md-6">
                                    <label for="usuario" class="form-label">Nombre de Usuario</label>
                                    <input type="text" id="usuario" disabled class="form-control" name="usuario">
                                </div>

                                <div class="mb-1 col-md-6">
                                    <label for="roles" class="form-label">Cargo</label>
                                    <select class="form-select" id="roles" name="roles_id">

                                        <?php

                                        require_once '../negocio/Nroles.php';
                                        $rol = new Nroles();
                                        $roles = $rol->nMostrarRol();
                                        ?>
                                        <?php foreach ($roles as $ro) : ?>

                                            <option value="<?php echo $ro['id_roles']; ?>">
                                                <?php echo $ro['nombre_rol']; ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="asignacion">Asignar Rol Usuario</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






</main>









<?php
            //         }
            // if (!$accesoPermitido) {
            //     echo 'No tienes acceso';
            //     echo '<script>window.location.href = "pAsignarRolUsuario.php";</script>';
            //     exit();
            // }
        } else {
            echo 'No tienes acceso';
            // echo '<script>window.location.href = "pAsignarRolUsuario.php";</script>';
            // exit();   
        }
?>
<?php
    }

?>

<?php
require_once 'template/footer.php';
?>