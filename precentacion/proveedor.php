<?php

require_once '../negocio/Nproveedor.php';

if(!isset($_POST['buscar'])){
    $_POST['buscar'] =trim("");
    $buscar = trim($_POST['buscar']);

}
$buscar = trim($_POST['buscar']);
$nProveedor = new Nproveedor();
$proveedores = $nProveedor->buscarProveedor($buscar);
// registror de un proveedor
if(isset($_POST['nombre'])){
    $nombre = strtoupper($_POST['nombre']);
    $telefono = strtoupper($_POST['telefono']);
    // $email = $_POST['email'];
    $direccion = strtoupper($_POST['direccion']);
    
    $nombre_empresa = strtoupper($_POST['nombre_empresa']);
    $telefono_empresa = $_POST['telefono_empresa'];

    if($nProveedor->registrarProveedor($nombre,$telefono,$direccion,$nombre_empresa,$telefono_empresa)){

        ?>
            <script>
                location.href = "pProveedor.php";
            </script>

        <?php


    }else{
        

        ?>
        <script>
            location.href = "pProveedor.php";

        </script>

    <?php
               

        
    }
}





// editacion del proveedor
if(isset($_POST['id_persona'])){
    $id_persona = $_POST['id_persona'];
    $nombre_proveedor = strtoupper($_POST['nombre_proveedor']);
    $nombre_empresa = strtoupper($_POST['nombre_empresa']);
    $telefono = strtoupper($_POST['telefono']);
    $direccion = strtoupper($_POST['direccion']);
    // $email = $_POST['email'];
    $telefono_empresa = $_POST['telefono_empresa'];

    if($nProveedor->editarProveedot($id_persona,$nombre_proveedor,$telefono,$direccion,$nombre_empresa,$telefono_empresa)){

        ?>
            <script>
                location.href = "pProveedor.php";
            </script>

        <?php


    }else{

        ?>
        <script>
            location.href = "pProveedor.php";
        </script>

    <?php
        // header('Location: pProveedor.php');
    }
}


// Eliminacion de un proveedor
if(isset($_POST['id_persona_proveedor'])){
    $id_persona_proveedor = $_POST['id_persona_proveedor'];
    
    

    if($nProveedor->eliminarProveedor($id_persona_proveedor)){

        ?>
            <script>
                location.href = "pProveedor.php";
            </script>

        <?php


    }else{
        header('Location: pProveedor.php');
    }
}





