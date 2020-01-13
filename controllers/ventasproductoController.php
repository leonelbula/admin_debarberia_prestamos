<?php

require_once 'models/Vendedores.php';
require_once 'models/ProductosVentas.php';
require_once 'models/Parametros.php';
require_once 'models/VentasProductoVendedor.php';
require_once 'models/AbonosVendedor.php';


class ventasproductoController{
	
	public function index() {		
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/listaventas.php';
		require_once 'views/layout/copy.php';
	}
	public function nuevaventa() {		
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/nuevaventa.php';
		require_once 'views/layout/copy.php';
	}
	public function guardarventa() {
		if (isset($_POST['idVendedor'])) {
			
			$id_vendedor = $_POST['idVendedor'];
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			$listaPorducto = isset($_POST['listaProductos']) ? $_POST['listaProductos'] : FALSE;
			$total = isset($_POST['nuevoTotalVendedor']) ? $_POST['nuevoTotalVendedor'] : FALSE;

			if ($id_vendedor && $fecha && $listaPorducto) {

				$parametros = new Parametros();
				$detallesParrametro = $parametros->MostrarParrametro();

				while ($row = $detallesParrametro->fetch_object()) {
					$numRegistro = $row->num_inicio_factura;
				}

				$ventaProducto = new VentasProductoVendedor();
				$ventaProducto->setId_vendedor($id_vendedor);
				$ultimaventa = $ventaProducto->VerUltimaVenta();

				if ($ultimaventa->num_rows != 0) {
					while ($row1 = $ultimaventa->fetch_object()) {
						$ultimoRegistro = $row1->num_factura;
					}
					$numVenta = $ultimoRegistro + 1;
				} else {
					$numVenta = $numRegistro;
				}

				$detallesPorducto = json_decode($listaPorducto, TRUE);

				foreach ($detallesPorducto as $key => $value) {
					$id_producto = $value['id'];
					$costo = (int) $value['costo'];
					$cantidaV = (int) $value['cantidad'];
					$precio = $value['precio'];


					$producto = new ProductosVentas();
					$producto->setId($id_producto);					
					$detalles = $producto->VercantidadProducto();

					while ($row2 = $detalles->fetch_object()) {
						$cantidaActual = (int) $row2->cantidad;
					}

					$nuevaCantidad = $cantidaActual - $cantidaV;

					$producto->setCantidad($nuevaCantidad);
					$producto->ActulizarStock();

					$totalCosto = $costo * $cantidaV;

					$arrayCosto[] = array('valor' => $totalCosto);
				}

				$arrayCostoTotal = array_column($arrayCosto, 'valor');
				$valortotalCosto = array_sum($arrayCostoTotal);
				$utilidad = (int) $total - (int) $valortotalCosto;

				$ventaProducto->setId_vendedor($id_vendedor);
				$ventaProducto->setNum_venta($numVenta);
				$ventaProducto->setFecha($fecha);
				$ventaProducto->setDetalle($listaPorducto);
				$ventaProducto->setUtilidad($utilidad);
				$ventaProducto->setTotalventa($total);
				$ventaProducto->setTotalcosto($valortotalCosto);
				$ventaProducto->setSaldo($total);
            var_dump($total);
            die();
				$resp = $ventaProducto->Guardar();
				
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
		}
	}

	public function editarventaproducto() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$ventasProcuto = new VentasProductoVendedor();
			$ventasProcuto->setId($id);
			$detalles = $ventasProcuto->verDetallesId();

			require_once 'views/ventaproducto/editarventasproducto.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "principal";

							}
						})

		</script>';
		}
		require_once 'views/layout/copy.php';
	}

	public function verdetalesventaproducto() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$ventasProcuto = new VentasProductoVendedor();
			$ventasProcuto->setId($id);
			$detalles = $ventasProcuto->verDetallesId();

			require_once 'views/ventaproducto/verdetallesventasproducto.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "principal";

							}
						})

		</script>';
		}
		require_once 'views/layout/copy.php';
	}

	public function actulizarventasproducto() {
		if ($_POST['id_venta']) {
			$id_venta = $_POST['id_venta'];
			$listaPorducto = isset($_POST['listaProductos']) ? $_POST['listaProductos'] : FALSE;
			$total = isset($_POST['nuevoTotalProducto']) ? $_POST['nuevoTotalProducto'] : FALSE;
			$id_vendedor = $_POST['idVendedor'];
			if ($id_venta && $listaPorducto) {


				$ventaProducto = new VentasProductoVendedor();
				$ventaProducto->setId($id_venta);
				$venta = $ventaProducto->verDetallesId();

				while ($row = $venta->fetch_object()) {
					$detallesProductoAnt = $row->detalles;
				}

				$detallesPorductoAnt = json_decode($detallesProductoAnt, TRUE);

				foreach ($detallesPorductoAnt as $key => $value) {
					$id_producto = $value['id'];
					$cantidaV = (int) $value['cantidad'];


					$producto = new ProductosVentas();
					$producto->setId($id_producto);
					
					$detalles = $producto->MostrarProductosId();

					while ($row2 = $detalles->fetch_object()) {
						$cantidaActual = (int) $row2->cantidad;
					}

					$nuevaCantidad = $cantidaActual + $cantidaV;

					$producto->setCantidad($nuevaCantidad);
					$producto->ActulizarStock();
				}


				$detallesPorducto = json_decode($listaPorducto, TRUE);

				foreach ($detallesPorducto as $key => $value) {
					$id_producto = $value['id'];
					$costo = (int) $value['costo'];
					$cantidaV = (int) $value['cantidad'];
					$precio = $value['precio'];


					$producto = new ProductosVentas();
					$producto->setId($id_producto);
					
					$detalles = $producto->MostrarProductosId();

					while ($row2 = $detalles->fetch_object()) {
						$cantidaActual = (int) $row2->cantidad;
					}

					$nuevaCantidad = $cantidaActual - $cantidaV;

					$producto->setCantidad($nuevaCantidad);
					$producto->ActulizarStock();

					$totalCosto = $costo * $cantidaV;

					$arrayCosto[] = array('valor' => $totalCosto);
				}

				$arrayCostoTotal = array_column($arrayCosto, 'valor');
				$valortotalCosto = array_sum($arrayCostoTotal);
				$utilidad = (int) $total - (int) $valortotalCosto;

				$ventaProducto->setId_vendedor($id_vendedor);
				$ventaProducto->setDetalle($listaPorducto);
				$ventaProducto->setUtilidad($utilidad);
				$ventaProducto->setTotalventa($total);
				$ventaProducto->setTotalcosto($valortotalCosto);
				$ventaProducto->setSaldo($total);
				$resp = $ventaProducto->Actulizar();
	
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventasproducto";

							}
						})

			  	</script>';
		}
	}

	public function eliminarventaproducto() {
		if (isset($_GET['id'])) {

			$id_venta = $_GET['id'];

			$ventaProducto = new VentaProducto();
			$ventaProducto->setId($id_venta);
			$venta = $ventaProducto->verDetallesId();

			while ($row = $venta->fetch_object()) {
				$detallesProductoAnt = $row->detalles;
				$id_sucursal = $row->id_sucursal;
			}

			$detallesPorductoAnt = json_decode($detallesProductoAnt, TRUE);

			foreach ($detallesPorductoAnt as $key => $value) {
				$id_producto = $value['id'];
				$cantidaV = (int) $value['cantidad'];


				$productoSucursal = new ProductoSucursal();
				$productoSucursal->setId_producto($id_producto);
				$productoSucursal->setId_sucursal($id_sucursal);
				$detalles = $productoSucursal->MostrarProductosSucursal();

				while ($row2 = $detalles->fetch_object()) {
					$cantidaActual = (int) $row2->cantidad;
				}

				$nuevaCantidad = $cantidaActual + $cantidaV;

				$productoSucursal->setCantidad($nuevaCantidad);
				$productoSucursal->ActulizarStockSucursal();
			}
			$resp = $ventaProducto->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Registro Eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "../frontend/principal";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nuevaventa";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Eliminado!",
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

	static public function verproducto($id) {
		$producto = new ProductosVentas();
		$producto->setId($id);
		$detalles = $producto->VercantidadProducto();
		return $detalles;
	}
	
	static public function ListaVendedores() {
		$vendedor = new Vendedores();
		$detalles = $vendedor->listarVendedores();
		return $detalles;
	}
   
	static public function ListaVenta($id) {
		$venta = new VentasProductoVendedor();
		$venta->setId($id);
		$detalles = $venta->verDetallesId();
		return $detalles;
	}
	
    static public function ListaVendedoresId($id) {
		$vendedor = new Vendedores();
      $vendedor->setId($id);
		$detalles = $vendedor->listarVendedoresId();
		return $detalles;
	}
	
	public function vendedores() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/listavendedores.php';
		require_once 'views/layout/copy.php';
	}
	
	public function nuevovendedor() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/registrarvendedor.php';
		require_once 'views/layout/copy.php';
	}
	
	public function guardarvendedor() {
		if ($_POST) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$nit = isset($_POST['nit']) ? $_POST['nit'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : FALSE;



			if ($nombre && $nit && $direccion && $ciudad) {
				$vendedor = new Vendedores();
				$vendedor->setNombre(strtoupper($nombre));
				$vendedor->setNit($nit);
				$vendedor->setDireccion($direccion);
				$vendedor->setCiudad(strtoupper($ciudad));
				$vendedor->setTelefono($telefono);

				$resp = $vendedor->Guargar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Cliente Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

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

							window.location = "vendedores";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

			  	</script>';
		}
	}

	public function editarvendedor() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$vendedor = new Vendedores();
			$vendedor->setId($id);
			$detalles = $vendedor->listarVendedoresId();
			require_once 'views/ventaproducto/editarVendedor.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar cliente a Editar!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

			  	</script>';
		}
	}

	public function actualizarvendedor() {
		if (!empty($_POST['id'])) {
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$nit = isset($_POST['nit']) ? $_POST['nit'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : FALSE;


			if ($id && $nombre && $nit) {
				$vendedor = new Vendedores();
				$vendedor->setId($id);
				$vendedor->setNombre(strtoupper($nombre));
				$vendedor->setNit($nit);
				$vendedor->setDireccion($direccion);
				$vendedor->setCiudad(strtoupper($ciudad));
				$vendedor->setTelefono($telefono);

				$resp = $vendedor->Actualizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Informacion Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

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

							window.location = "vendedores";

							}
						})

			  	</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

		</script>';
		}
	}

	public function eliminarvendedor() {
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$vendedor = new Vendedores();
			$vendedor->setId($id);
			
			$detalles = $vendedor->VerificarVentas();
			
			if ($detalles->num_rows != 0) {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede Eliminar.. tiene Ventas Entregados !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

			  	</script>';
			} else {
				
				$resp = $Cliente->Eliminar();
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Vendedor Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

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

							window.location = "vendedores";

							}
						})

			  	</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Eliminado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "vendedores";

							}
						})

		</script>';
		}
	}

	public function productos() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/listaProductos.php';
		require_once 'views/layout/copy.php';
	}
	
	public function nuevoproductos() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/registrarProducto.php';
		require_once 'views/layout/copy.php';
	}
	
	public function guardarproducto() {
		if (isset($_POST)) {
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$pocentaje_utilidad = isset($_POST['Utilidad']) ? $_POST['Utilidad'] : FALSE;		
			$cantidad_minima = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidainicial = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($costo && $nombre && $pocentaje_utilidad) {
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = (int) $row->codigo_prod;
				}
				if ($estadoCodigo == 1) {
					$producto = new ProductosVentas();
					$ultimoproducto = $producto->MostrarUltimoProductos();

					if ($ultimoproducto->num_rows != 0) {
						while ($row1 = $ultimoproducto->fetch_object()) {
							$utilimoCodigo = $row1->codigo;
						}
						$codigoprod = $utilimoCodigo + 1;
					} else {
						$codigoprod = $codigo;
					}
				} else {
					$codigoprod = $codigoD;
				}
				$utilidad = $costo * $pocentaje_utilidad / 100;

				$precio_venta = ($costo + ($costo * $pocentaje_utilidad / 100));
				
				
				$producto = new ProductosVentas();
				$producto->setCodigo($codigoprod);
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio_venta(intval($precio_venta));
				$producto->setProcentaje_utilidad($pocentaje_utilidad);
				$producto->setUtilidad($utilidad);				
				$producto->setCantidad($cantidainicial);
				$producto->setStock_minimo($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setId_proveedor($id_proveedor);
				
				$resp = $producto->Guardar();
					
								
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

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

							window.location = "productos";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
	}
	
	public function editar() {
		if ($_GET['id']) {
			require_once 'views/layout/menu.php';
			$id_producto = $_GET['id'];
			$producto = new ProductosVentas();
			$producto->setId($id_producto);
			$detallesProductos = $producto->MostrarProductosId();

			require_once 'views/ventaproducto/editarProducto.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
		}
	}
	
	public function actualizarproducto() {
		if ($_POST['id_producto']) {
			$id_producto = $_POST['id_producto'];
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$pocentaje_utilidad = isset($_POST['Utilidad']) ? $_POST['Utilidad'] : FALSE;			
			$cantidad_minima = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidainicial = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($costo && $nombre && $pocentaje_utilidad) {
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigoInicio = (int) $row->codigo_prod;
				}

				$utilidad = $costo * $pocentaje_utilidad / 100;

				$precio_venta = ($costo + ($costo * $pocentaje_utilidad / 100));

				$producto = new ProductosVentas();
				$producto->setId($id_producto);
				$detallesProducto = $producto->MostrarProductosId();

				while ($row1 = $detallesProducto->fetch_object()) {
					$codigoActual = $row1->codigo;
				}

				if ($estadoCodigo == 1) {

					$codigo = $codigoActual;
				} else {

					if ($codigoActual != $codigoD) {
						$codigo = $codigoD;
					} else {
						$codigo = $codigoActual;
					}
				}

				$producto->setCodigo($codigo);
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio_venta(intval($precio_venta));
				$producto->setProcentaje_utilidad($pocentaje_utilidad);
				$producto->setUtilidad($utilidad);				
				$producto->setCantidad($cantidainicial);
				$producto->setStock_minimo($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setId_proveedor($id_proveedor);

				$resp = $producto->Actulizar();
				

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Editado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

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

							window.location = "productos";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
		}
	}
	
	public function eliminarproducto() {
		if ($_GET['id']) {
			$id_producto = $_GET['id'];
			$producto = new ProductosVentas();
			$producto->setId($id_producto);			
			
			
			$resp = $producto->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Producto Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Eliminar producto !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
		}
	}
	
	public function ver() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id_producto = $_GET['id'];
			$productos = new ProductosVentas();
			$productos->setId($id_producto);
			$detallesPro = $productos->MostrarProductosId();
			require_once 'views/ventaproducto/verProducto.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Ver producto !",
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
   
   public function estadocuenta() {
		require_once 'views/layout/menu.php';
		$cuenta = new VentasProductoVendedor();
		$listaEstado = $cuenta->VerVenta();
		require_once 'views/ventaproducto/estadoCuenta.php';
		require_once 'views/layout/copy.php';
	}

	public function verestadocuentavend() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id_vendedor = $_GET['id'];
			$cuenta = new VentasProductoVendedor();
			$cuenta->setId_vendedor($id_vendedor);
			$listaEstado = $cuenta->MostrarComprasVendedor();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar proveedor a Editar!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}


		require_once 'views/ventaproducto/estadoCuentaVendedor.php';
		require_once 'views/layout/copy.php';
	}

	public function abonarfactura() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$cuenta = new VentasProductoVendedor();
			$cuenta->setId($id);
			$listaEstado = $cuenta->verDetallesId();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar proveedor a Editar!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}


		require_once 'views/ventaproducto/abonarfactura.php';
		require_once 'views/layout/copy.php';
	}

	public function guardarabono() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$abono = (int) $_POST['valor'];
			$descripcion = $_POST['descripcion'];
			$fecha = $_POST['fecha'];

			if ($id && $abono && $fecha) {

				$saldoVenta = new VentasProductoVendedor();
				$saldoVenta->setId($id);
				$valorSald = $saldoVenta->verDetallesId();

				while ($row = $valorSald->fetch_object()) {
					$saldoPendiente = (int) $row->saldo;
				}
				if ($saldoPendiente > $abono) {

					$nuevoSaldo = $saldoPendiente - $abono;
					
					$saldoVenta->setSaldo($nuevoSaldo);
					$reptA = $saldoVenta->Abonar();

					$abonoVendedor = new AbonosVendedor();
					$abonoVendedor->setId_factura($id);
					$abonoVendedor->setValor($abono);
					$abonoVendedor->setDescripcion($descripcion);
					$abonoVendedor->setFecha($fecha);

					$reptB = $abonoVendedor->RegistrarAbono();
					
					if ($reptA && $reptB) {
						echo'<script>

						swal({
							  type: "success",
							  title: "Abono registrado Correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "abonosfactura&id=' . $_POST['id'] . '";

								}
							})

						</script>';
					}
				} else {
					echo'<script>

						swal({
							  type: "warning",
							  title: "¡El abono es superior al saldo pendiente!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "abonarfactura&id=' . $_POST['id'] . '";

								}
							})

					</script>';
				}
			} else {
				echo'<script>

						swal({
							  type: "warning",
							  title: "¡El no debe llenar todos los campos!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "abonarfactura&id=' . $_POST['id'] . '";

								}
							})

					</script>';
			}
		}
	}

	public function abonosfactura() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {

			$id_factura = $_GET['id'];

			$abonos = new AbonosVendedor();
			$abonos->setId_factura($id_factura);
			$listaAbono = $abonos->MostrarAbonosId();

			$saldoVenta = new VentasProductoVendedor();
			$saldoVenta->setId($id_factura);
			$valorSald = $saldoVenta->verDetallesId();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar una factura !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estadocuenta";

							}
						})

			  	</script>';
		}
		require_once 'views/ventaproducto/abonosfactura.php';
		require_once 'views/layout/copy.php';
	}

	public function editarAbono() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$abono = new AbonosVendedor();
			$abono->setId($id);
			$DatosAbono = $abono->VerAbonoId();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar una factura !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estadocuenta";

							}
						})

			  	</script>';
		}
		require_once 'views/ventaproducto/editarabonos.php';
		require_once 'views/layout/copy.php';
	}

	public function ActualizarAbono() {
		if ($_POST['id']) {

			$id = isset($_POST['id']) ? $_POST['id'] : FALSE;
			$abonoValor = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
			$descripcion = $_POST['descripcion'];
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;

			if ($id && $abonoValor && $fecha) {


				$abono = new AbonosVendedor();
				$abono->setId($id);
				$DatosAbono = $abono->VerAbonoId();

				while ($row = $DatosAbono->fetch_object()) {
					$id_venta = $row->id_factura;
					$abonoanterior = (int) $row->valor;
				}

				$Venta = new VentasProductoVendedor();
				$Venta->setId($id);
				$detallesVenta = $Venta->verDetallesId();

				while ($row1 = $detallesVenta->fetch_object()) {
					$saldo = (int) $row1->saldo;
				}
				if ($saldo >= $abonoValor) {

					$nuevosaldo = $saldo + $abonoanterior;

					$Venta->setSaldo($nuevosaldo);
					$Venta->Abonar();

					$nuevovalorA = $nuevosaldo - (int) $abonoValor;

					$Venta->setSaldo($nuevovalorA);
					$Venta->Abonar();

					$abono->setId($id);
					$abono->setValor($abonoValor);
					$abono->setDescripcion($descripcion);
					$abono->setFecha($fecha);
					$respt = $abono->EditarAbono();

					if ($respt) {
						echo'<script>

							swal({
								  type: "success",
								  title: "Abono actualizado Correctamente",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
									if (result.value) {

									window.location = "abonosfactura&id=' . $id_venta . '";

									}
								})

							</script>';
					} else {
						echo'<script>

							swal({
							type: "error",
							title: "¡Debe selecionar pago relizado !",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
							  if (result.value) {

							  window.location = "abonarfactura&id=' . $id_venta . '";

							  }
						  })

			  	</script>';
					}
				} else {
					echo'<script>

						swal({
							  type: "warning",
							  title: "¡El abono es superior al saldo pendiente!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "editarabono&id=' . $_POST['id'] . '";

								}
							})

					</script>';
				}
			} else {
				echo'<script>

						swal({
							  type: "warning",
							  title: "¡No debes tener campos vacios!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "editarabono&id=' . $_POST['id'] . '";

								}
							})

				</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar pago relizado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estadocuenta";

							}
						})

			  	</script>';
		}
	}

	public function EliminarAbono() {
		if ($_GET['id']) {

			$id = $_GET['id'];


			$abono = new AbonosVendedor();
			$abono->setId($id);
			$DatosAbono = $abono->VerAbonoId();

			while ($row = $DatosAbono->fetch_object()) {
				$id_compra = $row->id_factura;
				$abonoanterior = (int) $row->valor;
			}

			$Venta = new VentasProductoVendedor();
			$Venta->setId($id);
			$detallesventa = $Venta->verDetallesId();

			while ($row1 = $detallesventa->fetch_object()) {
				$saldo = (int) $row1->saldo;
			}
			$nuevosaldo = $saldo + $abonoanterior;

			$Venta->setSaldo($nuevosaldo);
			$Venta->Abonar();

			$abono->setId($id);

			$respt = $abono->Eliminarbono();

			if ($respt) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Abono Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "abonosfactura&id=' . $id_compra . '";

							}
						})

					</script>';
			} else {
				
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar pago relizado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "estadocuentaproveedor";

							}
						})

			  	</script>';
		}
	}
	public function reportes() {
		require_once 'views/layout/menu.php';
		require_once 'views/ventaproducto/reporte.php';
		require_once 'views/layout/copy.php';
	}
}
