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
/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaCobroServicio tbody").on("click", "button.agregarServicio", function(){

	var idServicio = $(this).attr("idServicio");

	$(this).removeClass("btn-primary agregarServicio");

	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idServicio", idServicio);

     $.ajax({

     	url:"../ajax/serviciosAjax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      	    var descripcion = respuesta["nombre"];          	
          	var precio = respuesta["valor"];

	       $(".nuevoServicio").append(

          	'<div class="row" style="padding:5px 15px">'+			 
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarServicio" idservicio="'+idServicio+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcion" idservicio="'+idServicio+'" name="agregarServicio" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+	         

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidad" name="nuevaCantidad" min="1" value="1"  required>'+

	          '</div>' +	          

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecio" precioReal="'+precio+'" name="nuevoPrecio" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 
	
	sumarTotalPrecios()
	
	listarServicio()
      	}
		

     })

});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".nuevoServicio").on("draw.dt", function(){

	if(localStorage.getItem("quitarServicio") != null){

		var listaIdServicio = JSON.parse(localStorage.getItem("quitarServicio"));

		for(var i = 0; i < listaIdServicio.length; i++){

			$("button.recuperarBoton[idservicio='"+listaIdServicio[i]["idservicio"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idservicio='"+listaIdServicio[i]["idservicio"]+"']").addClass('btn-primary agregarServicio');

		}


	}


})
/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioCobro").on("click", "button.quitarServicio", function(){

	$(this).parent().parent().parent().parent().remove();

	var idservicio = $(this).attr("idservicio");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarServicio") == null){

		idQuitarServicio = [];
	
	}else{

		idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

	}

	idQuitarServicio.push({"idservicio":idservicio});

	localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));

	$("button.recuperarBoton[idservicio='"+idservicio+"']").removeClass('btn-default');

	$("button.recuperarBoton[idservicio='"+idservicio+"']").addClass('btn-primary agregarServicio');
	
	sumarTotalPrecios()
	
	listarServicio()
	

})

$(".formularioCobro").on("change", "input.nuevaCantidad", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecio");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);
	
	sumarTotalPrecios()
	
	listarServicio()
	
	$(".nuevototal").number(true);
	
	
})

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecio");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotal").val(sumaTotalPrecio);
	$("#total").val(sumaTotalPrecio);
	$("#nuevoTotal").attr("total",sumaTotalPrecio);


}

function listarServicio(){

	var listaServicios = [];

	var descripcion = $(".nuevaDescripcion");

	var cantidad = $(".nuevaCantidad");

	var precio = $(".nuevoPrecio");

	for(var i = 0; i < descripcion.length; i++){

		listaServicios.push({ "id" : $(descripcion[i]).attr("idservicio"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),							
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}

	$("#listaServicio").val(JSON.stringify(listaServicios)); 

}


$("#nuevoTotal").number(true);