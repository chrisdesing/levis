<?php

    require_once "../negocio/Nusuario.php";

    if(!isset($_POST['buscar'])){
        $_POST['buscar']=trim("");
        $buscar = trim($_POST['buscar']);
    }
    $buscar = trim($_POST['buscar']);
    $nUsuario = new Nusuario();
    $usuarios = $nUsuario->nbuscarUsuario($buscar);
    //  echo $nUsuario->visualizarDatos($buscar);
    
    