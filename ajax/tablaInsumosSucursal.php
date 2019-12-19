<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaInsumo {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarInsumo($id_sucursal) {
		$sql = "SELECT l.* ,p.nombre FROM insumos_sucursal l, insumos p WHERE l.id_insumo = p.id AND l.id_sucursal = $id_sucursal GROUP BY l.id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class InsumoAjax {
	public function MostrarInsumo() {
		$productos = new ListaInsumo();
		$id_sucursal = $_GET['idsucursal'];
		$listaproducto = $productos->MostrarInsumo($id_sucursal);
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproducto->fetch_object()) {		
				
			 

  			if($row->cantidad< $row->stock_minimo){

  				$stock = "<button class='btn btn-danger'>".$row->cantidad."</button>";
  			
  			}else{

  				$stock = "<button class='btn btn-success'>".$row->cantidad."</button>";

  			}
		  	
		 
		  	$datosJson .='[
			      "'.($i++).'",			      
			      "'.$row->nombre.'",	 
			      "'.$stock.'"			      
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}
$insumo = new InsumoAjax();
$insumo->MostrarInsumo();
