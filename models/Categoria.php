<?php

require_once 'config/DataBase.php';

class Categoria{
	public $db;
	private $id_categoria;
	private $nombre;
			
	function getId_categoria() {
		return $this->id_categoria;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarCategoria() {
		$sql = "SELECT * FROM categoria_producto";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarCategoriaId() {
		$sql = "SELECT * FROM categoria_producto  WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function GuardarCategoria() {
		$sql = "INSERT INTO categoria_producto VALUES (NULL,'{$this->getNombre()}')";
		$resul = $this->db->query($sql);
		$respt=FALSE;
		if($resul){
			$respt=TRUE;
		}
		return $respt;
	}
	public function EditarCategoria() {
		$sql = "UPDATE categoria_producto SET nombre='{$this->getNombre()}' WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
	public function EliminarCategoria() {
		$sql = "DELETE FROM categoria_producto WHERE id = {$this->getId_categoria()}";
		$resul = $this->db->query($sql);
		$respt = FALSE;
		if($resul){
			$respt = TRUE;
		}
		return $respt;
	}
}