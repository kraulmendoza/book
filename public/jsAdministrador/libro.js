
var idEditar
function ocultarMensaje(){
    setTimeout(function(){ $("#alert").fadeOut() 
    } , 5000);
}
$(document).ready(function(){
    

     //GUARDAR
     $(".btnGuardar").click(function(e){
        e.preventDefault();
        var form = $("#form-guardar");
        var listadecatalogos = new Array();

        //creo el array de catalogos
        var i = 1;
        while(($("#catalogo"+i).val())!=null){
            var u = $("#catalogo"+i).val()
            if ($("#catalogo"+i).prop('checked')){  
                listadecatalogos.push(u);
            }
            i++
        }
        //---------------------------
        var url = form.attr('action').replace('catalogos', listadecatalogos);      
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){
        if(result.id=="ok"){
            location.reload()
        }else{
            alert(result.mensaje)
        }
           
        }).fail(function(result){
            console.log(result)
           alert(result.mensaje)
        })
        ocultarMensaje()
    });


    //ELIMINAR
    $(".btnEliminar").click(function(e){
        e.preventDefault();
        if (! confirm("¿Seguro de eliminar a este libro?")) {
            return false;
        }
        var row = $(this).parents('tr');
        var codigoLibro =  row.data('id');
        var form = $("#form-eliminar");
        var url = form.attr('action').replace(':codigoLibro', codigoLibro);
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
        var codigoLibro = row.data('id');
        
        var form = $("#form-seleccionar");
        var url = form.attr('action').replace(':codigoLibro', codigoLibro);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(result){   
            console.log(result)  
            $("#modalEditar").modal();
            var catalogos = "";
            for (var i= 0; i < result.catalogos.length; i++) {
                catalogos = catalogos + "<li>"+result.catalogos[i].categoria+"</li>"   
            }
            $("#catalogosactuales").html(catalogos)
            
            $("#id").val(result.libro.id);
            $("#titulo").val(result.libro.titulo);
            $("#autor").val(result.libro.autor);
            $("#precioCompra").val(result.libro.precioCompra);
            $("#precioVenta").val(result.libro.precioVenta);
            $("#fechaPublicacion").val(result.libro.fechaPublicacion);
            idEditar =  result.id     
        }).fail(function(result){
            console.log(result)
            /*
            $('#alert').show();
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al seleccionar este registro")
            */
        })
 }); 

//Editar
 $(".btnEditar").click(function(e){
    e.preventDefault(); 
    var form = $("#form-editar");
    var listadecatalogos = new Array();
    var url
    //miro si va a actualizar tambn los catalogos del libro
    if($("#cambiarcatalogos").prop('checked')){
    var i = 1;
     //creo el array de catalogos
    while(($("#catalogoEditar"+i).val())!=null){
        var u = $("#catalogoEditar"+i).val()
        if ($("#catalogoEditar"+i).prop('checked')){  
            listadecatalogos.push(u);
        }
        i++
    }
    url = form.attr('action').replace('catalogos', listadecatalogos);
    
    }else{
        //Aqui digo q lo q voy a mandar al controlador es 0 en los catalogos para alla validar 
        //si el quiere o no modificarlos
    url = form.attr('action').replace('catalogos', 0);
    }
    //---------------------------
    $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
    });
    $.post(url,form.serialize(),function(result){ 

        alert("Datos Actualizados")   
        location.href = "Libros"
    }).fail(function(){
        console.log(result)
        alert("Hubo un error al editar este registro") 
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
  

    