	
// $.ajax({
//
// 	url: "../ajax/tablaclienteventa.php",
// 	success:function(respuesta){
//			console.log("respuesta", respuesta);
//	}
//
//})
 
$('.tablaTraslado').DataTable( {
    "ajax": "../ajax/tablaTraslado.php",
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

$(".tablaTraslado").on("click", ".btnEliminarTraslado", function(){

  var idTraslado = $(this).attr("idtraslado");

  swal({
        title: '¿Está seguro de borrar registro?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Registro!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "eliminartraslado&id="+idTraslado;
        }

  })

})

$(".tablaTraslado").on("click", ".btnImprimirTraslado", function(){

	var numtraslado = $(this).attr("numtraslado");

	window.open("../extensiones/tcpdf/pdf/trasladomercancia.php?codigo="+numtraslado, " _blank");

})