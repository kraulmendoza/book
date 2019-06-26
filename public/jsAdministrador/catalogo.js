var idEditar
function ocultarMensaje(){
    setTimeout(function(){ $("#alert").fadeOut() 
    } , 5000);
}
$(document).ready(function(){
    

    //ELIMINAR
    $(".btnEliminar").click(function(e){
        e.preventDefault();
        if (! confirm("¿Seguro de eliminar a este usuario?")) {
            return false;
        }
        var row = $(this).parents('tr');
        var codigoCatalogo = row.data('id');
        var form = $("#form-eliminar");
        var url = form.attr('action').replace(':codigoCatalogo', codigoCatalogo);
        $('#alert').show();
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){
            if (result.id=='error') {
                $("#alert").addClass("alert-danger");
                $("#alert").html(result.mensaje)
               
            }else{
            row.fadeOut();
            $("#alert").addClass("alert-success");
            $("#alert").html(result.mensaje)
            }
        }).fail(function(result){
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al eliminar este registro")
        })
        ocultarMensaje()
    });

        //Seleccionar para editar
    $(".btnSeleccionar").click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var codigoCatalogo = row.data('id');
        
        var form = $("#form-seleccionar");
        var url = form.attr('action').replace(':codigoCatalogo', codigoCatalogo);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){     
            $("#modalEditar").modal();
            $("#id").val(result.id);
            $("#categoria").val(result.categoria);
            idEditar =  result.id         
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
    var url = form.attr('action').replace(':codigoCatalogo', idEditar);

    $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
    }); 

    $.post(url,form.serialize(),function(result){     
        alert("Datos Actualizados")
        location.href = "Catalogos"   
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
  

    