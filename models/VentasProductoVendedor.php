<?php

require_once 'config/DataBase.php';

class VentasProductoVendedor{
	public $db;
	
	private $id;
	private $id_vendedor; 
	private $num_venta;
	private $fecha;
	private $detalle; 
	private $utilidad;
	private $totalventa;
	private $totalcosto;
	private $saldo;
			
	function getId() {
		return $this->id;
	}

	function getId_vendedor() {
		return $this->id_vendedor;
	}

	function getNum_venta() {
		return $this->num_venta;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getDetalle() {
		return $this->detalle;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function getTotalventa() {
		return $this->totalventa;
	}

	function getTotalcosto() {
		return $this->totalcosto;
	}

	function getSaldo() {
		return $this->saldo;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_vendedor($id_vendedor) {
		$this->id_vendedor = $id_vendedor;
	}

	function setNum_venta($num_venta) {
		$this->num_venta = $num_venta;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setDetalle($detalle) {
		$this->detalle = $detalle;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	function setTotalventa($totalventa) {
		$this->totalventa = $totalventa;
	}

	function setTotalcosto($totalcosto) {
		$this->totalcosto = $totalcosto;
	}

	function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

		
	public function __construct() {
		$this->db = Database::connect();
	}
	public function TotalVentasProducto() {
		$sql = "SELECT SUM(totalventa) as total FROM venta_vendedores";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO venta_vendedores VALUES (NULL,{$this->getId_vendedor()},{$this->getNum_venta()},'{$this->getFecha()}','{$this->getDetalle()}',{$this->getUtilidad()},{$this->getTotalventa()},{$this->getTotalcosto()},{$this->getSaldo()},1)";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE venta_vendedores SET id_vendedor={$this->getId_vendedor()}, detalles='{$this->getDetalle()}',utilidad={$this->getUtilidad()},totalventa={$this->getTotalventa()},totalcosto={$this->getTotalcosto()},saldo={$this->getSaldo()} WHERE id = {$this->getId()} ";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM venta_vendedores WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function VerUltimaVenta() {
		$sql = "SELECT * FROM venta_vendedores ORDER BY id DESC LIMIT 1";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function verDetallesId() {
		$sql = "SELECT * FROM venta_vendedores WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Cobrar() {
		$sql = "UPDATE venta_vendedores SET saldo = {$this->getSaldo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	
}