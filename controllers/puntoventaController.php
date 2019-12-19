<?php

require_once 'models/IniciarVenta.php';

class puntoventaController {

	public function index() {
		require_once 'views/layout/menu.php';
		$iniciarventas = new IniciarVenta();
		$detalles = $iniciarventas->ventasActivas();
		$listacierres = $iniciarventas->MostrarCierres();
		require_once 'views/puntoventa/iniciarVentas.php';
		require_once 'views/layout/copy.php';
	}
	public function vercierre() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$cierre = new IniciarVenta();
			$cierre->setId($id);
			$detalles = $cierre->VerCierres();
			require_once 'views/ventas/ver.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No se puede mostrar cierre de  venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}

		require_once 'views/layout/copy.php';
	}

	public function guardarinicioventa() {
		if ($_POST['basecaja']) {
			$fechainicio = date('Y-m-d');
			$fechacierre = date('Y-m-d');
			$basecaja = $_POST['basecaja'];
			$totalingresos = 0;
			$totalgastos = 0;
			$montoentregado = 0;
			$diferencia = 0;
			$estado = 1;

			$inicioventa = new IniciarVenta();

			$inicioventa->setFechainicio($fechainicio);
			$inicioventa->setFechacierre($fechacierre);
			$inicioventa->setBasecaja($basecaja);
			$inicioventa->setTotalingresos($totalingresos);
			$inicioventa->setTotalgastos($totalgastos);
			$inicioventa->setMontoentregado($montoentregado);
			$inicioventa->setDiferencia($diferencia);
			$inicioventa->setEstado($estado);
			$resp = $inicioventa->InicarVenta();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Punto Venta iniciado  Correctamente",
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
						  title: "¡No se pudo inicar punto de venta !",
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
						  title: "¡No a Elegido una venta !",
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

	public function guardarcierreventa() {
		require_once 'views/layout/menu.php';
		if ($_POST['caja']) {

			$fechacierre = date('Y-m-d');
			$montoentregado = (int) $_POST['caja'];


			$cerrarventa = new IniciarVenta();

			$detalles = $cerrarventa->ventasActivas();

			while ($row = $detalles->fetch_object()) {
				$id = $row->id;
				$basecaja = (int) $row->basecaja;
				$fechainicio = $row->fecha_inicio;
			}

			$ventas = new Venta();
			$totalVentas = $ventas->Ventas($fechainicio, $fechacierre);
			while ($row1 = $totalVentas->fetch_object()) {
				$ventatotal = (int) $row1->total;
			}

			$abonos = new AbonosCliente();
			$totalAbonos = $abonos->AbonosDiarios($fechainicio, $fechacierre);

			while ($row3 = $totalAbonos->fetch_object()) {
				$valorAbonos = $row3->total;
			}

			$gastos = new Gastos();
			$totalGastos = $gastos->Gastos($fechainicio, $fechacierre);
			while ($row2 = $totalGastos->fetch_object()) {
				$gastoGenerado = (int) $row2->total;
			}

			$resultado1 = $montoentregado + $gastoGenerado;
			$montoDiario = $ventatotal + $valorAbonos;
			$diferencia = $resultado1 - $montoDiario;

			$resp = TRUE;


			require_once 'views/puntoventa/confirmarcierre.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a Elegido una venta !",
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

	public function guardarcierre() {
		if ($_POST['id']) {
			$id = $_POST['id'];
			$fechacierre = date('Y-m-d');
			$totalingresos = $_POST['ventatotal'];
			$totalgastos = $_POST['gastototal'];
			$montoentregado = $_POST['montoentregado'];
			$diferencia = $_POST['diferencia'];
			$estado = 0;

			$cierre = new IniciarVenta();

			$cierre->setId($id);
			$cierre->setFechacierre($fechacierre);
			$cierre->setTotalingresos($totalingresos);
			$cierre->setMontoentregado($montoentregado);
			$cierre->setTotalgastos($totalgastos);
			$cierre->setDiferencia($diferencia);
			$cierre->setEstado($estado);

			$resp = $cierre->CerrarVenta();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Punto Venta cerrado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo generar ciere de venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡En cierre de venta !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inicarventas";

							}
						})

			  	</script>';
		}
	}
}