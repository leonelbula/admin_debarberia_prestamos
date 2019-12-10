<?php

require_once 'config/DataBase.php';

class Comisiones{
	
	public $db;
	
	private $id;
	private $valor;
	private $fecha;
	
	function getId() {
		return $this->id;
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

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarDetalles() {
		$sql = "SELECT * FROM comisiones ";
		$resp = $this->db->query($sql);
		return $resp->fetch_object();
	}
	public function Guardar() {
		$sql = "INSERT INTO comisiones VALUES (NULL,{$this->getValor()},'{$this->getFecha()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}