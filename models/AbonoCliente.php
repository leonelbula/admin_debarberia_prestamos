<?php

require_once 'config/DataBase.php';

class AbonoCliente{
	
	public $db;
	private $id;
	private $id_cliente;
	private $id_prestamo;
	private $valor;
	private $fecha;
	
	function getId() {
		return $this->id;
	}

	function getId_cliente() {
		return $this->id_cliente;
	}

	function getId_prestamo() {
		return $this->id_prestamo;
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

	function setId_cliente($id_cliente) {
		$this->id_cliente = $id_cliente;
	}

	function setId_prestamo($id_prestamo) {
		$this->id_prestamo = $id_prestamo;
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
		$sql = "SELECT * FROM abono_cliente WHERE id_prestamo = {$this->getId_prestamo()} ORDER BY id DESC";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function MostrarabonosId() {
		$sql = "SELECT * FROM abono_cliente WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO abono_cliente VALUES (NULL,{$this->getId_prestamo()},{$this->getId_cliente()},'{$this->getFecha()}',{$this->getValor()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE abono_cliente SET valor={$this->getValor()},fecha='{$this->getFecha()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM abono_cliente WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function PagosDiarios() {
		$sql = "SELECT SUM(valor) as total FROM abono_cliente WHERE fecha like '%{$this->getFecha()}%'";
		$resp = $this->db->query($sql);
		return $resp;
	}
}