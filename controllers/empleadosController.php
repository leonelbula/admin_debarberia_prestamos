<?php

require_once 'models/Empleados.php';
require_once 'models/Estilista.php';

class empleadosController{
	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/empleados/listaEmpleados.php';
		require_once 'views/layout/copy.php';
	}
	static public function estilistas($id) {
		$id_sucursal = $id;
		$estista = new Estilista();
		$estista->setId_sucursal($id_sucursal);
		$detalles = $estista->estilistas();
		return $detalles;
	}
	static public function estilistasId($id) {
		$id = $id;
		$estista = new Estilista();
		$estista->setId($id);
		$detalles = $estista->estilistasId();
		return $detalles;
	}
	public function registrarempleado() {
		if ($_POST['idsucursal']) {
			$id_sucursal = $_POST['idsucursal'];
			$nombre = !empty($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$identificacion = !empty($_POST['identificacion']) ? $_POST['identificacion']:FALSE;
			$telefono = !empty($_POST['telefono']) ? $_POST['telefono']:FALSE;
			$direccion = !empty($_POST['direccion']) ? $_POST['direccion']:FALSE;
			$fechaIngreso = !empty($_POST['fechaingreso']) ? $_POST['fechaingreso']:FALSE;
			
			if($id_sucursal && $nombre){
				$empleado = new Empleados();
				$empleado->setId_sucursal($id_sucursal);
				$empleado->setNombre($nombre);
				$empleado->setNit($identificacion);
				$empleado->setTelefono($telefono);
				$empleado->setDireccion($direccion);
				$empleado->setFechaIngreso($fechaIngreso);
				
				$resp = $empleado->Guardar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Empleado Guardado Correctamente",
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
			
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡En Registro!",
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
	
	public function registrarbarbero() {
		if ($_POST['idsucursal']) {
			$id_sucursal = $_POST['idsucursal'];
			$nombre = !empty($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$identificacion = !empty($_POST['identificacion']) ? $_POST['identificacion']:FALSE;
			$telefono = !empty($_POST['telefono']) ? $_POST['telefono']:FALSE;
			$direccion = !empty($_POST['direccion']) ? $_POST['direccion']:FALSE;
			$fechaIngreso = !empty($_POST['fechaingreso']) ? $_POST['fechaingreso']:FALSE;
			
			if($id_sucursal && $nombre){
				$estilista = new Estilista();
				$estilista->setId_sucursal($id_sucursal);
				$estilista->setNombre($nombre);
				$estilista->setNit($identificacion);
				$estilista->setTelefono($telefono);
				$estilista->setDireccion($direccion);
				$estilista->setFecha_registro($fechaIngreso);
				
				$resp = $estilista->Guardar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Barbero Guardado Correctamente",
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
			
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡En Registro!",
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
