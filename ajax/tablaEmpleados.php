<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class empleadosAjax {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarEmpleados() {
		$sql = "SELECT e.* ,s.nombre AS nombresucursal FROM empleado e INNER JOIN sucursal s ON s.id = e.id_sucursal";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class AjaxEmpleados {
	public function MostrarEmpleados() {
		$empleado = new empleadosAjax();
		$listaEmpleados = $empleado->MostrarEmpleados();
				
		 $datosJson = '{
		  "data": [';
		 
		 while ($row = $listaEmpleados->fetch_object()) {		
		
		//$url = URL_BASE.'prestamos';

  		$botones = "<div class='btn-group'><a href='editarcliente&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarEmpleado' idempleado=$row->id><i class='fa fa-times'></i></button></a></div>";
  		
		  		 
		  	$datosJson .='[
			      "'.$row->id.'",			      
			      "'.$row->nombre.'",
			      "'.$row->nit.'",
				  "'.$row->direccion.'",
				  "'.$row->fecha_ingreso.'",				 
				  "'.$row->nombresucursal.'",					 		  
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$empleados = new AjaxEmpleados();
$empleados->MostrarEmpleados();

