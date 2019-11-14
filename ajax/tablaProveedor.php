<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class proveedorAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function Mostrarproveedor() {
		$sql = "SELECT * FROM proveedor ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class ProveedorCompraAjax {
	public function MostrarProveedor() {
		$proveedor = new proveedorAjax();
		$listaproveedor = $proveedor->Mostrarproveedor();
				
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproveedor->fetch_object()) {		
				
		$url = URL_BASE.'proveedor';
  		$botones = "<div class='btn-group'><a href='$url/editar&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarProveedor' idproveedor='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/ver&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->nombre.'",
			      "'.$row->nit.'",
			      "'.$row->direccion.'",
				  "'.$row->telefono.'",
				  "'.$row->ciudad.'",
				  "'.$row->departamento.'",				  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$proveedor = new ProveedorCompraAjax();
$proveedor->MostrarProveedor();

