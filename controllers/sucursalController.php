<?php

require_once 'models/Sucursal.php';
require_once 'models/Comisiones.php';
require_once 'models/ProductosSucursal.php';
require_once 'models/VentasSucursal.php';
require_once 'models/VentaServicio.php';
require_once 'models/VentaProducto.php';
require_once 'models/ComponenteServicio.php';
require_once 'models/InsumoSucursal.php';
require_once 'models/ClienteVenta.php';
require_once 'models/Parametros.php';
require_once 'models/PrestamosSucursal.php';
require_once 'models/PrestamosEntregadosSucursal.php';
require_once 'models/AbonoPrestamoEmpleado.php';
require_once 'models/Avance.php';
require_once 'models/SaldoPendiente.php';
require_once 'models/PagosEstilista.php';
require_once 'models/AbonoEntregadosPrestamosSucursal.php';

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
				
				$comicion = new Comisiones();
				$detallesComicion = $comicion->MostrarDetalles();
				
				
				if(isset($detallesComicion) != NULL){
					$valorporcentaje =  (int)$detallesComicion->valor;
				}else{
					$valorporcentaje = 1;
				}
				

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
				} else {
					$numVenta = $numRegistro;
				}

				$detallesInsumo = json_decode($listaServicio, TRUE);

				foreach ($detallesInsumo as $key => $value) {
					$id_servicio = $value['id'];

					$insumo = new InsumoSucursal();
					$componente = new ComponenteServicio();

					$componente->setId_servicio($id_servicio);
					$detalles = $componente->verDetalles();
					if ($detalles->num_rows != 0) {
						while ($row2 = $detalles->fetch_object()) {
							$listaDetalles = $row2->detalle;
						}
						$listaInsumo = json_decode($listaDetalles, TRUE);

						foreach ($listaInsumo as $key => $value) {

							$insumo->setId_producto($value['id']);
							$insumo->setId_sucursal($id_sucursal);
							$insumoSer = $insumo->verInsumosId();

							while ($row3 = $insumoSer->fetch_object()) {
								$cantidadInsumo = (int) $row3->cantidad;
							}
							$nuevaCantidad = $cantidadInsumo - (int) $value['cantidad'];



							$insumo->setCantidad($nuevaCantidad);
							$insumo->ActulizarStock();
						}
					}
				}

				
				$totalInterno = ($valorporcentaje / 100) * $total;
					
				$valorinterno = $total - $totalInterno;


				$ventaServicio->setId_sucursal($id_sucursal);
				$ventaServicio->setId_estilista($id_estilista);
				$ventaServicio->setNum_venta($numVenta);
				$ventaServicio->setDetalle($listaServicio);
				$ventaServicio->setFecha($fecha);
				$ventaServicio->setValor($total);
				$ventaServicio->setSaldo($total);
				$ventaServicio->setValorinterno($valorinterno);
				$resp = $ventaServicio->Guardar();

				$IdUltimaventa = $ventaServicio->VerUltimaVentaServicio();

				while ($row4 = $IdUltimaventa->fetch_object()) {
					$idVenta = $row4->id;
				}

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarservico&id=' . $idVenta . '";

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
		if (isset($_POST['id'])) {

			$id = $_POST['id'];
			$valor = $_POST['valor'];

			$servicio = new VentaServicio();
			$servicio->setId($id);
			$detalles = $servicio->verDetallesId();

			while ($row = $detalles->fetch_object()) {
				$valorfactura = (int) $row->valor;
			}
			if ($valor >= $valorfactura) {
				$nuevoSaldo = 0;
			} else {
				$nuevoSaldo = $valorfactura - (int) $valor;
			}

			$servicio->setSaldo($nuevoSaldo);
			$resp = $servicio->Cobrar();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Servicio cobrado Correctamente",
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

							window.location = "ventaservicio";

							}
						})

			  	</script>';
			}
		}
	}

	public function editarventaservicio() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$ventasservicio = new VentaServicio();
			$ventasservicio->setId($id);
			$detalles = $ventasservicio->verDetallesId();

			require_once 'views/sucursal/editarventasservisio.php';
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

	public function verdetallesventaservicio() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$ventasservicio = new VentaServicio();
			$ventasservicio->setId($id);
			$detalles = $ventasservicio->verDetallesId();

			require_once 'views/sucursal/verventasservisio.php';
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

	public function actualizarventasservicio() {
		if ($_POST['id_venta']) {
			$id_venta = $_POST['id_venta'];
			$id_sucursal = $_POST['idSucursal'];
			$id_estilista = $_POST['idBarbero'];
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			$listaServicio = isset($_POST['listaServicio']) ? $_POST['listaServicio'] : FALSE;
			$total = isset($_POST['nuevoTotalServicio']) ? $_POST['nuevoTotalServicio'] : FALSE;

			if ($id_venta && $id_estilista && $fecha && $listaServicio) {

				$comicion = new Comisiones();
				$detallesComicion = $comicion->MostrarDetalles();
				
				
				if(isset($detallesComicion) != NULL){
					$valorporcentaje =  (int)$detallesComicion->valor;
				}else{
					$valorporcentaje = 1;
				}


				$numRegistro = $_POST['numregistro'];


				$ventaServicio = new VentaServicio();
				$ventaServicio->setId($id_venta);
				$ultimaventa = $ventaServicio->verDetallesId();


				while ($row1 = $ultimaventa->fetch_object()) {
					$detallesProducto = $row1->detalle;
				}
				$listaServicioAnt = json_decode($detallesProducto, TRUE);

				foreach ($listaServicioAnt as $key => $value) {
					$id_servicio = $value['id'];

					$insumo = new InsumoSucursal();
					$componente = new ComponenteServicio();

					$componente->setId_servicio($id_servicio);
					$detalles = $componente->verDetalles();
					if ($detalles->num_rows != 0) {
						while ($row2 = $detalles->fetch_object()) {
							$listaDetalles = $row2->detalle;
						}
						$listaInsumo = json_decode($listaDetalles, TRUE);

						foreach ($listaInsumo as $key => $value) {

							$insumo->setId_producto($value['id']);
							$insumo->setId_sucursal($id_sucursal);
							$insumoSer = $insumo->verInsumosId();

							while ($row3 = $insumoSer->fetch_object()) {
								$cantidadInsumo = (int) $row3->cantidad;
							}
							$nuevaCantidad = $cantidadInsumo + (int) $value['cantidad'];



							$insumo->setCantidad($nuevaCantidad);
							$insumo->ActulizarStock();
						}
					}
				}



				$detallesInsumo = json_decode($listaServicio, TRUE);

				foreach ($detallesInsumo as $key => $value) {
					$id_servicio = $value['id'];

					$insumo = new InsumoSucursal();
					$componente = new ComponenteServicio();

					$componente->setId_servicio($id_servicio);
					$detalles = $componente->verDetalles();
					if ($detalles->num_rows != 0) {
						while ($row2 = $detalles->fetch_object()) {
							$listaDetalles = $row2->detalle;
						}
						$listaInsumo = json_decode($listaDetalles, TRUE);

						foreach ($listaInsumo as $key => $value) {

							$insumo->setId_producto($value['id']);
							$insumo->setId_sucursal($id_sucursal);
							$insumoSer = $insumo->verInsumosId();

							while ($row3 = $insumoSer->fetch_object()) {
								$cantidadInsumo = (int) $row3->cantidad;
							}
							$nuevaCantidad = $cantidadInsumo - (int) $value['cantidad'];



							$insumo->setCantidad($nuevaCantidad);
							$insumo->ActulizarStock();
						}
					}
				}
				
				$totalInterno = ($valorporcentaje / 100) * $total;
					
				$valorinterno = $total - $totalInterno;

				$ventaServicio->setId_estilista($id_estilista);
				$ventaServicio->setDetalle($listaServicio);
				$ventaServicio->setValor($total);
				$ventaServicio->setSaldo($total);
				$ventaServicio->setValorinterno($valorinterno);
				$resp = $ventaServicio->Actulizar();

				$idVenta = $id_venta;


				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Actulizado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarservico&id=' . $idVenta . '";

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

	public function eliminarventaservicios() {
		if (isset($_GET['id'])) {

			$id_venta = $_GET['id'];
			$ventaServicio = new VentaServicio();
			$ventaServicio->setId($id_venta);
			$ultimaventa = $ventaServicio->verDetallesId();


			while ($row1 = $ultimaventa->fetch_object()) {
				$detallesProducto = $row1->detalle;
				$id_sucursal = $row1->id_sucursal;
			}
			$listaServicioAnt = json_decode($detallesProducto, TRUE);

			foreach ($listaServicioAnt as $key => $value) {
				$id_servicio = $value['id'];

				$insumo = new InsumoSucursal();
				$componente = new ComponenteServicio();

				$componente->setId_servicio($id_servicio);
				$detalles = $componente->verDetalles();
				if ($detalles->num_rows != 0) {
					while ($row2 = $detalles->fetch_object()) {
						$listaDetalles = $row2->detalle;
					}
					$listaInsumo = json_decode($listaDetalles, TRUE);

					foreach ($listaInsumo as $key => $value) {

						$insumo->setId_producto($value['id']);
						$insumo->setId_sucursal($id_sucursal);
						$insumoSer = $insumo->verInsumosId();

						while ($row3 = $insumoSer->fetch_object()) {
							$cantidadInsumo = (int) $row3->cantidad;
						}
						$nuevaCantidad = $cantidadInsumo + (int) $value['cantidad'];



						$insumo->setCantidad($nuevaCantidad);
						$insumo->ActulizarStock();
					}
				}
			}
			$resp = $ventaServicio->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Registro Actulizado Correctamente",
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
						  title: "Al borrar el registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "principal";

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

							window.location = "principal";

							}
						})

		</script>';
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

	static public function verproductosucursal($id_producto, $id_sucursal) {
		$producto = new ProductoSucursal();
		$producto->setId_producto($id_producto);
		$producto->setId_sucursal($id_sucursal);
		$detalles = $producto->verproducto();
		return $detalles;
	}

	public function guardarventasproducto() {
		if (isset($_POST['idSucursal'])) {

			$id_sucursal = $_POST['idSucursal'];
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			$listaPorducto = isset($_POST['listaProductos']) ? $_POST['listaProductos'] : FALSE;
			$total = isset($_POST['nuevoTotalProducto']) ? $_POST['nuevoTotalProducto'] : FALSE;

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
				} else {
					$numVenta = $numRegistro;
				}

				$detallesPorducto = json_decode($listaPorducto, TRUE);

				foreach ($detallesPorducto as $key => $value) {
					$id_producto = $value['id'];
					$costo = (int) $value['costo'];
					$cantidaV = (int) $value['cantidad'];
					$precio = $value['precio'];


					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$productoSucursal->setId_sucursal($id_sucursal);
					$detalles = $productoSucursal->MostrarProductosSucursal();

					while ($row2 = $detalles->fetch_object()) {
						$cantidaActual = (int) $row2->cantidad;
					}

					$nuevaCantidad = $cantidaActual - $cantidaV;

					$productoSucursal->setCantidad($nuevaCantidad);
					$productoSucursal->ActulizarStockSucursal();

					$totalCosto = $costo * $cantidaV;

					$arrayCosto[] = array('valor' => $totalCosto);
				}

				$arrayCostoTotal = array_column($arrayCosto, 'valor');
				$valortotalCosto = array_sum($arrayCostoTotal);
				$utilidad = (int) $total - (int) $valortotalCosto;

				$ventaProducto->setId_sucursal($id_sucursal);
				$ventaProducto->setNum_venta($numVenta);
				$ventaProducto->setFecha($fecha);
				$ventaProducto->setDetalle($listaPorducto);
				$ventaProducto->setUtilidad($utilidad);
				$ventaProducto->setTotalventa($total);
				$ventaProducto->setTotalcosto($valortotalCosto);
				$ventaProducto->setSaldo($total);
				$resp = $ventaProducto->Guardar();
				//var_dump($resp);
				$IdUltimaventa = $ventaProducto->VerUltimaVenta();

				while ($row4 = $IdUltimaventa->fetch_object()) {
					$idVenta = $row4->id;
				}

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarventa&id=' . $idVenta . '";

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

							window.location = "nuevaventa";

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

							window.location = "nuevaventa";

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

							window.location = "nuevaventa";

							}
						})

			  	</script>';
		}
	}

	public function editarventaproducto() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$ventasProcuto = new VentaProducto();
			$ventasProcuto->setId($id);
			$detalles = $ventasProcuto->verDetallesId();

			require_once 'views/sucursal/editarventasproducto.php';
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
			$ventasProcuto = new VentaProducto();
			$ventasProcuto->setId($id);
			$detalles = $ventasProcuto->verDetallesId();

			require_once 'views/sucursal/verdetallesventasproducto.php';
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
			$id_sucursal = $_POST['idSucursal'];
			if ($id_venta && $listaPorducto) {


				$ventaProducto = new VentaProducto();
				$ventaProducto->setId($id_venta);
				$venta = $ventaProducto->verDetallesId();

				while ($row = $venta->fetch_object()) {
					$detallesProductoAnt = $row->detalles;
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


				$detallesPorducto = json_decode($listaPorducto, TRUE);

				foreach ($detallesPorducto as $key => $value) {
					$id_producto = $value['id'];
					$costo = (int) $value['costo'];
					$cantidaV = (int) $value['cantidad'];
					$precio = $value['precio'];


					$productoSucursal = new ProductoSucursal();
					$productoSucursal->setId_producto($id_producto);
					$productoSucursal->setId_sucursal($id_sucursal);
					$detalles = $productoSucursal->MostrarProductosSucursal();

					while ($row2 = $detalles->fetch_object()) {
						$cantidaActual = (int) $row2->cantidad;
					}

					$nuevaCantidad = $cantidaActual - $cantidaV;

					$productoSucursal->setCantidad($nuevaCantidad);
					$productoSucursal->ActulizarStockSucursal();

					$totalCosto = $costo * $cantidaV;

					$arrayCosto[] = array('valor' => $totalCosto);
				}

				$arrayCostoTotal = array_column($arrayCosto, 'valor');
				$valortotalCosto = array_sum($arrayCostoTotal);
				$utilidad = (int) $total - (int) $valortotalCosto;

				$ventaProducto->setId_sucursal($id_sucursal);
				$ventaProducto->setDetalle($listaPorducto);
				$ventaProducto->setUtilidad($utilidad);
				$ventaProducto->setTotalventa($total);
				$ventaProducto->setTotalcosto($valortotalCosto);
				$ventaProducto->setSaldo($total);
				$resp = $ventaProducto->Actulizar();




				$idVenta = $id_venta;


				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cobrarventa&id=' . $idVenta . '";

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

							window.location = "nuevaventa";

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

							window.location = "nuevaventa";

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

							window.location = "nuevaventa";

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

	static public function verventaproducto($id) {
		$ventaproducto = new VentaProducto();
		$ventaproducto->setId($id);
		$detalles = $ventaproducto->verDetallesId();
		return $detalles;
	}

	public function cobrarventa() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/pagoventa.php';
		require_once 'views/layout/copy.php';
	}

	public function pagarventa() {
		if (isset($_POST['id'])) {

			$id = $_POST['id'];
			$valor = $_POST['valor'];

			$venta = new VentaProducto();
			$venta->setId($id);
			$detalles = $venta->verDetallesId();

			while ($row = $detalles->fetch_object()) {
				$valorfactura = (int) $row->totalventa;
			}
			if ($valor >= $valorfactura) {
				$nuevoSaldo = 0;
			} else {
				$nuevoSaldo = $valorfactura - (int) $valor;
			}

			$venta->setSaldo($nuevoSaldo);
			$resp = $venta->Cobrar();
			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Venta cobrada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "nuevaventa";

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

							window.location = "nuevaventa";

							}
						})

			  	</script>';
			}
		}
	}

	public function listaavences() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/listaavances.php';
		require_once 'views/layout/copy.php';
	}

	public function relizaravance() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/realizaravence.php';
		require_once 'views/layout/copy.php';
	}

	public function guardaravance() {
		if ($_POST['idEmpleado']) {
			$id_empleado = $_POST['idEmpleado'];
			$id_sucursal = $_POST['id_sucursal'];
			$fecha = $_POST['fechaEntrega'];
			$valor = isset($_POST['valor']) ? $_POST ['valor'] : FALSE;
			$estado = 1;
			if ($id_empleado && $valor) {
				$nuevoAvance = new Avance();

				$nuevoAvance->setId_estilista($id_empleado);
				$nuevoAvance->setId_sucursal($id_sucursal);
				$nuevoAvance->setValor($valor);
				$nuevoAvance->setFecha($fecha);
				$nuevoAvance->setEstado($estado);

				$resp = $nuevoAvance->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se logro guardar el abono!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

		</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un Empleado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

		</script>';
		}
	}

	public function veravance() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id_estilista = $_GET['id'];

			$avance = new Avance();
			$avance->setId_estilista($id_estilista);
			$detalles = $avance->MostrarAvancesId();
			$listaAvances = $avance->MostrarAvancesEstilista();
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un Empleado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

		</script>';
		}
		require_once 'views/sucursal/veravance.php';
		require_once 'views/layout/copy.php';
	}

	public function editaravance() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$avance = new Avance();
			$avance->setId($id);
			$detalles = $avance->MostrarAvancesDetalles();
			require_once 'views/sucursal/editaravance.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un Empleado!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

		</script>';
		}
		require_once 'views/layout/copy.php';
	}

	public function actulizaravance() {
		if ($_POST['id']) {

			$id = $_POST['id'];
			$id_empleado = $_POST['idEmpleado'];
			$id_sucursal = $_POST['id_sucursal'];
			$fecha = $_POST['fechaEntrega'];
			$valor = isset($_POST['valor']) ? $_POST ['valor'] : FALSE;
			$estado = 1;
			if ($id_empleado && $valor) {
				$nuevoAvance = new Avance();

				$nuevoAvance->setId($id);
				$nuevoAvance->setId_estilista($id_empleado);
				$nuevoAvance->setId_sucursal($id_sucursal);
				$nuevoAvance->setValor($valor);
				$nuevoAvance->setFecha($fecha);
				$nuevoAvance->setEstado($estado);

				$resp = $nuevoAvance->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Editado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "veravance&id=' . $id_empleado . '";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡No se logro guardar el abono!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizaravance";

							}
						})

		</script>';
				}
			}
		}
	}
	
	public function eliminaravance() {
		if (!empty($_GET['id'])) {
			$id_Avance = $_GET['id'];
			
			$avance = new Avance();
			$avance->setId($id_Avance);
			$resp = $avance->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Registro Eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listaavences";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se logro guardar el abono!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listaavences";

							}
						})

		</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado ningun registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "listaavences";

							}
						})

		</script>';
		}
	}

	public function liquidarpago() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/liquidarpago.php';
		require_once 'views/layout/copy.php';
	}

	public function pagoservicio() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$servicios = new VentaServicio();
			$servicios->setId_estilista($id);
			$detalles = $servicios->MostrarServiciosRealizados();
			$listaServicio = $servicios->verServicioPrestado();
			require_once 'views/sucursal/pagos.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "liquidarpago";

							}
						})

		</script>';
		}
		require_once 'views/layout/copy.php';
	}

	static public function consultaPrestamo($id_estilista) {
		$prestamo = new PrestamosSucursal();
		$prestamo->setId_estilista($id_estilista);
		$valorApagar = $prestamo->MostrarValorApagarDiario();
		return $valorApagar;
	}

	static public function consulataAvances($id_estilista) {
		$avance = new Avance();
		$avance->setId_estilista($id_estilista);
		$valorAvance = $avance->MostrarAvancesId();
		return $valorAvance;
	}

	static public function consulataSaldos($id_estilista) {
		$saldo = new SaldoPendiente();
		$saldo->setId_estilista($id_estilista);
		$valor = $saldo->MostrarSaldosPemienteIdEstilista();
		return $valor;
	}

	public function cerrarpagosestistas() {

		if (isset($_POST['id_estilista'])) {
			$id_estilista = isset($_POST['id_estilista']) ? $_POST['id_estilista'] : FALSE;
			$id_sucursal = isset($_POST['id_sucursal']) ? $_POST['id_sucursal'] : FALSE;
			$totalGenerado = isset($_POST['totalgenerado']) ? $_POST['totalgenerado'] : FALSE;
			$totalAvances = isset($_POST['totalavances']) ? $_POST['totalavances'] : FALSE;
			$totalCouta = isset($_POST['totalCouta']) ? $_POST['totalCouta'] : FALSE;
			$total = isset($_POST['total']) ? $_POST['total'] : FALSE;
			$comision = isset($_POST['comision']) ? $_POST['comision'] : FALSE;
			$saldonuevo = isset($_POST['saldopendiente']) ? $_POST['saldopendiente'] : FALSE;


			if ($id_estilista && $id_sucursal && $totalGenerado) {

				$fecha = date('Y-m-d');


				$avances = new Avance;
				$avances->setId_estilista($id_estilista);
				$avances->setId_sucursal($id_sucursal);
				$avances->Pagar();

				if ($totalCouta != 0) {
					$prestamo = new PrestamosSucursal();
					$prestamo->setId_estilista($id_estilista);
					$detallesPrestamo = $prestamo->MostrarPrestamoEntregadoIdEstilista();

					while ($row = $detallesPrestamo->fetch_object()) {

						$id = $row->id;						
						$saldoPendeinet = (int) $row->saldo;
						$saldoCuota = (int) $row->saldocuota;

						$saldo = $saldoPendeinet - (int)$totalCouta;
						$nuevosaldocuota = $saldoCuota - 1;

						$prestamo->setId($id);
						$prestamo->setSaldo($saldo);
						$prestamo->setSaldocuota($nuevosaldocuota);
						$prestamo->Abonar();
						
					}
					$estado = 1;
					$abonoRecivido = new AbonoEntregadosPrestamosSucursal();
					$abonoRecivido->setId_estilista($id_estilista);
					$abonoRecivido->setFecha($fecha);
					$abonoRecivido->setId_sucursal($id_sucursal);
					$abonoRecivido->setValor($totalCouta);
					$abonoRecivido->setEstado($estado);
					$abonoRecivido->Guardar();
					
				}
				

				$totalDeduciones = (int) $totalAvances + (int) $totalCouta + (int) $saldonuevo;

				$valorDiferencia = $totalDeduciones - $totalGenerado;
				if ($valorDiferencia != 0) {
					$saldoPendienteM = new SaldoPendiente();

					$saldoPendienteM->setId_estilista($id_estilista);
					$saldoPendienteM->Eliminar();

					$saldoPendienteM->setId_sucursal($id_sucursal);
					$saldoPendienteM->setValor($valorDiferencia);
					$saldoPendienteM->setFecha($fecha);

					$saldoPendienteM->Guardar();
				} else {
					$saldoPendienteM = new SaldoPendiente();

					$saldoPendienteM->setId_estilista($id_estilista);
					$saldoPendienteM->Eliminar();
				}


				$ventaServicio = new VentaServicio();
				$ventaServicio->setId_estilista($id_estilista);
				$ventaServicio->PagoEstilista();

				$pago = new PagosEstilista();

				$pago->setId_estilista($id_estilista);
				$pago->setId_sucursal($id_sucursal);
				$pago->setValor($totalGenerado);
				$pago->setValortotal($total);
				$pago->setValorcomision($comision);
				$pago->setFecha($fecha);
				$resp = $pago->Guardar();


				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "liquidarpago";

							}
						})

					</script>';
				} else {
					echo'<script>

					swal({
						  type: "error",
						  title: "¡Error en el registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "liquidarpago";

							}
						})

		</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Error en el registro ss!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "liquidarpago";

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

							window.location = "liquidarpago";

							}
						})

		</script>';
		}
	}
	
	public function pagosrealizados() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/pagosrealizados.php';
		require_once 'views/layout/copy.php';
	}
	
	public function productossucursal() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/listaproductos.php';
		require_once 'views/layout/copy.php';
	}
	
	public function insumossucursal() {
		require_once 'views/layout/menu.php';
		require_once 'views/sucursal/listainsumos.php';
		require_once 'views/layout/copy.php';
	}
	

}
