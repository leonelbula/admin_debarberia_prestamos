$(".formularioPagoServicio").on("change", "input#totalCouta", function(){

	var totalCouta = $(this).val();
	var valor = document.getElementById("totalgenerado").value;
	var valorAvance = document.getElementById("totalavances").value;
	var saldo =  Number(valor) - (Number(totalCouta) + Number(valorAvance));

	var nuevoValor = $(this).children().children('#totalEntregar');
	
	$("#totalEntregar").val(saldo);
	
	nuevoValor.val(saldo);
	
	console.log("valor ",valor);
	console.log("efectivo",totalCouta);
	console.log("avance",valorAvance)
	console.log("efectivo",saldo)

})