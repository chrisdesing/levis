<?php

require_once "../negocio/Nusuario.php";
session_start();
    if(isset($_POST['registrar'])){

    $ci = trim($_POST['ci']);
    $nombre = strtoupper(trim($_POST['nombre']));
    $apellidop = strtoupper(trim($_POST['apellidop']));
    $apellidom = strtoupper(trim($_POST['apellidom'])) ;
    $telefono =  trim($_POST['telef']);
    $email = trim($_POST['email']);
    $direccion = strtoupper(trim($_POST['direccion'])) ;
    $genero = $_POST['genero'];
    $usuario = strtoupper(trim($_POST['usuario'])); 
    $clave = trim($_POST['clave']);



    $nUsuario = new Nusuario();
    
    if ($nUsuario->registrarUsuarioPersona($ci,$nombre,$apellidop,$apellidom,$telefono,$email,$direccion,$genero,$usuario,$clave)){
  
        header("Location: pUsuario.php");
        exit;
    } else{
        $_SESSION['error_usuario'] = "Datos duplicados cedula identidad/correo electronico u usuario";
        header("Location: pUsuario.php");
        exit;
    }

}



if (isset($_POST['eliminar'])){
    $id = $_POST['id_persona'];

    $usuario = new Nusuario();
    if($usuario->nEliminarUsuario($id)){
        header("Location: pUsuario.php");
    }else{
        return "error";
    }
}

if (isset($_POST['editar'])){
    $id = $_POST['id_persona'];
    $cii = strtoupper($_POST['ci']);
    $nombree = strtoupper($_POST['nombre']);
    $apellp = strtoupper($_POST['apellidoP']);
    $apellm = strtoupper($_POST['apellidoM']) ;
    $telef =  $_POST['telefono'];
    $emaill = $_POST['email'];
    $direccionn = strtoupper($_POST['direccion']) ;
    $generoo = $_POST['genero'];
    $usuarios = strtoupper($_POST['usuario']); 
    // $claves = $_POST['clave'];
    // $estados = $_POST['estado'];

    $nUsuario = new Nusuario();
    if ($nUsuario->nEditarUsurio($id,$cii,$nombree,$apellp,$apellm,$telef,$emaill,$direccionn,$generoo,$usuarios)){
        header("Location: pUsuario.php");
    }else{
        // echo 'error datos duplicados cedula identidad/correo electronico';
        header("Location: pUsuario.php");
        $_SESSION['error_usuario'] = "Datos duplicados cedula identidad/email";
    }
}
