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
				
			 
  			if($row->cantidad< $row->stock){

  				$stock = "<button class='btn btn-danger'>".$row->cantidad."</button>";
  			
  			}else{

  				$stock = "<button class='btn btn-success'>".$row->cantidad."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			//$url = URL_BASE.'productos';
  			

  			$botones =  "<div class='btn-group'><a href='editarinsumo&id=".$row->id."'><button class='btn btn-warning btnAgregararticulo'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarInsumo' idinsumo='".$row->id."'><i class='fa fa-times'></i></button></a></div>"; 
  			

  			$redir = "href='verinsumo&id=".$row->id."'";

  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->codigo.'",
			      "<a '.$redir.'>'.$row->nombre.'</a>",
			      "'.$row->costo.'",			      		 
			      "'.$stock.'",
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
