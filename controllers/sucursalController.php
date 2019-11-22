<?php

require_once 'models/Sucursal.php';
require_once 'models/ProductosSucursal.php';
require_once 'models/VentasSucursal.php';

class sucursalController{
	
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
		if(!empty($_POST['nombre'])){
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;			
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			
			if($nombre && $direccion){
				$sucursal = new Sucursal();
				$sucursal->setNombre($nombre);
				$sucursal->setDireccion($direccion);
				$sucursal->setCiudad($ciudad);
				$sucursal->setDepartamento($departamento);
				$sucursal->setFecha($fecha);
				
				$resp = $sucursal->Guardar();
				
				if($resp){
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
				}else{
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
		}else{
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
		if($_GET['id']){
			
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$resp = $sucursal->Eliminar();
			if($resp){
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
			}else{
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
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detallesSucursal = $sucursal->motrarInformacion();	
			
		}else{
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
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;			
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : FALSE;
			$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : FALSE;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : FALSE;
			$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : FALSE;
			
			if($id && $nombre && $direccion){
				$sucursal = new Sucursal();
				$sucursal->setId($id);
				$sucursal->setNombre($nombre);
				$sucursal->setDireccion($direccion);
				$sucursal->setCiudad($ciudad);
				$sucursal->setDepartamento($departamento);
				$sucursal->setFecha($fecha);
				
				$resp = $sucursal->Actulizar();
				
				if($resp){
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
				}else{
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
		}else{
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
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detallesSucursal = $sucursal->motrarInformacion();
			
			$detalles = new ProductoSucursal();
			$detalles->setId_sucursal($id);
			$valorInventario = $detalles->ValorInventarioSucursal();
			
			
		}else{
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
		if($_GET['id']){
			$id = $_GET['id'];
			$sucursal = new Sucursal();
			$sucursal->setId($id);
			$detalleSucursal = $sucursal->motrarInformacion();
		}else{
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
}