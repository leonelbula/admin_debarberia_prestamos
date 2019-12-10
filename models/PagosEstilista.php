<?php

require_once 'config/DataBase.php';

class PagosEstilista{
	
	public $db;
	
	private $id;
	private $id_estilista;
	private $id_sucursal;
	private $valor;
	private $valortotal;	
	private $fecha;
	private $valorcomision;
	
	function getId() {
		return $this->id;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getValor() {
		return $this->valor;
	}
	function getValortotal() {
		return $this->valortotal;
	}

	function getFecha() {
		return $this->fecha;
	}
	function getValorcomision() {
		return $this->valorcomision;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_estilista($id_estilista) {
		$this->id_estilista = $id_estilista;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}
	function setValortotal($valortotal) {
		$this->valortotal = $valortotal;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	function setValorcomision($valorcomision) {
		$this->valorcomision = $valorcomision;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarSaldosPemienteIdEstilista() {
		$sql = "SELECT * FROM cierre_pago_estilista WHERE id_estilista = {$this->getId_estilista()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO cierre_pago_estilista VALUES (NULL,{$this->getId_estilista()},{$this->getId_sucursal()},{$this->getValor()},{$this->getValortotal()},'{$this->getFecha()}',{$this->getValorcomision()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}