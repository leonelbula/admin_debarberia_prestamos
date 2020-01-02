<?php

require_once 'config/DataBase.php';

class UsuarioVendedor{
	
	public $db;
	private $id;
	private $nombre;
	private $password;
	private $estado;
			
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getPassword() {
		return $this->password;
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

	function setPassword($password) {
		$this->password = $password;
	}
	function setEstado($estado) {
		$this->estado = $estado;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarTodos() {
		$sql = "SELECT * FROM usuario_vendedor ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarUsuarioId() {
		$sql = "SELECT * FROM usuario_vendedor WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function save() {
		$sql = "INSERT INTO usuario_vendedor VALUE(NULL,'{$this->getNombre()}','{$this->getPassword()}',{$this->getEstado()})";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE usuario_vendedor SET nombre='{$this->getNombre()}',password='{$this->getPassword()}' WHERE id = {$this->getId()}";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Eliminar() {
		$sql = "DELETE FROM usuario_vendedor WHERE id = {$this->getId()} ";
		$save = $this->db->query($sql);
		
		$resul = false;
		
		if($save){
			 $resul = true;
		}
		return $resul;
	}
	public function Login() {
		$result = FALSE;
		$nombre = $this->nombre;
		$password = $this->password;
			
		$sql = "SELECT * FROM usuario_vendedor WHERE nombre = '$nombre'";
		$login = $this->db->query($sql);
		
		if($login && $login->num_rows == 1){
			
			$usuario = $login->fetch_object();
			
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		return $result;
	}
	
}