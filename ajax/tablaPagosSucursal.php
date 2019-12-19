<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class pagosSucursalAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function Mostrarpagos($id_sucursal) {
		$sql = "SELECT c.* ,e.nombre FROM cierre_pago_estilista c, estilista e WHERE c.id_estilista = e.id AND c.id_sucursal = $id_sucursal GROUP BY e.id ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class PagosAjax {
	public function MostrarPago() {
		$pago = new pagosSucursalAjax();
		$id_sucursal = $_GET['idsucursal'];
		$listapago = $pago->Mostrarpagos($id_sucursal);
				
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listapago->fetch_object()) {		
				
		$url = URL_BASE.'proveedor';
  		$botones = "<div class='btn-group'><a href='$url/editar&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarProveedor' idproveedor='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/ver&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->nombre.'",			     
				  "'.$row->fecha.'",
				  "'.$row->valor.'",
				  "'.$row->valortotal.'"				  
			     
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$pago= new PagosAjax();
$pago->MostrarPago();

