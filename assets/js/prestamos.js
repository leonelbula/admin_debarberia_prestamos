$(".formularioPrestamo").on("change", "input.valorPrestamo", function(){ 
	
	var valorPrestamo = Number($(".valorPrestamo").val());
	var interes = Number($(".interes").val());
	var cuotas = Number($(".numCuotas").val());
	var meses;
	var valorApagar;
	var cuotaDiaria;
	
	var plazo = cuotas / 30;
	if(plazo == 1 || plazo < 1){
		meses = 1;
	}else{
		meses = plazo;
	}
	
	valorApagar = parseInt(((valorPrestamo * interes/100)*meses)+valorPrestamo);
	cuotaDiaria = parseInt(valorApagar / cuotas);
	
	$("#nuevoTotal").val(valorApagar);
	$("#cuotaDiaria").val(cuotaDiaria);
	$(".nuevoTotal").number(true);
	$(".cuotaDiaria").number(true);

})
$(".formularioPrestamo").on("change", "input.interes", function(){ 
	
	var valorPrestamo = Number($(".valorPrestamo").val());
	var interes = Number($(".interes").val());
	var cuotas = Number($(".numCuotas").val());
	var meses;
	var valorApagar;
	var cuotaDiaria;
	
	var plazo = cuotas / 30;
	if(plazo == 1 || plazo < 1){
		meses = 1;
	}else{
		meses = plazo;
	}
	
	valorApagar = parseInt(((valorPrestamo * interes/100)*meses)+valorPrestamo);
	cuotaDiaria = parseInt(valorApagar / cuotas);
	
	$("#nuevoTotal").val(valorApagar);
	$("#cuotaDiaria").val(cuotaDiaria);
	$(".nuevoTotal").number(true);
	$(".cuotaDiaria").number(true);
	

	
})
$(".formularioPrestamo").on("change", "input.numCuotas", function(){ 
	
	var valorPrestamo = Number($(".valorPrestamo").val());
	var interes = Number($(".interes").val());
	var cuotas = Number($(".numCuotas").val());
	var meses;
	var valorApagar;
	var cuotaDiaria;
	
	var plazo = cuotas / 30;
	if(plazo == 1 || plazo < 1){
		meses = 1;
	}else{
		meses = plazo;
	}
	
	valorApagar = parseInt(((valorPrestamo * interes/100)*meses)+valorPrestamo);
	cuotaDiaria = parseInt(valorApagar / cuotas);
	
	$("#nuevoTotal").val(valorApagar);
	$("#cuotaDiaria").val(cuotaDiaria);
	$(".nuevoTotal").number(true);
	$(".cuotaDiaria").number(true);

	
})


/*=============================================
BORRAR PRESTAMOS
=============================================*/
var rutaOculta = $("#rutaOculta").val();

$(".tablasPrestamos").on("click", ".btnEliminarPrestamos", function(){

  var idprestamo = $(this).attr("idprestamos");

  swal({
        title: '¿Está seguro de borrar el prestamo?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar el prestamo!'
      }).then(function(result){
        if (result.value) {
          
            window.location = rutaOculta+"prestamos/eliminarprestamos&id="+idprestamo;
        }

  })

})
/*=============================================
BORRAR ABONO
=============================================*/

$(".tablaestadocuentaprestamo").on("click", ".btnEliminarAbono", function(){

  var idAbono = $(this).attr("idabono");

  swal({
        title: '¿Está seguro de borrar el abono?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar el Abono!'
      }).then(function(result){
        if (result.value) {
          
            window.location = rutaOculta+"prestamos/eliminarabono&id="+idAbono;
        }

  })

})
/*=============================================
BORRAR CLIENTE
=============================================*/
$(".tablacliente").on("click", ".btnEliminarCliente", function(){

  var idCliente = $(this).attr("idcliente");

  swal({
        title: '¿Está seguro de borrar el Cliente?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = rutaOculta+"prestamos/eliminarcliente&id="+idCliente;
        }

  })

})