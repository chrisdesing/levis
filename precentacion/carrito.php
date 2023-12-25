<?php
require_once 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // aqui estamos diciendo si el elemento seleccionado ya existe
    if (isset($_SESSION['carrito']['productos'][$id])) {
        $_SESSION['carrito']['productos'][$id] += 1;
    } else {
        // o caso contrario es el primer elemento o el primer producto que el 
        // cliente este seleccionando solo asignalo un valor
        // 1 = 1
        $_SESSION['carrito']['productos'][$id] = 1;
    }
// para que nos valla contabilizando todo los id que obtengamos
    $datos['numero'] = count($_SESSION['carrito']['productos']);
    
    $datos['ok'] = true;
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);







