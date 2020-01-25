<?php

require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class Contenido2 {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function listarContenido2() {
		$sql = "SELECT * FROM contenido_empleado";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class contenidoAjax2 {
	
	public function MostrarContenido2() {
		$contenido = new Contenido2();
		$listacontenido = $contenido->listarContenido2();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listacontenido->fetch_object()) {			
	

  	    	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarContenido2' data-toggle='modal' data-target='#modalEditarRegistroContenido2' idContenido ='$row->id'><i class='fa fa-edit'></i> Editar</button></div>";
			
			$img = "<img src='".URL_BASE."imagen/pagina/".$row->img."' class='img-thumbnail' width='40px'>";
  		
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",
				  "'.$row->nombre.'",					  
			      "'.$row->descripcion.'",
				  "'.$img.'",					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}

$contenido = new contenidoAjax2();
$contenido->MostrarContenido2();