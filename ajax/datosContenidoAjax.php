<?php
require_once '../config/DataBase.php';

class ListaContenido {
	
	public $db;
	


	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarContenidoId($id) {
		$sql = "SELECT * FROM contenido WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}	
}

class AjaxContenido{
	
	public $idContenido;
	
	public function MostrarContenidoId() {
		$id = $this->idContenido;
		$producto = new ListaContenido();
		$respuesta = $producto->MostrarContenidoId($id);
		echo json_encode($respuesta);
	}

}
if(isset($_POST["idContenido"])){

  $dato = new AjaxContenido();
  $dato -> idContenido = $_POST["idContenido"];
  $dato ->MostrarContenidoId();

}