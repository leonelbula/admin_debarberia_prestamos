<?php

require_once 'models/Sucursal.php';
require_once 'models/VentasSucursal.php';
require_once 'models/Ventas.php';

class ventasController{
	public function index() {		
		require_once 'views/layout/menu.php';		
		require_once 'views/ventas/listaventas.php';
		require_once 'views/layout/copy.php';
	}	
}