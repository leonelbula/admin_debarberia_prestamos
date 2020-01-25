<?php

require_once 'config/DataBase.php';

class DatosEmpresa{
	
	public $db;
	
	private $id;
	private $nit;
	private $nombre;
	private $direccion;
	private $departamento;
	private $ciudad;
	private $telefono;
	private $fecha_inicio;
			
	function getId() {
		return $this->id;
	}

	function getNit() {
		return $this->nit;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getDepartamento() {
		return $this->departamento;
	}

	function getCiudad() {
		return $this->ciudad;
	}

	function getTelefono() {
		return $this->telefono;
	}
	function getFecha_inicio() {
		return $this->fecha_inicio;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNit($nit) {
		$this->nit = $nit;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	function setDepartamento($departamento) {
		$this->departamento = $departamento;
	}

	function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	function setFecha_inicio($fecha_inicio) {
		$this->fecha_inicio = $fecha_inicio;
	}

		
	public function __construct() {
		$this->db = Database::connect();
	}
	
	public function MostrarInformacion() {
		$sql = "SELECT * FROM datos_empresa ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Registrar() {
		$sql = "INSERT INTO datos_empresa VALUES (NULL, '{$this->getNit()}', '{$this->getNombre()}',"
				. "'{$this->getDireccion()}', '{$this->getDepartamento()}', '{$this->getCiudad()}',"
				. " '{$this->getTelefono()},'{$this->getFecha_inicio()}')";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if ($resul) {
			$resp = TRUE;
		}
		return $resp;
	}
	public function Actualizar() {
		$sql = "UPDATE datos_empresa SET nombre='{$this->getNombre()}',nit='{$this->getNit()}',direccion='{$this->getDireccion()}',"
		. "departamento='{$this->getDepartamento()}',ciudad='{$this->getCiudad()}',telefono='{$this->getTelefono()}',fecha_inicio='{$this->getFecha_inicio()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}
