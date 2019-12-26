<?php

require_once 'config/DataBase.php';

class AbonoEntregadosPrestamosSucursal{
	
	public $db;
	private $id;	
	private $id_estilista;	
	private $id_sucursal;	
	private $fecha;
	private $valor;
	private $estado;
	
	function getId() {
		return $this->id;
	}

	function getId_estilista() {
		return $this->id_estilista;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getValor() {
		return $this->valor;
	}

	function getEstado() {
		return $this->estado;
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

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setValor($valor) {
		$this->valor = $valor;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	public function __construct() {
		$this->db = Database::connect();
	}
	public function Guardar() {
		$sql = "INSERT INTO abono_entregados_prestamos_sucursal VALUES (NULL,{$this->getId_estilista()},{$this->getId_sucursal()},'{$this->getFecha()}',{$this->getValor()},{$this->getEstado()})";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function AbonosDiarios($fechaInicial, $fechaFinal,$id_sucursal) {


		if ($fechaInicial == $fechaFinal) {

			$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha like '%$fechaFinal%' AND id_sucursal = $id_sucursal";
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal";
			} else {

				$sql = "SELECT SUM(valor) as total FROM abono_entregados_prestamos_sucursal WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal";
			}
		}


		$resul = $this->db->query($sql);
		return $resul;
	}
}

