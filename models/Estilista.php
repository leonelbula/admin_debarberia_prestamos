<?php

require_once 'config/DataBase.php';

class Estilista{
	public $db;
	private $id;
	private $id_sucursal;
	private $nombre;
	private $nit;
	private $telefono;
	private $direccion;
	private $fecha_registro;
	
	function getId() {
		return $this->id;
	}

	function getId_sucursal() {
		return $this->id_sucuarsal;
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

	function getFecha_registro() {
		return $this->fecha_registro;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_sucursal($id_sucuarsal) {
		$this->id_sucuarsal = $id_sucuarsal;
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

	function setFecha_registro($fecha_registro) {
		$this->fecha_registro = $fecha_registro;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Mostrarestilistas() {
		$sql = "SELECT * FROM estilista";
		$respt = $this->db->query($sql);
		return $respt;
	}
	public function estilistas() {
		$sql = "SELECT * FROM estilista WHERE id_sucursal = {$this->getId_sucursal()}";
		$respt = $this->db->query($sql);
		return $respt;
	}
	public function estilistasId() {
		$sql = "SELECT * FROM estilista WHERE id = {$this->getId()}";
		$respt = $this->db->query($sql);
		return $respt;
	}
	public function Guardar() {
		$sql = "INSERT INTO estilista VALUES (NULL,{$this->getId_sucursal()},'{$this->getNombre()}',{$this->getNit()},{$this->getTelefono()},'{$this->getDireccion()}','{$this->getFecha_registro()}')";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}
	public function Actulizar() {
		$sql = "UPDATE estilista SET id_sucursal={$this->getId_sucursal()},nombre='{$this->getNombre()}',nit={$this->getNit()},"
		. "telefono='{$this->getTelefono()}',direccion='{$this->getDireccion()}',fecha_registro='{$this->getFecha_registro()}' WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}
	public function Eliminar() {
		$sql = "DELETE FROM estilista WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}
}
