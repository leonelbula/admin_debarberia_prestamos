	var idsucursal = $("#idsucursal").val();
//	//console.log("idsucursal", idsucursal);
// $.ajax({
//
// 	url: "../ajax/tablaVentaServiciosSucursal.php?idsucursal="+idsucursal,
// 	success:function(respuesta){
//			console.log("respuesta", respuesta);
//	}
//
//})
  
 
$('.tablasCierreSucursal').DataTable( {
    "ajax": "../ajax/tablaCierreCaja.php?idsucursal="+idsucursal,
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



/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablasCierreSucursal").on("click", ".btnImprimirDocumento", function(){

	var codigo = $(this).attr("numDocumento");

	window.open("../extensiones/tcpdf/pdf/cierre.php?codigo="+codigo, " _blank");

})