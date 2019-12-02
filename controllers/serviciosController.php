<?php


require_once 'models/Servicio.php';

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
		if($_POST['nombre']){
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$valor  = isset($_POST['valor']) ? $_POST['valor']:FALSE;
			if($nombre && $valor){
				
				$servicio = new Servicio();
				$servicio->setNombre($nombre);
				$servicio->setValor($valor);
								
				$filefoto = $_FILES['nuevaImagen'];
				$nomFile = time().$filefoto['name'];				
				$type = $filefoto['type'];
				
				$dir = 'imagen/cortes';
				
				if($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg'){
					
					if(!is_dir($dir)){
						mkdir($dir, 0777,TRUE);
					}
					$servicio->setImg($nomFile);
					move_uploaded_file($filefoto['tmp_name'], $dir.'/'.$nomFile);
				}
				$resp = $servicio->Guardar();
				
				if($resp){
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
			
		}
	}
	public function editar() {
		require_once 'views/layout/menu.php';
		require_once 'views/servicios/editarServicios.php';
		require_once 'views/layout/copy.php';
	}
	public function actualizar() {
		
	}
	public function ver() {
		require_once 'views/layout/menu.php';
		require_once 'views/servicios/verServicio.php';
		require_once 'views/layout/copy.php';
	}
	public function eliminar() {
		
	}
	public function agregarcomponente() {
		
	}
	
}