<?php
require_once '../config/DataBase.php';

class ListaProductoInsumos {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductosInsumos() {
		$sql = "SELECT * FROM insumos";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class ProductosInsumosAjax {
	public function MostrarProdcutosInsumos() {
		$inventario = new ListaProductoInsumos();
		$listaproducto = $inventario->MostrarProductosInsumos();
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproducto->fetch_object()) {		
					 
			 

  			if($row->cantidad< $row->stock){

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
			      "'.$row->costo.'",				 		     
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
$productos = new ProductosInsumosAjax();
$productos->MostrarProdcutosInsumos();

