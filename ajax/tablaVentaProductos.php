<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class ventaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	public function MostrarSucursaloId($id) {
		$sql = "SELECT * FROM sucursal WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function MostrarVentaProducto() {
		$sql = "SELECT * FROM venta_producto ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VentaProductoAjax {
	public function MostrarVentaProducto() {
		$sucursal = new ventaProducto();
		
		$listasucarsales = $sucursal->MostrarVentaProducto();
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listasucarsales->fetch_object()) {		
		
			 $detallesEstilista = $sucursal->MostrarSucursaloId($row->id_sucursal);
			 
			 foreach ($detallesEstilista as $key => $value) {
				 $nombre = $value['nombre'];
			 }
			 
//			 $url = '../sucursal';
//			$botones = "<div class='btn-group'><a href='$url/editarventaservicio&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarVentaServicios' idventaservicio='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/verdetallesventaservicio&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
//  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->fecha.'",
			      "'.$nombre.'",
			      "'.$row->totalventa.'",				 					  
			      "'.$row->utilidad.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$venta = new VentaProductoAjax();
$venta->MostrarVentaProducto();

