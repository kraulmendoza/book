
$(document).ready(function(){
    

  
    //ver los detalles
    $(".btnVerDetalles").click(function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        var codigoVenta= row.data('id');
        
        var form = $("#form-ver-detalles");
        var url = form.attr('action').replace(':codigoVenta', codigoVenta);
        $.ajaxSetup({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
        }); 

        $.post(url,form.serialize(),function(detalles){    
            $("#modalDetalles").modal();
            var infodetalles = "<label><i>Total de detalles : "+detalles.length+"</i></label><br><br>"
            for (var i = 0; i < detalles.length; i++) {
                infodetalles +=" <label><b>ISBN : "+detalles[i].idLibro+" </b></label><br><label><b>Libro : "+detalles[i].titulo+" </b></label><br><label><b>Precio de venta del libro : "+detalles[i].precioVenta+" </b></label><br><label><b>Cantidad vendida : "+detalles[i].cantidadvendida+" </b></label><br><label><b>Total de detalle : "+detalles[i].totaldetalle+" </b></label><br><label><b>Cantidad Actual : "+detalles[i].cantidadactual+" </b></label><br><hr><br></br>";     
            }
            $("#infodetalles").html(infodetalles)
            
        }).fail(function(result){
            $('#alert').show();
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
  

    