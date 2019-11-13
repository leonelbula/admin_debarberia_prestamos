<?php

require_once 'config/DataBase.php';

class Parametros{
	
	public $db;
	
	private $id; 
	private $num_inicio_factura; 	
	private $generar_codigo;
	private $codigo_prod;
			
	function getId() {
		return $this->id;
	}

	function getNum_inicio_factura() {
		return $this->num_inicio_factura;
	}

	function getGenerar_codigo() {
		return $this->generar_codigo;
	}

	function getCodigo_prod() {
		return $this->codigo_prod;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNum_inicio_factura($num_inicio_factura) {
		$this->num_inicio_factura = $num_inicio_factura;
	}

	function setGenerar_codigo($generar_codigo) {
		$this->generar_codigo = $generar_codigo;
	}

	function setCodigo_prod($codigo_prod) {
		$this->codigo_prod = $codigo_prod;
	}

	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarParrametro() {
		$sql = "SELECT * FROM parametros";
		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function ActualizarConfig() {
		$sql = "UPDATE parametros SET num_inicio_factura={$this->getNum_inicio_factura()},"				
				. "generar_codigo={$this->getGenerar_codigo()},codigo_prod={$this->getCodigo_prod()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
}