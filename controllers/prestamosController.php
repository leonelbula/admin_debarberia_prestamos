<?php

require_once 'models/Cliente.php';
require_once 'models/Prestamos.php';
require_once 'models/PrestamosEntregados.php';
require_once 'models/AbonoCliente.php';
require_once 'models/EstadoCuenta.php';

class prestamosController {

	public function index() {
		require_once 'views/layout/menu.php';
		$prestamos = new Prestamos();
		$listaPrestamos = $prestamos->MostrarPrestamos();
		require_once 'views/prestamos/listaprestamos.php';
		require_once 'views/layout/copy.php';
	}

	public function cliente() {
		require_once 'views/layout/menu.php';
		require_once 'views/prestamos/listacliente.php';
		require_once 'views/layout/copy.php';
	}

	public function nuevocliente() {
		require_once 'views/layout/menu.php';
		require_once 'views/prestamos/registrarCliente.php';
		require_once 'views/layout/copy.php';
	}

	static public function listaCliente() {
		$cliente = new Cliente();
		$listacliente = $cliente->listarClientes();
		return $listacliente;
	}

	static public function listaClienteId($id) {
		$cliente = new Cliente();
		$cliente->setId($id);
		$listacliente = $cliente->listarClienteId();
		return $listacliente;
	}

	public function guardarcliente() {
		if ($_POST) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$nit = isset($_POST['nit']) ? $_POST['nit'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : FALSE;



			if ($nombre && $nit && $direccion && $ciudad) {
				$cliente = new Cliente();
				$cliente->setNombre(strtoupper($nombre));
				$cliente->setNit($nit);
				$cliente->setDireccion($direccion);
				$cliente->setCiudad(strtoupper($ciudad));
				$cliente->setTelefono($telefono);

				$resp = $cliente->Guargar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cliente";

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

							window.location = "cliente";

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

							window.location = "cliente";

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

							window.location = "cliente";

							}
						})

