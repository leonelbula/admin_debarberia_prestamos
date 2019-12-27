<?php
require_once 'models/VentaProducto.php';
require_once 'models/VentaServicio.php';
require_once 'models/Compra.php';
require_once 'models/Productos.php';

class frontendController{
	
	public function index() {		
		require_once 'views/login/login.php';		
	}	
	public function Principal() {
		
		require_once 'views/layout/menu.php';
		$ventasProducto = new VentaProducto();
		$Compra = new Compra();	
		$ventaServicio = new VentaServicio();
		$productos = new Producto();	
		
		
		$totalCompra = $Compra->TotalCompras();
		$totalVentasProductos = $ventasProducto->TotalVentasProducto();
		$totalVentaServicios = $ventaServicio->TotalVentasServicio();
		$totalProductos = $productos->TotalProductos();
		require_once 'views/layout/principal.php';
		require_once 'views/layout/copy.php';
		
	}
	static public function Notificaciones() {
		$notificaciones = new Notificaciones();
		$Notificacion = $notificaciones->MostrarNotificacione();
		return $Notificacion;
	}
	public function usucursal() {
		require_once 'views/sucursal/menusucursal.php';		
		require_once 'views/sucursal/principal.php';
		
	}
}

