<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class ventaServicioSucursal {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	public function MostrarEmpleadoId($id) {
		$sql = "SELECT * FROM estilista WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function MostrarVentaServicioSucursal($id_sucursal) {
		$sql = "SELECT * FROM venta_servicio WHERE id_sucursal = $id_sucursal ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VentaServicioSucursalAjax {
	public function MostrarVentaServicioSucursal() {
		$sucursal = new ventaServicioSucursal();
		$id_sucursal = $_GET['idsucursal'];
		$listasucarsales = $sucursal->MostrarVentaServicioSucursal($id_sucursal);
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listasucarsales->fetch_object()) {		
		
			 $detallesEstilista = $sucursal->MostrarEmpleadoId($row->id_estilista);
			 
			 foreach ($detallesEstilista as $key => $value) {
				 $nombre = $value['nombre'];
			 }
			 
			 $url = '../sucursal';
			$botones = "<div class='btn-group'><a href='$url/editarventaservicio&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarVentaServicios' idventaservicio='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/verventaservicio&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->fecha.'",
			      "'.$nombre.'",
			      "'.$row->valor.'",				 					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$sucursal = new VentaServicioSucursalAjax();
$sucursal->MostrarVentaServicioSucursal();

