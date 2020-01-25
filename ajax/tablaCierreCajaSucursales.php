<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class CierreCajaSucursal {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	
	
	public function MostrarCierreSucursal() {
		$sql = "SELECT i.* , s.nombre FROM iniciar_punto_venta i,sucursal s WHERE i.id_sucursal = s.id ORDER BY i.id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class CierreCajaSucursalAjax {
	public function MostrarCierreCajaSucursal() {
		$sucursal = new CierreCajaSucursal();
		
		$listacierre = $sucursal->MostrarCierreSucursal();
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listacierre->fetch_object()) {		
					 
			
  			$botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirDocumento' numDocumento='".$row->id."'><i class='fa fa-print'></i></button></div>"; 
  			 		 
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->nombre.'",
			      "'.$row->fecha_inicio.'",
			      "'.$row->fecha_cierre.'",
			      "'.$row->totalgastos.'",	
				  "'.$row->totalingresos.'",
				  "'.$row->montoentregado.'",
				  "'.$row->diferencia.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$sucursal = new CierreCajaSucursalAjax();
$sucursal->MostrarCierreCajaSucursal();
