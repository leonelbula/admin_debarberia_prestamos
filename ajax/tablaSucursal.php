<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class InformacionSucursal {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarSucursal() {
		$sql = "SELECT * FROM sucursal ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class SucursalAjax {
	public function MostrarSucursal() {
		$sucursal = new InformacionSucursal();
		$listasucarsales = $sucursal->MostrarSucursal();
				
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listasucarsales->fetch_object()) {		
				
		$url = URL_BASE.'proveedor';
  		$botones = "<div class='btn-group'><a href='editar&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarSucursal' idsucursal='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='ver&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->nombre.'",
			      "'.$row->direccion.'",
			      "'.$row->ciudad.'",				 
				  "'.$row->departamento.'",				
				  "'.$row->fecha_inicio.'",					  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$sucursal = new SucursalAjax();
$sucursal->MostrarSucursal();

