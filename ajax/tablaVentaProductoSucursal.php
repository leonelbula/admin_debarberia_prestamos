<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class ventaProductoSucursal {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	
	
	public function MostrarVentaProductoSucursal($id_sucursal) {
		$sql = "SELECT * FROM venta_producto WHERE id_sucursal = $id_sucursal ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VentaProductoSucursalAjax {
	public function MostrarVentaProductoSucursal() {
		$sucursal = new ventaProductoSucursal();
		$id_sucursal = $_GET['idsucursal'];
		$listasucarsales = $sucursal->MostrarVentaProductoSucursal($id_sucursal);
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listasucarsales->fetch_object()) {		
					 
			 
			 $url = '../sucursal';
			$botones = "<div class='btn-group'><a href='$url/editarventaproducto&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarVentaproducto' idventaproducto='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/verdetalesventaproducto&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->fecha.'",
			      "'.$row->num_factura.'",
			      "'.$row->totalventa.'",				 					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$sucursal = new VentaProductoSucursalAjax;
$sucursal->MostrarVentaProductoSucursal();

