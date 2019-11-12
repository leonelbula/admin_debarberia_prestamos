<?php

class productosController {

	public function index() {
		require_once 'views/layout/menu.php';		
		require_once 'views/productos/listaProductos.php';
		require_once 'views/layout/copy.php';
	}

}