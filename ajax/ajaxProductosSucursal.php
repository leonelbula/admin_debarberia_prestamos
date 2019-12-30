<?php
require_once '../config/DataBase.php';

class ListaProductoItemFactura {
	
	public $db;
	


	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarProductosId($id) {
		$sql = "SELECT p.id,p.codigo,p.costo,p.nombre,p.precio_venta ,s.cantidad FROM producto p , producto_sucursal s WHERE s.id_producto = $id AND p.id = s.id_producto";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}
	public function categoriaId($id) {
		$sql = "SELECT * FROM categoria_producto  WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
}

class AjaxProductos{
	
	public $idProducto;
	
	public function MostrarProductoId() {
		$id = $this->idProducto;
		$producto = new ListaProductoItemFactura();
		$respuesta = $producto->MostrarProductosId($id);
		echo json_encode($respuesta);
	}

}
if(isset($_POST["idProducto"])){

  $Producto = new AjaxProductos();
  $Producto -> idProducto = $_POST["idProducto"];
  $Producto -> MostrarProductoId();

}