			  	</script>';
		}
	}

	public function editarcliente() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$cliente = new Cliente();
			$cliente->setId($id);
			$detallesCliente = $cliente->listarClienteId();
			require_once 'views/prestamos/editarCliente.php';
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

							window.location = "cliente";

							}
						})

			  	</script>';
		}
	}

	public function actualizarcliente() {
		if (!empty($_POST['id'])) {
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$nit = isset($_POST['nit']) ? $_POST['nit'] : FALSE;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : FALSE;


			if ($id && $nombre && $nit) {
				$cliente = new Cliente();
				$cliente->setId($id);
				$cliente->setNombre(strtoupper($nombre));
				$cliente->setNit($nit);
				$cliente->setDireccion($direccion);
				$cliente->setCiudad(strtoupper($ciudad));
				$cliente->setTelefono($telefono);

				$resp = $cliente->Actualizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Informacion Guardada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cliente";

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

							window.location = "cliente";

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

							window.location = "cliente";

							}
						})

		</script>';
		}
	}

	public function eliminarcliente() {
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$Cliente = new Cliente();
			$Cliente->setId($id);

			$prestamo = new Prestamos();
			$prestamo->setId_cliente($id);
			$detalles = $prestamo->VerificarCuenta();
			
			if ($detalles->num_rows != 0) {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede Eliminar.. tiene prestamos Entregados !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cliente";

							}
						})

			  	</script>';
			} else {
				
				$resp = $Cliente->Eliminar();
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Cliente Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cliente";

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

							window.location = "cliente";

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

							window.location = "cliente";

							}
						})

		</script>';
		}
	}

	public function relizarprestamo() {
		require_once 'views/layout/menu.php';
		require_once 'views/prestamos/realizarPrestamos.php';
		require_once 'views/layout/copy.php';
	}

	public function guardarprestamos() {
		if ($_POST['idCliente']) {
			$idCliente = $_POST['idCliente'];
			$fechaEntrega = isset($_POST['fechaEntrega']) ? $_POST['fechaEntrega'] : FALSE;
			$interes = isset($_POST['interes']) ? $_POST['interes'] : FALSE;
			$numCuotas = isset($_POST['numCuotas']) ? $_POST['numCuotas'] : FALSE;
			$valor = isset($_POST['valorPrestamo']) ? $_POST['valorPrestamo'] : FALSE;

			if ($idCliente && $interes && $numCuotas && $valor) {


				$fecha = $fechaEntrega;
				$fechaActual = strtotime('+' . $numCuotas . ' day', strtotime($fecha));
				$fechaVencimiento = date('Y-m-d', $fechaActual);


				$plazo = $numCuotas / 30;
				if ($plazo <= 1) {
					$meses = 1;
				} else {
					$meses = $plazo;
				}

				$valorApagar = (((int) $valor * (int) $interes / 100) * $meses) + $valor;
				$cuotas = (int) $valorApagar / (int) $numCuotas;

				$utilidad = (int) $valorApagar - (int) $valor;

				$prestamosEntegados = new PrestamosEntregado();
				$prestamosEntegados->setId_cliente($idCliente);
				$prestamosEntegados->setValor($valor);
				$prestamosEntegados->setFecha($fechaEntrega);
				$res = $prestamosEntegados->Guardar();


				$prestamo = new Prestamos();
				$prestamo->setId_cliente($idCliente);
				$prestamo->setInteres($interes);
				$prestamo->setFecha_entrega($fechaEntrega);
				$prestamo->setFecha_vencimiento($fechaVencimiento);
				$prestamo->setNum_cuotas($numCuotas);
				$prestamo->setValor($valor);
				$prestamo->setValorcuota($cuotas);
				$prestamo->setValortotal((int) $valorApagar);
				$prestamo->setSaldo((int) $valorApagar);
				$prestamo->setCuota_saldo($numCuotas);
				$prestamo->setUtilidad((int) $utilidad);

				$resp = $prestamo->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Prestamo Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

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

							window.location = "relizarprestamo";

							}
						})

		</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡hay campos vacios!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizarprestamo";

							}
						})

		</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizarprestamo";

							}
						})

		</script>';
		}
	}

	public function editarprestamo() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$prestamos = new Prestamos();
			$prestamos->setId($id);
			$detalles = $prestamos->MostrarPrestamosId();
			require_once 'views/prestamos/editarPrestamos.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "relizarprestamo";

							}
						})

		</script>';
		}

		require_once 'views/layout/copy.php';
	}

	public function actuizarprestamos() {
		if ($_POST['id']) {
			$id = $_POST['id'];
			$idCliente = $_POST['idCliente'];
			$fechaEntrega = isset($_POST['fechaEntrega']) ? $_POST['fechaEntrega'] : FALSE;
			$interes = isset($_POST['interes']) ? $_POST['interes'] : FALSE;
			$numCuotas = isset($_POST['numCuotas']) ? $_POST['numCuotas'] : FALSE;
			$valor = isset($_POST['valorPrestamo']) ? $_POST['valorPrestamo'] : FALSE;

			if ($id && $idCliente && $interes && $numCuotas && $valor) {


				$prestamo = new Prestamos();

				$prestamo->setId($id);
				$detalles = $prestamo->MostrarPrestamosId();

				while ($row = $detalles->fetch_object()) {
					$saldo = $row->saldo;
					$valorPrestamo = $row->valor;
					$numCuotaActual = $row->num_cuotas;
					$interesActua = $row->interes;
					$valorTotalActual = $row->valortotal;
					$saldoActual = $row->saldo;
					$cuotasSaldoActual = $row->cuota_saldo;
					$cuotaActual = $row->valorcuota;
					$utilidadActual = $row->utilidad;
					$id_cliente = $row->id_cliente;
				}

				if ($valor != $valorPrestamo || $numCuotas != $numCuotaActual || $interes != $interesActua) {

					$fecha = $fechaEntrega;
					$fechaActual = strtotime('+' . $numCuotas . ' day', strtotime($fecha));
					$fechaVencimiento = date('Y-m-d', $fechaActual);

					$plazo = $numCuotas / 30;
					if ($plazo <= 1) {
						$meses = 1;
					} else {
						$meses = $plazo;
					}

					$valorApagar = (((int) $valor * (int) $interes / 100) * $meses) + $valor;
					$cuotas = (int) $valorApagar / (int) $numCuotas;

					$utilidad = (int) $valorApagar - (int) $valor;
				} else {
					$fecha = $fechaEntrega;
					$fechaActual = strtotime('+' . $numCuotas . ' day', strtotime($fecha));
					$fechaVencimiento = date('Y-m-d', $fechaActual);


					$valor = $valorPrestamo;
					$numCuotas = $numCuotaActual;
					$interes = $interesActua;
					$valorApagar = $valorTotalActual;
					$numCuotas = $cuotasSaldoActual;
					$cuotas = $cuotaActual;
					$utilidad = $utilidadActual;
				}

				if ($saldoActual != $valorApagar) {
					$diferencia = $valorApagar - $valorTotalActual;
					$saldoNuevo = (int) $valorApagar - (int) $diferencia;
				} else {
					$saldoNuevo = $saldo;
				}



				$prestamosEntegados = new PrestamosEntregado();
				$prestamosEntegados->setId_cliente($idCliente);
				$detalleEntr = $prestamosEntegados->MostrarPrestamoEntregadoIdCliente();
				while ($row1 = $detalleEntr->fetch_object()) {
					$idEntregado = $row1->id;
				}
				$prestamosEntegados->setId($idEntregado);
				$prestamosEntegados->setValor($valor);
				$prestamosEntegados->setFecha($fechaEntrega);
				$prestamosEntegados->Actulizar();

				$prestamo->setId_cliente($idCliente);
				$prestamo->setInteres($interes);
				$prestamo->setFecha_entrega($fechaEntrega);
				$prestamo->setFecha_vencimiento($fechaVencimiento);
				$prestamo->setNum_cuotas($numCuotas);
				$prestamo->setValor($valor);
				$prestamo->setValorcuota($cuotas);
				$prestamo->setValortotal((int) $valorApagar);
				$prestamo->setSaldo((int) $saldoNuevo);
				$prestamo->setCuota_saldo($numCuotas);
				$prestamo->setUtilidad((int) $utilidad);

				$resp = $prestamo->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Prestamo Editado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

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

							window.location = "relizarprestamo";

							}
						})

		</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

		</script>';
			}
		}
	}

	public function eliminarprestamos() {
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$prestamo = new Prestamos();
			$prestamo->setId($id);

			$detalles = $prestamo->MostrarPrestamosId();

			while ($row = $detalles->fetch_object()) {
				$id_cliente = $row->id_cliente;
			}

			$prestamoEntregado = new PrestamosEntregado();
			$prestamoEntregado->setId_cliente($id_cliente);
			$detalleEntregado = $prestamoEntregado->MostrarPrestamoEntregadoIdCliente();

			while ($row1 = $detalleEntregado->fetch_object()) {
				$idEntregado = (int) $row1->id;
			}
			$prestamoEntregado->setId($idEntregado);
			$resp = $prestamoEntregado->Eliminar();

			$resp = $prestamo->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Prestamos Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

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

							window.location = "prestamos";

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

							window.location = "cliente";

							}
						})

		</script>';
		}
	}

	public function verprestamo() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$prestamo = new Prestamos();
			$prestamo->setId($id);
			$detalles = $prestamo->MostrarPrestamosId();
			$abonoFactura = new AbonoCliente();
			$abonoFactura->setId_prestamo($id);
			$listaAbono = $abonoFactura->MostrarabonosEntregadoId();
			require_once 'views/prestamos/ver.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

		</script>';
		}
		require_once 'views/layout/copy.php';
	}

	public function abonar() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$prestamo = new Prestamos();
			$prestamo->setId($id);
			$detalles = $prestamo->MostrarPrestamosId();
			require_once 'views/prestamos/abonarPrestamo.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar un prestamo !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

			  	</script>';
		}
		require_once 'views/layout/copy.php';
	}

	static public function detallesPrestamo($id) {

		$prestamo = new Prestamos();
		$prestamo->setId($id);
		$detalles = $prestamo->MostrarPrestamosId();
		return $detalles;
	}

	public function guardarabono() {
		if ($_POST['id']) {
			$id_Prestamo = $_POST['id'];
			$id_cliente = $_POST['idCliente'];
			$abono = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
			$fecha = $_POST['fecha'];

			if ($id_Prestamo && $id_cliente && $abono) {
				$prestamo = new Prestamos();
				$prestamo->setId($id_Prestamo);
				$detallesPrestamo = $prestamo->MostrarPrestamosId();
				while ($row = $detallesPrestamo->fetch_object()) {
					$numCuotas = (int) $row->num_cuotas;
					$saldoPrendiente = (int) $row->saldo;
				}
				$nuevoSaldo = $saldoPrendiente - (int) $abono;
				if ($nuevoSaldo == 0) {
					$saldoCuota = 0;
				} else {
					$saldoCuota = $numCuotas - 1;
				}
				$abonoCliente = new AbonoCliente();
				$abonoCliente->setId_cliente($id_cliente);
				$abonoCliente->setId_prestamo($id_Prestamo);
				$abonoCliente->setValor($abono);
				$abonoCliente->setFecha($fecha);

				$abonoCliente->Guardar();

				$prestamo->setCuota_saldo($saldoCuota);
				$prestamo->setSaldo($nuevoSaldo);



				$resp = $prestamo->Abonar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Abono Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "verprestamo&id=' . $id_Prestamo . '";

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

							window.location = "prestamos";

							}
						})

		</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un prestamo!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

		</script>';
		}
	}

	public function editarabono() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$abono = new AbonoCliente();
			$abono->setId($id);
			$detalles = $abono->MostrarabonosId();
			require_once 'views/prestamos/editarAbono.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar un prestamo !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

			  	</script>';
		}
		require_once 'views/layout/copy.php';
	}

	public function actulizarabono() {
		if ($_POST['id']) {
			$id = $_POST['id'];
			$id_Prestamo = $_POST['idPrestamo'];
			$abono = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
			$abonoAnterio = $_POST['abonoAnterio'];
			$fecha = $_POST['fecha'];

			if ($id && $id_Prestamo && $abono) {

				$prestamo = new Prestamos();
				$prestamo->setId($id_Prestamo);
				$detallesPrestamo = $prestamo->MostrarPrestamosId();

				while ($row = $detallesPrestamo->fetch_object()) {
					$numCuotas = (int) $row->cuotas_saldo;
					$saldoPrendiente = (int) $row->saldo;
				}
				$nuevosaldoPrendiete = $saldoPrendiente + (int) $abonoAnterio;
				$nuevoSaldo = $nuevosaldoPrendiete - (int) $abono;
				if ($nuevoSaldo == 0) {
					$saldoCuota = 0;
				} else {
					$saldoCuota = $numCuotas;
				}
				$abonoCliente = new AbonoCliente();

				$abonoCliente->setId($id);
				$abonoCliente->setValor($abono);
				$abonoCliente->setFecha($fecha);

				$abonoCliente->Actulizar();

				$prestamo->setCuota_saldo($saldoCuota);
				$prestamo->setSaldo($nuevoSaldo);

				$resp = $prestamo->Abonar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Abono actulizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "verprestamo&id=' . $id_Prestamo . '";

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

							window.location = "prestamos";

							}
						})

		</script>';
				}
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un prestamo!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

		</script>';
		}
	}

	public function eliminarabono() {
		if (!empty($_GET['id'])) {
			$idAbono = $_GET['id'];

			$abono = new AbonoCliente();
			$abono->setId($idAbono);
			$detallesAbono = $abono->MostrarabonosId();

			while ($row = $detallesAbono->fetch_object()) {
				$idPrestamo = $row->id_prestamo;
				$valorAbono = (int) $row->valor;
			}

			$prestamo = new Prestamos();
			$prestamo->setId($idPrestamo);
			$detallesPrestamo = $prestamo->MostrarPrestamosId();

			while ($row = $detallesPrestamo->fetch_object()) {
				$numCuotas = (int) $row->num_cuotas;
				$saldoPrendiente = (int) $row->saldo;
			}
			$nuevoSaldo = $saldoPrendiente + $valorAbono;
			$nuevoSaldoCuota = $numCuotas + 1;

			$prestamo->setCuota_saldo($nuevoSaldoCuota);
			$prestamo->setSaldo($nuevoSaldo);

			$prestamo->Abonar();

			$resp = $abono->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Abono Eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "verprestamo&id=' . $idPrestamo . '";

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

							window.location = "prestamos";

							}
						})

		</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un abono!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "prestamos";

							}
						})

		</script>';
		}
	}
	public function estadocuenta() {

		require_once 'views/layout/menu.php';
		$estadoCuenta = new EstadoCuenta();
		$detalles = $estadoCuenta->EstadoCuenta();
		$totalPrestamos = $estadoCuenta->TotalPrestamos();
		require_once 'views/prestamos/estadoCuenta.php';
		require_once 'views/layout/copy.php';
	}
	public function pagorecividos() {
		require_once 'views/layout/menu.php';
		$fecha = date('Y-m-d');
		$abono = new AbonoCliente();
		$abono->setFecha($fecha);
		$detalles = $abono->PagosDiarios();
		require_once 'views/prestamos/pagoRecividos.php';
		require_once 'views/layout/copy.php';
	}
	public function reportes() {
		require_once 'views/layout/menu.php';		
		require_once 'views/prestamos/reportePrestamo.php';
		require_once 'views/layout/copy.php';
	}
}
