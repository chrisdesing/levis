<?php
require_once '../negocio/Nusuario.php';
require_once '../negocio/Nroles.php';
session_start();

if (isset($_POST['ingresar'])) {
    $usuario = strtoupper($_POST['usuario']);
    $clave = $_POST['clave'];
    $nUsuaro = new Nusuario();

    if ($nUsuaro->ingresar($usuario, $clave)) {
        if ($nUsuaro->nObtenerEstado($usuario)) {
            $id_persona = $nUsuaro->nObtener_id($usuario);
            $_SESSION['id_persona'] = $id_persona;
            $_SESSION['usuario'] = $usuario;
            // $_SESSION['id_persona'] = $user_id;
            $rolesUsuario = $nUsuaro->nObtenerRolUsuario($usuario);
            $_SESSION['nombre_rol'] = $rolesUsuario;

            foreach ($_SESSION['nombre_rol'] as $rol) {
                // var_dump($_SESSION['nombre_rol']);
            
        
                
                if ($rol == 'VENDEDOR') {
                    header('Location: pProducto.php');
                    exit;
                }else{
                    header('Location: inicio.php');
                    exit;
                }
            
           
           
            }
        } else {
            $_SESSION['error'] = "Usuario no habilitado";
        }
    } else {
        $_SESSION['error'] = 'Usuario/Contraseña incorrectas';
    }
}

header('Location: index.php');
exit;
?>
