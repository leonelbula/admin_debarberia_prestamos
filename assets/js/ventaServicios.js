// $.ajax({
//
// 	url: "../ajax/serviciosSucuarsal.php",
// 	success:function(respuesta){
//				console.log("respuesta", respuesta);
//	}
//
// })
 
 $('.tablaCobroServicio').DataTable( {
    "ajax": "../ajax/serviciosSucuarsal.php",
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

	 
$(".tablaCobroServicio tbody").on("click", "button.agregarServicio", function(){
	
			
	var idServicio = $(this).attr("idServicio");
	
	$(this).removeClass("btn-primary agregarServicio");

	$(this).addClass("btn-default");
	
	var datos = new FormData();
    datos.append("idServicio", idServicio);
	
	$.ajax({

		url: "../ajax/ajaxServicios.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			
			
			//console.log("Respuesta", precio);
			var id = respuesta["id"];		
			var codigo = respuesta["id"];
			var nombre = respuesta["nombre"];      	
			var costo = respuesta["valor"];
			
			
			$(".nuevoServicio").append(
					'<tr>'+
							'<td class="valorivap">'+codigo+'<input  class="valoriva" type="hidden" name="valoriva"  /></td>'+
							'<td class="costop">'+nombre+'<input  class="costo" type="hidden" name="costo"  value="'+costo+'"/></td>'+							
							'<td class="ingresoCantidad"><input type="number" class="CantidadProd" name="CantidadProd"  value="1" /></td>'+							
							'<td class="precio"><input type="number" class="costoProducto" name="costoProducto" value="'+costo+'"/></td>'+							
							'<td class="descuentop"><input type="number" class="descuento" id="descuentoProduC" name="descuento" value="0"/></td>'+
							'<td class="nuevototalp"><input type="text" class="nuevototalC"  name="nuevototalC"  value="'+costo+'" readonly></td>'+
							'<td><button class="btn btn-danger quitarServicio" idServicio="'+id+'"><i class="fa fa-times"></i></button></td>'+
							'<input  class="nombreProduc" type="hidden" name="nombreProduc" value="'+nombre+'"/>'+
							'<input  class="idProductoVenta" type="hidden" name="idProductoVenta" value="'+id+'"/>'+	
							'<input  class="codigo" type="hidden" name="codigo" value="'+codigo+'"/>'+
					'</tr>'
					)
			sumarTotalServicio()			
			
			
			listarVentasServicio()
			
			$(".nuevototalC").number(true);
			
			
			
			
		}

	})
	
});

function QuitarAgregarProducto(){
	var idServicio = $(".quitarServicio");
	var botonesTabla = $(".tablaCobroServicio tbody button.agregarServicio");
	
	for(var i = 0; i < idServicio.length; i++){
		
		var boton = $(idServicio[i]).attr("idServicio");
		
		for(var j = 0; j < botonesTabla.length; j ++){
			
			if($(botonesTabla[j]).attr("idServicio") == boton){
				$(botonesTabla[j]).removeClass('btn-primary agregarServicio');
				$(botonesTabla[j]).addClass('btn-default');
			}
		}
	}
}


/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaCobroServicio").on("draw.dt", function(){
 //console.log("tabla");
	if(localStorage.getItem("quitarServicio") != null){

		var listaIdServicio = JSON.parse(localStorage.getItem("quitarServicio"));

		for(var i = 0; i < listaIdServicio.length; i++){

			$("button.recuperarBoton[idServicio='"+listaIdServicio[i]["idServicio"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idServicio='"+listaIdServicio[i]["idServicio"]+"']").addClass('btn-primary agregarServicio');

		}


	}

	QuitarAgregarProducto()
})


/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarProducto");

$(".formularioServicio").on("click", "button.quitarServicio", function(){

	//console.log("boton");
	$(this).parent().parent().remove();
	
	var idServicio = $(this).attr("idServicio");
	
	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarServicio") == null){

		idQuitarServicio = [];
	
	}else{

		idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

	}
	idQuitarServicio.push({"idServicio":idServicio});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarServicio));
	
	$("button.recuperarBoton[idServicio='"+idServicio+"']").removeClass('btn-default');

	$("button.recuperarBoton[idServicio='"+idServicio+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

	
		$("#nuevoTotalCompra").val(0);
	
		$("#totalCompra").val(0);
		//$("#nuevoTotalCompra").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalServicio()
		
		
    	// AGREGAR IMPUESTO
	   
       // agregarImpuestoCompra()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarVentasServicio()

	}


})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioServicio").on("change", "input.CantidadProd", function(){
	
	//var elemt= $(this).parent().parent().children().children(".costoProducto");
	var precio = $(this).parent().parent().children().children(".costoProducto");
	var subtotalP = $(this).parent().parent().children().children(".nuevototalC");
	var descuentoP = $(this).parent().parent().children().children(".descuento");	
	var TotalIvaP = $(this).parent().parent().children().children(".valoriva");
	
	
	var cantidad = $(this).val();
	var costoProducto = precio.val();
	var descuento = descuentoP.val();
	
	
	//console.log("totalIva",valorIvapor)	
		
	//console.log("porcentaje",prue);
	
	
	if(Number($(this).val()) < 0 ){
		
		$(this).val(1);
		
		var cantidad = $(this).val();
		var costoProducto = precio.val();
		
		var subtotal = parseInt(cantidad * costoProducto);	
		
				
		//console.log("valorIva",TotalIva);
				
		subtotalP.val(subtotal);
		//TotalIvaP.val(TotalIva);
		
		sumarTotalServicio()
		
		 // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarVentasServicio()
		
		swal({
	      title: "La cantidad no puede ser cero",
	      text: "¡minumo una unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });
		

	}
	
	if(descuento != 0){
		
		var subtotal = parseInt(cantidad * (costoProducto -(costoProducto * descuento/100)));
		
		//console.log("valorIva",TotalIva);
	}else{
	
		var subtotal = parseInt(cantidad * costoProducto);
						
		//console.log("valorIva",TotalIva);
	}
	
	
	//$(this).attr("descuentoProduC", valorDescuento);
	subtotalP.val(subtotal);
	
	
	
		sumarTotalServicio()		
		
	 // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarVentasServicio()
	
})
/*=============================================
MODIFICAR EL PRECIO
=============================================*/

