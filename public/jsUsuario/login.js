function ocultarMensaje(){
    setTimeout(function(){ $("#alert").fadeOut() 
    } , 5000);
}

$(document).ready(function(){

    $("#btnEntrar").click(function(e){
        e.preventDefault();
        var usuario = $("#usuario").val();
        var password = $("#password").val();
//valido
        if (usuario =="") {
            $('#alert').show();
            $("#alert").addClass("alert-danger");
            $("#alert").html("Debe llenar el campo usuario")
            ocultarMensaje()
            return 0
        }else if (password=="") {
            $('#alert').show();
            $("#alert").addClass("alert-danger");
            $("#alert").html("Debe llenar el campo password")
            ocultarMensaje()
            return 0
        }

//obtengo valores para enviarlos
var form = $("#form-login");

$.ajaxSetup({
headers: {
 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
}
}); 


var url = form.attr('action');
$.post(url,form.serialize(),function(result){  
    if (result.id=='error') {
        $('#alert').show();
        $("#alert").addClass("alert-danger");
        $("#alert").html(result.mensaje)      
    }else{
        $('#alert').show();
            $("#alert").addClass("alert-success");
            $("#alert").html(result.mensaje) 
        setTimeout(function(){  
            if (result.rol=="2") {
               location.href = "Administrador"
            }else{
                location.href = "MiPerfil"
            }
    } , 1500);
    }
}).fail(function(result){
    $('#alert').show();
    $("#alert").addClass("alert-danger");
    $("#alert").html("Hubo un error al ingresar")
})
ocultarMensaje()
})
})
  

