<?php

//require_once 'ModeloBase.php';
require_once 'config/DataBase.php';

class ProductoSucursal {
	
	public $db;
	
	private $id;
	private $id_producto;
	private $id_sucursal;	
	private $cantidad;
	private $stock_minimo;	
	
	function getId() {
		return $this->id;
	}

	function getId_producto() {
		return $this->id_producto;
	}

	function getId_sucursal() {
		return $this->id_sucursal;
	}

	function getCantidad() {
		return $this->cantidad;
	}

	function getStock_minimo() {
		return $this->stock_minimo;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setId_producto($id_producto) {
		$this->id_producto = $id_producto;
	}

	function setId_sucursal($id_sucursal) {
		$this->id_sucursal = $id_sucursal;
	}

	function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
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
		$sql = "SELECT * FROM producto_sucursal WHERE id_producto = {$this->getId_producto()} && id_sucursal = {$this->getId_sucursal()}";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function ValorInventarioSucursal() {
		$sql = "SELECT SUM(costo * cantidad) AS total FROM producto_sucursal WHERE id_sucursal =  {$this->getId_sucursal()}";
		$resul = $this->db->query($sql);
		return $resul->fetch_object();
	}
	public function ValInventarioSucursal() {
		$sql = "SELECT SUM(p.costo * ps.cantidad) AS total FROM producto_sucursal ps, producto p WHERE id_sucursal = {$this->getId_sucursal()} AND ps.id_producto = p.id ";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function Guardar() {
		$sql = "INSERT INTO producto_sucursal VALUES (NULL,{$this->getId_producto()},{$this->getId_sucursal()},{$this->getCantidad()},{$this->getStock_minimo()})";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function Actulizar() {
		$sql = "UPDATE producto_sucursal SET id_producto={$this->getId_producto()},id_sucursal={$this->getId_sucursal()},cantidad={$this->getCantidad()},stock_minimo={$this->getStock_minimo()} WHERE id = {$this->getId()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;

	}
	public function Eliminar() {
		$sql = "DELETE FROM producto_sucursal WHERE id_producto = {$this->getId_producto()}";
		$resp = $this->db->query($sql);
		$resul = FALSE;
		if($resp){
			$resul = TRUE;
		}
		return $resul;
	}
	public function VercantidadProductoSucursal() {
		$sql = "SELECT cantidad FROM producto_sucursal WHERE id_producto = {$this->getId_producto()} AND id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ActulizarStockSucursal() {
		$sql = "UPDATE producto_sucursal SET cantidad={$this->getCantidad()}  WHERE id_producto = {$this->getId_producto()} AND id_sucursal = {$this->getId_sucursal()}";
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
		$sql = "SELECT COUNT(id) AS total  FROM producto_sucursal WHERE cantidad_min >= can_inicial";
		$resp = $this->db->query($sql);		
		return $resp;
	}
	public function ListaProductos() {
		$sql = "SELECT p,id,p.codigo,p.costo,p.nombre,p.precio_venta ,s.cantidad, s.stock_minimo FROM producto p , producto_sucursal s WHERE p.id = s.id_producto AND s.id_sucursal = {$this->getId_sucursal()} GROUP BY p.id";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function verproducto() {		
		$sql = "SELECT * FROM producto_sucursal WHERE id_producto = {$this->getId_producto()} AND id_sucursal = {$this->getId_sucursal()}";
		$resp = $this->db->query($sql);		
		return $resp;
	}	
}