<?php
require_once '../config/DataBase.php';

class ListaInsumos {
	
	public $db;
	


	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarInsumoId($id) {
		$sql = "SELECT * FROM insumos WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}	
}

class AjaxProductos{
	
	public $idProducto;
	
	public function MostrarProductoId() {
		$id = $this->idProducto;
		$producto = new ListaInsumos();
		$respuesta = $producto->MostrarInsumoId($id);
		echo json_encode($respuesta);
	}

}
if(isset($_POST["idProducto"])){

  $Producto = new AjaxProductos();
  $Producto -> idProducto = $_POST["idProducto"];
  $Producto -> MostrarProductoId();

}