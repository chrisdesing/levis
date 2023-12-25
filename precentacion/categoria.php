<?php

require_once '../negocio/Ncategoria.php';
if(!isset($_POST['buscar'])){
    $_POST['buscar'] = "";
    $buscar = trim($_POST['buscar']);
}
$buscar = trim($_POST['buscar']);

$ncategoria = new Ncategoria();
$categorias = $ncategoria->nBucasCategoria($buscar);



if (isset($_POST['nombre_categoriaas'])){
    $nombre_categoria = strtoupper($_POST['nombre_categoriaas']);

    if($ncategoria->nRegistrarCategoria($nombre_categoria)){
        // header("Location: pCategoria.php");
    
?>
    <script>
        location.href = "pCategoria.php";
    </script>
<?php

    }else{
        header('Location: pCategoria.php');
    }
    
}

  

 




if(isset($_POST['eliminar_categoria'])){
    $id = $_POST['id_categoria'];

   
    if( $ncategoria->nEliminarcategoria($id)){
        header("Location: pCategoria.php");
    }else{
        echo 'Error al eliminar';
    }
}


if(isset($_POST['editar_categoria'])){
    $idc = $_POST['id_categoria'];
    $nombreCategoria = strtoupper ($_POST['nombre_categoria']);

    if($ncategoria->nEditarCategoria($nombreCategoria,$idc)){
        header("Location: pCategoria.php");
    }else{
        header('Location: pCategoria.php');
    }
}


?>