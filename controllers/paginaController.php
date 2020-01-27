<?php

require_once 'models/Pagina.php';

class paginaController{
	
	public function index() {
		require_once 'views/layout/menu.php';		
		require_once 'views/pagina/datospagina.php';
		require_once 'views/layout/copy.php';
	}
	public function actuizarcontenido() {
		require_once 'views/layout/menu.php';		
		require_once 'views/pagina/datospagina.php';
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$titulo = isset($_POST['titulo']) ? $_POST['titulo']:FALSE;
			$titulo2 = isset($_POST['titulo2']) ? $_POST['titulo2']:FALSE;
			
			if($id && $titulo && $titulo2){
				$contenido = new PaginaContenido();
				$contenido->setId($id);
				$contenido->setTitulo($titulo);
				$contenido->setTitulo2($titulo2);
				$resp = $contenido->Editar();
				
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Informacion Actulizada Correctamente",
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
			}else{
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
			
		}else{
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
	
	public function actuizarcontenido2() {
		require_once 'views/layout/menu.php';		
		require_once 'views/pagina/datospagina.php';
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$descripcion = isset($_POST['description']) ? $_POST['description']:FALSE;
						
			if($id && $nombre && $descripcion){
				$contenido = new ContenidoEmpleado();
				$contenido->setId($id);
				$contenido->setNombre($nombre);
				$contenido->setDescripcion($descripcion);
				
				
				$file = $_FILES['editarImagen'];
				$fileNom = $file['name'];
				$type = $file['type'];
				
				$dir = 'imagen/pagina';
				
				if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') {
					
					if(!is_dir($dir)){
						mkdir($dir, 0777,TRUE);
					}
					
					 move_uploaded_file($file['tmp_name'],$dir.'/'.$fileNom);
					
					$contenido->setImg($fileNom);
					
				}else{
					$fileNom = "";
					$contenido->setImg($fileNom);
				}
				
				$resp= $contenido->Editar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Informacion Actulizada Correctamente",
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
			}else{
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
			
		}else{
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
	
	public function actuizarcontenido3() {
		require_once 'views/layout/menu.php';		
		require_once 'views/pagina/datospagina.php';
		if(isset($_POST['id'])){
			$id = $_POST['id'];
			$nombre = isset($_POST['nombre']) ? $_POST['nombre']:FALSE;
			$horrario = isset($_POST['horrario']) ? $_POST['horrario']:FALSE;			
			
			if($id && $nombre && $horrario){
				$contenido = new ContenidoSucursal();
				$contenido->setId($id);
				$contenido->setNombre($nombre);
				$contenido->setHorrario($horrario);				
				
				$file = $_FILES['editarImagen'];
				$fileNom = $file['name'];
				$type = $file['type'];
				
				$dir = 'imagen/pagina';
				
				if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png') {
					
					if(!is_dir($dir)){
						mkdir($dir, 0777,TRUE);
					}
					
					 move_uploaded_file($file['tmp_name'],$dir.'/'.$fileNom);
					
					$contenido->setImg($fileNom);
					
				}else{
					$fileNom = "";
					$contenido->setImg($fileNom);
				}
				
				$resp= $contenido->Editar();
				
				if($resp){
					echo'<script>

					swal({
						  type: "success",
						  title: "Informacion Actulizada Correctamente",
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
			}else{
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
			
		}else{
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
}