$(".formularioServicio").on("change", "input.costoProducto", function(){
	
	
	var cantidad = $(this).parent().parent().children().children(".CantidadProd");
	var subtotalP = $(this).parent().parent().children().children(".nuevototalC");
	var descuento = $(this).parent().parent().children().children(".descuento");	
	var costo = $(this).parent().parent().children().children(".costo");
	
	
	var descuento = descuento.val();
	var cantidad = cantidad.val();	
	var costoProducto = $(this).val();
	var valorCosto = costo.val();
	//var TotalivaP = TotalIva.val();
	
	//console.log("totalIva",TotalivaP)
	
	//console.log("costo",valorCosto);
		
	
	if(Number($(this).val()) < 0 ){
		
		//$(this).val(valorCosto);
		
		var costoProducto = $(this).val(valorCosto);		
				
		var subtotal = parseInt(cantidad * valorCosto);	
			
				
				
		subtotalP.val(subtotal);
		
		sumarTotalServicio()
		
			
		 // AGRUPAR PRODUCTOS EN FORMATO JSON

       listarVentasServicio()
		
		swal({
	      title: "El precio esta por debajo del costo",
	      text: "¡El Precios costo es "+valorCosto+" del Articulo",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });
		

	}
	
	
	
	if(descuento != 0){				
		
		var subtotal = parseInt(cantidad * (costoProducto -(costoProducto * descuento/100)));
			
		
	}else{		
		var subtotal = parseInt(cantidad * costoProducto);
				
	}
	//var subtotal = cantidad * costoProducto;
	
	
	subtotalP.val(subtotal);
	
	//console.log("cantidad",cantidad);
	//console.log("precio",costoProducto);
	//console.log("descuento",valorDescuento);
	sumarTotalServicio()
	
	// AGRUPAR PRODUCTOS EN FORMATO JSON

    listarVentasServicio()
	
})
/*=============================================
MODIFICAR EL DESCUENTO
=============================================*/

$(".formularioServicio").on("change", "input.descuento", function(){
	
	
	var cantidad = $(this).parent().parent().children().children(".CantidadProd");
	var precio = $(this).parent().parent().children().children(".costoProducto");
	var subtotalP = $(this).parent().parent().children().children(".nuevototalC");
		
	var cantidad = cantidad.val();	
	var descuento= $(this).val();
	var precioP = precio.val();
	 
	
	//console.log("totalIva",TotalivaP)
	
	
	var descuentoG = Number((precioP * descuento/100));
	var subtotal = parseInt(Number(cantidad  * (precioP - descuentoG)));
	
		
	subtotalP.val(subtotal);
	
	//TotalIvaP.val(TotalIva);
	//console.log("boton",precioP);
	//console.log("descuento",valorDescuento);
	
		sumarTotalServicio()
	
	 // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarVentasServicio()
})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/
function sumarTotalServicio(){
	
	var precioItem = $(".nuevototalC");
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
		$("#nuevoTotalServicio").val(sumaTotalPrecio);
		$("#totalServicio").val(sumaTotalPrecio);
	
		
	//console.log("IdCliente",cliente)
}



function listarVentasServicio(){
	var listaServicio = [];
	var id = $(".idProductoVenta");	
	var codigo = $(".codigo");	
	var descuento = $(".descuento");	
	var descripcion = $(".nombreProduc");
	var cantidad = $(".CantidadProd");
	var precio = $(".costoProducto");	
	var subTotal = $(".nuevototalC");
	
	for(var i = 0; i < descripcion.length; i++){

		listaServicio.push({ "id" : $(id[i]).val(), 
							  "codigo" : $(codigo[i]).val(),
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),							 
							  "precio" : $(precio[i]).val(),
							  "descuento" : $(descuento[i]).val(),							 
							  "subtotal" : $(subTotal[i]).val()})

	}
	//console.log("ListaProducto", JSON.stringify(listaProductos));
	
	$("#listaServicio").val(JSON.stringify(listaServicio)); 

}
