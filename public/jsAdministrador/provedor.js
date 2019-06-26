var cedulaEditar
function ocultarMensaje(){
    setTimeout(function(){ $("#alert").fadeOut() 
    console.log("hola")} , 5000);
}
$(document).ready(function(){
    //ELIMINAR
    $(".btnEliminar").click(function(e){
        e.preventDefault();
        if (! confirm("¿Seguro de eliminar a este provedor?")) {
            return false;
        }
        var row = $(this).parents('tr');
        var codigoProvedor = row.data('id');
        var form = $("#form-eliminar");
        var url = form.attr('action').replace(':codigoProvedor', codigoProvedor);
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
            ocultarMensaje()
        }).fail(function(){
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al eliminar este registro")
            ocultarMensaje()
        })
    });

        //Seleccionar para editar
    $(".btnSeleccionar").click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var codigoProvedor = row.data('id');
        
        var form = $("#form-seleccionar");
        var url = form.attr('action').replace(':codigoProvedor', codigoProvedor);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){     
            $("#modalEditar").modal();
            $("#id").val(result.id);
            $("#nombre").val(result.nombre);
            buscarSelect(result.tipo);
            $("#telefono").val(result.telefono);
            $("#direccion").val(result.direccion); 
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
    var url = form.attr('action').replace(':codigoProvedor', cedulaEditar);

    $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
    }); 

    $.post(url,form.serialize(),function(result){     
        alert("Datos Actualizados")
        location.href = "Provedores"   
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

 function buscarSelect(valor)
{
	// creamos un variable que hace referencia al select
	var select=document.getElementById("tipo");

	// recorremos todos los valores del select
	for(var i=1;i<select.length;i++)
	{
		if(select.options[i].text==valor)
		{
			// seleccionamos el valor que coincide
			select.selectedIndex=i;
		}
	}
}
  

    