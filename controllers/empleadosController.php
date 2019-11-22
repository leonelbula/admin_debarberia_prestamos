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
	
	public function editarempleado() {
		require_once 'views/layout/menu.php';
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$empleado = new Empleados();
			$empleado->setId($id);
			$detallesEmpleado = $empleado->MostraEmpleadoId();
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a elegido un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/empleados/editarEmpleados.php';
		require_once 'views/layout/copy.php';
	}
	
	public function actulizarempleado() {
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$id_sucursal = $_POST['idsucursal'];
			$nombre = !empty($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$identificacion = !empty($_POST['identificacion']) ? $_POST['identificacion']:FALSE;
			$telefono = !empty($_POST['telefono']) ? $_POST['telefono']:FALSE;
			$direccion = !empty($_POST['direccion']) ? $_POST['direccion']:FALSE;
			$fechaIngreso = !empty($_POST['fechaingreso']) ? $_POST['fechaingreso']:FALSE;
			
			if($id && $id_sucursal && $nombre){
				$empleado = new Empleados();
				$empleado->setId($id);
				$empleado->setId_sucursal($id_sucursal);
				$empleado->setNombre($nombre);
				$empleado->setNit($identificacion);
				$empleado->setTelefono($telefono);
				$empleado->setDireccion($direccion);
				$empleado->setFechaIngreso($fechaIngreso);
				
				$resp = $empleado->Actulizar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro modificado Correctamente",
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
						  title: "¡Registro no Modificado !",
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
	
	public function eliminarempleado() {
		if ($_GET['id']) {
			$id = $_GET['id'];
			$empleado = new Empleados();
			$empleado->setId($id);
			$resp = $empleado->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Registro Eliminado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "indes";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no eliminado !",
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
	
	public function verempleado() {
		require_once 'views/layout/menu.php';
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$empleado = new Empleados();
			$empleado->setId($id);
			$detallesEmpleado = $empleado->MostraEmpleadoId();
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a elegido un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/empleados/verEmpleados.php';
		require_once 'views/layout/copy.php';
	}
	
	public function editarestilista() {
		require_once 'views/layout/menu.php';
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$estlista = new Estilista();
			$estlista->setId($id);
			$detallesEtilista = $estlista->estilistasId();
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a elegido un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/empleados/editarEstilista.php';
		require_once 'views/layout/copy.php';
	}
	
	public function actulizarbarbero() {
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$id_sucursal = $_POST['idsucursal'];
			$nombre = !empty($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$identificacion = !empty($_POST['identificacion']) ? $_POST['identificacion']:FALSE;
			$telefono = !empty($_POST['telefono']) ? $_POST['telefono']:FALSE;
			$direccion = !empty($_POST['direccion']) ? $_POST['direccion']:FALSE;
			$fechaIngreso = !empty($_POST['fechaingreso']) ? $_POST['fechaingreso']:FALSE;
			
			if($id && $id_sucursal && $nombre){
				$empleado = new Estilista();
				$empleado->setId($id);
				$empleado->setId_sucursal($id_sucursal);
				$empleado->setNombre($nombre);
				$empleado->setNit($identificacion);
				$empleado->setTelefono($telefono);
				$empleado->setDireccion($direccion);
				$empleado->setFecha_registro($fechaIngreso);
				
				$resp = $empleado->Actulizar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Registro modificado Correctamente",
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
						  title: "¡Registro no Modificado !",
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
	
	public function eliminarbarbero() {
		if ($_GET['id']) {
			$id = $_GET['id'];
			$empleado = new Estilista();
			$empleado->setId($id);
			$resp = $empleado->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Registro Eliminado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "indes";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no eliminado !",
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
	
	public function verbarbero() {
		require_once 'views/layout/menu.php';
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$empleado = new Estilista();
			$empleado->setId($id);
			$detallesBarbero = $empleado->estilistasId();
		}else{
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No a elegido un registro!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "index";

							}
						})

			  	</script>';
		}
		require_once 'views/empleados/verBarbero.php';
		require_once 'views/layout/copy.php';
	}
}
