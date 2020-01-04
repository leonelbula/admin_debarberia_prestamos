<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';


class ventaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	
	public function MostrarVendedorId($id) {
		$sql = "SELECT * FROM vendedores WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function MostrarVentaProducto() {
		$sql = "SELECT * FROM venta_vendedores ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VentaProductoAjax {
	public function MostrarVentaProducto() {
		$ventas = new ventaProducto();
		
		$listaventas = $ventas->MostrarVentaProducto();
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaventas->fetch_object()) {		
		
			 $nombre = 'compra de  productos';
			 
			 
			
			 
			 $url = '../ventasproducto';
			$botones = "<div class='btn-group'></div><a href='verdetallescompra&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i>Ver</button></a></div>";
//  				
		 
		  	$datosJson .='[
			      "'.($i++).'",			     
				  "'.$row->fecha.'",
				  "'.$row->num_factura.'",
			      "'.$nombre.'",
			      "'.$row->totalventa.'",				 					  
			      "'.$row->saldo.'",
				  "'.$botones.'"
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

