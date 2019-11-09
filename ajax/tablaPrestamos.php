<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class PrestamosAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarclienteId($id) {
		$sql = "SELECT * FROM cliente_prestamo WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarPrestamosCliente() {
		$sql = "SELECT * FROM prestamos_cliente WHERE saldo > 0";
		$resp = $this->db->query($sql);
		return $resp;
	}
	
}

class ListaPrestamosAjax {
	public function MostrarPrestamo() {
		$prestamo = new PrestamosAjax();
		$listaPrestamo = $prestamo->MostrarPrestamosCliente();
		
		$i = 1;			
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listaPrestamo->fetch_object()) {		
			 
			 $listacliente = $prestamo->MostrarclienteId($row->id_cliente);
			 
			 while ($row1 = $listacliente->fetch_object()) {
				 $nombre = $row1->nombre;
			 }
		
		$url = URL_BASE.'prestamos';

  		$botones = "<div class='btn-group'><a href='$url/editarprestamo&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarPrestamos' idprestamos='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/verprestamo&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  		
		  		 
		  	$datosJson .='[
			      "'.$i++.'",
				  "'.$nombre.'",
				  "'.$row->fecha_entrega.'",
			      "'.$row->interes.'",
			      "'.$row->num_cuotas.'",
				  "'.$row->valor.'",
				  "'.$row->valortotal.'",				 
				  "'.$row->valorcuota.'",
				  "'.$row->fecha_vencimiento.'",	
				  "'.$row->saldo.'",					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$pretamo = new ListaPrestamosAjax();
$pretamo->MostrarPrestamo();

