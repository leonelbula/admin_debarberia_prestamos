<?php
require_once '../config/DataBase.php';

class ListaContenido3 {
	
	public $db;

	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarContenidoId3($id) {
		$sql = "SELECT * FROM contenido_sucursal WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}	
}

class AjaxContenido3{
	
	public $idContenido;
	
	public function MostrarContenidoId3() {
		$id = $this->idContenido;
		$producto = new ListaContenido3();
		$respuesta = $producto->MostrarContenidoId3($id);
		echo json_encode($respuesta);
	}

}
if(isset($_POST["idContenido"])){

  $dato = new AjaxContenido3();
  $dato -> idContenido = $_POST["idContenido"];
  $dato ->MostrarContenidoId3();

}