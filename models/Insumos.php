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
	public function MostrarInsumosId() {
		$sql = "SELECT * FROM insumos WHERE id = {$this->getId()}";
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
	public function Actualizar() {
		$sql = "UPDATE insumos SET codigo='{$this->getCodigo()}',nombre='{$this->getNombre()}',costo={$this->getCosto()},cantidad={$this->getCantidad()},stock={$this->getStock()},id_vendedor={$this->getId_proveedor()},codigo_vendedor='{$this->getCodigo_vendedor()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM insumos WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
}