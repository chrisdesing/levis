<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';
include 'roles.php';
?>
<main class=" mt-5 pt-4">
 

    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR') {
        ?>


            <?php
            if (isset($_SESSION['error_rol'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error_rol'] . '</div>';
                unset($_SESSION['error_rol']);
            }
            ?>




            <!-- Modal de registro de Rol -->
            <div class="modal fade" id="rol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Llene los campos</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="register" class="row g-3" onsubmit="return validarRol();" role="form" method="POST" action="roles.php">
                                <div class="col-md-6">
                                    <label for="rol_nombre" class="form-label">Nombre Rol</label>
                                    <input type="text" id="rol_nombre" class="form-control" name="nombre_rol">
                                    <small style="color: red; display: none" id="lbl_rol">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="descripcion_rol" class="form-label">Descripcion</label>
                                    <input type="text" id="descripcion_rol" class="form-control" name="descripcion">
                                    <small style="color: red; display: none" id="lbl_descripcion">Campo invalido</small>
                                </div>


                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="registrar_rol">Registrar_Rol</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <script>

            </script>

            <div class="col-md-12">
                <div class="card custom-cardd">
                    <!-- Tabla 1 -->
                    <div class="card-body ">
                        <h5 class="card-title" style="text-align: center;">Administrar Roles</h5>

                        <!--BOTTON PARA ACCEDER AL MODAL ROL -->
                        <button type="button" class="btn btn-primary px-3 mt-2 " data-bs-toggle="modal" data-bs-target="#rol" >
                        <i class="fa-solid fa-circle-plus"></i>
                            Registrar Roles
                        </button>
                        <div class="table table-responsive">
                            <table id="tabla_roles" class="table table-bordered table-striped table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <!-- <th>Estado</th> -->
                                        <th>Fecha Creacion</th>
                                        <th>Aciones</th>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($roles as $rol) {
                                ?>

                                    <tr>
                                        <td style="display: none;"><?php echo $rol['id_roles']; ?>
                                        </td>
                                        <td><?php echo $rol['nombre_rol']; ?></td>
                                        <td><?php echo $rol['descripcion']; ?></td>
                                        <td><?php echo $rol['fecha_creacion_formateado']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete-rol" data-bs-toggle="modal" data-bs-target="#eliminar">
                                                Eliminar_rol
                                            </button>
                                            <button type="button" class="btn btn-warning update-rol" data-bs-toggle="modal" data-bs-target="#editar">
                                                Editar_rol
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- </tbody> -->
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>







            <!-- Modal para eliminar un rol -->
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliga una opcion</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="register" class="row g-3" role="form" method="POST" action="roles.php">
                                <input type="hidden" id="eliminar-id" name="id_roles">
                                <h3>¿Seguro de eliminar el rol? </h3>

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="eliminar_rol">Eliminar rol</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






            <!-- Modal editar rol -->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliga que campo editar</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="register" onsubmit="return validarRolEdit();" class="row g-3" role="form" method="POST" action="roles.php">

                                <input type="hidden" id="rol_id" name="id_roles">
                                <div class="col-md-6">
                                    <label for="nombre_rol" class="form-label">Nombre Rol</label>
                                    <input autofocus type="text" id="nombre_rol" class="form-control" name="nombre_rol">
                                    <small style="color: red; display: none" id="lbl_roll">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="descripcion_rol" class="form-label">Descripcion</label>
                                    <input type="text" id="rol_descripcion" class="form-control" name="descripcion">
                                    <small style="color: red; display: none" id="lbl_descripcionn">Campo invalido</small>
                                </div>

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="editar_rol">Editar Rol</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>













</main>

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