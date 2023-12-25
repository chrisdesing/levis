function validarRol(){
    const nombre_rol = document.getElementById('rol_nombre').value;
    console.log(nombre_rol)
    const descripcion = document.getElementById('descripcion_rol').value
    // solonumero y letras
    const expRegular = /^[a-zA-Z0-9\s]*$/;
    if (nombre_rol.trim() === '' || !nombre_rol.match(expRegular)) {
        $('#rol_nombre').focus();
        $('#lbl_rol').css('display', 'block')
        return false;
    }else if(descripcion.trim() === '' || !descripcion.match(expRegular)){
        $('#descripcion_rol').focus();
        $('#lbl_descripcion').css('display', 'block')
        return false;
    }
    return true
}


function validarRolEdit(){
    const nombre_rol = document.getElementById('nombre_rol').value;
    console.log(nombre_rol)
    const descripcion = document.getElementById('rol_descripcion').value
    // solonumero y letras
    const expRegular = /^[a-zA-Z0-9\s]*$/;
    if (nombre_rol.trim() === '' || !nombre_rol.match(expRegular)) {
        $('#nombre_rol').focus();
        $('#lbl_roll').css('display', 'block')
        return false;
    }else if(descripcion.trim() === '' || !descripcion.match(expRegular)){
        $('#rol_descripcion').focus();
        $('#lbl_descripcionn').css('display', 'block')
        return false;
    }
    return true
    

}




