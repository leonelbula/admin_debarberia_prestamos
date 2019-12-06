<?php

require_once 'config/DataBase.php';

class PrestamosEntregadosSucursal{
	
	public $db;
	
	private $id;
	private $id_estilista;
	private $id_sucursal;
	private $valor;
	private $fecha;
	
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

	function getFecha() {
		return $this->fecha;
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

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarPrestamoEntregadoIdEstilista() {
		$sql = "SELECT * FROM prestamos_entregados_sucursal WHERE id_estilista = {$this->getId_estilista()}";
		$resp = $this->db->query($sql);
		return $resp;
	}
	public function Guardar() {
		$sql = "INSERT INTO prestamos_entregados_sucursal VALUES (NULL,{$this->getId_estilista()},{$this->getId_sucursal()},{$this->getValor()},'{$this->getFecha()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE prestamos_entregados_sucursal SET id_estilista={$this->getId_estilista()},valor={$this->getValor()},fecha='{$this->getFecha()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM prestamos_entregados_sucursal WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}