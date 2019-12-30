<?php


class vendedoresController {

	public function index() {		
		require_once 'views/vendedor/login.php';		
	}
	public function login() {
		if($_POST){
			var_dump($_POST);
		}else{
			
		}
	}
}

