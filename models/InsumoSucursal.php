<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class InsumoSucursal {
	
	public $db;
	
	private $id;
	private $id_producto;
	private $id_sucursal;	
	private $cantidad;
	private $stock_minimo;	
	
	function getId() {
		return $this->id;
	}

	function getId_producto() {
		return $this->id_producto;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getCantidad() {
		return $this->cantidad;
	}

	function getStock_minimo() {
		return $this->stock_minimo;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_producto($id_producto) {
		$this->id_producto = $id_producto;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	function setStock_minimo($stock_minimo) {
		$this->stock_minimo = $stock_minimo;
	}

		
	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarProductosId() {
		$sql = "SELECT * FROM insumos_sucursal WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarProductosSucursal() {
		$sql = "SELECT * FROM insumos_sucursal WHERE id = {$this->getId()} && id_sucursal = {$this->getId_sucursal()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO insumos_sucursal VALUES (NULL,{$this->getId_producto()},{$this->getId_sucursal()},{$this->getCantidad()},{$this->getStock_minimo()})";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE insumos_sucursal SET id_producto={$this->getId_producto()},id_sucursal={$this->getId_sucursal()},cantidad={$this->getCantidad()},stock_minimo={$this->getStock_minimo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;

	}
	public function Eliminar() {
		$sql = "DELETE FROM insumos_sucursal WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
}