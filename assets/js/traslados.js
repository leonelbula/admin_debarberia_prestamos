//$.ajax({
//
// 	url: "../ajax/productosCompra.php",
// 	success:function(respuesta){
//				console.log("respuesta", respuesta);
//	}
//
// })
 
 $('.tablaProductoTraslado').DataTable( {
    "ajax": "../ajax/productosCompra.php",
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

//console.log("estdo iva",precio);
	 
$(".tablaProductoTraslado tbody").on("click", "button.agregarProducto", function(){
	
	//var ivaAplicado = $("#tipoIva").val();	
	
	/*
	if(precioFactura == 1){
		console.log("valor",precioFactura);
	}else if(precioFactura == 2){
		console.log("valor",precioFactura);
	}else{
		console.log("valor",precioFactura);
	}*/
		
	var idProducto = $(this).attr("idProducto");
	
	$(this).removeClass("btn-primary agregarProducto");

	$(this).addClass("btn-default");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);
	
	$.ajax({

		url: "../ajax/ajaxProductos.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			
			
			//console.log("Respuesta", precio);
			var id = respuesta["id"];		
			var codigo = respuesta["codigo"];
			var nombre = respuesta["nombre"];      	
			var costo = respuesta["costo"];
			var stock = respuesta["cantidad"];
			
			
			$(".nuevoProductoTraslado").append(
					'<tr>'+
							'<td class="valorivap">'+codigo+'<input  class="valoriva" type="hidden" name="valoriva"  /></td>'+
							'<td class="costop">'+nombre+'<input  class="costo" type="hidden" name="costo"  value="'+costo+'"/></td>'+							
							'<td class="ingresoCantidad"><input type="number" class="CantidadProd" name="CantidadProd"  stock="'+stock+'"  value="1" /></td>'+							
							'<td class="precio"><input type="number" class="costoProducto" name="costoProducto" value="'+costo+'" readonly/></td>'+
							'<td class="nuevototalp"><input type="text" class="nuevototalT"  name="nuevototalT"  value="'+costo+'" readonly></td>'+
							'<td><button class="btn btn-danger quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></td>'+
							'<input  class="nombreProduc" type="hidden" name="nombreProduc" value="'+nombre+'"/>'+
							'<input  class="idProductoVenta" type="hidden" name="idProductoVenta" value="'+idProducto+'"/>'+	
							'<input  class="codigo" type="hidden" name="codigo" value="'+codigo+'"/>'+
					'</tr>'
					)
			sumarTotalPreciosTraslado()			
			
			
			listarProductosTraslado()
			
			$(".nuevototalT").number(true);
			
			
			
			
		}

	})
	
});

function QuitarAgregarProducto(){
	var idProductos = $(".quitarProducto");
	var botonesTabla = $(".tablaProductoTraslado tbody button.agregarProducto");
	
	for(var i = 0; i < idProductos.length; i++){
		
		var boton = $(idProductos[i]).attr("idProducto");
		
		for(var j = 0; j < botonesTabla.length; j ++){
			
			if($(botonesTabla[j]).attr("idProducto") == boton){
				$(botonesTabla[j]).removeClass('btn-primary agregarProducto');
				$(botonesTabla[j]).addClass('btn-default');
			}
		}
	}
}


/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaProductoTraslado").on("draw.dt", function(){
 //console.log("tabla");
	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}

	QuitarAgregarProducto()
})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioTraslado").on("click", "button.quitarProducto", function(){

	//console.log("boton");
	$(this).parent().parent().remove();
	
	var idProducto = $(this).attr("idProducto");
	
	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}
	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
	
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

	
		$("#nuevoTotalTraslado").val(0);
	
		$("#totalTraslado").val(0);
		//$("#nuevoTotalCompra").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosTraslado()
		
		
    	// AGREGAR IMPUESTO
	   
       // agregarImpuestoCompra()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosTraslado()

	}


})
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioTraslado").on("change", "input.CantidadProd", function(){
	
	//var elemt= $(this).parent().parent().children().children(".costoProducto");
	var precio = $(this).parent().parent().children().children(".costoProducto");
	var subtotalP = $(this).parent().parent().children().children(".nuevototalT");
	
		
	
	if(Number($(this).val()) > Number($(this).attr("stock"))){
		
		$(this).val(1);
		
		var cantidad = $(this).val();
		var costoProducto = precio.val();
		
		var subtotal = parseInt(cantidad * costoProducto);	
					
	     //console.log("Subtotal",costoProducto);
				
		subtotalP.val(subtotal);
		//TotalIvaP.val(TotalIva);
		
		//sumarTotalPreciosTraslado()
	
		 // AGRUPAR PRODUCTOS EN FORMATO JSON

       // listarProductos()
		
		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });
		

	}else{
		var cantidad = $(this).val();
		var costoProducto = precio.val();
		
		var subtotal = parseInt(cantidad * costoProducto);	
					
	     //console.log("Subtotal",costoProducto);
				
		subtotalP.val(subtotal);
	}
					
	//$(this).attr("descuentoProduC", valorDescuento);
		subtotalP.val(subtotal);
	
	
	
		sumarTotalPreciosTraslado()		
		
	 // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosTraslado()
	
})


/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/
function sumarTotalPreciosTraslado(){
	
	var precioItem = $(".nuevototalT");
	var arraySumaPrecio = [];  
	
	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
	}
	function sumaArrayPrecios(total, numero){

		return total + numero;

	}
	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	//console.log("sub total",sumaTotalPrecio)
	i
		$("#nuevoTotalTraslado").val(sumaTotalPrecio);
		$("#totalTraslado").val(sumaTotalPrecio);
			
	//console.log("IdCliente",cliente)
}



function listarProductosTraslado(){
	var listaProductos = [];
	var id = $(".idProductoVenta");	
	var codigo = $(".codigo");		
	var descripcion = $(".nombreProduc");
	var cantidad = $(".CantidadProd");
	var precio = $(".costoProducto");	
	var subTotal = $(".nuevototalC");
	
	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(id[i]).val(), 
							  "codigo" : $(codigo[i]).val(),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),							 
							  "precio" : $(precio[i]).val(),										 
							  "subtotal" : $(subTotal[i]).val()})

	}
	//console.log("ListaProducto", JSON.stringify(listaProductos));
	
	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}
