<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
}


require_once "proveedor.php";
require_once "template/header.php";
?>


<main class="mt-5 pt-4">


    <?php foreach ($_SESSION['nombre_rol'] as $rol) {
        // var_dump($_SESSION['nombre_rol']);
    ?>

        <?php
        if ($rol == 'ADMINISTRADOR') {
        ?>

            <?php
            // if (isset($_SESSION['error_usuario'])) {
            //     echo '<div class="alert alert-danger">' . $_SESSION['error_usuario'] . '</div>';
            //     unset($_SESSION['error_usuario']);
            // }
            ?>

            <!-- Modal -->
            <div class="modal fade" id="frmproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #1d36b1; color:white">
                            <h5 class="modal-title" id="exampleModalLabel">Registrar proveedor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row g-3">

                            <div class="col-md-6">
                                <label for="nombre_proveedor" class="form-label">Nombre Completo</label>
                                <input type="text" id="nombre_proveedor" class="form-control">
                                <small style="color: red;display: none;" id="lbl_nombre">* Campo invalido</small>
                            </div>
                            <!-- <div class="col-md-6">
                            <label for="apellidoo" class="form-label">Apellido Paterno</label>
                            <input type="text" id="apellidop" class="form-control" name="apellidop" required>

                        </div>
                        <div class="col-md-6">
                            <label for="apellidoo" class="form-label">Apellido Materno</label>
                            <input type="text" id="apellidom" class="form-control" name="apellidom" required>

                        </div> -->

                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Celular</label>
                                <input type="number" id="telefono" class="form-control">
                                <small style="color: red;display: none;" id="lbl_telefono">* Campo invalido</small>
                            </div>

                            <div class="col-md-6">
                                <label for="nombre_empresa" class="form-label">Empresa</label>
                                <input type="text" id="nombre_empresa" class="form-control">
                                <small style="color: red;display: none;" id="lbl_empresa">* Campo invalido</small>
                            </div>

                            <div class="col-md-6">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" id="direccion" class="form-control">
                                <small style="color: red;display: none;" id="lbl_direccion">* Campo invalido</small>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="email" class="form-label">Correo electronico</label>
                                <input type="email" id="email" class="form-control">

                            </div> -->
                            <div class="col-md-6">
                                <label for="telefono_empresa" class="form-label">Teléfono</label>
                                <input type="tel" id="telefono_empresa" class="form-control" placeholder="Opcional">

                            </div>





                            <div class="modal-footer col-md-12">
                                <button type="submit" class="btn btn-primary" id="btn_registrar">Registrar Proveedor</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            <div id="respuesta">
                                <div id="resultado_categoria"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="col-md-12" style="margin: 0 auto;">
                <div class="card custom-cardd">
                    <div class="card-body ">
                        <h5 class="card-title" style="text-align: center;">Administrar Proveedores</h5>
                        <!-- MODAL INSERTAR proveedor-->
                        <button type="button" class="btn btn-primary px-4 mt-2" data-bs-toggle="modal" data-bs-target="#frmproveedor">
                            <i class="fa-solid fa-circle-plus"></i>
                            Registrar_proveedor
                        </button>
                        <!-- El componente de busqueda -->
                        <form class="d-flex ms-auto" action="pProveedor.php" method="post">
                            <div class="input-group my-3 my-lg-4" style="width: 35%;">
                                <input type="text" class="form-control" name="buscar" placeholder="Realize su busqueda" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" value="buscar" id="button-addon2"><i class="bi bi-search"></i>Buscar_proveedor</button>
                            </div>
                        </form>
                        <div class="table table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <!-- <th>id</th> -->
                                        <!-- <th>Cédula</th> -->
                                        <th>Nombre</th>
                                        <!-- <th>A. Paterno</th> -->
                                        <!-- <th>A. Materno</th> -->
                                        <th>Celular</th>
                                        <!-- <th>Correo Electronico</th> -->
                                        <th>Dirección</th>
                                        <!-- <th>Estado</th> -->
                                        <th>Empresa</th>
                                        <th>Teléfono</th>
                                        <!-- <th>Clave</th> -->
                                        <!-- <th>Estado</th> -->
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <?php
                                foreach ($proveedores as $user) {
                                    $id_persona = $user['id_persona'];
                                ?>
                                    <!-- <tbody id="bodyUser"> -->

                                    <tr>
                                        <td style="display: none;">
                                            <?php echo $user['id_persona']; ?>
                                        </td>
                                        <td><?php echo $user['nombre']; ?></td>

                                        <td>
                                            <a href="https://wa.me/591<?php echo $user['telefono']; ?>" target="_blank" class="btn btn-success">
                                                <i class="fa-brands fa-whatsapp"></i>
                                                <?php echo $user['telefono']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $user['direccion']; ?></td>
                                        <!-- <td><?php echo $user['estado']; ?></td> -->
                                        <td><?php echo $user['nombre_empresa'] ?></td>
                                        <td><?php echo $user['telefono_empresa'] ?></td>

                                        <td>
                                            <button type="button" class="btn btn-warning update-proveedor" data-bs-toggle="modal" data-bs-target="#editar<?php echo $id_persona; ?>">
                                                <!-- <i class="fa-solid fa-pen"></i> -->
                                                Editar proveedor
                                            </button>

                                            <!-- Modal Editar proveedor-->
                                            <div class="modal fade" id="editar<?php echo $id_persona; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row g-3">
                                                            <div class="col-md-6">
                                                                <label for="nombre_proveedor" class="form-label">Nombre Completo</label>
                                                                <input type="text" value="<?php echo $user['nombre']; ?>" id="nombre_proveedor<?php echo $id_persona; ?>" class="form-control">
                                                                <small style="color: red;display: none;" id="lbl_nombre<?php echo $id_persona; ?>">* Campo invalido</small>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="telefono" class="form-label">Celular</label>
                                                                <input type="number" id="telefono<?php echo $id_persona; ?>" value="<?php echo $user['telefono']; ?>" class="form-control">
                                                                <small style="color: red;display: none;" id="lbl_telefono<?php echo $id_persona; ?>">* Campo invalido</small>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="nombre_empresa" class="form-label">Empresa</label>
                                                                <input type="text" id="nombre_empresa<?php echo $id_persona; ?>" value="<?php echo $user['nombre_empresa'] ?>" class="form-control">
                                                                <small style="color: red;display: none;" id="lbl_empresa<?php echo $id_persona; ?>">* Campo invalido</small>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="direccion" class="form-label">Dirección</label>
                                                                <input type="text" id="direccion<?php echo $id_persona; ?>" value="<?php echo $user['direccion']; ?>" class="form-control">
                                                                <small style="color: red;display: none;" id="lbl_direccion<?php echo $id_persona; ?>">* Campo invalido</small>
                                                            </div>

                                                            <!-- <div class="col-md-6">
                                                                <label for="email" class="form-label">Correo electronico</label>
                                                                <input type="email" id="email<?php echo $id_persona; ?>" value="<?php echo $user['email']; ?>" class="form-control">
                                                            </div> -->

                                                            <div class="col-md-6">
                                                                <label for="telefono_empresa" class="form-label">Teléfono</label>
                                                                <input type="text" id="telefono_empresa<?php echo $id_persona; ?>" value="<?php echo $user['telefono_empresa'] ?>" class="form-control">

                                                            </div>









                                                            <div class="modal-footer col-md-12">
                                                                <button type="button" class="btn btn-primary" id="btn_update_proveedor<?php echo $id_persona; ?>">Editar Proveedor</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>



                                                            <div id="respuesta">
                                                                <div id="resultado_categoria"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $('#btn_update_proveedor<?php echo $id_persona; ?>').click(function() {
                                                        var id_persona = <?php echo $id_persona; ?>;
                                                        var nombre_proveedor = $('#nombre_proveedor<?php echo $id_persona; ?>').val();
                                                        var nombre_empresa = $('#nombre_empresa<?php echo $id_persona; ?>').val();
                                                        var telefono = $('#telefono<?php echo $id_persona; ?>').val();
                                                        var direccion = $('#direccion<?php echo $id_persona; ?>').val();
                                                        // var email = $('#email<?php echo $id_persona; ?>').val();
                                                        let telefono_empresa = $('#telefono_empresa<?php echo $id_persona; ?>').val();
                                                        if (nombre_proveedor == "") {
                                                            $('#nombre_proveedor<?php echo $id_persona; ?>').focus();
                                                            $('#lbl_nombre<?php echo $id_persona; ?>').css('display', 'block');
                                                        } else if (nombre_empresa == "") {
                                                            $('#nombre_empresa<?php echo $id_persona; ?>').focus();
                                                            $('#lbl_empresa<?php echo $id_persona; ?>').css('display', 'block');
                                                        } else if (telefono == "") {
                                                            $('#telefono<?php echo $id_persona; ?>').focus();
                                                            $('#lbl_telefono<?php echo $id_persona; ?>').css('display', 'block');
                                                        } else if (direccion == "") {
                                                            $('#direccion<?php echo $id_persona; ?>').focus();
                                                            $('#lbl_direccion<?php echo $id_persona; ?>').css('display', 'block');
                                                        } else {
                                                            let url = "../../precentacion/proveedor.php";
                                                            $.post(url, {
                                                                id_persona: id_persona,
                                                                nombre_proveedor: nombre_proveedor,
                                                                nombre_empresa: nombre_empresa,
                                                                telefono: telefono,
                                                                direccion: direccion,
                                                                telefono_empresa: telefono_empresa
                                                            }, function(dato) {
                                                                $('#respuesta').html(dato);
                                                            });
                                                        }
                                                    });
                                                </script>
                                            </div>

                                            <!-- boton eliminar -->
                                            <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#eliminar<?php echo $id_persona; ?>">
                                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                                Eliminar proveedor
                                            </button>
                                            <!-- Modal para eliminar proveedor -->
                                            <div class="modal fade" id="eliminar<?php echo $id_persona; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background-color: darkred; color: whitesmoke;">
                                                            <h5 class="modal-title" id="exampleModalLabel">Borrar Proveedor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row g-3">
                                                            <h3>¿Seguro de eliminar los datos del proveedor?</h3>
                                                            <div class="modal-footer col-md-12">
                                                                <button type="button" class="btn btn-primary" id="btn_eliminar_proveedor<?php echo $id_persona; ?>">Eliminar_Proveedor</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>

                                                            <div id="respuesta">
                                                                <div id="resultado_categoria"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    $('#btn_eliminar_proveedor<?php echo $id_persona; ?>').click(function() {
                                                        var id_persona_proveedor = <?php echo $id_persona; ?>;

                                                        let url2 = "../../precentacion/proveedor.php";
                                                        $.post(url2, {
                                                            id_persona_proveedor: id_persona_proveedor,

                                                        }, function(dato) {
                                                            $('#respuesta').html(dato);
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- </tbody> -->
                                <?php } ?>
                            </table>
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