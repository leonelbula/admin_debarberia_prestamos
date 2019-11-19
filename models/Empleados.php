<?php

require_once 'config/DataBase.php';

class Empleados {
	
	public $db;
	
	private $id;
	private $id_sucursal;
	private $nombre;
	private $nit;
	private $telefono;
	private $direccion;
	private $fechaIngreso;
	
	function getId() {
		return $this->id;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getNit() {
		return $this->nit;
	}

	function getTelefono() {
		return $this->telefono;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getFechaIngreso() {
		return $this->fechaIngreso;
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

	function setNit($nit) {
		$this->nit = $nit;
	}

	function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	function setFechaIngreso($fechaIngreso) {
		$this->fechaIngreso = $fechaIngreso;
	}

	
			
	function __construct() {
		$this->db = Database::connect();
	}
	public function MostraEmpleados() {
		$sql = "SELECT e.* ,s.nombre AS nombresucursal FROM empleado e INNER JOIN sucursal s ON s.id = e.id_sucursal";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO empleado VALUES (NULL,{$this->getId_sucursal()},'{$this->getNombre()}',{$this->getNit()},{$this->getTelefono()},'{$this->getDireccion()}','{$this->getFechaIngreso()}')";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}

}
