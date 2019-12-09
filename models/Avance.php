<?php

require_once 'config/DataBase.php';

class Avance{
	
	public $db;
	
	private $id;
	private $id_estilista;
	private $id_sucursal;
	private $valor;
	private $fecha;
	private $estado;
			
	function getId() {
		return $this->id;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getValor() {
		return $this->valor;
	}

	function getFecha() {
		return $this->fecha;
	}
	
	function getEstado() {
		return $this->estado;
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

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	function setEstado($estado) {
		$this->estado = $estado;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarAvancesId() {
		$sql = "SELECT *, SUM(valor) AS total  FROM avances WHERE id_estilista = {$this->getId_estilista()} AND estado = 1 ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarAvancesEstilista() {
		$sql = "SELECT * FROM avances WHERE id_estilista = {$this->getId_estilista()} AND estado = 1 ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarAvancesDetalles() {
		$sql = "SELECT * FROM avances WHERE id = {$this->getId()} AND estado = 1 ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO avances VALUES (NULL,{$this->getId_sucursal()},{$this->getId_estilista()},{$this->getValor()},'{$this->getFecha()}',{$this->getEstado()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE avances SET id_estilista={$this->getId_estilista()},valor={$this->getValor()},fecha='{$this->getFecha()}' WHERE id = {$this->getId()} AND id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM avances WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}
