<?php

require_once 'config/DataBase.php';

class ClienteVenta{

	public $db;
	
	private $id;
	private $nombre;
	private $nit;
	private $direccion;	
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getNit() {
		return $this->nit;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setNit($nit) {
		$this->nit = $nit;
	}

	function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function listarClientes() {
		$sql = "SELECT * FROM cliente_venta";
		$resul = $this->db->query($sql);
		return $resul;
	}
}
