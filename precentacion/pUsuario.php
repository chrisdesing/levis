<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}
require_once "template/header.php";

include 'visualizar-usuarios.php';
?>
<main class=" mt-5 pt-4">


    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR') {
        ?>
            <?php
            if (isset($_SESSION['error_usuario'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['error_usuario'] . '</div>';
                unset($_SESSION['error_usuario']);
            }
            ?>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="register_usuario" onsubmit="return validarFormulario()" class="row g-3" role="form" method="POST" action="usuario.php">
                                <div class="col-md-6" id="grupo_usuario">
                                    <label for="identidad" class="form-label"><span class="text-danger">*</span>Cédula de Identidad</label>
                                    <input type="text" id="identidad" class="form-control" name="ci" placeholder="Ingrese su cedula identidad">
                                    <small style="color: red; display: none" id="lbl_cedula">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="nombreo" class="form-label">Nombre Completo</label>
                                    <input type="text" id="nombreo" class="form-control" name="nombre" placeholder="Ingrese su nombre completo">
                                    <small style="color: red; display: none" id="lbl_nombre">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="apellidop" class="form-label">Apellido Paterno</label>
                                    <input type="text" id="apellidop" class="form-control" name="apellidop" placeholder="Ingrese su apellido paterno">
                                    <small style="color: red; display: none" id="lbl_apellidop">Campo invalido</small>

                                </div>
                                <div class="col-md-6">
                                    <label for="apellidoo" class="form-label">Apellido Materno</label>
                                    <input type="text" id="apellidom" class="form-control" name="apellidom" placeholder="Ingrese su apellido materno">
                                    <small style="color: red; display: none" id="lbl_apellidom">Campo invalido</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="telef" class="form-label">Celular</label>
                                    <input type="number" name="telef" id="telef" class="form-control" placeholder="Ingresu el n° celular">
                                    <small style="color: red; display: none" id="lbl_celular">Campo obligatorio</small>
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
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" id="direccion" class="form-control" name="direccion" placeholder="Ingrese la dirección">
                                    <small style="color: red; display: none" id="lbl_direccion">Campo obligatorio</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo electronico</label>
                                    <input type="email" id="email" class="form-control" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="user" class="form-label">Nombre de Usuario:</label>
                                    <input type="text" id="user" class="form-control" name="usuario" placeholder="Ingrese el usuario">
                                    <small style="color: red; display: none" id="lbl_nombre_user">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="pass" class="form-label">Contraseña</label>
                                    <input type="password" id="pass" class="form-control" name="clave" placeholder="Ingrese la contraseña">
                                    <small style="color: red; display: none" id="lbl_contrasena">Campo invalido</small>
                                </div>

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="registrar">Registrar Usuario</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                                <div id="respuesta">
                                    <div id="resultado_categoria"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- <div class="row"> -->
                <div class="col-md-12">
                    <!-- Tabla 1 -->
                    <div class="card custom-cardd">
                        <div class="card-body">
                            <h5 class="card-title" style="text-align: center;">Administrar Usuarios</h5>
                            <!-- MODAL INSERTAR -->
                            <button type="button" class="btn btn-primary px-3 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-circle-plus"></i>
                                Registrar Usuario
                            </button>
                            <!-- <form class="d-flex ms-auto" action="pUsuario.php" method="post">
                                <div class="input-group my-3 my-lg-4" style="width: 35%;">
                                    <input type="text" class="form-control" name="buscar" placeholder="Realize su bussqueda" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search"></i> Buscar Usuario</button>
                                </div>
                            </form> -->
                            <div class="table-responsive">
                                <table id="lista_usuario" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">Id</th>
                                            <th>Cédula</th>
                                            <th>Nombres</th>
                                            <th>A. Paterno</th>
                                            <th>A. Materno</th>
                                            <th>Celular</th>
                                            <th>Correo E.</th>
                                            <th>Domicilio</th>
                                            <th>Genero</th>
                                            <th>Usuario</th>
                                            <!-- <th>Clave</th> -->
                                            <!-- <th>Estado</th> -->
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>


                                    <?php
                                    foreach ($usuarios as $user) {
                                        $id_usuario = $user['id_persona']; ?>
                                        <!-- <tbody id="bodyUser"> -->

                                        <tr>
                                            <td style="display: none;">
                                                <?php echo $user['id_persona']; ?>
                                            </td>
                                            <td><?php echo $user['ci']; ?></td>
                                            <td><?php echo $user['nombre']; ?></td>
                                            <td><?php echo $user['apellidoP']; ?></td>
                                            <td><?php echo $user['apellidoM']; ?></td>
                                            <td><?php echo $user['telefono']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['direccion']; ?></td>
                                            <td style="text-align: center;"><?php echo $user['genero']; ?></td>
                                            <td><?php echo $user['usuario']; ?></td>
                                            <!-- <td style="display: none;"><?php echo $user['clave'] ?></td> -->
                                            <!-- <td style="display: none;"><?php echo $user['estado']; ?></td> -->
                                            <td>
                                                <button type="button" class="btn btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#eliminar" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar usuario" style="padding: 0;">
                                                    <!-- <i class="fa-solid fa-trash-can"></i> -->
                                                    Eliminar Usuario
                                                </button>
                                                <button type="button" class="btn btn-warning editbtn" data-bs-toggle="modal" data-bs-target="#editar" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar usuario" style="padding: 0;">
                                                    <!-- <i class="fa-solid fa-pen"></i> -->
                                                    Editar Usuario
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
            <!-- </div> -->



            <!-- Modal Editar-->
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido de la ventana modal -->
                            <form id="form-editar" class="row g-3" role="form" method="POST" action="usuario.php" onsubmit="return validarFormularioEdit()">
                                <input type="hidden" name="id_persona" id="update-id">
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
                                    <label for="celular" class="form-label">Celular</label>
                                    <input type="number" id="celular" class="form-control" name="telefono">
                                    <small style="color: red; display: none" id="lbl_celu">Campo invalido</small>
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
                                    <small style="color: red; display: none" id="lbl_address">Campo invalido</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="correo" class="form-label">Correo electronico</label>
                                    <input type="email" id="correo" class="form-control" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="usser" class="form-label">Nombre de Usuario:</label>
                                    <input type="text" id="usser" class="form-control" name="usuario" readonly>
                                    <small style="color: red; display: none" id="lbl_user">Campo invalido</small>
                                </div>
                                <!-- <div class="col-md-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" class="form-control" name="clave">
                        </div> -->

                                <!-- <div class="mb-1 col-md-6">
                            <label for="seleccion" class="form-label">Estado</label>
                            <select class="form-select" id="seleccion" name="estado">
                                <option value="HABILITADO">HABILITADO</option>
                                <option value="INHABILITADO">INHABILITADO</option>
                            </select>
                        </div> -->

                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="editar">Editar Usuario</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Modal eliminar -->

            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Contenido de la ventana modal -->
                            <h4>¿Esta Seguro de Eliminar?</h4>
                            <form id="form-eliminar" class="row g-3" role="form" method="POST" action="usuario.php">
                                <input type="hidden" name="id_persona" id="delete-id">
                                <div class="modal-footer col-md-12">
                                    <button type="submit" class="btn btn-primary" name="eliminar">Eliminar_usuario</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>















        <?php
        } else {
            echo 'No tiene acceso';
        }
        ?>
    <?php
    }
    ?>
</main>

<?php
require_once "template/footer.php";
?>