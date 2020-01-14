<?php

require_once 'config/DataBase.php';

class Sucursal{
	public $db;
	private $id;
	private $id_sucursal;
	private $nombre;
	private $direccion;
	private $ciudad;
	private $departamento;	
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

	function getDireccion() {
		return $this->direccion;
	}

	function getCiudad() {
		return $this->ciudad;
	}

	function getDepartamento() {
		return $this->departamento;
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

	function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	function setDepartamento($departamento) {
		$this->departamento = $departamento;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function listaSucursal() {
		$sql = "SELECT * FROM sucursal ";
		$respt = $this->db->query($sql);
		return $respt;
	}
	
	public function motrarInformacion() {
		$sql = "SELECT * FROM sucursal WHERE id = {$this->getId()}";
		$respt = $this->db->query($sql);
		return $respt;
	}
	public function motrarUbicacionUsuario() {
		$sql = "SELECT * FROM sucursal WHERE id = {$this->getId()}";
		$respt = $this->db->query($sql);
		return $respt->fetch_object();
	}
	
	public function Guardar() {
		$sql = "INSERT INTO sucursal VALUES (NULL,'{$this->getNombre()}','{$this->getDireccion()}','{$this->getCiudad()}','{$this->getDepartamento()}','{$this->getFecha()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE sucursal SET nombre='{$this->getNombre()}',direccion='{$this->getDireccion()}',ciudad='{$this->getCiudad()}',departamento='{$this->getDepartamento()}',fecha_inicio='{$this->getFecha()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM sucursal WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	
	
}