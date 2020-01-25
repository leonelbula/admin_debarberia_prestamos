<?php

require_once '../config/DataBase.php';

class Contenido {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function listarContenido() {
		$sql = "SELECT * FROM contenido";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class contenidoAjax {
	
	public function MostrarContenido() {
		$contenido = new Contenido();
		$listacontenido = $contenido->listarContenido();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listacontenido->fetch_object()) {			
	

  	    	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarContenido' data-toggle='modal' data-target='#modalEditarRegistroContenido' idContenido ='$row->id'><i class='fa fa-edit'></i> Editar</button></div>";
  	
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",
				  "'.$row->titulo.'",					  
			      "'.$row->titulo2.'",			     
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}

$contenido = new contenidoAjax();
$contenido->MostrarContenido();