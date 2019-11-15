<?php

require_once 'config/DataBase.php';

class VentasSucursal{
	public $db;
	private $id_sucursal;
	private $fecha;
	
	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function ventasDiariaProcutosSucursal() {
		$sql = "SELECT SUM(totalventa) AS total FROM venta_producto WHERE id_sucursal =  {$this->getId_sucursal()} && fecha = '{$this->getFecha()}'";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}
	public function ventasDiariaServicioSucursal() {
		$sql = "SELECT SUM(valor) AS total FROM venta_servicio WHERE id_sucursal =  {$this->getId_sucursal()} && fecha = '{$this->getFecha()}'";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}
}