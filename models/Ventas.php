<?php

require_once 'config/DataBase.php';

class Ventas{
	
	public $db;
	private $id;
	private $id_sucursal;
	private $fecha;
	
	function getId() {
		return $this->id;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setId($id) {
		$this->id = $id;
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
	public function MostrarVentas() {
		//SELECT s.*, SUM(vp.totalventa) AS ventaproducto FROM venta_producto vp INNER JOIN sucursal s ON s.id =vp.id_sucursal AND fecha BETWEEN '2019-11-11' AND '2019-11-18' GROUP BY s.id
		
		$sql = "";
		$resp = $this->db->query($sql);
		return $resp;
	}
	
}

