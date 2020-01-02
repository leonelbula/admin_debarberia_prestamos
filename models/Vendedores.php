<?php

require_once 'config/DataBase.php';

class Vendedores{

	public $db;
	
	private $id;
	private $nombre;
	private $nit;
	private $direccion;	
	private $ciudad; 	
	private $telefono;
	private $estado; 	
	
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

	function getCiudad() {
		return $this->ciudad;
	}

	function getTelefono() {
		return $this->telefono;
	}

	function getEstado() {
		return $this->estado;
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

	function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

		
	public function __construct() {
		$this->db = Database::connect();
	}
	public function listarVendedores() {
		$sql = "SELECT * FROM vendedores";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function TotalVendedores() {
		$sql = "SELECT COUNT(id) as total FROM vendedores";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function listarVendedoresId() {
		$sql = "SELECT * FROM vendedores WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guargar() {
		$sql = "INSERT INTO vendedores VALUES (NULL,'{$this->getNombre()}','{$this->getNit()}','{$this->getDireccion()}',"
			 . "'{$this->getCiudad()}','{$this->getTelefono()}')";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}		
		return $resul;
	}
	public function Actualizar() {
		$sql = "UPDATE vendedores SET nombre='{$this->getNombre()}',nit='{$this->getNit()}',direccion='{$this->getDireccion()}',"
		. "ciudad='{$this->getCiudad()}',telefono='{$this->getTelefono()}'"
		. " WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM vendedores WHERE  id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VerificarVentas() {
		$sql = "SELECT * FROM venta_vendedores WHERE id_vendedor  = {$this->getId()}";
		$resp = $this->db->query($sql);			
		return $resp;
	}
	
}
