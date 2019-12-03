<?php

require_once 'models/Servicio.php';
require_once 'models/ComponenteServicio.php';

class serviciosController {

	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/servicios/listaServicio.php';
		require_once 'views/layout/copy.php';
	}

	public function nuevoregistro() {
		require_once 'views/layout/menu.php';
		require_once 'views/servicios/nuevoServicio.php';
		require_once 'views/layout/copy.php';
	}

	public function guardarservicio() {
		if ($_POST['nombre']) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$valor = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
			if ($nombre && $valor) {

				$servicio = new Servicio();
				$servicio->setNombre($nombre);
				$servicio->setValor($valor);

				$filefoto = $_FILES['nuevaImagen'];
				$nomFile = time() . $filefoto['name'];
				$type = $filefoto['type'];

				$dir = 'imagen/cortes';

				if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {

					if (!is_dir($dir)) {
						mkdir($dir, 0777, TRUE);
					}
					$servicio->setImg($nomFile);
					move_uploaded_file($filefoto['tmp_name'], $dir . '/' . $nomFile);
				}
				$resp = $servicio->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado Correctamente",
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
			
		}
	}

	public function editar() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {

			$id = $_GET['id'];
			$servicio = new Servicio();
			$servicio->setId($id);
			$detallesServicio = $servicio->verDetalles();

			require_once 'views/servicios/editarServicios.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Seleccione un registro!",
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

	public function actualizar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$nombre = $_POST['nombre'];
			$valor = $_POST['valor'];
			$imgAnterio = $_POST['fotoActual'];

			if ($id && $nombre && $valor) {
				$servico = new Servicio();
				$servico->setId($id);
				$servico->setNombre($nombre);
				$servico->setValor($valor);

				$filefoto = $_FILES['nuevaImagen'];
				$nomFile = time() . $filefoto['name'];
				$type = $filefoto['type'];


				if (!empty($filefoto['name'])) {

					if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
						if (!empty($_POST['fotoActual'])) {
							unlink($dir . '/' . $_POST['fotoActual']);
						}
						$servico->setImg($nomFile);
						move_uploaded_file($file['tmp_name'], $dir . '/' . $nomFile);
					}
				} else {
					$servico->setImg($imgAnterio);
				}
				$resp = $servico->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado Correctamente",
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
						  title: "¡Registro no Editado!",
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
						  title: "¡En registro!",
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

	public function ver() {
		require_once 'views/layout/menu.php';
		require_once 'views/servicios/verServicio.php';
		require_once 'views/layout/copy.php';
	}

	public function eliminar() {
		if (isset($_POST['id'])) {
			
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No se pudo guardar la informacion!",
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

	public function agregarcomponente() {
		require_once 'views/layout/menu.php';
		if (isset($_GET['id'])) {

			$id = $_GET['id'];
			$servicio = new Servicio();
			$servicio->setId($id);
			$detallesServicio = $servicio->verDetalles();
			
			$componente = new ComponenteServicio();
			$componente->setId_servicio($id);
			$Detallescomponente = $componente->verDetalles();

			require_once 'views/servicios/agregarComponentes.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Seleccione un registro!",
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

	public function guardarcomponente() {
		if ($_POST['id']) {
			$id_servicio = $_POST['id'];
			$detalle = $_POST['listaComponente'];
			if ($id_servicio && $detalle) {

				$componente = new ComponenteServicio();
				
				$componente->setId_servicio($id_servicio);
				$compDetalles = $componente->verDetalles();
				
				
				if ($compDetalles->num_rows != 0) {
					$componente->Eliminar();
				}
				
				
				$componente->setDetalle($detalle);
				$resp = $componente->Guardar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro guardado Correctamente",
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
	}

}
