<?php

require_once 'config/DataBase.php';

class UsuarioUbicacion{
	
	public $db;
	
	private $id_usuario;
	private	$id_sucursal;
	private	$estado;
	
	function getId_usuario() {
		return $this->id_usuario;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getEstado() {
		return $this->estado;
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
}