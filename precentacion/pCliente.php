<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once 'template/header.php';

require_once 'cliente.php';

?>


<main class="mt-5 pt-4">


    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR' || $rol == 'CAJA') {
        ?>

            <!-- Modal para el registro de clientes -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Llene los campos</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row g-3">


                            <!-- <form id="register_cliente" class="row g-3" role="form" method="POST" action="cliente.php"> -->
                            <div class="col-md-6">
                                <label for="ci_cliente" class="form-label"><span class="text-danger">*</span>Cédula de Identidad</label>
                                <input type="text" id="ci_clientee" class="form-control " placeholder="Ingrese su cédula identidad">
                                <small style="color: red; display: none" id="lbl_cedula">Campo invalido</small>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre_cliente" class="form-label">Nombre Completo</label>
                                <input type="text" id="nombre_cliente" class="form-control">
                                <small style="color: red; display: none" id="lbl_nombre">Campo invalido</small>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidop_cliente" class="form-label">Apellido Paterno</label>
                                <input type="text" id="apellidop_cliente" class="form-control">
                                <small style="color: red; display: none" id="lbl_apellidop">Campo invalido</small>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidom_cliente" class="form-label">Apellido Materno</label>
                                <input type="text" id="apellidom_cliente" class="form-control" requireda>
                                <small style="color: red; display: none" id="lbl_apellidom">Campo invalido</small>
                            </div>

                            <div class="col-md-6">
                                <label for="telefono_cliente" class="form-label">Teléfono Celular</label>
                                <input type="text" id="telefono_cliente" class="form-control" placeholder="Opcinal">
                                <small style="color: red; display: none" id="lbl_telefono">Campo invalido</small>
                            </div>
                            <div id="generoDiv" class="form-check col-md-6">
                                <label class="form-label">Género</label>
                                <div>
                                    <input type="radio" id="masculino" class="form-check-input" name="genero" value="M" checked>
                                    <label for="masculino">Masculino</label>
                                </div>
                                <div>
                                    <input type="radio" id="femenino" class="form-check-input" name="genero" value="F">
                                    <label for="femenino">Femenino</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="direccion_cliente" class="form-label">Dirección</label>
                                <input type="text" id="direccion_cliente" class="form-control" placeholder="Opcional">
                            </div>
                            <div class="col-md-6">
                                <label for="email_cliente" class="form-label">Correo electrónico</label>
                                <input type="email" id="email_cliente" class="form-control" placeholder="Opcinal">
                            </div>

                            <div class="modal-footer col-md-12">
                                <button type="button" class="btn btn-primary" id="btn_create_cliente">Registrar_Cliente</button>

                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

                            </div>
                            <div id="respuesta">
                                <div id="resultado_categoria"></div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>

