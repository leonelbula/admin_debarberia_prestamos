<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class Insumo {
	
	public $db;
	
	private $id;	
	private $codigo;
	private $nombre;
	private $costo;	
	private $cantidad;	
	private $stock;	
	private $codigo_vendedor;	
	private $id_proveedor;
	
	function getId() {
		return $this->id;
	}

	function getCodigo() {
		return $this->codigo;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getCosto() {
		return $this->costo;
	}

	function getCantidad() {
		return $this->cantidad;
	}

	function getStock() {
		return $this->stock;
	}

	function getCodigo_vendedor() {
		return $this->codigo_vendedor;
	}

	function getId_proveedor() {
		return $this->id_proveedor;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setCosto($costo) {
		$this->costo = $costo;
	}

	function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	function setStock($stock) {
		$this->stock = $stock;
	}

	function setCodigo_vendedor($codigo_vendedor) {
		$this->codigo_vendedor = $codigo_vendedor;
	}

	function setId_proveedor($id_proveedor) {
		$this->id_proveedor = $id_proveedor;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarUltimoInsumos() {
		$sql = "SELECT p.id , p.codigo FROM insumos p ORDER by id DESC LIMIT 1";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO insumos VALUES (NULL,'{$this->getCodigo()}','{$this->getNombre()}',{$this->getCosto()},{$this->getCantidad()},{$this->getStock()},{$this->getId_proveedor()},'{$this->getCodigo_vendedor()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}