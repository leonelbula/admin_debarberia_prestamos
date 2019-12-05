<?php

require_once 'models/Sucursal.php';
require_once 'models/ProductosSucursal.php';
require_once 'models/VentasSucursal.php';
require_once 'models/VentaServicio.php';
require_once 'models/VentaProducto.php';
require_once 'models/ComponenteServicio.php';
require_once 'models/InsumoSucursal.php';
require_once 'models/ClienteVenta.php';
require_once 'models/Parametros.php';

class sucursalController {

	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/listasucursal.php';
		require_once 'views/layout/copy.php';
	}

	static public function listaSucursal() {
		$sucursal = new Sucursal();
		$listaSucursal = $sucursal->listaSucursal();
		return $listaSucursal;
	}

	static public function SucursalId($id) {
		$sucursal = new Sucursal();
		$sucursal->setId($id);
		$listaSucursal = $sucursal->motrarInformacion();
		return $listaSucursal;
	}

	public function registrar() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/registrar.php';
		require_once 'views/layout/copy.php';
	}

	public function guardar() {
		if (!empty($_POST['nombre'])) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;

			if ($nombre && $direccion) {
				$sucursal = new Sucursal();
				$sucursal->setNombre($nombre);
				$sucursal->setDireccion($direccion);
				$sucursal->setCiudad($ciudad);
				$sucursal->setDepartamento($departamento);
				$sucursal->setFecha($fecha);

				$resp = $sucursal->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Sucuarsal guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo guardar la informacion!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "registar";

							}
						})

			  	</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar todos los campos!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "registar";

							}
						})

			  	</script>';
		}
	}

	public function eliminar() {
		if ($_GET['id']) {

			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$resp = $sucursal->Eliminar();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Sucuarsal eliminada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo eliminar la informacion!",
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
						  title: "¡Debe seleccionar una valor!",
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
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detallesSucursal = $sucursal->motrarInformacion();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe seleccionar una sucursal!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/sucursal/editar.php';
		require_once 'views/layout/copy.php';
	}

	public function actualizar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;

			if ($id && $nombre && $direccion) {
				$sucursal = new Sucursal();
				$sucursal->setId($id);
				$sucursal->setNombre($nombre);
				$sucursal->setDireccion($direccion);
				$sucursal->setCiudad($ciudad);
				$sucursal->setDepartamento($departamento);
				$sucursal->setFecha($fecha);

				$resp = $sucursal->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Sucuarsal editada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo editar la informacion!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "registar";

							}
						})

			  	</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar todos los campos!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "registar";

							}
						})

			  	</script>';
		}
	}

	public function ver() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detallesSucursal = $sucursal->motrarInformacion();

			$detalles = new ProductoSucursal();
			$detalles->setId_sucursal($id);
			$valorInventario = $detalles->ValorInventarioSucursal();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe seleccionar una sucursal!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/sucursal/ver.php';
		require_once 'views/layout/copy.php';
	}

	public function ventassucursal() {
		require_once 'views/layout/menu.php';

		$sucursal = new Sucursal();
		$listaSucursal = $sucursal->listaSucursal();

		require_once 'views/sucursal/ventas.php';
		require_once 'views/layout/copy.php';
	}

	static public function ventasdiarioproductossucursal($id) {
		$ventasSucuarsal = new VentasSucursal();
		$ventasSucuarsal->setId_sucursal($id);
		$ventasSucuarsal->setFecha(date('Y-m-d'));
		$ventaProducto = $ventasSucuarsal->ventasDiariaProcutosSucursal();
		return $ventaProducto;
	}

	static public function ventasdiarioserviciossucursal($id) {
		$ventasSucuarsal = new VentasSucursal();
		$ventasSucuarsal->setId_sucursal($id);
		$ventasSucuarsal->setFecha(date('Y-m-d'));
		$ventaServicio = $ventasSucuarsal->ventasDiariaServicioSucursal();
		return $ventaServicio;
	}

	public function verventas() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detalleSucursal = $sucursal->motrarInformacion();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe seleccionar una sucursal!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventas";

							}
						})

			  	</script>';
		}

		require_once 'views/sucursal/verventas.php';
		require_once 'views/layout/copy.php';
	}

	public function reportes() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/reportes.php';
		require_once 'views/layout/copy.php';
	}

	public function ventaservicio() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/nuevaVentaServicio.php';
		require_once 'views/layout/copy.php';
	}

	public function guardarventasservicio() {
		if (isset($_POST['idBarbero'])) {

			$id_sucursal = $_POST['idSucursal'];
			$id_estilista = $_POST['idBarbero'];
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			$listaServicio = isset($_POST['listaServicio']) ? $_POST['listaServicio'] : FALSE;
			$total = isset($_POST['nuevoTotalServicio']) ? $_POST['nuevoTotalServicio'] : FALSE;

			if ($id_estilista && $fecha && $listaServicio) {

				$parametros = new Parametros();
				$detallesParrametro = $parametros->MostrarParrametro();

				while ($row = $detallesParrametro->fetch_object()) {
					$numRegistro = $row->num_inicio_factura;
				}

				$ventaServicio = new VentaServicio();
				$ventaServicio->setId_sucursal($id_sucursal);
				$ultimaventa = $ventaServicio->VerUltimaVentaServicio();
				
				if ($ultimaventa->num_rows != 0) {
					while ($row1 = $ultimaventa->fetch_object()) {
						$ultimoRegistro = $row1->num_venta;
					}
					$numVenta = $ultimoRegistro + 1;
				}else{
					$numVenta = $numRegistro;
				}
				
				$detallesInsumo = json_decode($listaServicio,TRUE);
				
				foreach ($detallesInsumo as $key => $value) {
					$id_servicio = $value['id'];
					
					$insumo = new InsumoSucursal();
					$componente = new ComponenteServicio();
					
					$componente->setId_servicio($id_servicio);
					$detalles = $componente->verDetalles();
					
					while ($row2 = $detalles->fetch_object()) {
						$listaDetalles = $row2->detalle;
					}
					$listaInsumo = json_decode($listaDetalles,TRUE);
					
					foreach ($listaInsumo as $key => $value) {
																								
						$insumo->setId_producto($value['id']);
						$insumo->setId_sucursal($id_sucursal);
						$insumoSer = $insumo->verInsumosId();
						
						while ($row3 = $insumoSer->fetch_object()) {
							$cantidadInsumo = (int)$row3->cantidad;
						}
						$nuevaCantidad = $cantidadInsumo - (int)$value['cantidad'];
						
							
						
						$insumo->setCantidad($nuevaCantidad);						
						$insumo->ActulizarStock();
						
					}
					
				}
						
										
				
				
				$ventaServicio->setId_sucursal($id_sucursal);
				$ventaServicio->setId_estilista($id_estilista);
				$ventaServicio->setNum_venta($numVenta);
				$ventaServicio->setDetalle($listaServicio);
				$ventaServicio->setFecha($fecha);
				$ventaServicio->setValor($total);
				$ventaServicio->setSaldo($total);
				$resp = $ventaServicio->Guardar();
				
				$IdUltimaventa = $ventaServicio->VerUltimaVentaServicio();
				
				while ($row4 = $IdUltimaventa->fetch_object()) {
					$idVenta = $row4->id;
				}
				
				if ($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Sucuarsal guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarservico&id='.$idVenta.'";

							}
						})

					</script>';
				}else{
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventaservicio";

							}
						})

			  	</script>';
				}
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

							window.location = "ventaservicio";

							}
						})

			  	</script>';
		}
	}
	static public function verventaservicio($id) {
		$ventaservicio = new VentaServicio();
		$ventaservicio->setId($id);
		$detalles = $ventaservicio->verDetallesId();
		return $detalles;
	}
	public function cobrarservico() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/pagoservicio.php';
		require_once 'views/layout/copy.php';
	}
	public function pagarservicio() {
		if(isset($_POST['id'])){
			
			$id = $_POST['id'];
			$valor = $_POST['valor'];
			
			$servicio = new VentaServicio();
			$servicio->setId($id);
			$detalles = $servicio->verDetallesId();
			
			while ($row = $detalles->fetch_object()) {
				$valorfactura = (int)$row->valor;
			}
			if($valor >= $valorfactura){
				$nuevoSaldo = 0;
			}else{
				$nuevoSaldo = $valorfactura - (int)$valor;
			}
			
			$servicio->setSaldo($nuevoSaldo);
			$resp = $servicio-> Cobrar();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta cobrada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventaservicio";

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

							window.location = "listarventas";

							}
						})

			  	</script>';
			}
		}
	}
	
	public function nuevaventa() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/nuevaVenta.php';
		require_once 'views/layout/copy.php';
	}
	static public function listaclientes() {
		$cliente = new ClienteVenta();
		$detalles = $cliente->listarClientes();
		return $detalles;
	}
	static public function listaproductosucursal($id_sucursal) {
		$producto = new ProductoSucursal();
		$producto->setId_sucursal($id_sucursal);
		$detalles = $producto->ListaProductos();
		return $detalles;
		
	}
	public function guardarventasproducto() {
		if (isset($_POST['idSucursal'])) {

			$id_sucursal = $_POST['idSucursal'];			
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			$listaPorducto = isset($_POST['listaProductos']) ? $_POST['listaProductos'] : FALSE;
			$total = isset($_POST['nuevoTotalServicio']) ? $_POST['nuevoTotalServicio'] : FALSE;

			if ($id_sucursal && $fecha && $listaPorducto) {

				$parametros = new Parametros();
				$detallesParrametro = $parametros->MostrarParrametro();

				while ($row = $detallesParrametro->fetch_object()) {
					$numRegistro = $row->num_inicio_factura;
				}

				$ventaProducto = new VentaProducto();
				$ventaProducto->setId_sucursal($id_sucursal);
				$ultimaventa = $ventaProducto->VerUltimaVenta();
				
				if ($ultimaventa->num_rows != 0) {
					while ($row1 = $ultimaventa->fetch_object()) {
						$ultimoRegistro = $row1->num_factura;
					}
					$numVenta = $ultimoRegistro + 1;
				}else{
					$numVenta = $numRegistro;
				}
				
				$detallesPorducto = json_decode($listaPorducto,TRUE);
				
				foreach ($detallesPorducto as $key => $value) {
					$id_producto = $value['id'];
					$costo = $value['costo'];
					$cantidaV = $value['cantidad'];
					$precio = $value['precio'];
										
					
					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$productoSucursal->setId_sucursal($id_sucursal);
					$detalles = $productoSucursal->MostrarProductosSucursal();
					
					var_dump($detalles);			
					
					
					
					
					}
					
				}
						
				
				die();
				
				
				$ventaServicio->setId_sucursal($id_sucursal);
				$ventaServicio->setId_estilista($id_estilista);
				$ventaServicio->setNum_venta($numVenta);
				$ventaServicio->setDetalle($listaServicio);
				$ventaServicio->setFecha($fecha);
				$ventaServicio->setValor($total);
				$ventaServicio->setSaldo($total);
				$resp = $ventaServicio->Guardar();
				
				$IdUltimaventa = $ventaServicio->VerUltimaVentaServicio();
				
				while ($row4 = $IdUltimaventa->fetch_object()) {
					$idVenta = $row4->id;
				}
				
				if ($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Sucuarsal guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarservico&id='.$idVenta.'";

							}
						})

					</script>';
				}else{
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ventaservicio";

							}
						})

			  	</script>';
				}
			
		} else {
			
		}
	}
}
