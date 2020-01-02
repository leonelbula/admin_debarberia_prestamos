<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class vendedoresAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarVendedores() {
		$sql = "SELECT * FROM vendedores ORDER BY nombre ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VendedoresVentaAjax {
	public function MostrarVendedores() {
		$vendedor = new vendedoresAjax();
		$listavendedor = $vendedor->MostrarVendedores();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listavendedor->fetch_object()) {		
		
		$url = URL_BASE.'ventasproducto';

  		$botones = "<div class='btn-group'><a href='$url/editarvendedor&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarVendedor' idvendedor=$row->id><i class='fa fa-times'></i></button></a></div>";
  		
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",			      
			      "'.$row->nombre.'",
			      "'.$row->nit.'",
				  "'.$row->direccion.'",
				  "'.$row->ciudad.'",				 
				  "'.$row->telefono.'",					 		  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$venddores = new VendedoresVentaAjax();
$venddores->MostrarVendedores();

