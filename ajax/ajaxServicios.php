<?php

require_once '../config/DataBase.php';

class ListaProductoItem {

	public $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	public function MostrarServiciosId($id) {
		$sql = "SELECT * FROM servicios WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}

}

class AjaxServicios {

	public $idServicios;
	

	public function MostrarServiciosId() {


		$id = $this->idServicios;
		$servicio = new ListaProductoItem();
		$respuesta = $servicio->MostrarServiciosId($id);
		echo json_encode($respuesta);
	}
	

}

if (isset($_POST["idServicio"])) {
	$servicio = new AjaxServicios();
	$servicio->idServicios = $_POST["idServicio"];
	$servicio->MostrarServiciosId();
}
