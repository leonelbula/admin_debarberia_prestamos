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
	
	public function MostrarVentaProducto($id_vendedor) {
		$sql = "SELECT * FROM venta_vendedores WHERE id_vendedor = $id_vendedor ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
}

class VentaProductoAjax {
	public function MostrarVentaProducto() {
		$ventas = new ventaProducto();
		
		$id_vendedor = $_GET['idvendedor'];
		
		$listaventas = $ventas->MostrarVentaProducto($id_vendedor);
						
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaventas->fetch_object()) {		
		
			 $detalles = $ventas->MostrarVendedorId($row->id_vendedor);
			 
			 foreach ($detalles as $key => $value) {
				 $nombre = $value['nombre'];
			 }
			 
			 $url = '../ventasproducto';
			$botones = "<div class='btn-group'><a href='$url/editarventaproducto&id=$row->id'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarVentaVendedor' idventavendedor='$row->id' ><i class='fa fa-times'></i></button></a></div><a href='$url/verdetallesventavendedor&id=$row->id'><button class='btn btn-info'><i class='fa fa-eye'></i></button></a></div>";
//  				
		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->num_factura.'",
				  "'.$row->fecha.'",
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
