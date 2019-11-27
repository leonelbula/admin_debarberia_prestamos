<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class Producto {
	
	public $db;
	
	private $id;
	private $id_categoria;	
	private $codigo;
	private $nombre;
	private $costo;	
	private $cantidad;	
	private $precio_venta;	
	private $procentaje_utilidad;
	private $utilidad;	
	private $stock_minimo;	
	private $codigo_vendedor;	
	private $id_proveedor;
	
	function getId() {
		return $this->id;
	}

	function getId_categoria() {
		return $this->id_categoria;
	}

	function getCodigo() {
		return $this->codigo;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getCosto() {
		return $this->costo;
	}

	function getCantidad() {
		return $this->cantidad;
	}

	function getPrecio_venta() {
		return $this->precio_venta;
	}

	function getProcentaje_utilidad() {
		return $this->procentaje_utiidad;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function getStock_minimo() {
		return $this->stock_minimo;
	}

	function getCodigo_vendedor() {
		return $this->codigo_vendedor;
	}

	function getId_proveedor() {
		return $this->id_proveedor;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	function setCosto($costo) {
		$this->costo = $costo;
	}

	function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	function setPrecio_venta($precio_venta) {
		$this->precio_venta = $precio_venta;
	}

	function setProcentaje_utilidad($procentaje_utiidad) {
		$this->procentaje_utiidad = $procentaje_utiidad;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	function setStock_minimo($stock_minimo) {
		$this->stock_minimo = $stock_minimo;
	}

	function setCodigo_vendedor($codigo_vendedor) {
		$this->codigo_vendedor = $codigo_vendedor;
	}

	function setId_proveedor($id_proveedor) {
		$this->id_proveedor = $id_proveedor;
	}

		
	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarProductosId() {
		$sql = "SELECT * FROM producto WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function TotalProductos() {
		$sql = "SELECT COUNT(id) as total FROM producto ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarProductos() {
		$sql = "SELECT * FROM producto ORDER by ventas DESC ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarUltimoProductos() {
		$sql = "SELECT p.id , p.codigo FROM producto p ORDER by id DESC LIMIT 1";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO producto VALUES(NULL,{$this->getId_categoria()},'{$this->getCodigo()}','{$this->getNombre()}',{$this->getCosto()},"
		. "{$this->getCantidad()},{$this->getPrecio_venta()},{$this->getProcentaje_utilidad()},{$this->getUtilidad()},"
		. "{$this->getStock_minimo()},'{$this->getCodigo_vendedor()}',{$this->getId_proveedor()}"
		. ")";
		$resp = $this->db->query($sql);
		$link = $this->db;
		$resul = mysqli_insert_id($link);
//		if($resp){
//			$resul = TRUE;
//		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE producto SET id_categoria={$this->getId_categoria()},codigo='{$this->getCodigo()}',nombre='{$this->getNombre()}',costo={$this->getCosto()},"
		. "cantidad={$this->getCantidad()},precio_venta={$this->getPrecio_venta()},porcentaje_utilidad={$this->getProcentaje_utilidad()},utilidad={$this->getUtilidad()},"
		. "stock_minimo={$this->getStock_minimo()},codigo_vendedor='{$this->getCodigo_vendedor()}',id_vendedor={$this->getId_proveedor()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;

	}
	public function Eliminar() {
		$sql = "DELETE FROM producto WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VercantidadProducto() {
		$sql = "SELECT cantidad FROM producto WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ActulizarStock() {
		$sql = "UPDATE producto SET cantidad={$this->getCantidad()}  WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VentaProductos() {
		$sql = "SELECT p.nombre, COUNT(v.cantidad) AS cantidad FROM vanta_producto v INNER JOIN producto p ON v.id_producto=p.id GROUP BY v.id_producto";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ValorInventario() {
		$sql = "SELECT SUM(costo*cantidad) as resultado FROM producto";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function stock() {		
		$sql = "SELECT COUNT(id) AS total  FROM producto WHERE cantidad_min >= can_inicial";
		$resp = $this->db->query($sql);		
		return $resp;
	}
}