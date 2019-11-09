<?php

require_once 'models/Sucursal.php';

class sucursalController{
	
	public function index() {		
		require_once 'views/layout/menu.php';		
		require_once 'views/sucursal/listasucursal.php';
		require_once 'views/layout/copy.php';
	}	
	
	
}