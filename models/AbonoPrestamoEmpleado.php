<?php

require_once 'config/DataBase.php';

class AbonoPrestamoEmpleado{
	
	public $db;
	private $id;
	private $id_prestamo;
	private $id_sucursal;
	private $id_estilista;
	private $valor;
	private $fecha;
	
	function getId() {
		return $this->id;
	}

	function getId_prestamo() {
		return $this->id_prestamo;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getValor() {
		return $this->valor;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_prestamo($id_prestamo) {
		$this->id_prestamo = $id_prestamo;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setId_estilista($id_estilista) {
		$this->id_estilista = $id_estilista;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarabonosEntregadoId() {
		$sql = "SELECT * FROM abono_prestamos_estilista WHERE id_prestamo = {$this->getId_prestamo()} ORDER BY id DESC";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function MostrarabonosId() {
		$sql = "SELECT * FROM abono_prestamos_estilista WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO abono_prestamos_estilista VALUES (NULL,{$this->getId_prestamo()},{$this->getId_estilista()},'{$this->getFecha()}',{$this->getValor()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE abono_prestamos_estilista SET valor={$this->getValor()},fecha='{$this->getFecha()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM abono_prestamos_estilista WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function PagosDiarios() {
		$sql = "SELECT SUM(valor) as total FROM abono_prestamos_estilista WHERE fecha like '%{$this->getFecha()}%'";
		$resp = $this->db->query($sql);
		return $resp;
	}
}
