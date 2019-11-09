<?php

require_once 'config/DataBase.php';

class PrestamosEntregado{
	
	public $db;
	private $id;
	private $id_cliente;
	private $valor;
	private $fecha;
	
	function getId() {
		return $this->id;
	}

	function getId_cliente() {
		return $this->id_cliente;
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

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarPrestamoEntregadoIdCliente() {
		$sql = "SELECT * FROM `prestamos_entregados` WHERE id_cliente = {$this->getId_cliente()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO prestamos_entregados VALUES (NULL,{$this->getId_cliente()},{$this->getValor()},'{$this->getFecha()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE prestamos_entregados SET id_cliente={$this->getId_cliente()},valor={$this->getValor()},fecha='{$this->getFecha()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM prestamos_entregados WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}
