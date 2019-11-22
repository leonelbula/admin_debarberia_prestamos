<?php
require_once '../config/DataBase.php';

class ListaCompras{
	
	public $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}	

	public function MostrarCompras() {
		$sql = "SELECT * FROM compra  ORDER BY id DESC";
		$resul = $this->db->query($sql);
		return $resul;
	}
	public function proveedorId($id) {
		$sql = "SELECT * FROM proveedor  WHERE id = $id";
		$resul = $this->db->query($sql);
		return $resul;
	}
}
class ajaxTablaCompra{
	public function MostrarCompra() {
			
		
		 $datosJson = '{
		  "data":[';
		 $i = 1;
		 $compra = new ListaCompras();
		$listaCompras = $compra->MostrarCompras();
		 while ($row = $listaCompras->fetch_object()) {		
				
			 $id = $row->id_proveedor;
			 $proveedor = $compra->proveedorId($id);
			 
			 while ($row1 = $proveedor->fetch_object()) {
				 $NomProveedor = $row1->nombre;
			 }

  			if($row->tipo == 1){

  				$tipo = "<button class='btn btn-primary btn-xs'>Credito</button>";
  			
  			}else{

  				$tipo = "<button class='btn btn-info btn-xs'>Contado</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
  			

  			$botones =  "<div class='btn-group'><button class='btn btn-info btnImprimirFacturaCompra' numCompra='".$row->num_factura."'><i class='fa fa-print'></i></button><a href='editarcompra&id=".$row->id."'><button class='btn btn-warning  btnEditarCompra'><i class='fa fa-pencil'></i></button></a><button class='btn btn-danger btnEliminarCompra' idcompra='".$row->id."'><i class='fa fa-times'></i></button></div>"; 
  			

  			//$redir = "href='ver&id=".$row->id."'";

  		

		 
		  	$datosJson .='[
			      "'.($i++).'",
				  "'.$row->fecha_compra.'",
			      "'.$row->num_factura.'",
			      "'.$NomProveedor.'",			      			     
			      "'.$row->fecha_vencimiento.'",
				  "'.$row->total.'",
				  "'.$row->saldo.'",
				  "'.$tipo.'",
				  "'.$botones.'"			     
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	

	}	
}

$compra = new ajaxTablaCompra();
$compra->MostrarCompra();