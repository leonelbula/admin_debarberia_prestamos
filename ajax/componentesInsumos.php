<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaInsumos {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarInsumos() {
		$sql = "SELECT * FROM insumos";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class InsumosAjax {
	public function MostrarInsumos() {
		$insumos = new ListaInsumos();
		$listaInsumos = $insumos->MostrarInsumos();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaInsumos->fetch_object()) {		
				
			  
  			$botones = "<button type='button' class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$row->id."'>Agregar</button>"; 
  			
  		
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->codigo.'",
			      "'.$row->nombre.'",	
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$insumos = new InsumosAjax();
$insumos->MostrarInsumos();
