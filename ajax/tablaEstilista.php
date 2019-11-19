<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class EstilistaAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarEstilista() {
		$sql = "SELECT e.* ,s.nombre AS nombresucursal FROM estilista e INNER JOIN sucursal s ON s.id = e.id_sucursal";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class AjaxEstilista {
	public function MostrarEstilista() {
		$estilista = new EstilistaAjax();
		$listaEstilista = $estilista->MostrarEstilista();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listaEstilista->fetch_object()) {		
		
		//$url = URL_BASE.'prestamos';

  		$botones = "<div class='btn-group'><a href='editarcliente&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarBarbero' idbarbero=$row->id><i class='fa fa-times'></i></button></a></div>";
  		
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",			      
			      "'.$row->nombre.'",
			      "'.$row->nit.'",
				  "'.$row->direccion.'",
				  "'.$row->fecha_ingreso.'",				 
				  "'.$row->nombresucursal.'",					 		  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$estilista = new AjaxEstilista();
$estilista->MostrarEstilista();

