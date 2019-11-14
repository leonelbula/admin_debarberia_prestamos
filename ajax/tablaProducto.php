<?php
require_once '../config/DataBase.php';
require_once '../config/parameters.php';

class ListaProducto {
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductos() {
		$sql = "SELECT * FROM producto";
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
		$listaproducto = $productos->MostrarProductos();
		
		
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
			      "<a '.$redir.'>'.$row->nombre.'</a>",
			      "'.$row->costo.'",
			      "'.$categoria.'",
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
