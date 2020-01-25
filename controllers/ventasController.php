<?php

require_once 'models/Sucursal.php';
require_once 'models/VentasSucursal.php';
require_once 'models/Ventas.php';
require_once 'models/IniciarVenta.php';

class ventasController{
	public function index() {		
		require_once 'views/layout/menu.php';		
		require_once 'views/ventas/listaventas.php';
		require_once 'views/layout/copy.php';
	}	
	public function cierres() {
		require_once 'views/layout/menu.php';		
		require_once 'views/ventas/cierres.php';
		require_once 'views/layout/copy.php';
	}
	public function reportes() {		
		require_once 'views/layout/menu.php';		
		require_once 'views/ventas/reportes.php';
		require_once 'views/layout/copy.php';
	}	
}