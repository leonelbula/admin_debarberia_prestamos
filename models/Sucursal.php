<?php

require_once 'config/DataBase.php';

class Sucursal{
	public $db;
	private $id;
	private $id_sucursal;
	private $nombre;
	private $direcion;
	private $ciudad;
	private $departamento;
	private $dias_atencion;
	private $hora_atencion;
	private $fecha;

	function getId() {
		return $this->id;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDirecion() {
		return $this->direcion;
	}

	function getCiudad() {
		return $this->ciudad;
	}

	function getDepartamento() {
		return $this->departamento;
	}

	function getDias_atencion() {
		return $this->dias_atencion;
	}

	function getHora_atencion() {
		return $this->hora_atencion;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setDirecion($direcion) {
		$this->direcion = $direcion;
	}

	function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	function setDepartamento($departamento) {
		$this->departamento = $departamento;
	}

	function setDias_atencion($dias_atencion) {
		$this->dias_atencion = $dias_atencion;
	}

	function setHora_atencion($hora_atencion) {
		$this->hora_atencion = $hora_atencion;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	

	public function __construct() {
		$this->db = Database::connect();
	}
	public function motrarInformacion() {
		$sql = "SELECT * FROM sucursal WHERE id = {$this->getId()}";
		$respt = $this->db->query($sql);
		return $respt->fetch_object();
	}
	
}