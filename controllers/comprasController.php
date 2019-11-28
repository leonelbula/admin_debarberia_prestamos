<?php

require_once 'models/Productos.php';
require_once 'models/ProductosSucursal.php';
require_once 'models/CompraProducto.php';
require_once 'models/Compra.php';
require_once 'models/Traslado.php';

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
		if (isset($_POST['proveedorCompraN']) && !empty($_POST['proveedorCompraN'])) {



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
				while ($row = $respuest->fetch_object()) {
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

				$productoCompra->CompraProductoRealizada();
			}


			$valorCompra = (int) $_POST['totalCompra'];
			$detalle_compra = $_POST["listaProductos"];

			$id_proveedor = (int) $_POST['proveedorCompraN'];


			$tipo = (int) $_POST['tipoventa'];

			if ($tipo == 1) {
//				$id_plazo = (int)$_POST['plazos'];
//				
//				$plazoinf = new Plazo();
//				$plazoinf->setId($id_plazo);
//				$detallesPlazo = $plazoinf->MostrarPlazoId();
//				
//				while ($row3 = $detallesPlazo->fetch_object()) {
//					$dias = $row3->num_dias;
//				}
				$dias = (int) $_POST['dias'];

				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+' . $dias . ' day', strtotime($fecha));
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
			$compra->setPlazo($dias);
			$compra->setFecha_vencimiento($fecha_vencimiento);
			$compra->setId_proveedor($id_proveedor);
			$compra->setDetalle_compra($detalle_compra);
			$compra->setTotal($valorCompra);
			$compra->setSaldo($saldo);
			$compra->setIva(0);
			$compra->setSub_total(0);



			$resp = $compra->GuardarCompra();


			if ($resp) {
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
			} else {
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
		} else {
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

	public function editarcompra() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {

			$id = $_GET['id'];
			$compra = new Compra();
			$compra->setId($id);
			$detallesCompra = $compra->MostrarComprasId();
			require_once 'views/compras/editarCompra.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}

		require_once 'views/layout/copy.php';
	}

	public function actulizarcompra() {

		if ($_POST['idCompra']) {
			//var_dump($_POST);


			$id_compra = $_POST['idCompra'];
			//ver la venta anterios
			$compAnt = new Compra();
			$compAnt->setId($id_compra);
			$compAn = $compAnt->VerCompra();

			while ($row = $compAn->fetch_object()) {
				$listProductos = $row->detalles;
				$num_factura = $row->num_factura;
				$id_proveedor = $row->id_proveedor;
			}
			//eliminar los productos de la venta a modificar
			$compraProd = new CompraProduto();
			$compraProd->setNum_factura($num_factura);
			$compraProd->EliminarC();


			$listaProductos = json_decode($listProductos, true);
			//actulizamos los productos modidicados
			foreach ($listaProductos as $key => $value) {

				$producto = new Producto();
				$id_producto = $value["id"];

				$producto->setId($id_producto);
				$respuest = $producto->VercantidadProducto();

				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->cantidad;
				}
				$nuevCantidad = $cantidad - $value['cantidad'];

				$producto->setCantidad($nuevCantidad);
				$producto->ActulizarStock();
			}
			//fin de actulizar productos
			if ($_POST["listaProductos"] == '') {
				$detalle_compra = $listProductos;
			} else {
				$detalle_compra = $_POST["listaProductos"];
			}
			$listaProductos = json_decode($detalle_compra, true);
			//modificando las cantidades de los productos		
			$UtilidadP = 0;
			foreach ($listaProductos as $key => $value) {

				$costo = $value['precio'];
				$cantidadC = $value['cantidad'];
				$subTotal = $value['subtotal'];
				$fechaventa = date('y-m-d');

				$producto = new Producto();
				$id_producto = $value["id"];

				$producto->setId($id_producto);
				$respuest = $producto->VercantidadProducto();
				while ($row = $respuest->fetch_object()) {
					$cantidad = $row->cantidad;
				}

				$nuevCantidad = $cantidad + $cantidadC;

				$producto->setCantidad($nuevCantidad);
				$producto->ActulizarStock();

				$productoCompra = new CompraProduto();
				$productoCompra->setId_producto($id_producto);
				$productoCompra->setCantidad($cantidadC);
				$productoCompra->setNum_factura($num_factura);
				$productoCompra->setFecha($fechaventa);

				$productoCompra->CompraProductoRealizada();
			}


			$subTotalCompra = (int) 0;
			$impuesto = (int) 0;
			$valorCompra = (int) $_POST['totalCompra'];


			$tipo = (int) $_POST['tipoventa'];

			if ($tipo == 1) {
//				$id_plazo = (int)$_POST['plazos'];
//				
//				$plazoinf = new Plazo();
//				$plazoinf->setId($id_plazo);
//				$detallesPlazo = $plazoinf->MostrarPlazoId();
//				
//				while ($row3 = $detallesPlazo->fetch_object()) {
//					$dias = $row3->num_dias;
//				}
				$dias = (int) $_POST['dias'];

				$fecha = date('Y-m-d');
				$fechaActual = strtotime('+' . $dias . ' day', strtotime($fecha));
				$fecha_vencimiento = date('Y-m-d', $fechaActual);


				$saldo = $valorCompra;
			} else {
				$fecha = date('Y-m-d');
				$fecha_vencimiento = date('Y-m-d');
				$id_plazo = 0;
				$saldo = 0;
			}

			date_default_timezone_set('America/Bogota');
			$fechaActualFact = date('Y-m-d');
			$horaFactura = date('H:i:s');

			$compra = new Compra();
			$compra->setId($id_compra);
			$compra->setId_proveedor($id_proveedor);
			$compra->setCodigo($num_factura);
			$compra->setFecha($fechaActualFact);
			$compra->setTipo($tipo);
			$compra->setPlazo($dias);
			$compra->setFecha_vencimiento($fecha_vencimiento);
			$compra->setDetalle_compra($detalle_compra);
			$compra->setSub_total($subTotalCompra);
			$compra->setIva($impuesto);
			$compra->setTotal($valorCompra);
			$compra->setSaldo($saldo);

			$resp = $compra->Actulizar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Compra Actulizada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

					</script>';
			} else {
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
		}
	}

	public function eliminarCompra() {
		if (isset($_GET['id'])) {

			$id_compra = $_GET['id'];
			//ver la venta anterios
			$compraAnt = new Compra();
			$compraAnt->setId($id_compra);
			$compraAn = $compraAnt->VerCompra();

			while ($row = $compraAn->fetch_object()) {
				$listProductos = $row->detalles;
				$num_factura = $row->num_factura;
			}
			//eliminar los productos de la venta a modificar
			$compraProd = new CompraProduto();
			$compraProd->setNum_factura($num_factura);
			$compraProd->EliminarC();


			$listaProductos = json_decode($listProductos, true);

			foreach ($listaProductos as $key => $value) {

				$producto = new Producto();
				$id_producto = $value["id"];

				$producto->setId($id_producto);
				$respuest = $producto->VercantidadProducto();

				while ($row = $respuest->fetch_object()) {
					$cantidad = (int) $row->cantidad;
				}
				$nuevCantidad = $cantidad - (int) $value['cantidad'];

				$producto->setCantidad($nuevCantidad);

				$producto->ActulizarStock();
			}


			$compra = new Compra();
			$compra->setId($id_compra);
			$resp = $compra->EliminarCompra();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Compras Eliminada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Eliminado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "compras";

							}
						})

			  	</script>';
			}
		}
	}

	public function trasladomercancia() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/trasladoCompra.php';
		require_once 'views/layout/copy.php';
	}

	public function nuevotraslado() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/nuevotraslado.php';
		require_once 'views/layout/copy.php';
	}

	public function guardartraslado() {
		if (isset($_POST['idSucursal']) && !empty($_POST['idSucursal'])) {
			$id_sucursal = $_POST['idSucursal'];
			$listaProducto = $_POST['listaProductos'];
			$totalTraslado = $_POST['totalTraslado'];
			if ($id_sucursal) {

				$listaProductos = json_decode($_POST["listaProductos"], true);

				foreach ($listaProductos as $key => $value) {

					//array_push($totalProductosComprados, $value["cantidad"]);
					$costo = $value['precio'];
					$cantidadT = $value['cantidad'];
					$id_producto = $value["id"];

					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$detallesProducto = $productoSucursal->VercantidadProductoSucursal();

					while ($row1 = $detallesProducto->fetch_object()) {
						$prodCantidad = $row1->cantidad;
					}

					$nuevCantSucursal = $prodCantidad + $cantidadT;

					$productoSucursal->setCantidad($nuevCantSucursal);
					$productoSucursal->ActulizarStockSucursal();

					$producto = new Producto();

					$producto->setId($id_producto);
					$respuest = $producto->VercantidadProducto();
					while ($row = $respuest->fetch_object()) {
						$cantidad = $row->cantidad;
					}

					$nuevCantidad = $cantidad - $cantidadT;

					$producto->setCantidad($nuevCantidad);
					$producto->ActulizarStock();
				}

				$traslado = new Traslado();


				$fecha = date('Y-m-d');


				$ultimoTraslado = $traslado->VerUltimaTraslado();

				while ($row2 = $ultimoTraslado->fetch_object()) {
					$num_registroAnt = $row2->num_registro;
				}

				if ($num_registroAnt != 0) {
					$num_registro = $num_registroAnt + 1;
				} else {
					$num_registro = 10000;
				}

				$traslado->setId_sucursal($id_sucursal);
				$traslado->setNum_registro($num_registro);
				$traslado->setFecha($fecha);
				$traslado->setDetalle($listaProducto);
				$traslado->setTotal($totalTraslado);

				$resp = $traslado->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede guardar se produjo un Error!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

		</script>';
			}
		}
	}

	public function editartraslado() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id_traslado = $_GET['id'];
			$traslado = new Traslado();
			$traslado->setId($id_traslado);
			$detallesTraslado = $traslado->VerTrasladoId();
			require_once 'views/compras/editartraslado.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

		</script>';
		}

		require_once 'views/layout/copy.php';
	}

	public function actulizartraslado() {
		if (isset($_POST['idTraslado'])) {
			$id_traslado = $_POST['idTraslado'];
			$id_sucursal = $_POST['idSucursal'];
			$listaProducto = $_POST['listaProductos'];
			$totalTraslado = $_POST['totalTraslado'];
			if ($id_traslado && $id_sucursal) {

				$traslado = new Traslado();
				$traslado->setId($id_traslado);
				$detallesTrasl = $traslado->VerTrasladoId();

				while ($row2 = $detallesTrasl->fetch_object()) {
					$detallesProducto = $row2->detalles;
				}
				$Producto = json_decode($detallesProducto, TRUE);

				foreach ($Producto as $key => $value) {

					$id_producto = $value["id"];

					$producto = new Producto();

					$producto->setId($id_producto);
					$respuestProducto = $producto->VercantidadProducto();

					while ($row4 = $respuestProducto->fetch_object()) {
						$cantidadPro = (int) $row4->cantidad;
					}
					$nuevaCantidadProducto = $cantidadPro + (int) $value['cantidad'];

					$producto->setCantidad($nuevaCantidadProducto);
					$producto->ActulizarStock();

					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$ProductoDetalles = $productoSucursal->VercantidadProductoSucursal();

					while ($row3 = $ProductoDetalles->fetch_object()) {
						$cantidaAnt = (int) $row3->cantidad;
					}
					$nuevaCantidad = $cantidaAnt - (int) $value['cantidad'];

					$productoSucursal->setCantidad($nuevaCantidad);
					$productoSucursal->ActulizarStockSucursal();
				}



				$listaProductos = json_decode($_POST["listaProductos"], true);


				foreach ($listaProductos as $key => $value) {

					//array_push($totalProductosComprados, $value["cantidad"]);
					$costo = $value['precio'];
					$cantidadT = $value['cantidad'];
					$id_producto = $value["id"];


					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$detallesProducto = $productoSucursal->VercantidadProductoSucursal();

					while ($row1 = $detallesProducto->fetch_object()) {
						$prodCantidad = $row1->cantidad;
					}

					$nuevCantSucursal = $prodCantidad + $cantidadT;

					$productoSucursal->setCantidad($nuevCantSucursal);
					$productoSucursal->ActulizarStockSucursal();


					$producto->setId($id_producto);
					$respuest = $producto->VercantidadProducto();
					while ($row = $respuest->fetch_object()) {
						$cantidad = $row->cantidad;
					}

					$nuevCantidad = $cantidad - $cantidadT;

					$producto->setCantidad($nuevCantidad);
					$producto->ActulizarStock();
				}

				$traslado = new Traslado();


				$fecha = $_POST['fecha_hora'];
				$traslado->setId($id_traslado);
				$traslado->setId_sucursal($id_sucursal);
				$traslado->setFecha($fecha);
				$traslado->setDetalle($listaProducto);
				$traslado->setTotal($totalTraslado);

				$resp = $traslado->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Modificado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

		</script>';
			}
		}
	}
	
	public function eliminartraslado() {
		if(isset($_GET['id'])){
				$id_traslado = $_GET['id'];
				$traslado = new Traslado();
				$traslado->setId($id_traslado);
				$detallesTrasl = $traslado->VerTrasladoId();

				while ($row2 = $detallesTrasl->fetch_object()) {
					$detallesProducto = $row2->detalles;
				}
				$Producto = json_decode($detallesProducto, TRUE);

				foreach ($Producto as $key => $value) {

					$id_producto = $value["id"];

					$producto = new Producto();

					$producto->setId($id_producto);
					$respuestProducto = $producto->VercantidadProducto();

					while ($row4 = $respuestProducto->fetch_object()) {
						$cantidadPro = (int) $row4->cantidad;
					}
					$nuevaCantidadProducto = $cantidadPro + (int) $value['cantidad'];

					$producto->setCantidad($nuevaCantidadProducto);
					$producto->ActulizarStock();

					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$ProductoDetalles = $productoSucursal->VercantidadProductoSucursal();

					while ($row3 = $ProductoDetalles->fetch_object()) {
						$cantidaAnt = (int) $row3->cantidad;
					}
					$nuevaCantidad = $cantidaAnt - (int) $value['cantidad'];

					$productoSucursal->setCantidad($nuevaCantidad);
					$productoSucursal->ActulizarStockSucursal();
				}
				$traslado->setId($id_traslado);
				$resp = $traslado->Eliminar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

					</script>';
				}else{
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puedo eliminar el registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

		</script>';
				}
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "trasladomercancia";

							}
						})

		</script>';
		}
	}
	
	public function reportescompra() {
		require_once 'views/layout/menu.php';
		require_once 'views/compras/reporte.php';
		require_once 'views/layout/copy.php';
	}
}
