<?php

require_once 'config/DataBase.php';

class PrestamosSucursal {

	public $db;
	private $id;
	private $id_estilista;
	private $id_sucursal;
	private $fecha;
	private $fecha_vencimiento;
	private $interes;
	private $valor;
	private $valortotal;
	private $saldo;
	private $cuotas;
	private $saldocuota;
	private $utilidad;
	private $valorcuota;

	function getId() {
		return $this->id;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getFecha_vencimiento() {
		return $this->fecha_vencimiento;
	}

	function getInteres() {
		return $this->interes;
	}

	function getValor() {
		return $this->valor;
	}

	function getValortotal() {
		return $this->valortotal;
	}

	function getSaldo() {
		return $this->saldo;
	}

	function getCuotas() {
		return $this->cuotas;
	}

	function getSaldocuota() {
		return $this->saldocuota;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function getValorcuota() {
		return $this->valorcuota;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_estilista($id_estilista) {
		$this->id_estilista = $id_estilista;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setFecha_vencimiento($fecha_vencimiento) {
		$this->fecha_vencimiento = $fecha_vencimiento;
	}

	function setInteres($interes) {
		$this->interes = $interes;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setValortotal($valortotal) {
		$this->valortotal = $valortotal;
	}

	function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

	function setCuotas($cuotas) {
		$this->cuotas = $cuotas;
	}

	function setSaldocuota($saldocuota) {
		$this->saldocuota = $saldocuota;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	function setValorcuota($valorcuota) {
		$this->valorcuota = $valorcuota;
	}

	public function __construct() {
		$this->db = Database::connect();
	}

	public function PrestamosSucursal() {
		$sql = "SELECT * FROM prestamo_estilista WHERE id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		return $resp;
	}

	public function MostrarPrestamosId() {
		$sql = "SELECT * FROM prestamo_estilista WHERE id = {$this->getId()} ";
		$resp = $this->db->query($sql);
		return $resp;
	}

	public function MostrarPrestamoEntregadoIdEstilista() {
		$sql = "SELECT * FROM prestamo_estilista WHERE id_estilista = {$this->getId_estilista()}";
		$resp = $this->db->query($sql);
		return $resp;
	}

	public function MostrarValorApagarDiario() {
		$sql = "SELECT SUM(valorcuota) as totalcuota FROM prestamo_estilista WHERE id_estilista = {$this->getId_estilista()} AND saldo > 0
";
		$resp = $this->db->query($sql);
		return $resp;
	}

	public function Guardar() {
		$sql = "INSERT INTO prestamo_estilista VALUES (NULL,{$this->getId_estilista()},{$this->getId_sucursal()},"
				. "'{$this->getFecha()}','{$this->getFecha_vencimiento()}',{$this->getInteres()},"
				. "{$this->getValor()},{$this->getValortotal()},{$this->getSaldo()},{$this->getCuotas()},{$this->getSaldocuota()},{$this->getUtilidad()},{$this->getValorcuota()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if ($resp) {
			$result = TRUE;
		}
		return $result;
	}

	public function Actulizar() {
		$sql = "UPDATE prestamo_estilista SET id_estilista={$this->getId_estilista()},"
				. "fecha='{$this->getFecha()}',fecha_vencimiento='{$this->getFecha_vencimiento()}',"
				. "interes={$this->getInteres()},valor={$this->getValor()},valortotal={$this->getValortotal()},saldo={$this->getSaldo()},"
				. "cuotas={$this->getCuotas()},saldocuota={$this->getSaldocuota()},utilidad={$this->getCuotas()},valorcuota={$this->getValorcuota()} WHERE id = {$this->getId()} AND id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if ($resp) {
			$result = TRUE;
		}
		return $resp;
	}

	public function Eliminar() {
		$sql = "DELETE FROM prestamo_estilista WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if ($resp) {
			$result = TRUE;
		}
		return $result;
	}

	public function Abonar() {
		$sql = "UPDATE prestamo_estilista SET saldo = {$this->getSaldo()} , saldocuota = {$this->getSaldocuota()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if ($resp) {
			$result = TRUE;
		}
		return $result;
	}

	public function VerificarCuenta() {
		$sql = "SELECT * FROM prestamo_estilista WHERE id_estilista  = {$this->getId_estilista()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	
}
