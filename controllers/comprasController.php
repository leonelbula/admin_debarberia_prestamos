<?php

require_once 'models/Productos.php';
require_once 'models/CompraProducto.php';
require_once 'models/Compra.php';


class comprasController {

	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/listaCompras.php';
		require_once 'views/layout/copy.php';
	}
	public function nuevacompra() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/nuevaCompra.php';
		require_once 'views/layout/copy.php';
	}
	public function guardarcompra() {
		if(isset($_POST['proveedorCompraN'])&& !empty($_POST['proveedorCompraN'])){
			
			
			
			$codigo = $_POST['numFactura'];
				
			
			$listaProductos = json_decode($_POST["listaProductos"], true);
					
			
			foreach ($listaProductos as $key => $value) {

			   //array_push($totalProductosComprados, $value["cantidad"]);
				$costo = $value['precio'];				
				$cantidadC = $value['cantidad'];
				$subTotal = $value['subtotal'];				
				$fechacompra = date('Y-m-d');
				
				$producto = new Producto();
				$id_producto = $value["id"];
				
				$producto->setId($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest-> fetch_object()) {
					$cantidad = $row->cantidad;
				}
				
				$nuevCantidad = $cantidad + $cantidadC;
				
				$producto->setCantidad($nuevCantidad);
				$producto->ActulizarStock();
				
				$productoCompra = new CompraProduto();
				$productoCompra->setId_producto($id_producto);
				$productoCompra->setCantidad($cantidadC);
				$productoCompra->setNum_factura($codigo);
				$productoCompra->setFecha($fechacompra);
				
				//$productoCompra->CompraProductoRealizada();
								
							
			}
						
			
			$valorCompra = (int)$_POST['totalCompra'];
			$detalle_compra = $_POST["listaProductos"];
			
			$id_proveedor = (int)$_POST['proveedorCompraN'];
			
						
			$tipo = (int)$_POST['tipoventa'];
			
			if($tipo == 1){
//				$id_plazo = (int)$_POST['plazos'];
//				
//				$plazoinf = new Plazo();
//				$plazoinf->setId($id_plazo);
//				$detallesPlazo = $plazoinf->MostrarPlazoId();
//				
//				while ($row3 = $detallesPlazo->fetch_object()) {
//					$dias = $row3->num_dias;
//				}
				$dias = (int)$_POST['dias'];
				
				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+'.$dias.' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);
				
								
				$saldo = $valorCompra;
				
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');					
				$id_plazo = 0;
				$saldo = 0;
			}
			$compra = new Compra();
			
			date_default_timezone_set('America/Bogota');
			
			$fechaActualFact = date('Y-m-d');
			
			$compra->setCodigo($codigo);
			$compra->setFecha($fechaActualFact);
			
			$compra->setTipo($tipo);
			$compra->setId_plazo($id_plazo);			
			$compra->setFecha_vencimiento($fecha_vencimiento);
			$compra->setId_proveedor($id_proveedor);
			$compra->setDetalle_compra($detalle_compra);
			$compra->setTotal($valorCompra);
			$compra->setSaldo($saldo);
			$compra->setIva(0);
			$compra->setSub_total(0);
			
			
			
			$resp = $compra->GuardarCompra();
			
			
			if($resp){
				echo'<script>

					swal({
						  type: "success",
						  title: "Compra Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

					</script>';
			}else{
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

			  	</script>';
			}
			
			
			
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede guardar la Compra si seleccionar el cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nuevaventa";

							}
						})

		</script>';
		}
	}
	public function eliminarCompra() {
		
	}
}
