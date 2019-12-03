<?php

require_once 'config/DataBase.php';

class Servicio{
	
	public $db;
	
	private $id;
	private $nombre;
	private $valor;
	private $img;
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getValor() {
		return $this->valor;
	}

	function getImg() {
		return $this->img;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setImg($img) {
		$this->img = $img;
	}
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	public function verDetalles() {
		$sql = "SELECT * FROM servicios WHERE id = {$this->getId()}";
		$respt = $this->db->query($sql);
		return $respt;
	}
		
	public function Guardar() {
		$sql = "INSERT INTO servicios VALUES (NULL,'{$this->getNombre()}',{$this->getValor()},'{$this->getImg()}')";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Actulizar() {
		$sql = "UPDATE servicios SET nombre='{$this->getNombre()}',valor={$this->getValor()},img='{$this->getImg()}' WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function Eliminar() {
		$sql = "DELETE FROM servicios WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	
}
