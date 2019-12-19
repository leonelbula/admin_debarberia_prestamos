<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductos($id_sucursal) {
		$sql = "SELECT l.* ,p.nombre,p.id_categoria,p.precio_venta,p.codigo FROM producto_sucursal l, producto p WHERE l.id_producto = p.id AND l.id_sucursal = $id_sucursal GROUP BY l.id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function categoriaId($id) {
		$sql = "SELECT * FROM categoria_producto  WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
}

class ProductosAjax {
	public function MostrarProductos() {
		$productos = new ListaProducto();
		$id_sucursal = $_GET['idsucursal'];
		$listaproducto = $productos->MostrarProductos($id_sucursal);
		
		
		 $datosJson = '{
		  "data": [';
		 $i = 1;
		 while ($row = $listaproducto->fetch_object()) {		
				
			 $id = $row->id_categoria;
			 $listaCate = $productos->categoriaId($id);
			 
			 while ($row1 = $listaCate->fetch_object()) {
				 $categoria = $row1->nombre;
			 }

  			if($row->cantidad< $row->stock_minimo){

  				$stock = "<button class='btn btn-danger'>".$row->cantidad."</button>";
  			
  			}else{

  				$stock = "<button class='btn btn-success'>".$row->cantidad."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
			$url = URL_BASE.'productos';
  			

  			$botones =  "<div class='btn-group'><a href='editar&id=".$row->id."'><button class='btn btn-warning btnAgregararticulo'><i class='fa fa-pencil'></i></button></a><a><button class='btn btn-danger btnEliminarProducto' idproducto='".$row->id."'><i class='fa fa-times'></i></button></a></div>"; 
  			

  			$redir = "href='ver&id=".$row->id."'";

  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
			      "'.$row->codigo.'",
			      "'.$row->nombre.'",			      
			      "'.$categoria.'",
			      "'.$row->precio_venta.'",				 
			      "'.$stock.'"			      
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
