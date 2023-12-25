<?php


require_once '../negocio/Ncliente.php';

if (!isset($_POST['buscar'])) {
    $_POST['buscar'] = trim("");
    $buscar = trim($_POST['buscar']);
}
$buscar = trim($_POST['buscar']);

$ncliente = new Ncliente();
$clientes = $ncliente->nBuscarCliente($buscar);

// $erros = [];
if (isset($_POST['ci_cliente'])) {

    $ci_cliente = trim($_POST['ci_cliente']);
    $nombre_cliente = strtoupper(trim($_POST['nombre_cliente']));
    $apellidop_cliente = strtoupper(trim($_POST['apellidop_cliente']));
    $apellidom_cliente = strtoupper(trim($_POST['apellidom_cliente']));
    $telefono_cliente = trim($_POST['telefono_cliente']);
    $email_cliente = trim($_POST['email_cliente']);
    $direccion_cliente = strtoupper(trim($_POST['direccion_cliente']));
    $genero = trim($_POST['genero']);



    // echo "$ci,$nombre,$apellidoP,$apellidoM,$telefono,$email,$direccion,$genero";
    $cliente = new Ncliente();

    // if($cliente->esNull([$ci,$nombre,$apellidoP,$apellidoM])){
    //     $erros[] = "Debe llenar todos los campos";
    // }

    // if(!$cliente->is_email($email)){
    //     $erros[] = "Correo electronico no valido";
    // }

    // if($cliente->emailExiste($email)){
    //     $erros[] = "Correo electronico ya existe";
    // }

    // if (count($erros) == 0 ){
    if ($cliente->nRegistrarCliente($ci_cliente, $nombre_cliente, $apellidop_cliente, $apellidom_cliente, $telefono_cliente, $email_cliente, $direccion_cliente, $genero)) {

    ?>
        <script>
            location.href = "pVenta_2.php";
        </script>
    <?php



    } else {
        echo 'N°carnet/email duplicado';
    }

    // }


}



if (isset($_POST['editar_cliente'])) {
    $id = trim($_POST['id_persona']);
    $cii = strtoupper(trim($_POST['ci']));
    $nombree = strtoupper(trim($_POST['nombre']));
    $apellp = strtoupper(trim($_POST['apellidoP']));
    $apellm = strtoupper(trim($_POST['apellidoM']));
    $telef =  trim($_POST['telefono']);
    $emaill = trim($_POST['email']);
    $direccionn = strtoupper(trim($_POST['direccion']));
    $generoo = $_POST['genero'];
    // $estados = $_POST['estado'];

    $cliente = new Ncliente();
    if ($cliente->nEditarCliente($id, $cii, $nombree, $apellp, $apellm, $telef, $emaill, $direccionn, $generoo)) {
        header("Location: pCliente.php");
    } else {
        
        header("Location: pCliente.php");
    }
}

if (isset($_POST['eliminar_cliente'])) {
    $id = $_POST['id_persona'];

    $cliente = new Ncliente();
    if ($cliente->nEliminarCliente($id)) {
        header("Location: pCliente.php");
    } else {
        echo 'Error al eliminar';
    }
}
