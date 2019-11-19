// $.ajax({
//
// 	url: "../ajax/tablaProducto.php",
// 	success:function(respuesta){
//				console.log("respuesta", respuesta);
//	}
//
// })
 
 $('.tablainsumos').DataTable( {
    "ajax": "../ajax/tablaInsumos.php",
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
BORRAR PRODUCTO
=============================================*/
var rutaOculta = $("#rutaOculta").val();

$(".tablainsumos").on("click", ".btnEliminarInsumo", function(){

  var idInsumo = $(this).attr("idinsumo");

  swal({
        title: '¿Está seguro de borrar este insumo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar el insumo !'
      }).then(function(result){
        if (result.value) {
          
            window.location = rutaOculta+"productos/eliminarinsumo&id="+idInsumo;
        }

  })

})
