
// $.ajax({
//
// 	url: "../ajax/tablaCompra.php",
// 	success:function(respuesta){
//			console.log("respuesta", respuesta);
//	}
//
//})
 
$('.tablasCompra').DataTable( {
    "ajax": "../ajax/tablaCompra.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

$(".tablasCompra").on("click", ".btnEliminarCompra", function(){

  var idCompra = $(this).attr("idcompra");

  swal({
        title: '¿Está seguro de borrar la compra?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Compra!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "eliminarCompra&id="+idCompra;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablasCompra").on("click", ".btnImprimirFacturaCompra", function(){

	var codigoCompra = $(this).attr("numCompra");

	window.open("../extensiones/tcpdf/pdf/facturacompra.php?codigo="+codigoCompra, " _blank");

})