<?php
require_once '../config/DataBase.php';

class ListaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductos($idSucursal) {
		$sql = "SELECT p.codigo,p.costo,p.nombre,p.precio_venta ,s.cantidad FROM producto p , producto_sucursal s WHERE p.id = s.id_producto AND s.id_sucursal = $idSucursal GROUP BY p.id";
		$resul = $this->db->query($sql);
		return $resul;
	}	
}

class ProductosAjax {
	public function MostrarProdcutos() {
		$inventario = new ListaProducto();
		$idSucursal = $_GET['idsucursal'];
		$listaproducto = $inventario->MostrarProductos($idSucursal);
		
		
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
$productos->MostrarProdcutos();
