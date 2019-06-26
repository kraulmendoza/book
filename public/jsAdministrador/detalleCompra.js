var totaldetallesaagregar=0
var listadedetalles = new Array();
function ocultarMensaje(){
    setTimeout(function(){ $("#alert").fadeOut() 
    } , 5000);

}
$(document).ready(function(){
    

    //AGREGAR LIBROS AL ABASTECIMIENTO
    $("#agregarlibro").click(function(e){
        e.preventDefault();
        if ($("#detalle").val()=="" || $("#cantidad").val()=="") {
            alert("Debe llenar antes todos los datos requeridos para almacenar este al abastecimiento actual")
        }else{
        var detalle = new Object();
        detalle.libro = $("#detalle").val();
        detalle.cantidad = $("#cantidad").val();
        listadedetalles.push(detalle)
        $("#cantidad").val("")
        $("#totalcarrito").html(listadedetalles.length)
        console.log(listadedetalles)
        }
    });

        //Seleccionar para editar
    $(".btnVerDetalles").click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var codigoCompra= row.data('id');
        
        var form = $("#form-ver-detalles");
        var url = form.attr('action').replace(':codigoCompra', codigoCompra);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(detalles){    
            $("#modalDetalles").modal();
            var infodetalles = "<label><i>Total de detalles : "+detalles.length+"</i></label><br><br>"
            for (var i = 0; i < detalles.length; i++) {
                infodetalles +=" <label><b>ISBN : "+detalles[i].idLibro+" </b></label><br><label><b>Libro : "+detalles[i].titulo+" </b></label><br><label><b>Precio de compra del libro : "+detalles[i].precioCompra+" </b></label><br><label><b>Cantidad abastecida : "+detalles[i].cantidadcomprada+" </b></label><br><label><b>Total de detalle : "+detalles[i].totaldetalle+" </b></label><br><label><b>Cantidad Actual : "+detalles[i].cantidadactual+" </b></label><br><hr><br></br>";     
            }
            $("#infodetalles").html(infodetalles)
            
              
        }).fail(function(result){
            $('#alert').show();
            $("#alert").addClass("alert-danger");
            $("#alert").html("Hubo un error al seleccionar este registro")
        })
 }); 

//Editar
 $("#btnGuardar").click(function(e){
    e.preventDefault();
    
    var form = $("#form-guardar");

    $.ajaxSetup({
    headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
    }); 
    var url1 = form.attr('action').replace('libro', listadedetalles[0].libro);
    var url =url1.replace('cantidad', listadedetalles[0].cantidad);
    var provedor = $("#codigo_Provedor").val()
$.ajax({
  type: "POST",
  url: url,
  dataType: "JSON",
  data:{
    listadedetalles :listadedetalles,
    provedor : provedor
  }
})
.done(function(result) {
console.log(result)  
    })
      .fail(function() {
        alert( "error" );
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
  

    