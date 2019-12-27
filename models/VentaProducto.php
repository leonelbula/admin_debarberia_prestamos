<?php

require_once 'config/DataBase.php';

class VentaProducto{
	public $db;
	
	private $id;
	private $id_sucursal; 
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

	function getId_sucursal() {
		return $this->id_sucursal;
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

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
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
		$sql = "SELECT SUM(totalventa) as total FROM venta_producto";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO venta_producto VALUES (NULL,{$this->getId_sucursal()},{$this->getNum_venta()},'{$this->getFecha()}','{$this->getDetalle()}',{$this->getUtilidad()},{$this->getTotalventa()},{$this->getTotalcosto()},{$this->getSaldo()},1)";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE venta_producto SET detalles='{$this->getDetalle()}',utilidad={$this->getUtilidad()},totalventa={$this->getTotalventa()},totalcosto={$this->getTotalcosto()},saldo={$this->getSaldo()} WHERE id = {$this->getId()} AND id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM venta_producto WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function VerUltimaVenta() {
		$sql = "SELECT * FROM venta_producto WHERE id_sucursal = {$this->getId_sucursal()} ORDER BY id DESC LIMIT 1";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function verDetallesId() {
		$sql = "SELECT * FROM venta_producto WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Cobrar() {
		$sql = "UPDATE venta_producto SET saldo = {$this->getSaldo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	
}