<?php

require_once 'config/DataBase.php';

class Prestamos{

	public $db;
	private $id; 
	private $id_cliente; 
	private $interes; 
	private $fecha_entrega; 
	private $fecha_vencimiento; 
	private $num_cuotas; 
	private $valor; 
	private $valorcuota; 
	private $valortotal;
	private $saldo; 
	private $cuota_saldo; 
	private $utilidad;
	
	function getId() {
		return $this->id;
	}

	function getId_cliente() {
		return $this->id_cliente;
	}

	function getInteres() {
		return $this->interes;
	}

	function getFecha_entrega() {
		return $this->fecha_entrega;
	}

	function getFecha_vencimiento() {
		return $this->fecha_vencimiento;
	}

	function getNum_cuotas() {
		return $this->num_cuotas;
	}

	function getValor() {
		return $this->valor;
	}

	function getValorcuota() {
		return $this->valorcuota;
	}
	
	function getValortotal() {
		return $this->valortotal;
	}
	
	function getSaldo() {
		return $this->saldo;
	}

	function getCuota_saldo() {
		return $this->cuota_saldo;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_cliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}

	function setInteres($interes) {
		$this->interes = $interes;
	}

	function setFecha_entrega($fecha_entrega) {
		$this->fecha_entrega = $fecha_entrega;
	}

	function setFecha_vencimiento($fecha_vencimiento) {
		$this->fecha_vencimiento = $fecha_vencimiento;
	}

	function setNum_cuotas($num_cuotas) {
		$this->num_cuotas = $num_cuotas;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setValorcuota($valorcuota) {
		$this->valorcuota = $valorcuota;
	}

	function setValortotal($valortotal) {
		$this->valortotal = $valortotal;
	}
		
	function setSaldo($saldo) {
		$this->saldo = $saldo;
	}

	function setCuota_saldo($cuota_saldo) {
		$this->cuota_saldo = $cuota_saldo;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarPrestamos() {
		$sql = "SELECT * FROM prestamos_cliente WHERE saldo > 0";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function MostrarPrestamosId() {
		$sql = "SELECT * FROM prestamos_cliente WHERE id = {$this->getId()} ";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO prestamos_cliente VALUES (NULL,{$this->getId_cliente()},{$this->getInteres()},"
		. "'{$this->getFecha_entrega()}','{$this->getFecha_vencimiento()}',{$this->getNum_cuotas()},{$this->getValor()},"
		. "{$this->getValorcuota()},{$this->getValortotal()},{$this->getSaldo()},{$this->getCuota_saldo()},{$this->getUtilidad()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE prestamos_cliente SET id_cliente={$this->getId_cliente()},interes={$this->getInteres()},"
		. "fecha_entrega='{$this->getFecha_entrega()}',fecha_vencimiento='{$this->getFecha_vencimiento()}',num_cuotas={$this->getNum_cuotas()},"
		. "valor={$this->getValor()},valorcuota={$this->getValorcuota()},valortotal={$this->getValortotal()},saldo={$this->getSaldo()},"
		. "cuota_saldo={$this->getCuota_saldo()},utilidad={$this->getUtilidad()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM prestamos_cliente WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Abonar() {
		$sql = "UPDATE prestamos_cliente SET saldo = {$this->getSaldo()} , cuota_saldo = {$this->getCuota_saldo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function VerificarCuenta() {
		$sql = "SELECT * FROM prestamos_cliente WHERE id_cliente  = {$this->getId_cliente()}";
		$resp = $this->db->query($sql);			
		return $resp;
	}
}