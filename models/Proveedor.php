<?php

require_once 'config/DataBase.php';

class Proveedor {

	public  $db;
	private $id;
	private $nombre;
	private $nit;
	private $direccion;
	private $telefono;
	private $ciudad; 
	private $departamento;
	
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

	function getTelefono() {
		return $this->telefono;
	}

	function getCiudad() {
		return $this->ciudad;
	}

	function getDepartamento() {
		return $this->departamento;
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

	function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	function setDepartamento($departamento) {
		$this->departamento = $departamento;
	}

		
	public function __construct() {
		$this->db = Database::connect();
	}
	public function listarProveedor() {
		$sql = "SELECT * FROM proveedor";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function listarProveedorId() {
		$sql = "SELECT * FROM proveedor WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guargar() {
		$sql = "INSERT INTO proveedor VALUES (NULL,'{$this->getNombre()}','{$this->getNit()}','{$this->getDireccion()}',"
			 . " '{$this->getTelefono()}','{$this->getCiudad()}','{$this->getDepartamento()}')";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}		
		return $resul;
	}
	public function Actualizar() {
		$sql = "UPDATE proveedor SET nombre='{$this->getNombre()}',nit='{$this->getNit()}',direccion='{$this->getDireccion()}',"
		. "telefono='{$this->getTelefono()}',ciudad='{$this->getCiudad()}',departamento='{$this->getDepartamento()}'"
		. " WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM proveedor WHERE  id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
}
