<?php


class frontendController{
	
	public function index() {		
		require_once 'views/login/login.php';		
	}	
	public function Principal() {
		
		require_once 'views/layout/menu.php';		
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

