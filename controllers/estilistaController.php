<?php

require_once 'models/Estilista.php';

class estilistaController{
	
	static public function estilistas($id) {
		$id_sucursal = $id;
		$estista = new Estilista();
		$estista->setId_sucursal($id_sucursal);
		$detalles = $estista->estilistas();
		return $detalles;
	}
	static public function estilistasId($id) {
		$id = $id;
		$estista = new Estilista();
		$estista->setId($id);
		$detalles = $estista->estilistasId();
		return $detalles;
	}
}