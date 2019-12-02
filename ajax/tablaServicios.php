<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaServicios {
	
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

class ServisiosAjax {
	public function MostrarServicios() {
		$servicios = new ListaServicios();
		$listaservicio = $servicios->MostrarServicios();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaservicio->fetch_object()) {		
				
			 
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			$url = URL_BASE;
  			

  			$botones =  "<div class='btn-group'><a href='editar&id=".$row->id."'><button class='btn btn-warning '><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarServicios' idservicio='".$row->id."'><i class='fa fa-times'></i></button></a></div>"; 
  			

  			$redir = "href='ver&id=".$row->id."'";
			
			$img = "<img src='".URL_BASE."imagen/cortes/".$row->img."' class='img-thumbnail' width='40px'>";
  		
			$componente = "<a href='agregarcomponente&id=".$row->id."'><button class='btn btn-primary btn-xs'>Agregar</button><a/>";
		 
		  	$datosJson .='[
			      "'.($i++).'",			      
			      "<a '.$redir.'>'.$row->nombre.'</a>",
			      "'.$row->valor.'",
			      "'.$img.'",
				  "'.$componente.'",					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$servicio = new ServisiosAjax();
$servicio -> MostrarServicios();
