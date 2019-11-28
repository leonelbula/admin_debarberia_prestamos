<?php
require_once '../config/DataBase.php';

class ListaTraslado{
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarTraslado() {
		$sql = "SELECT t.* ,s.nombre AS nombresucursal FROM traslado_mercancia t INNER JOIN sucursal s ON s.id = t.id_sucursal ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}
class ajaxTablaTraslado{
	public function MostrarTraslado() {
			
		
		 $datosJson = '{
		  "data":[';
		 $i = 1;
		 $traslado = new ListaTraslado();
		 $listaTraslado = $traslado->MostrarTraslado();
		 while ($row = $listaTraslado->fetch_object()) {		
				
			 
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
  			

  			$botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirTraslado' numtraslado='".$row->num_registro."'><i class='fa fa-print'></i></button><a href='editartraslado&id=".$row->id."'><button class='btn btn-warning  btnEditarTraslado'><i class='fa fa-pencil'></i></button></a><button class='btn btn-danger btnEliminarTraslado' idtraslado='".$row->id."'><i class='fa fa-times'></i></button></div>"; 
  			

  			//$redir = "href='ver&id=".$row->id."'";

  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
				  "'.$row->fecha.'",
			      "'.$row->num_registro.'",
			      "'.$row->nombresucursal.'",
				  "'.$row->total.'",				 
				  "'.$botones.'"			     
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}

$traslado = new ajaxTablaTraslado();
$traslado->MostrarTraslado();