function actualizarCliente(){
    const ci = document.getElementById('ci').value;
    const nombre = document.getElementById('name').value
    const apellidop = document.getElementById('apellp').value
    const apellidom = document.getElementById('apellm').value
    
    
    const expRegular = /^[a-zA-Z0-9]*$/;
     // solo mayusculas y minusculas
     const exMayusMinuS = /^[a-zA-Z0-9\s]*$/;
    // expresion regular que solo acepta numero letras y gion medio y bajo
    const expContrasena = /^[a-zA-Z0-9_\-]+$/;

    if (ci.trim() === '' || !ci.match(expRegular)){
        // alert('Campo cedula de identidad invalida')
        $('#ci').focus();
        $('#lbl_ci').css('display', 'block')
        return false;
        
    }else if(nombre.trim() === '' || !nombre.match(exMayusMinuS)){
        // alert('Nombre invalido');
        $('#name').focus();
        $('#lbl_name').css('display', 'block')
        return false;

    }else if(apellidop.trim() === '' || !apellidop.match(exMayusMinuS)){
        // alert('Apellido invalido');
        $('#apellp').focus();
        $('#lbl_apellp').css('display', 'block')
        return false;
    }else if(apellidom.trim() === '' || !apellidom.match(exMayusMinuS)){
        // alert('Apellido invalido');
        $('#apellm').focus();
        $('#lbl_apellm').css('display', 'block')
        return false;
    }

    return true;
}




$('.update-cliente').on('click', function(){
    $tr = $(this).closest('tr');
    let datos = $tr.children("td").map(function(){
        return $(this).text();
    })
   $('#update_id').val(datos[0]);
   $('#ci').val(datos[1]);
   $('#name').val(datos[2]);
   $('#apellp').val(datos[3]);
   $('#apellm').val(datos[4]);
   $('#celular').val(datos[5]);
   $('#correo').val(datos[6]);
   $('#address').val(datos[7]);
   var genero = $tr.find('td:eq(8)').text();
   $('#sexo input[name="genero"]').prop('checked', false); 
   $('#sexo input[name="genero"][value="' + genero + '"]').prop('checked', true); 
   $('#seleccion').val(datos[9]);

});


$('.delete-cliente').on('click', function(){
    $tr = $(this).closest('tr');
    let datos = $tr.children("td").map(function(){
       return $(this).text();
 
    });
    $('#delete-id').val(datos[0]);
 });



 $('.delete_categoria').on('click', function(){
    $tr = $(this).closest('tr')
    let datos = $tr.children("td").map(function(){
        return $(this).text();
    })
    $('#categoria-id').val(datos[0]);
 })

 $('.edit_categoria').on('click', function(){
    $tr = $(this).closest('tr')
    let dato = $tr.children("td").map(function(){
        return $(this).text();
    })

    $('#id-categori').val(dato[0])
    $('#nombreCateg').val(dato[1])
    // $('#categoria_estado').val(dato[2])
 })



 $('.editar_producto').on('click', function(){
    $tr = $(this).closest('tr')
    let dat = $tr.children("td").map(function(){
        return $(this).text();
    })
    $('#id_product').val(dat[0])
    $('#codigo_producto').val(dat[1])
    $('#nombre_producto').val(dat[2])
    // $('#descipcion').val(dat[3])
    $('#precio-venta').val(dat[4])
    $('#precio-compra').val(dat[5])
    $('#talla_producto').val(dat[6])
    $('#color_producto').val(dat[7])
    $('#existencia_producto').val(dat[8])
    $('#estock_minimo').val(dat[9])
    $('#categori_id').val(dat[10])
 })



 $('.delete_producto').on('click', function(){
    $tr = $(this).closest('tr')
    let datos = $tr.children("td").map(function(){
        return $(this).text();
    })
    $('#eliminar_id').val(datos[0]);
 })




 $('#btn_create_categoria').click(function(){
    // alert("guardar")
    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9\s]*$/;
    let nombre_categoriaas = $('#nombre_categoriaa').val()
    // let estado = $('#estado_rol').val()
    if(nombre_categoriaas.trim() === "" || !nombre_categoriaas.match(expRegular)){
        $('#nombre_categoriaa').focus();
        $('#lbl_create').css('display','block')
    }else{
        let url = "../../precentacion/categoria.php";
        $.post(url,{nombre_categoriaas}, function(datos){
            $('#respuesta').html(datos) 
        });
    }
        
})



