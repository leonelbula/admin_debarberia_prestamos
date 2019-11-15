// $.ajax({
//
// 	url: "../ajax/tablaProducto.php",
// 	success:function(respuesta){
//				console.log("respuesta", respuesta);
//	}
//
// })
 
 $('.tablaprouctos').DataTable( {
    "ajax": "../ajax/tablaProducto.php",
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
     
$(".formularioProducto").on("change", "input.costo", function(){ 
	var costo = Number($(".costo").val());
	var utilidad = Number($(".Utilidad").val());
	var valor;
	var precio_venta;
	
	valor = Number(costo * utilidad/100);
	precio_venta = (parseInt(valor) + parseInt(costo));
	
	//console.log("respuesta", precio_venta);
	
	$("#precio_venta").val(precio_venta);
	$(".precio_venta").number(true);
	
})
$(".formularioProducto").on("change", "input.Utilidad", function(){ 
	var costo = Number($(".costo").val());
	var utilidad = Number($(".Utilidad").val());
	var valor;
	var precio_venta;
	
	valor = Number(costo * utilidad/100);
	precio_venta = (parseInt(valor) + parseInt(costo));
	
	//console.log("respuesta", precio_venta);
	
	$("#precio_venta").val(precio_venta);
	$(".precio_venta").number(true);
	
})

/*=============================================
BORRAR PRODUCTO
=============================================*/
var rutaOculta = $("#rutaOculta").val();

$(".tablaprouctos").on("click", ".btnEliminarProducto", function(){

  var idProducto = $(this).attr("idproducto");

  swal({
        title: '¿Está seguro de borrar este producto?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar el producto !'
      }).then(function(result){
        if (result.value) {
          
            window.location = rutaOculta+"productos/eliminarproducto&id="+idProducto;
        }

  })

})

