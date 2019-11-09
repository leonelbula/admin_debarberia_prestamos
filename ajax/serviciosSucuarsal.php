<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaServiciosCobro {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarServicios() {
		$sql = "SELECT * FROM servicios";
		$resul = $this->db->query($sql);
		return $resul;
	}	
}

class serviciosAjax {
	public function MostrarServicios() {
		$servicio = new ListaServiciosCobro();
		$listaservicio = $servicio->MostrarServicios();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaservicio->fetch_object()) {		
			 
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
 			
  			$botones = "<button type='button' class='btn btn-primary agregarServicio recuperarBoton' idServicio='".$row->id."'>Agregar</button>"; 
  					 		
			$img = "<img src='".URL_BASE."imagen/cortes/".$row->img."' class='img-thumbnail' width='40px'>";
		 
		  	$datosJson .='[
			      "'.($i++).'",
				  "'.$img.'",
			      "'.$row->id.'",
			      "'.$row->nombre.'",      
			      "'.$row->valor.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$servicio = new serviciosAjax();
$servicio->MostrarServicios();
