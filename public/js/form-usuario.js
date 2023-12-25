// validacion del registro de usuario
function validarFormulario() {
    const ci = document.getElementById('identidad').value;
    const nombre = document.getElementById('nombreo').value
    const apellidop = document.getElementById('apellidop').value
    const apellidom = document.getElementById('apellidom').value
    const celular = document.getElementById('telef').value
    const direccion = document.getElementById('direccion').value
    const user = document.getElementById('user').value
    const password = document.getElementById('pass').value;

    // solo mayusculas y minusculas
    const exMayusMinuSs = /^[A-Za-z]+$/;
    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas y espacios en blanco
    const exMayusMinuS = /^[a-zA-Z0-9\s]*$/;
    // expresion regular que solo acepta numero letras y gion medio y bajo
    const expContrasena = /^[a-zA-Z0-9_\-]+$/;

    if (ci.trim() === '' || !ci.match(expRegular)) {
        // alert('Campo cedula de identidad invalida')
        $('#identidad').focus();
        $('#lbl_cedula').css('display', 'block')
        return false;

    } else if (nombre.trim() === '' || !nombre.match(exMayusMinuS)) {
        // alert('Nombre invalido');
        $('#nombreo').focus();
        $('#lbl_nombre').css('display', 'block')
        return false;

    } else if (apellidop.trim() === '' || !apellidop.match(exMayusMinuSs)) {
        // alert('Apellido invalido');
        $('#apellidop').focus();
        $('#lbl_apellidop').css('display', 'block')
        return false;
    } else if (apellidom.trim() === '' || !apellidom.match(exMayusMinuSs)) {
        // alert('Apellido invalido');
        $('#apellidom').focus();
        $('#lbl_apellidom').css('display', 'block')
        return false;
    } else if (celular.trim() === '') {
        $('#telef').focus();
        $('#lbl_celular').css('display', 'block')
        return false;
    } else if (direccion.trim() === '') {
        $('#direccion').focus();
        $('#lbl_direccion').css('display', 'block')
        return false;
    }
    if (user.trim() === '' || !user.match(expContrasena)) {
        $('#user').focus();
        $('#lbl_nombre_user').css('display', 'block')
        return false;
    } else if (password.trim() === '' || !password.match(expContrasena)) {
        // alert('Formato de contraseña invalida');
        $('#pass').focus();
        $('#lbl_contrasena').css('display', 'block')
        return false;
    }

    return true;
}


// validacion del la edicion de usuario
function validarFormularioEdit() {
    const ci = document.getElementById('ci').value;
    const nombre = document.getElementById('name').value
    const apellidop = document.getElementById('apellp').value
    const apellidom = document.getElementById('apellm').value
    const celular = document.getElementById('celular').value
    const direccion = document.getElementById('address').value
    const user = document.getElementById('usser').value


 // solo mayusculas y minusculas
 const exMayusMinuSs = /^[A-Za-z]+$/;

    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas espacios en blanco
    const exMayusMinuS = /^[a-zA-Z0-9\s]*$/;
    // expresion regular que solo acepta numero letras y gion medio y bajo
    const expContrasena = /^[a-zA-Z0-9_\-]+$/;

    if (ci.trim() === '' || !ci.match(expRegular)) {
        // alert('Campo cedula de identidad invalida')
        $('#ci').focus();
        $('#lbl_ci').css('display', 'block')
        return false;

    } else if (nombre.trim() === '' || !nombre.match(exMayusMinuS)) {
        // alert('Nombre invalido');
        $('#name').focus();
        $('#lbl_name').css('display', 'block')
        return false;

    } else if (apellidop.trim() === '' || !apellidop.match(exMayusMinuSs)) {
        // alert('Apellido invalido');
        $('#apellp').focus();
        $('#lbl_apellp').css('display', 'block')
        return false;
    } else if (apellidom.trim() === '' || !apellidom.match(exMayusMinuSs)) {
        // alert('Apellido invalido');
        $('#apellm').focus();
        $('#lbl_apellm').css('display', 'block')
        return false;
    } else if (celular.trim() === '') {
        $('#celular').focus();
        $('#lbl_celu').css('display', 'block')
        return false;
    } else if (direccion.trim() === '') {
        $('#address').focus();
        $('#lbl_address').css('display', 'block')
        return false;
    }
    if (user.trim() === '' || !user.match(expContrasena)) {
        $('#usser').focus();
        $('#lbl_user').css('display', 'block')
        return false;
    }

    return true;
}


