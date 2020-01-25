<?php
require_once '../config/DataBase.php';

class ListaContenido2 {
	
	public $db;

	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarContenidoId2($id) {
		$sql = "SELECT * FROM contenido_empleado WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}	
}

class AjaxContenido2{
	
	public $idContenido;
	
	public function MostrarContenidoId2() {
		$id = $this->idContenido;
		$producto = new ListaContenido2();
		$respuesta = $producto->MostrarContenidoId2($id);
		echo json_encode($respuesta);
	}

}
if(isset($_POST["idContenido"])){

  $dato = new AjaxContenido2();
  $dato -> idContenido = $_POST["idContenido"];
  $dato ->MostrarContenidoId2();

}