<!--mostrar los datos  -->

            <div class="col-md-11" style="margin: 0 auto;">
                <div class="card custom-cardd">


                    <div class="card-body" style="display: block;">
                    <h5 class="card-title" style="text-align: center;">Administrar Clientes</h5>
                        <!-- Botton del modal insertar cliente -->
                        <button type="button" class="btn btn-primary px-3 mt-2 " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-plus"></i>
                            registrar_cliente
                        </button>

                        <!-- El componente de busqueda -->
                        <!-- <form class="d-flex ms-auto" action="pCliente.php" method="post">
                            <div class="input-group my-3 my-lg-4" style="width: 35%;">
                                <input type="text" class="form-control" name="buscar" placeholder="Realize su busqueda" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search">Buscar_cliente</i></button>
                            </div>
                        </form> -->
                        <!-- busqueda global -->
                        <!-- <input type="text" class="form-control" id="searchInput" placeholder="Buscar..."> -->

                        <div class="table table-responsive">
                            <table id="tabla_clientes" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>A. Paterno</th>
                                        <th>A. Materno</th>
                                        <th>Celular</th>
                                        <th>Correo eletronico</th>
                                        <th>Domicilio</th>
                                        <th>Género</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once '../negocio/Ncliente.php';
                                    $ncliente = new Ncliente();
                                    // $ncliente->frecuente();
                                    foreach ($clientes as $cliente) {

                                    ?>



                                        <tr>
                                            <td style="display: none;"><?php echo $cliente['id_persona']; ?></td>
                                            <td><?php echo $cliente['ci']; ?></td>
                                            <td><?php echo $cliente['nombre']; ?></td>
                                            <td><?php echo $cliente['apellidoP']; ?></td>
                                            <td><?php echo $cliente['apellidoM']; ?></td>
                                            <td><?php echo $cliente['telefono']; ?></td>
                                            <td><?php echo $cliente['email']; ?></td>
                                            <td><?php echo $cliente['direccion']; ?></td>
                                            <td><?php echo $cliente['genero']; ?></td>

                                       
                                            <td>
                                                <button type="button" class="btn btn-danger delete-cliente" data-bs-toggle="modal" data-bs-target="#eliminar" style="padding: 0.1em">
                                                    <!-- <i class="fa-solid fa-trash"></i> -->
                                                    Eliminar_cliente
                                                </button>
                                                <button type="button" class="btn btn-warning update-cliente" data-bs-toggle="modal" data-bs-target="#editar" style="padding: 0.1em">
                                                    <!-- <i class="fa-solid fa-pen"></i> -->
                                                    Editar_cliente
                                                </button>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Editar cliente-->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido de la ventana modal -->
                            <form id="form-editar" class="row g-3" role="form" method="POST" action="cliente.php" onsubmit="return actualizarCliente()">
                                <input type="hidden" name="id_persona" id="update_id">
                                <div class="col-md-6">
                                    <label for="ci" class="form-label">Cédula de Identidad</label>
                                    <input type="text" id="ci" class="form-control" name="ci">
                                    <small style="color: red; display: none" id="lbl_ci">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nombre Completo</label>
                                    <input type="text" id="name" class="form-control" name="nombre">
                                    <small style="color: red; display: none" id="lbl_name">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellp" class="form-label">Apellido Paterno</label>
                                    <input type="text" id="apellp" class="form-control" name="apellidoP">
                                    <small style="color: red; display: none" id="lbl_apellp">Campo invalido</small>

                                </div>
                                <div class="col-md-6">
                                    <label for="apellm" class="form-label">Apellido Materno</label>
                                    <input type="text" id="apellm" class="form-control" name="apellidoM">
                                    <small style="color: red; display: none" id="lbl_apellm">Campo invalido</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="celular" class="form-label">Teléfono</label>
                                    <input type="text" id="celular" class="form-control" name="telefono">
                                </div>
                                <div id="sexo" class="form-check col-md-6">
                                    <label class="form-label">Género</label>
                                    <div>
                                        <input type="radio" id="m" class="form-check-input" name="genero" value="M" checked>
                                        <label for="m">Masculino</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="f" class="form-check-input" name="genero" value="F">
                                        <label for="f">Femenino</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input type="text" id="address" class="form-control" name="direccion">
                                </div>
                                <div class="col-md-6">
                                    <label for="correo" class="form-label">Correo electronico</label>
                                    <input type="email" id="correo" class="form-control" name="email">
                                </div>

                                <!-- <div class="mb-1 col-md-6">
                            <label for="seleccion" class="form-label">Estado</label>
                            <select class="form-select" id="seleccion" name="estado">
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div> -->

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="editar_cliente">Editar_Cliente</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Modal eliminar cliente -->

            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inactivar al cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido de la ventana modal -->
                            <h4>¿Estas seguro de eliminar el cliente?</h4>
                            <form id="form-eliminar" class="row g-3" role="form" method="POST" action="cliente.php">
                                <input type="hidden" name="id_persona" id="delete-id">
                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="eliminar_cliente">Eliminar_cliente</button>
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