function validarCategoriaEdit() {
    const nombre_cate = document.getElementById('nombreCateg').value;

    const expRegular = /^[a-zA-Z0-9\s]*$/;
    if (nombre_cate.trim() === "" || !nombre_cate.match(expRegular)) {
        $('#nombreCateg').focus();
        $('#lbl_nombre_categoria').css('display', 'block')
        return false;
    }
    return true;
}

// entrada de productos
function validadProducto() {
    const codigo = document.getElementById('codigo').value
    const nombre_produc = document.getElementById('nombre_produc').value
    const precio_venta = document.getElementById('precio_venta').value
    // const precio_compra = document.getElementById('precio_compra').value
    const color = document.getElementById('color').value
    const existencia = document.getElementById('existencia').value
    const existencia_minima = document.getElementById('existencia_minima').value

    const imagen = document.getElementById('file').files[0];


    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas
    const exMayusMinuS = /^[A-Za-z]+$/;
    // expresion regular acepta numero letras y espacios en blancos
    const nLEspacio = /^[a-zA-Z0-9\s]+$/
    ;

    if (codigo.trim() === '' ) {
        // alert('Campo cedula de identidad invalida')
        $('#codigo').focus();
        $('#lbl_codigo').css('display', 'block')
        return false;

    } else if (nombre_produc.trim() === '' || !nombre_produc.match(nLEspacio)) {
        // alert('Nombre invalido');
        $('#nombre_produc').focus();
        $('#lbl_nombre_produc').css('display', 'block')
        return false;

    } else if (precio_venta.trim() === '') {
        $('#precio_venta').focus();
        $('#lbl_precio_venta').css('display', 'block')
        return false;
    // } else if (precio_compra.trim() === '' ) {
    //     // alert('Apellido invalido');
    //     $('#precio_compra').focus();
    //     $('#lbl_precio_compra').css('display', 'block')
    //     return false;
    }else if (existencia.trim() === '' ) {
        // alert('Apellido invalido');
        $('#existencia').focus();
        $('#lbl_existencia').css('display', 'block')
        return false;
    }else if (existencia_minima.trim() === '' ) {
        // alert('Apellido invalido');
        $('#existencia_minima').focus();
        $('#lbl_existencia_minima').css('display', 'block')
        return false;
    }else if (color.trim() === '' || !color.match(expRegular)) {
        // alert('Apellido invalido');
        $('#color').focus();
        $('#lbl_color').css('display', 'block')
        return false;
    }else if (!imagen) {
        alert('Seleccione una imagen.');
        return false;
    }
    return true;

}


function validarEditProduct(){
    const codigo = document.getElementById('codigo_producto').value
    const nombre_produc = document.getElementById('nombre_producto').value
    const precio_venta = document.getElementById('precio-venta').value
    const precio_compra = document.getElementById('precio-compra').value
    const color = document.getElementById('color_producto').value
    const existencia = document.getElementById('existencia_producto').value
    const existencia_minima = document.getElementById('estock_minimo').value

    


    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas
    const exMayusMinuS = /^[A-Za-z]+$/;
    // expresion regular acepta numero letras y espacios en blancos
    const nLEspacio = /^[a-zA-Z0-9\s]+$/
    ;

    if (codigo.trim() === '' ) {
        // alert('Campo cedula de identidad invalida')
        $('#codigo_producto').focus();
        $('#lbl_codigoo').css('display', 'block')
        return false;

    } else if (nombre_produc.trim() === '' || !nombre_produc.match(nLEspacio)) {
        // alert('Nombre invalido');
        $('#nombre_producto').focus();
        $('#lbl_nombre_producto').css('display', 'block')
        return false;

    } else if (precio_venta.trim() === '') {
        $('#precio-venta').focus();
        $('#lbl_precio-venta').css('display', 'block')
        return false;
    } else if (precio_compra.trim() === '' ) {
        // alert('Apellido invalido');
        $('#precio-compra').focus();
        $('#lbl_precio-compra').css('display', 'block')
        return false;
    }else if (existencia.trim() === '' ) {
        // alert('Apellido invalido');
        $('#existencia_producto').focus();
        $('#lbl_existencia_producto').css('display', 'block')
        return false;
    }else if (existencia_minima.trim() === '' ) {
        // alert('Apellido invalido');
        $('#estock_minimo').focus();
        $('#lbl_estock_minimo').css('display', 'block')
        return false;
    }else if (color.trim() === '' || !color.match(expRegular)) {
        // alert('Apellido invalido');
        $('#color_producto').focus();
        $('#lbl_color_producto').css('display', 'block')
        return false;
    }else if (!imagen) {
        alert('Seleccione una imagen.');
        return false;
    }
    return true;
}