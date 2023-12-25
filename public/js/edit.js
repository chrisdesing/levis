// actulizacion de usuarios
$('.editbtn').on('click', function(){
   $tr = $(this).closest('tr');
   let datos = $tr.children("td").map(function(){
      return $(this).text();

   });
   
   $('#update-id').val(datos[0]);
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
   $('#usser').val(datos[9]);
   // $('#password').val(datos[10]);
   $('#seleccion').val(datos[11]);


});

$('.deletebtn').on('click', function(){
   $tr = $(this).closest('tr');
   let datos = $tr.children("td").map(function(){
      return $(this).text();

   });
   $('#delete-id').val(datos[0]);
});


$('.delete-rol').on('click', function(){
   $tr = $(this).closest('tr')
   let date = $tr.children("td").map(function(){
      return $(this).text();
   });
   $('#eliminar-id').val(date[0]);
});


$('.update-rol').on('click',function(){
   $tr = $(this).closest('tr')
   let dat = $tr.children("td").map(function(){
      return $(this).text();
   });
   $('#rol_id').val(dat[0]);
   $('#nombre_rol').val(dat[1]);
   $('#rol_descripcion').val(dat[2]);
   $('#rol_estado').val(dat[3]);


});


$('.asignarbtn').on('click', function(){
   $tr = $(this).closest('tr');
   let data = $tr.children("td").map(function(){
      return $(this).text();

   });

   $('#asignar-id').val(data[0]);
   $('#usuario').val(data[1])
   $('#roles').val(data[2])

})
  