$('#btn_create_cliente').click(function() {

   
    let ci_cliente = $('#ci_clientee').val();
    let nombre_cliente = $('#nombre_cliente').val();
    let apellidop_cliente = $('#apellidop_cliente').val();
    let apellidom_cliente = $('#apellidom_cliente').val();
    let telefono_cliente = $('#telefono_cliente').val();
    let direccion_cliente = $('#direccion_cliente').val();
    let email_cliente = $('#email_cliente').val();
    let generoSeleccionado = $('input[name="genero"]:checked').val();
 
    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas y espacio en blancos
    const exMayusMinuS = /^[a-zA-Z0-9\s]*$/;



    if(ci_cliente.trim() === '' || !ci_cliente.match(expRegular)){
        $('#ci_cliente').focus();
        $('#lbl_cedula').css('display', 'block')
    }else if(nombre_cliente.trim() === "" || !nombre_cliente.match(exMayusMinuS)){
        $('#nombre_cliente').focus()
        $('#lbl_nombre').css('display', 'block')
    }else if(apellidop_cliente.trim() === "" || !apellidop_cliente.match(exMayusMinuS)){
        $('#apellidop_cliente').focus()
        $('#lbl_apellidop').css('display', 'block')
    }else if(apellidom_cliente === "" || !apellidom_cliente.match(exMayusMinuS)){
        $('#apellidom_cliente').focus()
        $('#lbl_apellidom').css('display', 'block')
    }else{
            let url = "../../precentacion/cliente.php";
        $.post(url, {ci_cliente, nombre_cliente, apellidop_cliente, apellidom_cliente, telefono_cliente, direccion_cliente, email_cliente, genero: generoSeleccionado }, function (datos) {
            $('#respuesta').html(datos);
        });
    }

})

// registrar proveedor y validacion antes de registrar
$('#btn_registrar').click(function(){
    let nombre = $('#nombre_proveedor').val();
    let telefono = $('#telefono').val();
    let direccion = $('#direccion').val();
    // let email = $('#email').val();
    let nombre_empresa = $('#nombre_empresa').val();
    let telefono_empresa = $('#telefono_empresa').val();
    // alert(nombre);
    // solo numero y letras
    const expRegular = /^[a-zA-Z0-9]*$/;
    // solo mayusculas y minusculas y espacios en blanco
    const exMayusMinuS = /^[a-zA-Z0-9\s]*$/;
    // solo numeros letras y punto
    const number_let_punt = /^[A-Za-z0-9. ]+$/;

    if (nombre === "" || !nombre.match(exMayusMinuS)){
        $('#nombre_proveedor').focus()
        $('#lbl_nombre').css('display', 'block');
    }else if(telefono === ""){
        $('#telefono').focus()
        $('#lbl_telefono').css('display', 'block');
    }
    else if(direccion === "" || !direccion.match(number_let_punt)){
        $('#direccion').focus()
        $('#lbl_direccion').css('display', 'block');
    }else if(nombre_empresa === "" || !nombre_empresa.match(expRegular)){
        $('#nombre_empresa').focus()
        $('#lbl_empresa').css('display', 'block');
    }
    else{
        let url = "../../precentacion/proveedor.php";
        $.post(url,{ nombre,telefono,direccion,nombre_empresa,telefono_empresa },function(dato){
            $('#respuesta').html(dato)
        })
    }
})




