<?php
// session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda | Online </title>
  <!-- cdn pdf -->


  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- boton para la exportacion de datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">



  <!-- Datatables -->
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

  <!-- bootstrap 5 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->



  <!-- booststrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->

  <!-- iconos de font-awsone -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />






  <link rel="stylesheet" href="../../public/css/style.css">

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> -->

  <!-- <link rel="stylesheet" href="../../public/css/dark-mode.css"> -->



</head>


<body>

  <nav class="navbar navbar-expand-lg navbar-dark  fixed-top" style="background-color:#22313f">
    <div class="container-fluid">
      <!-- Sidebar Trigger Start -->
      <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Sidebar Trigger End -->
      <div class="pt-2 mx-5">

        <img src="../../public/images/Levis-Logo-PNG.png" alt="" style="max-width:5.5em;">
      </div>
      <a class="navbar-brand fw-bold me-auto" href="/precentacion/inicio.php">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- <style>
          .title{
            margin-left: 5.5rem
            
          };
        </style>
            <small class="title" style="color: white;">SISTEMA DE VENTAS</small> -->

        <form class="d-flex ms-auto">
          <!-- <div class="input-group my-3 my-lg-0">
              <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
            </div> -->
        </form>

        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cerrar Sesión
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <!-- <a class="dropdown-item" href="#">Usuario</a> -->
              </li>
              <li>
                <!-- <a class="dropdown-item" href="#">Cambiar contraseña</a> -->
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item" href="/precentacion/cerrar_sesion.php">Cerrar Sesión</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Sidebar Start -->
  <div class="offcanvas offcanvas-start  text-white side-bar" data-bs-scroll="true" tabindex="-1" id="offcanvas" aria-labelledby="offcanvas" style="background-color: #22313f" >

    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav pt-3">
          <!-- <li>
            <div class="text-muted small fw-bold text-uppercase px-3 py-3">Core</div>
          </li> -->

          <?php foreach ($_SESSION['nombre_rol'] as $rol) {
            // var_dump($_SESSION['nombre_rol']);
          ?>

            <?php
            if ($rol == 'ADMINISTRADOR') {
            ?>
              <!-- <li>
                <a href="/precentacion/inicio.php" class="nav-link px-3 active">
                  <span class="me-2">
                    <i class="bi bi-wrench-adjustable-circle"></i>
                  </span>
                  <span class="fw-bold">Menu</span>
                </a>
              </li> -->


              <li class="my-2">
                <hr class="dropdown-divider">
              </li>



              <li>
                <!-- <div class="text-muted small fw-bold text-uppercase px-3">Acceso y Seguridad</div> -->
              </li>




              <li>
                <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#accesoSeguridad" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <span class="me-2">
                    <i class="fa-solid fa-shield-halved"></i>
                  </span>
                  <span class="fw-bold">Acceso y Seguridad</span>
                  <span class="right-icon ms-auto">
                    <!-- <i class="bi bi-chevron-down"></i> -->
                  </span>
                </a>
                <div class="collapse" id="accesoSeguridad">
                  <div>
                    <ul class="navbar-nav ps-3">
                      <li>
                        <a href="/precentacion/pUsuario.php" class="nav-link px-3">
                          <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                          <span class="fw-bold">Administrar Usuario</span>
                        </a>
                      </li>
                      <li>
                        <a href="/precentacion/pRoles.php" class="nav-link px-3">
                          <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                          <span class="fw-bold">Administrar Roles</span>
                        </a>
                      </li>
                      <li>
                        <a href="/precentacion/pAsignarRolUsuario.php" class="nav-link px-3">
                          <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                          <span class="fw-bold">Asignar Rol a Usuario</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            <?php
            }
            ?>
            <!-- ------------------------------------------------------------------------ -->
            <?php
            if (($rol == 'ASISTENTE') || ($rol == 'ADMINISTRADOR')) {

            ?>
              <li class="my-2">
                <hr class="dropdown-divider">
              </li>
              <li>
                <!-- <div class="text-muted small fw-bold text-uppercase px-3">Parametrizacion</div> -->
              </li>

              <li>
                <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#parametrizacion" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <span class="me-2">
                    <!-- <i class="fa-solid fa-magnifying-glass-chart"></i> -->
                  </span>
                  <span class="fw-bold">Parametrización</span>
                  <span class="right-icon ms-auto">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </a>
                <div class="collapse" id="parametrizacion">
                  <div>
                    <ul class="navbar-nav ps-3">
                      <?php
                      if ($rol == 'ADMINISTRADOR') {
                      ?>

                        <li>
                          <a href="/precentacion/pCliente.php" class="nav-link px-3">
                            <!-- <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span> -->
                            <span class="fw-bold">Administrar Clientes</span>
                          </a>
                        </li>
                        <li>
                          <a href="/precentacion/pCategoria.php" class="nav-link px-3">
                            <!-- <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span> -->
                            <span class="fw-bold">Administrar Categorías</span>
                          </a>
                        </li>

                        <li>
                          <a href="/precentacion/pProveedor.php" class="nav-link px-3">
                            <!-- <span class="me-2">
                            <i class="fa-solid fa-truck-moving" style="color: #46dd5f;"></i>
                          </span> -->
                            <span class="fw-bold">Administrar Proveedores</span>
                          </a>
                        </li>
                      <?php
                      }
                      ?>

                      <?php
                      if (($rol == 'ASISTENTE') || ($rol == 'ADMINISTRADOR')) {

                      ?>
                        <li>
                          <a href="/precentacion/pProducto.php" class="nav-link px-3">
                            <!-- <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span> -->
                            <span class="fw-bold">Administrar Productos</span>
                          </a>
                        </li>
                      <?php
                      }
                      ?>

                    </ul>
                  </div>
                </div>
              </li>


            <?php
            }
            ?>



            <?php
            if (($rol == 'CAJA') || ($rol == 'ADMINISTRADOR')) {
            ?>
              <li class="my-2">
                <hr class="dropdown-divider">
              </li>
              <li>
                <!-- <div class="text-muted small fw-bold text-uppercase px-3">Transaccionales</div> -->
              </li>
              <li>
                <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#transaccional" role="button" aria-expanded="false" aria-controls="transaccional">
                  <span class="me-2">
                    <!-- <i class="fa-solid fa-truck-ramp-box"></i> -->
                  </span>
                  <span class="fw-bold">Transaccionales</span>
                  <span class="right-icon ms-auto">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </a>
                <div class="collapse" id="transaccional">
                  <div>
                    <ul class="navbar-nav ps-3">

                      <?php
                      if ($rol == 'ADMINISTRADOR') {
                      ?>
                        <!-- <li>
                          <a href="/precentacion/pListado_compra.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                            <span class="fw-bold">Listado de compras</span>
                          </a>
                        </li> -->

                        <li>
                          <a href="/precentacion/pCompra_2.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                            <span class="fw-bold">Gestionar Compra</span>
                          </a>
                        </li>

                      <?php
                      }
                      ?>


                      <?php
                      if (($rol == 'CAJA') || $rol == 'ADMINISTRADOR') {
                      ?>
                        <!-- <li>
                          <a href="/precentacion/pListado_venta.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                            <span class="fw-bold">Listado de Ventas</span>
                          </a>
                        </li> -->

                        <li>
                          <a href="/precentacion/pVenta_2.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-layout-text-window-reverse"></i></span>
                            <span class="fw-bold">Gestionar Venta</span>
                          </a>
                        </li>
                      <?php
                      }
                      ?>




                    </ul>
                  </div>
                </div>
              </li>




              <!-- REPORTES -->


              <li class="my-2">
                <hr class="dropdown-divider">
              </li>

              <li>

                <div class="text-muted small fw-bold text-uppercase px-3">Reporte</div>
              </li>

              <li>
                <a href="/precentacion/inicio.php" class="nav-link px-3">
                  <!-- <span class="me-2"><i class="fa-brands fa-aws"></i></span> -->
                  <span class="fw-bold">Venta Diaria</span>
                </a>
              </li>
              <li>
                <a href="/precentacion/web.php" class="nav-link px-3">
                  <!-- <span class="me-2"><i class="fa-brands fa-aws"></i></span> -->
                  <span class="fw-bold">Web</span>
                </a>
              </li>

            <?php
            }
            ?>




          <?php
          }
          ?>

          <!-- </ul> -->

          <!-- </div> -->
          <!-- </div> -->






          <!-- </li> -->
          <!-- </li> -->
        </ul>

      </nav>
    </div>
    <div>

      <div class="small">Conetado:

        <?php
        echo $_SESSION['usuario']
        ?>
      </div>

    </div>
  </div>