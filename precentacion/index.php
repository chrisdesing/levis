<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Levi's</title>



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script> -->



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- nuestro formulario de login. donde inicia la aplicacion -->
<style>
  .port {
    /* background-color: #ff6219; */
    margin: 0 auto;
  }
</style>

<body>



  <div class="card-body p-4 p-lg-5 text-black port" style="width: 500px;">
    <form action="ingresar.php" method="post" >
      <div class="d-flex align-items-center mb-3 pb-1">
        <!-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> -->

        <span class="h1 fw-bold mb-0"></span>
      </div>
      <div>

        <img src="../public/images/levi.jpg" alt="" style="max-width:7em;">
      </div>
      <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Ingresar</h5>
      <div class="form-outline mb-4">
        <label class="form-label" for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" placeholder="Ingrese su nombre de usuario" autofocus>
      </div>
      <div class="form-outline mb-4">
        <label class="form-label" for="contrasena">Contraseña</label>
        <input type="password" id="contrasena" name="clave" class="form-control form-control-lg" placeholder="Ingrese su contraseña">
      </div>

      <div class="pt-1 mb-4">
        <button class="btn btn-dark btn-lg btn-block" type="submit" name="ingresar">Ingresar</button>
      </div>
    </form>
  </div>
  <!-- Muestra la alerta de error si existe en la sesión -->
  <div class="alert alert-danger mb-4" role="alert" id="errorAlert" style="display: none;">
    <?php
    if (isset($_SESSION['error'])) {
      echo $_SESSION['error'];
      // con esto se limpia la seccion de error
      unset($_SESSION['error']);
    }
    ?>
  </div>

  <script>
    // Verifica si el elemento contiene texto y muestra la notificación
    if (document.querySelector("#errorAlert").textContent.trim() !== "") {
      document.querySelector("#errorAlert").style.display = "block";
    }
  </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>