<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductos() {
		$sql = "SELECT * FROM productoventa";
		$resul = $this->db->query($sql);
		return $resul;
	}	
}

class ProductosAjax {
	public function MostrarProductos() {
		$productos = new ListaProducto();
		$listaproducto = $productos->MostrarProductos();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproducto->fetch_object()) {		
				
			 

  			if($row->cantidad< $row->stock_minimo){

  				$stock = "<button class='btn btn-danger'>".$row->cantidad."</button>";
  			
  			}else{

  				$stock = "<button class='btn btn-success'>".$row->cantidad."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
		  			  			
  			$botones = "<button type='button' class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$row->id."'>Agregar</button>"; 
  			 		  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->codigo.'",
			      "'.$row->nombre.'",
			      "'.$row->precio_venta.'", 			 
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$productos = new ProductosAjax();
$productos->MostrarProductos();
