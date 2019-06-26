var cedulaEditar
$(document).ready(function(){
    //ELIMINAR
    $(".btnEliminar").click(function(e){
        e.preventDefault();
        if (! confirm("¿Seguro de eliminar a este usuario?")) {
            return false;
        }
        var row = $(this).parents('tr');
        var codigoUsuario = row.data('id');
        var form = $("#form-eliminar");
        var url = form.attr('action').replace(':codigoUsuario', codigoUsuario);
        $('#alert').show();
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){
            row.fadeOut();
            $("#alert").addClass("alert-success");
            $("#alert").html(result.mensaje)
        }).fail(function(){
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al eliminar este registro")
        })

    });

        //Seleccionar para editar
    $(".btnSeleccionar").click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var codigoUsuario = row.data('id');
        
        var form = $("#form-seleccionar");
        var url = form.attr('action').replace(':codigoUsuario', codigoUsuario);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){     
            $("#modalEditar").modal();
            $("#id").val(result.id);
            $("#nombre").val(result.nombre);
            $("#apellido").val(result.apellido);
            $("#correo").val(result.correo);
            $("#numeroTelefono").val(result.numeroTelefono);
            $("#direccion").val(result.direccion);
            $("#usuario").val(result.user);
            $("#password").val(result.password);  
            cedulaEditar =  result.id         
        }).fail(function(){
            $('#alert').show();
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al seleccionar este registro")
        })
 }); 

//Editar
 $("#btnEditar").click(function(e){
    e.preventDefault();
    
    var form = $("#form-editar");
    var url = form.attr('action').replace(':codigoUsuario', cedulaEditar);

    $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
    }); 

    $.post(url,form.serialize(),function(result){     
        alert("Datos Actualizados")
        location.href = "Clientes"   
    }).fail(function(){
        $("#alert").addClass("alert-danger");
        $("#alert").html("Hubo un error al seleccionar este registro")
    })
}); 
    
 });


 //FILTRO
 $(document).ready(function () {
    $('#filtro').keyup(function () {
       var rex = new RegExp($(this).val(), 'i');
         $('#bodytable tr').hide();
         $('#bodytable tr').filter(function () {
             return rex.test($(this).text());
         }).show();
 
         })
 });
  

    