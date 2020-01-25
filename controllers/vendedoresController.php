<?php

require_once 'models/UsuarioVendedor.php';

class vendedoresController {

	public function index() {		
		require_once 'views/vendedor/login.php';		
	}
	public function login() {
		if($_POST){
			$nombre = $_POST['nombre'];
			$password = $_POST['password'];			
			if($nombre && $password){
				
				$usuario = new UsuarioVendedor();
				$usuario->setNombre($nombre);
				$usuario->setPassword($password);
				
				$identity = $usuario->Login();
				
				if ($identity && is_object($identity)) {
					
					$_SESSION['identity'] = $identity;
					
					if($_SESSION['identity']->estado == 1){
						
						echo'<script>

						swal({
							  type: "success",
							  title: "Acceso exitoso",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
								if (result.value) {

								window.location = "'. URL_BASE .'vendedores/principal";

								}
							})

						</script>';
						}else{
							echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'vendedores/";

										}
									})

							</script>';
						}				
					
				} else {

					echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'vendedores/";

										}
									})

							</script>';
				}
			}
		}else{
			echo'<script>

								swal({
									  type: "error",
									  title: "¡Credenciales de acceso incorrectas !",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result){
										if (result.value) {

										window.location = "'. URL_BASE.'";

										}
									})

							</script>';
		}
	}
	
	public function principal() {
		require_once 'views/vendedor/menu.php';		
		require_once 'views/vendedor/principal.php';
		require_once 'views/layout/footer.php';				
	}
	public function Salir() {
		if (isset($_SESSION['identity'])) {
			unset($_SESSION['identity']);
		}		
		//header('Location:'.URL_BASE);
		echo'<script>
				window.location="' . URL_BASE . 'vendedores/";
			</script>';
	}
}

