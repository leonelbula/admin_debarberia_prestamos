<?php

require_once 'config/DataBase.php';

class VentasSucursal {

	public $db;
	private $id_sucursal;
	private $fecha;

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function __construct() {
		$this->db = Database::connect();
	}

	public function ventasDiariaProcutosSucursal() {
		$sql = "SELECT SUM(totalventa) AS total FROM venta_producto WHERE id_sucursal =  {$this->getId_sucursal()} && fecha = '{$this->getFecha()}'";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}

	public function ventasDiariaServicioSucursal() {
		$sql = "SELECT SUM(valor) AS total FROM venta_servicio WHERE id_sucursal =  {$this->getId_sucursal()} && fecha = '{$this->getFecha()}'";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}

	public function VentasProductos($fechaInicial, $fechaFinal,$id_sucursal) {


		if ($fechaInicial == $fechaFinal) {

			$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha like '%$fechaFinal%'  AND id_sucursal = $id_sucursal AND estado = 1";
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal AND estado = 1";
			} else {

				$sql = "SELECT SUM(totalventa) as total FROM venta_producto WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal AND estado = 1";
			}
		}


		$resul = $this->db->query($sql);
		return $resul;
	}
	
	public function VentasServicios($fechaInicial, $fechaFinal,$id_sucursal) {


		if ($fechaInicial == $fechaFinal) {

			$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha like '%$fechaFinal%'  AND id_sucursal = $id_sucursal AND estadocierre = 1";
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_sucursal = $id_sucursal AND estadocierre = 1";
			} else {

				$sql = "SELECT SUM(valorinterno) as total FROM venta_servicio WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_sucursal = $id_sucursal AND estadocierre = 1";
			}
		}


		$resul = $this->db->query($sql);
		return $resul;
	}

	public function MostrarSumaVentas() {
		$sql = "SELECT SUM(total) as total FROM venta";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function CerrarVentasServicio() {
		$sql = "UPDATE venta_servicio SET estadocierre = 0 WHERE id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function CerrarVentasProducto() {
		$sql = "UPDATE venta_producto SET estado = 0 WHERE id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}
	public function CerrarAbonos() {
		$sql = "UPDATE abono_entregados_prestamos_sucursal SET estado = 0 WHERE id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);
		$result = FALSE;
		if($resp){
			$result = TRUE;
		}
		return $result;
	}

}
