<?php

require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class Contenido3 {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function listarContenido3() {
		$sql = "SELECT * FROM contenido_sucursal";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class contenidoAjax3 {
	
	public function MostrarContenido3() {
		$contenido = new Contenido3();
		$listacontenido = $contenido->listarContenido3();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listacontenido->fetch_object()) {			
	

  	    	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarContenido3' data-toggle='modal' data-target='#modalEditarRegistroContenido3' idContenido ='$row->id'><i class='fa fa-edit'></i> Editar</button></div>";
			
			$img = "<img src='".URL_BASE."imagen/pagina/".$row->img."' class='img-thumbnail' width='40px'>";
  		
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",
				  "'.$row->nombre.'",					  
			      "'.$row->horrario.'",
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

$contenido = new contenidoAjax3();
$contenido->MostrarContenido3();