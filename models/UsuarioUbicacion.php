<?php

require_once 'config/DataBase.php';

class UsuarioUbicacion{
	
	public $db;
	
	private $id;
	private $id_usuario;
	private	$id_sucursal;
	private	$estado;
	
	function getId() {
		return $this->id;
	}

	function getId_usuario() {
		return $this->id_usuario;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getEstado() {
		return $this->estado;
	}

	function setId($id) {
		$this->id = $id;
	}
		
	function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function UbicacionUsuario() {
		$sql = "SELECT * FROM usuario_ubicacion WHERE id_usuario = {$this->getId_usuario()}";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}
	public function save() {
		$sql = "INSERT INTO usuario_ubicacion VALUES (NULL,{$this->getId_usuario()},{$this->getId_sucursal()},{$this->getEstado()})";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Eliminar() {
		$sql = "DELETE FROM usuario_ubicacion WHERE id = {$this->getId()} ";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	
}