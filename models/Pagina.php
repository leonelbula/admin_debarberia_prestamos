<?php

require_once 'config/DataBase.php';

class PaginaContenido{
	
	public $db;	
	private $id;
	private $titulo;
	private $titulo2;
	
	function getId() {
		return $this->id;
	}

	function getTitulo() {
		return $this->titulo;
	}

	function getTitulo2() {
		return $this->titulo2;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	function setTitulo2($titulo2) {
		$this->titulo2 = $titulo2;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Editar() {
		$sql = "UPDATE contenido SET titulo='{$this->getTitulo()}',titulo2='{$this->getTitulo2()}' WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if ($resul) {
			$resp = TRUE;
		}
		return $resp;
	}
	
}

class ServiciosPagina {

	public $db;
	
	private $id;
	private $nombre;
	private $img;
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
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

	function setImg($img) {
		$this->img = $img;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Editar() {
		$sql = "UPDATE servicios_pagina SET nombre='{$this->getNombre()}',img='{$this->getImg()}'  WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if ($resul) {
			$resp = TRUE;
		}
		return $resp;
	}

}

class ContenidoEmpleado {

	public $db;
	
	private $id;
	private $nombre;
	private $descripcion;
	private $img;
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
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

	function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	function setImg($img) {
		$this->img = $img;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Editar() {
		$sql = "UPDATE contenido_empleado SET nombre='{$this->getNombre()}',descripcion='{$this->getDescripcion()}',img='{$this->getImg()}' WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if ($resul) {
			$resp = TRUE;
		}
		return $resp;
	}

}

class ContenidoSucursal {

	public $db;
	
	private $id;
	private $nombre;
	private $horrario;
	private $img;
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getHorrario() {
		return $this->horrario;
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

	function setHorrario($horrario) {
		$this->horrario = $horrario;
	}

	function setImg($img) {
		$this->img = $img;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Editar() {
		$sql = "UPDATE contenido_sucursal SET nombre='{$this->getNombre()}',horrario='{$this->getHorrario()}',img='{$this->getImg()}'  WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if ($resul) {
			$resp = TRUE;
		}
		return $resp;
	}

}