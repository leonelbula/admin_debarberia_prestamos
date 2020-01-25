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
			$nombre = isset($_POST['titulo']) ? $_POST['titulo']:FALSE;
			$descripcion = isset($_POST['titulo2']) ? $_POST['titulo2']:FALSE;
			
			if($id && $nombre && $descripcion){
				$contenido = new ContenidoEmpleado();
				$contenido->setId($id);
				$contenido->setNombre($nombre);
				$contenido->setDescripcion($descripcion);
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
	public function actuizarcontenido3() {
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
}
