<?php

require_once 'config/DataBase.php';

class VentaServicio{
	public $db;
	
	private $id;
	private $id_sucursal; 
	private $num_venta;
	private $detalle; 
	private $id_estilista; 
	private $fecha; 
	private $valor;
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

	function getDetalle() {
		return $this->detalle;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getValor() {
		return $this->valor;
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

	function setDetalle($detalle) {
		$this->detalle = $detalle;
	}

	function setId_estilista($id_estilista) {
		$this->id_estilista = $id_estilista;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}
	function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Guardar() {
		$sql = "INSERT INTO venta_servicio VALUES (NULL,{$this->getId_sucursal()},{$this->getNum_venta()},'{$this->getDetalle()}',{$this->getId_estilista()},'{$this->getFecha()}',{$this->getValor()},{$this->getSaldo()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function VerUltimaVentaServicio() {
		$sql = "SELECT * FROM venta_servicio WHERE id_sucursal = {$this->getId_sucursal()} ORDER BY id DESC LIMIT 1";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function verDetallesId() {
		$sql = "SELECT * FROM venta_servicio WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Cobrar() {
		$sql = "UPDATE venta_servicio SET saldo = {$this->getSaldo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	
}
