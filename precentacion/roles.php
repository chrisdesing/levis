<?php
require_once "../negocio/Nroles.php";


if (!isset($_POST['buscar'])){
    $_POST['buscar'] = "";
    $buscar = $_POST['buscar'];


  
}

$buscar = $_POST['buscar'];


$nroles = new Nroles();

$roles =$nroles->nBuscarRoles($buscar);



if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['registrar_rol'])){
    $nombre_rol = strtoupper($_POST['nombre_rol']);
    $descripcion = strtoupper($_POST['descripcion']);
    // $estado_rol = $_POST['estado_rol'];

    $roles = new Nroles();
    if($roles->nRegistrarRol($nombre_rol,$descripcion)){
        header('Location: pRoles.php');
        exit;
    }else{
        $_SESSION['error_rol'] = "Fallo al registrar el rol";

        header("Location: pRoles.php");

        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['eliminar_rol'])){
    $id_rol = $_POST['id_roles'];

    $roles = new Nroles();
    if ($roles->nEliminar_roles($id_rol)){
        header('Location: pRoles.php');
    }else{
        echo 'Hubo un error';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['editar_rol'])) {
    $nombre_rol = strtoupper($_POST['nombre_rol']);
    $descripcion = strtoupper($_POST['descripcion']);
    // $estado_rol = $_POST['estado_rol'];

    $id_rol = $_POST['id_roles'];

    $nroles = new Nroles();
    if ($nroles->nEditar_roles($id_rol,$nombre_rol,$descripcion)){
        header('Location: pRoles.php');
        exit();
    }else{
        session_start();

        header("Location: pRoles.php");
        $_SESSION['error_rol'] = "Rol duplicado";
    }
}
