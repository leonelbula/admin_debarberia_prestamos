<?php

require_once 'config/DataBase.php';

class DatosCierre{

	public $db;
	
	private $id;
	private $id_cierre;
	private $totalproducto;
	private $totalservicio;	
	
	
	function getId() {
		return $this->id;
	}

	function getId_cierre() {
		return $this->id_cierre;
	}

	function getTotalproducto() {
		return $this->totalproducto;
	}

	function getTotalservicio() {
		return $this->totalservicio;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_cierre($id_cierre) {
		$this->id_cierre = $id_cierre;
	}

	function setTotalproducto($totalproducto) {
		$this->totalproducto = $totalproducto;
	}

	function setTotalservicio($totalservicio) {
		$this->totalservicio = $totalservicio;
	}

	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function Guardar() {
		$sql = "INSERT INTO datos_cierre VALUES (NULL,{$this->getId_cierre()},{$this->getTotalproducto()},{$this->getTotalservicio()})";
		$resul = $this->db->query($sql);
		$resp = FALSE;
		if($resul){
			$resp = TRUE;
		}
		return $resp;
	}
}