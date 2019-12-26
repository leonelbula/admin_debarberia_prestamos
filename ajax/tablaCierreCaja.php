<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class CierreCajaSucursal {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	
	
	public function MostrarCierreSucursal($id_sucursal) {
		$sql = "SELECT * FROM iniciar_punto_venta WHERE id_sucursal = $id_sucursal ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class CierreCajaSucursalAjax {
	public function MostrarCierreCajaSucursal() {
		$sucursal = new CierreCajaSucursal();
		$id_sucursal = $_GET['idsucursal'];
		$listacierre = $sucursal->MostrarCierreSucursal($id_sucursal);
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listacierre->fetch_object()) {		
					 
			
  			$botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirDocumento' numDocumento='".$row->id."'><i class='fa fa-print'></i></button></div>"; 
  			 		 
		 
		  	$datosJson .='[
			      "'.($i++).'",
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
