<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class ProductoSucursal {
	
	public $db;
	
	private $id;
	private $id_categoria;
	private $id_sucursal;
	private $codigo;
	private $nombre;
	private $costo;	
	private $cantidad;	
	private $precio_venta;	
	private $procentaje_utilidad;
	private $utilidad;	
	private $stock_minimo;	
	
	function getId() {
		return $this->id;
	}

	function getId_categoria() {
		return $this->id_categoria;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
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
		return $this->procentaje_utilidad;
	}

	function getUtilidad() {
		return $this->utilidad;
	}

	function getStock_minimo() {
		return $this->stock_minimo;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_categoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
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

	function setProcentaje_utilidad($procentaje_utilidad) {
		$this->procentaje_utilidad = $procentaje_utilidad;
	}

	function setUtilidad($utilidad) {
		$this->utilidad = $utilidad;
	}

	function setStock_minimo($stock_minimo) {
		$this->stock_minimo = $stock_minimo;
	}

	
	
	public function __construct() {
		$this->db = Database::connect();
	}
	public function MostrarProductosId() {
		$sql = "SELECT * FROM producto_sucursal WHERE id = {$this->getId()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function MostrarProductosSucursal() {
		$sql = "SELECT * FROM producto_sucursal WHERE id = {$this->getId()} && id_sucursal = {$this->getId_sucursal()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function ValorInventarioSucursal() {
		$sql = "SELECT SUM(costo * cantidad) AS total FROM producto_sucursal WHERE id_sucursal =  {$this->getId_sucursal()}";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}		
	public function Guardar() {
		$sql = "INSERT INTO producto VALUES(NULL,{$this->getId_categoria()},{$this->getId_sucursal()},'{$this->getCodigo()}','{$this->getNombre()}',{$this->getCosto()},"
		. "{$this->getCantidad()},{$this->getPrecio_venta()},{$this->getProcentaje_utilidad()},{$this->getUtilidad()},"
		. "{$this->getStock_minimo()}"
		. ")";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE producto SET id_categoria={$this->getId_categoria()},id_sucursal={$this->getId_sucursal()},codigo='{$this->getCodigo()}',nombre='{$this->getNombre()}',costo={$this->getCosto()},"
		. "cantidad={$this->getCantidad()},precio_venta={$this->getPrecio_venta()},porcentaje_utilidad={$this->getProcentaje_utilidad()},utilidad={$this->getUtilidad()},"
		. "stock_minimo={$this->getStock_minimo()} WHERE id = {$this->getId()}";
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
		$sql = "SELECT cantidad FROM producto WHERE id = {$this->getId_producto()}";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ActulizarStock() {
		$sql = "UPDATE product SET cantidad={$this->getCantidad_Inicial()}  WHERE id = {$this->getId_producto()}";
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
		$sql = "SELECT SUM(costo*can_inicial) as resultado FROM product";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function stock() {		
		$sql = "SELECT COUNT(id) AS total  FROM product WHERE cantidad_min >= can_inicial";
		$resp = $this->db->query($sql);		
		return $resp;
	}
}