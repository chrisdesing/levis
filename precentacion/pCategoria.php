<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
}
require_once 'categoria.php';
require_once 'template/header.php';


?>

<main class="mt-5 pt-4">

    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR') {
        ?>



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar Categoría</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <label for="nombre_categoriaa" class="form-label"><span class="text-danger">*</span>Nombre de la categoría</label>
                                <input type="text" id="nombre_categoriaa" class="form-control " placeholder="Ingrese la categoria">
                                <small style="color: red; display: none" id="lbl_create">Campo invalido</small>
                            </div>

                            <div class="modal-footer col-md-12">
                                <button type="button" class="btn btn-primary" id="btn_create_categoria">RegistrarCategoría</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <div id="respuesta">
                                    <div id="resultado_categoria"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>














            <!-- <div class="card-body" style="display: block;">
                <form class="d-flex ms-auto" action="pCategoria.php" method="post">
                    <div class="input-group my-3 my-lg-4" style="width: 35%;">
                        <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search">BuscarCategoria</i></button>
                    </div>
                </form> -->

            <div class="col-md-11" style="margin: 0 auto;">
                <div class="card custom-cardd">
                    <div class="card-body ">
                        <h5 class="card-title" style="text-align: center;">Administrar Categorias</h5>

                        <!-- MODAL INSERTAR -->
                        <button type="button" class="btn btn-primary px-3 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-plus"></i>
                            RegistrarCategoria
                        </button>
                        <div class="table table-responsive">
                            <table id="tabla_categoria" class="table table-bordered table-striped table-sm" >
                                <thead>

                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Categoria</th>
                                        <!-- <th>Estado</th> -->
                                        <th>fecha creacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <?php
                                foreach ($categorias as $categoria) {
                                ?>
                                    <tr>
                                        <td style="display: none;"><?php echo $categoria['id_categoria']; ?></td>
                                        <td><?php echo $categoria['nombre_categoria']; ?></td>
                                        <!-- <td><?php echo $categoria['estado']; ?></td> -->
                                        <td><?php echo $categoria['fecha_creacion']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger delete_categoria" data-bs-toggle="modal" data-bs-target="#eliminar">
                                                <i class="fa-solid fa-trash-can"></i>
                                                EliminarCategoria
                                            </button>
                                            <button type="button" class="btn btn-warning edit_categoria" data-bs-toggle="modal" data-bs-target="#editar">
                                                EditarCategoria
                                            </button>
                                        </td>
                                    </tr>


                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>









            <!-- Modal para eliminar categoria -->
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliga una opcion</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" role="form" method="POST" action="categoria.php">
                                <input type="hidden" id="categoria-id" name="id_categoria">
                                <h3>¿Seguro de Eliminar la Categoria? </h3>

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="eliminar_categoria">Eliminar Categoria</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Modal editar categoria -->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edite su campo</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" role="form" method="POST" action="categoria.php" onsubmit="return validarCategoriaEdit()">

                                <input type="hidden" id="id-categori" name="id_categoria">
                                <div class="col-md-12">
                                    <label for="nombreCateg" class="form-label">Categoría</label>
                                    <input type="text" id="nombreCateg" class="form-control" name="nombre_categoria">
                                    <small style="color: red; display: none" id="lbl_nombre_categoria">Campo invalido</small>
                                </div>


                                <!-- <div class="mb-1 col-md-6">
                                    <label for="categoria_estado" class="form-label">Estado</label>
                                    <select class="form-select" id="categoria_estado" name="estado">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div> -->


                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="editar_categoria">Editar Categoría</button>
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