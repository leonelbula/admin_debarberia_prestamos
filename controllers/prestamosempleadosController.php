<?php

require_once 'models/Sucursal.php';

require_once 'models/Parametros.php';
require_once 'models/PrestamosSucursal.php';
require_once 'models/PrestamosEntregadosSucursal.php';
require_once 'models/AbonoPrestamoEmpleado.php';
require_once 'models/AbonoEntregadosPrestamosSucursal.php';
require_once 'models/Estilista.php';

class prestamosempleadosController {

	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/prestamosEmpleados/listaprestamos.php';
		require_once 'views/layout/copy.php';
	}
	
	public function relizarprestamo() {
		require_once 'views/layout/menu.php';
		require_once 'views/prestamosEmpleados/realizarPrestamos.php';
		require_once 'views/layout/copy.php';
	}

	public function guardarprestamos() {
		if ($_POST['idCliente']) {
			$idCliente = $_POST['idCliente'];			
			$fechaEntrega = isset($_POST['fechaEntrega']) ? $_POST['fechaEntrega'] : FALSE;
			$interes = isset($_POST['interes']) ? $_POST['interes'] : FALSE;
			$numCuotas = isset($_POST['numCuotas']) ? $_POST['numCuotas'] : FALSE;
			$valor = isset($_POST['valorPrestamo']) ? $_POST['valorPrestamo'] : FALSE;

			if ($idCliente &&  $interes && $numCuotas && $valor) {
				
				$empleado = new Estilista();
				$empleado->setId($idCliente);
				$detalesEmpleado = $empleado->Mostrarestilistas();
				
				while ($row = $detalesEmpleado->fetch_object()) {
					$id_sucursal = $row->id_sucursal;
				}

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

				$prestamosEntegados = new PrestamosEntregadosSucursal();
				$prestamosEntegados->setId_estilista($idCliente);
				$prestamosEntegados->setId_sucursal($id_sucursal);
				$prestamosEntegados->setValor($valor);
				$prestamosEntegados->setFecha($fechaEntrega);
				$prestamosEntegados->Guardar();


				$prestamo = new PrestamosSucursal();

				$prestamo->setId_estilista($idCliente);
				$prestamo->setId_sucursal($id_sucursal);
				$prestamo->setInteres($interes);
				$prestamo->setFecha($fechaEntrega);
				$prestamo->setFecha_vencimiento($fechaVencimiento);
				$prestamo->setCuotas($numCuotas);
				$prestamo->setValor($valor);
				$prestamo->setValorcuota((int) $cuotas);
				$prestamo->setValortotal((int) $valorApagar);
				$prestamo->setSaldo((int) $valorApagar);
				$prestamo->setSaldocuota($numCuotas);
				$prestamo->setUtilidad((int) $utilidad);

				$resp = $prestamo->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Guardado Correctamente",
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
						  title: "¡Registro no Guardado!",
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
						  title: "¡hay campos vacios!",
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
						  title: "¡No a seleccionado un cliente!",
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

	public function editarprestamo() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$prestamos = new PrestamosSucursal();
			$prestamos->setId($id);
			$detalles = $prestamos->MostrarPrestamosId();

			require_once 'views/prestamosEmpleados/editarPrestamos.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
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

	public function actuizarprestamos() {
		if ($_POST['id']) {
			$id = $_POST['id'];			
			$idCliente = $_POST['idCliente'];
			$fechaEntrega = isset($_POST['fechaEntrega']) ? $_POST['fechaEntrega'] : FALSE;
			$interes = isset($_POST['interes']) ? $_POST['interes'] : FALSE;
			$numCuotas = isset($_POST['numCuotas']) ? $_POST['numCuotas'] : FALSE;
			$valor = isset($_POST['valorPrestamo']) ? $_POST['valorPrestamo'] : FALSE;

			if ($id && $idCliente && $interes && $numCuotas && $valor) {
				
				$empleado = new Estilista();
				$empleado->setId($idCliente);
				$detalesEmpleado = $empleado->Mostrarestilistas();
				
				while ($row = $detalesEmpleado->fetch_object()) {
					$id_sucursal = $row->id_sucursal;
				}

				$prestamo = new PrestamosSucursal();

				$prestamo->setId($id);
				$detalles = $prestamo->MostrarPrestamosId();

				while ($row = $detalles->fetch_object()) {
					$saldo = $row->saldo;
					$valorPrestamo = $row->valor;
					$numCuotaActual = $row->cuotas;
					$interesActua = $row->interes;
					$valorTotalActual = $row->valortotal;
					$saldoActual = (int)$row->saldo;
					$cuotasSaldoActual = $row->saldocuota;
					$cuotaActual = $row->valorcuota;
					$utilidadActual = $row->utilidad;
					$id_cliente = $row->id_estilista;
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
					$diferencia = $valorTotalActual - $saldoActual;
					$saldoNuevo = (int) $valorApagar - (int) $diferencia;
				} else {
					$saldoNuevo = $saldo;
				}
				

				$prestamosEntegados = new PrestamosEntregadosSucursal();
				$prestamosEntegados->setId_estilista($idCliente);
				$detalleEntr = $prestamosEntegados->MostrarPrestamoEntregadoIdEstilista();
				while ($row1 = $detalleEntr->fetch_object()) {
					$idEntregado = $row1->id;
				}
				$prestamosEntegados->setId($idEntregado);
				$prestamosEntegados->setValor($valor);
				$prestamosEntegados->setFecha($fechaEntrega);
				$prestamosEntegados->Actulizar();

				$prestamo->setId_estilista($idCliente);
				$prestamo->setId_sucursal($id_sucursal);
				$prestamo->setInteres($interes);
				$prestamo->setFecha($fechaEntrega);
				$prestamo->setFecha_vencimiento($fechaVencimiento);
				$prestamo->setCuotas($numCuotas);
				$prestamo->setValor($valor);
				$prestamo->setValorcuota($cuotas);
				$prestamo->setValortotal((int) $valorApagar);
				$prestamo->setSaldo((int) $saldoNuevo);
				$prestamo->setSaldocuota($numCuotas);
				$prestamo->setUtilidad((int) $utilidad);
				
				$resp = $prestamo->Actulizar();
				
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro Editado Correctamente",
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
						  title: "¡Registro no Guardado!",
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
						  title: "¡No a seleccionado un cliente!",
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
	}

	public function eliminarprestamos() {
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];
			$prestamo = new PrestamosSucursal();
			$prestamo->setId($id);

			$detalles = $prestamo->MostrarPrestamosId();

			while ($row = $detalles->fetch_object()) {
				$id_cliente = $row->id_estilista;
			}

			$prestamoEntregado = new PrestamosEntregadosSucursal();
			$prestamoEntregado->setId_estilista($id_cliente);
			$detalleEntregado = $prestamoEntregado->MostrarPrestamoEntregadoIdEstilista();

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
						  title: "Registro Eliminado Correctamente",
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
						  title: "¡Registro no Eliminado !",
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
						  title: "¡Registro no Eliminado!",
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

	public function verprestamo() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$prestamo = new PrestamosSucursal();
			$prestamo->setId($id);
			$detalles = $prestamo->MostrarPrestamosId();
			$abonoPrestamo = new AbonoPrestamoEmpleado();
			$abonoPrestamo->setId_prestamo($id);
			$listaAbono = $abonoPrestamo->MostrarabonosEntregadoId();
			require_once 'views/prestamosEmpleados/verdetalles.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a seleccionado un cliente!",
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

	public function abonar() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$prestamo = new PrestamosSucursal();
			$prestamo->setId($id);
			$detalles = $prestamo->MostrarPrestamosId();
			require_once 'views/prestamosEmpleados/abonarPrestamo.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar un prestamo !",
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

	static public function detallesPrestamo($id) {

		$prestamo = new PrestamosSucursal();
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
				$prestamo = new PrestamosSucursal();
				$prestamo->setId($id_Prestamo);
				$detallesPrestamo = $prestamo->MostrarPrestamosId();
				while ($row = $detallesPrestamo->fetch_object()) {
					$numCuotas = (int) $row->cuotas;
					$saldoPrendiente = (int) $row->saldo;
				}
				$nuevoSaldo = $saldoPrendiente - (int) $abono;
				if ($nuevoSaldo == 0) {
					$saldoCuota = 0;
				} else {
					$saldoCuota = $numCuotas - 1;
				}
				$abonoCliente = new AbonoPrestamoEmpleado();				
				$abonoCliente->setId_estilista($id_cliente);
				$abonoCliente->setId_prestamo($id_Prestamo);
				$abonoCliente->setValor($abono);
				$abonoCliente->setFecha($fecha);

				$abonoCliente->Guardar();


				$prestamo->setSaldocuota($saldoCuota);
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

							window.location = "verprestamo&id=' . $id_Prestamo . '";

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

							window.location = "index";

							}
						})

		</script>';
		}
	}

	public function editarabono() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$abono = new AbonoPrestamoEmpleado();
			$abono->setId($id);
			$detalles = $abono->MostrarabonosId();

			require_once 'views/prestamosEmpleados/editarAbono.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe selecionar un prestamo !",
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

	public function actulizarabono() {
		if ($_POST['id']) {
			$id = $_POST['id'];			
			$id_Prestamo = $_POST['idPrestamo'];
			$abono = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
			$abonoAnterio = $_POST['abonoAnterio'];
			$fecha = $_POST['fecha'];

			if ($id && $id_Prestamo && $abono) {

				$prestamo = new PrestamosSucursal();
				$prestamo->setId($id_Prestamo);
				$detallesPrestamo = $prestamo->MostrarPrestamosId();

				while ($row = $detallesPrestamo->fetch_object()) {
					$numCuotas = (int) $row->saldocuota;
					$saldoPrendiente = (int) $row->saldo;
				}
				$nuevosaldoPrendiete = $saldoPrendiente + (int) $abonoAnterio;
				$nuevoSaldo = $nuevosaldoPrendiete - (int) $abono;
				if ($nuevoSaldo == 0) {
					$saldoCuota = 0;
				} else {
					$saldoCuota = $numCuotas;
				}
				$abonoCliente = new AbonoPrestamoEmpleado();

				$abonoCliente->setId($id);
				$abonoCliente->setValor($abono);
				$abonoCliente->setFecha($fecha);

				$abonoCliente->Actulizar();

				$prestamo->setSaldocuota($saldoCuota);
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

							window.location = "index";

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

							window.location = "index";

							}
						})

		</script>';
		}
	}

	public function eliminarabono() {
		if (!empty($_GET['id'])) {
			$idAbono = $_GET['id'];

			$abono = new AbonoPrestamoEmpleado();
			$abono->setId($idAbono);
			$detallesAbono = $abono->MostrarabonosId();

			while ($row = $detallesAbono->fetch_object()) {
				$idPrestamo = $row->id_prestamo;
				$valorAbono = (int) $row->valor;
			}

			$prestamo = new PrestamosSucursal();
			$prestamo->setId($idPrestamo);
			$detallesPrestamo = $prestamo->MostrarPrestamosId();

			while ($row = $detallesPrestamo->fetch_object()) {
				$numCuotas = (int) $row->saldocuota;
				$saldoPrendiente = (int) $row->saldo;
			}
			$nuevoSaldo = $saldoPrendiente + $valorAbono;
			$nuevoSaldoCuota = $numCuotas + 1;

			$prestamo->setSaldocuota($nuevoSaldoCuota);
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

							window.location = "index";

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

							window.location = "index";

							}
						})

		</script>';
		}
	}

}