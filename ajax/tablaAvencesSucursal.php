<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class AvencesAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarEmpleadoId($id) {
		$sql = "SELECT * FROM estilista WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarAvencesEmpleado($idsucursal) {
		$sql = "SELECT e.id,e.nombre, SUM(a.valor) AS total ,a.fecha FROM avances a, estilista e WHERE a.id_estilista = e.id AND a.id_sucursal = $idsucursal AND a.estado = 1 GROUP BY e.id";
		$resp = $this->db->query($sql);
		return $resp;
	}
	
}

class ListaAvencesAjax {
	public function MostrarAvences() {
		$avences = new AvencesAjax();
		$idsucursal = $_GET['idsucursal'];
		$listaAvences = $avences->MostrarAvencesEmpleado($idsucursal);
		
		$i = 1;			
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listaAvences->fetch_object()) {		
			 
		
		$url = URL_BASE.'sucursal';

  		$botones = "<div class='btn-group'><a href='$url/veravance&id=$row->id'><button class='btn btn-info'>Ver inf. <i class='fa fa-eye'></i></button></a></div>";
  		
		  		 
		  	$datosJson .='[
			      "'.$i++.'",
				  "'.$row->nombre.'",
				  "'.$row->fecha.'",			    
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
$avances= new ListaAvencesAjax();
$avances->MostrarAvences();

