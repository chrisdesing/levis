<?php

require_once '../negocio/Nasignar-roles.php';


if (!isset($_POST['buscar'])){
    $_POST['buscar']= "";

    $buscar = $_POST['buscar'];
}
// que capture mediante el metodo post el dato buscar
$buscar = $_POST['buscar'];

$asignar = new NasignarRolUsuario();
$asignarRol = $asignar->nBuscarUsuario($buscar);



if($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_POST['asignacion'])){
    $id_persona = $_POST['persona_id'];
    $id_rol = $_POST['roles_id'];

    $pAsignar = new NasignarRolUsuario();
    if ($asignar->nAsignarRoleUsuario($id_persona,$id_rol)){
        header('Location: pAsignarRolUsuario.php');
    }else{
        // echo 'Fallo al asignar';
        $_SESSION['error_asignar'] = "Error al asignar";
        header("Location: pUsuario.php");
        exit;
    }
}
