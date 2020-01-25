//
//$.ajax({
//
// 	url: "../ajax/tablaPaginaContenido2.php",
// 	success:function(respuesta){
//				console.log("respuesta", respuesta);
//	}
//
// })
var rutaOculta = $("#rutaOculta").val();

$('.tablaContenidoPagina').DataTable( {
    "ajax": "../ajax/tablaPaginaContenido.php",
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

$(".tablaContenidoPagina").on("click", ".btnEditarContenido", function(){

  var idContenido = $(this).attr("idContenido");

  var datos = new FormData();
	datos.append("idContenido", idContenido);

	$.ajax({

		url:"../ajax/datosContenidoAjax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
		console.log("respuesta", respuesta);
			$("#modalEditarRegistroContenido .id").val(respuesta["id"]);
			
			$("#modalEditarRegistroContenido .titulo").val(respuesta["titulo"]);
			$("#modalEditarRegistroContenido .titulo2").val(respuesta["titulo2"]);
			
			
				
						
		}
	})

})

$('.tablaContenidoPagina2').DataTable( {
    "ajax": "../ajax/tablaPaginaContenido2.php",
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

$(".tablaContenidoPagina2").on("click", ".btnEditarContenido2", function(){

  var idContenido = $(this).attr("idContenido");

  var datos = new FormData();
	datos.append("idContenido", idContenido);

	$.ajax({

		url:"../ajax/datosContenidoAjax2.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
		console.log("respuesta", respuesta);
			$("#modalEditarRegistroContenido2 .id").val(respuesta["id"]);
			
			$("#modalEditarRegistroContenido2 .nombre").val(respuesta["nombre"]);
			$("#modalEditarRegistroContenido2 .description").val(respuesta["descripcion"]);
			$("#modalEditarRegistroContenido2 .img").val(respuesta["img"]);
			
			$(".previsualizar").attr("src",  rutaOculta+"image/pagina/"+respuesta["img"]);
				
						
		}
	})

})

$('.tablaContenidoPagina3').DataTable( {
    "ajax": "../ajax/tablaPaginaContenido3.php",
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

$(".tablaContenidoPagina3").on("click", ".btnEditarContenido3", function(){

  var idContenido = $(this).attr("idContenido");

  var datos = new FormData();
	datos.append("idContenido", idContenido);

	$.ajax({

		url:"../ajax/datosContenidoAjax3.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
		console.log("respuesta", respuesta);
			$("#modalEditarRegistroContenido3 .id").val(respuesta["id"]);
			
			$("#modalEditarRegistroContenido3 .nombre").val(respuesta["nombre"]);
			$("#modalEditarRegistroContenido3 .horrario").val(respuesta["horrario"]);
			$("#modalEditarRegistroContenido3 .img").val(respuesta["img"]);
			
			$(".previsualizar").attr("src",  rutaOculta+"image/pagina/"+respuesta["img"]);
			
			
				
						
		}
	})

})

