<?php

require_once 'models/Categoria.php';
require_once 'models/Productos.php';
require_once 'models/Insumos.php';
require_once 'models/Parametros.php';
require_once 'models/ProductosSucursal.php';
require_once 'models/InsumoSucursal.php';
require_once 'models/Sucursal.php';

class productosController {

	public function index() {
		require_once 'views/layout/menu.php';
		require_once 'views/productos/listaProductos.php';
		require_once 'views/layout/copy.php';
	}

	public function categoria() {
		require_once 'views/layout/menu.php';
		$categoria = new Categoria();
		$listCategoria = $categoria->MostrarCategoria();

		require_once 'views/productos/categoria.php';
		require_once 'views/layout/copy.php';
	}

	public function insumos() {
		require_once 'views/layout/menu.php';
		require_once 'views/productos/insumos.php';
		require_once 'views/layout/copy.php';
	}

	static public function ListaMostrarCategoria() {
		$categoria = new Categoria();
		$listCategoria = $categoria->MostrarCategoria();
		return $listCategoria;
	}

	static public function MostarCategoria($id) {
		if ($id) {
			$id_categoria = $id;
			$categoria = new Categoria();
			$categoria->setId_categoria($id_categoria);
			$detallesCategoria = $categoria->MostrarCategoriaId();
			return $detallesCategoria;
		}
	}

	public function registrarCategoria() {
		if ($_POST) {
			$nombre = isset($_POST['nombreCategoria']) ? $_POST['nombreCategoria'] : FALSE;

			if ($nombre) {

				$categoria = new Categoria();
				$categoria->setNombre($nombre);
				$resp = $categoria->GuardarCategoria();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Categoria Creada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categoria";

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

							window.location = "categoria";

							}
						})

			  	</script>';
				}
			}
		}
	}

	public function actulizar() {
		if ($_POST['IdCategoria']) {
			$id_categoria = $_POST['IdCategoria'];
			$nombre = isset($_POST['nombreCategoria']) ? $_POST['nombreCategoria'] : FALSE;

			if ($id_categoria && $nombre) {

				$categoria = new Categoria();
				$categoria->setId_categoria($id_categoria);
				$categoria->setNombre($nombre);
				$resp = $categoria->EditarCategoria();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Categoria Modificada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categoria";

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

							window.location = "categoria";

							}
						})

			  	</script>';
				}
			}
		}
	}

	public function Eliminar() {
		if ($_GET['id']) {
			$id_categoria = $_GET['id'];
			$cate = new Categoria();
			$cate->setId_categoria($id_categoria);
			$resp = $cate->EliminarCategoria();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Categoria Eliminada Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categoria";

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

							window.location = "categoria";

							}
						})

			  	</script>';
			}
		}
	}

	static public function ListaProductos() {
		$productos = new Inventario();
		$listaProducto = $productos->MostrarProductos();
		return $listaProducto;
	}

	static public function VerProdutoId($id) {
		$producto = new Producto();
		$producto->setId($id);
		$resp = $producto->MostrarProductosId();
		return$resp;
	}

	public function registrar() {
		require_once 'views/layout/menu.php';
		require_once 'views/productos/registrar.php';
		require_once 'views/layout/copy.php';
	}

	public function registrarinsumo() {
		require_once 'views/layout/menu.php';
		require_once 'views/productos/regitrarinsumos.php';
		require_once 'views/layout/copy.php';
	}

	public function GuardarProducto() {
		if (isset($_POST)) {
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$pocentaje_utilidad = isset($_POST['Utilidad']) ? $_POST['Utilidad'] : FALSE;
			$id_categoria = isset($_POST['idcategoria']) ? $_POST['idcategoria'] : FALSE;
			$cantidad_minima = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidainicial = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($costo && $nombre && $pocentaje_utilidad) {
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = (int) $row->codigo_prod;
				}
				if ($estadoCodigo == 1) {
					$producto = new Producto();
					$ultimoproducto = $producto->MostrarUltimoProductos();

					if ($ultimoproducto->num_rows != 0) {
						while ($row1 = $ultimoproducto->fetch_object()) {
							$utilimoCodigo = $row1->codigo;
						}
						$codigoprod = $utilimoCodigo + 1;
					} else {
						$codigoprod = $codigo;
					}
				} else {
					$codigoprod = $codigoD;
				}
				$utilidad = $costo * $pocentaje_utilidad / 100;

				$precio_venta = ($costo + ($costo * $pocentaje_utilidad / 100));
				
				
				$producto = new Producto();
				$producto->setCodigo($codigoprod);
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio_venta(intval($precio_venta));
				$producto->setProcentaje_utilidad($pocentaje_utilidad);
				$producto->setUtilidad($utilidad);
				$producto->setId_categoria($id_categoria);
				$producto->setCantidad($cantidainicial);
				$producto->setStock_minimo($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setId_proveedor($id_proveedor);
				
				$resp = $producto->Guardar();
				
				$sucursal = new Sucursal();
				$detallesSucursal = $sucursal->listaSucursal();
				
				while ($row2 = $detallesSucursal->fetch_object()) {
					
					$ProductoSucursal = new ProductoSucursal();
					$ProductoSucursal->setId_producto($resp);
					$ProductoSucursal->setId_sucursal($row2->id);
					$ProductoSucursal->setCantidad(0);					
					$ProductoSucursal->setStock_minimo($cantidad_minima);
					$ProductoSucursal->Guardar();
				}
				
				
				
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Guardado Correctamente",
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
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
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

	public function guardarinsumo() {
		if ($_POST) {
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$stock = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidad = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($nombre && $costo) {
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = (int) $row->codigo_prod;
				}
				if ($estadoCodigo == 1) {
					$insumo = new Insumo();
					$ultimoInsumo = $insumo->MostrarUltimoInsumos();

					if (isset($ultimoInsumo->num_rows) != 0) {
						while ($row1 = $ultimoInsumo->fetch_object()) {
							$utilimoCodigo = $row1->codigo;
						}
						$codigoInsu = $utilimoCodigo + 1;
					} else {
						$codigoInsu = $codigo;
					}
				} else {
					$codigoInsu = $codigoD;
				}

				$insumo->setCodigo($codigoInsu);
				$insumo->setNombre($nombre);
				$insumo->setCosto($costo);
				$insumo->setCantidad($cantidad);
				$insumo->setStock($stock);
				$insumo->setId_proveedor($id_proveedor);
				$insumo->setCodigo_vendedor($codigo_vendedor);

				$resp = $insumo->Guardar();
				
				$sucursal = new Sucursal();
				$detallesSucursal = $sucursal->listaSucursal();
				
				while ($row2 = $detallesSucursal->fetch_object()) {
					
					$InsumoSucursal = new InsumoSucursal();
					$InsumoSucursal->setId_producto($resp);
					$InsumoSucursal->setId_sucursal($row2->id);
					$InsumoSucursal->setCantidad(0);					
					$InsumoSucursal->setStock_minimo($stock);
					$InsumoSucursal->Guardar();
				}
				
				
				 if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Guardado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

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

							window.location = "insumos";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
		}
	}

	public function editar() {
		if ($_GET['id']) {
			require_once 'views/layout/menu.php';
			$id_producto = $_GET['id'];
			$producto = new Producto();
			$producto->setId($id_producto);
			$detallesProductos = $producto->MostrarProductosId();

			require_once 'views/productos/editar.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
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

	public function editarinsumo() {
		if ($_GET['id']) {
			require_once 'views/layout/menu.php';
			$id_producto = $_GET['id'];
			$insumos = new Insumo();
			$insumos->setId($id_producto);
			$detallesInsumo = $insumos->MostrarInsumosId();

			require_once 'views/productos/editarInsumo.php';
			require_once 'views/layout/copy.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un producto !",
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

	public function actualizarproducto() {
		if ($_POST['id_producto']) {
			$id_producto = $_POST['id_producto'];
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$pocentaje_utilidad = isset($_POST['Utilidad']) ? $_POST['Utilidad'] : FALSE;
			$id_categoria = isset($_POST['idcategoria']) ? $_POST['idcategoria'] : FALSE;
			$cantidad_minima = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidainicial = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($costo && $nombre && $pocentaje_utilidad) {
				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();
				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigoInicio = (int) $row->codigo_prod;
				}

				$utilidad = $costo * $pocentaje_utilidad / 100;

				$precio_venta = ($costo + ($costo * $pocentaje_utilidad / 100));

				$producto = new Producto();
				$producto->setId($id_producto);
				$detallesProducto = $producto->MostrarProductosId();

				while ($row1 = $detallesProducto->fetch_object()) {
					$codigoActual = $row1->codigo;
				}

				if ($estadoCodigo == 1) {

					$codigo = $codigoActual;
				} else {

					if ($codigoActual != $codigoD) {
						$codigo = $codigoD;
					} else {
						$codigo = $codigoActual;
					}
				}

				$producto->setCodigo($codigo);
				$producto->setCosto($costo);
				$producto->setNombre(strtolower($nombre));
				$producto->setPrecio_venta(intval($precio_venta));
				$producto->setProcentaje_utilidad($pocentaje_utilidad);
				$producto->setUtilidad($utilidad);
				$producto->setId_categoria($id_categoria);
				$producto->setCantidad($cantidainicial);
				$producto->setStock_minimo($cantidad_minima);
				$producto->setCodigo_vendedor($codigo_vendedor);
				$producto->setId_proveedor($id_proveedor);

				$resp = $producto->Actulizar();

				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Producto Editado Correctamente",
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
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Debe llenar los campos Obligatorios!",
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
						  title: "¡No A seleccionado un producto !",
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

	public function actulizarinsumo() {
		if ($_POST['id']) {
			$id = $_POST['id'];
			$codigoD = isset($_POST['codigo']) ? $_POST['codigo'] : FALSE;
			$costo = isset($_POST['costo']) ? $_POST['costo'] : FALSE;
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
			$stock = isset($_POST['cantidamin']) ? $_POST['cantidamin'] : FALSE;
			$cantidad = isset($_POST['cantidainicial']) ? $_POST['cantidainicial'] : FALSE;
			$codigo_vendedor = isset($_POST['codigo_vendedor']) ? $_POST['codigo_vendedor'] : FALSE;
			$id_proveedor = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : FALSE;

			if ($nombre && $costo) {

				$par = new Parametros();
				$listaParra = $par->MostrarParrametro();

				while ($row = $listaParra->fetch_object()) {
					$estadoCodigo = $row->generar_codigo;
					$codigo = (int) $row->codigo_prod;
				}

				$insumo = new Insumo();
				$insumo->setId($id);
				$detallesInsumo = $insumo->MostrarInsumosId();

				while ($row1 = $detallesInsumo->fetch_object()) {
					$codigoActual = $row1->codigo;
				}

				if ($estadoCodigo == 1) {

					$codigo = $codigoActual;
				} else {

					if ($codigoActual != $codigoD) {
						$codigo = $codigoD;
					} else {
						$codigo = $codigoActual;
					}
				}

				$insumo->setCodigo($codigo);
				$insumo->setNombre($nombre);
				$insumo->setCosto($costo);
				$insumo->setCantidad($cantidad);
				$insumo->setStock($stock);
				$insumo->setId_proveedor($id_proveedor);
				$insumo->setCodigo_vendedor($codigo_vendedor);

				$resp = $insumo->Actualizar();
				
				if ($resp) {
					echo'<script>

					swal({
						  type: "success",
						  title: "Insumo Actulizado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

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

							window.location = "insumos";

							}
						})

			  	</script>';
				}
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Registro no Guardado !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
			}
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡No A seleccionado un insumo !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
		}
	}

	public function eliminarproducto() {
		if ($_GET['id']) {
			$id_producto = $_GET['id'];
			$producto = new Producto();
			$producto->setId($id_producto);
			
			$productoSuc = new ProductoSucursal();
			$productoSuc->setId_producto($id_producto);
			$productoSuc->Eliminar();
			
			$resp = $producto->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Producto Eliminado Correctamente",
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
						  title: "¡Al Eliminar producto !",
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
	
	public function eliminarinsumo() {
		if ($_GET['id']) {
			$id = $_GET['id'];
			$insumo = new Insumo();
			$insumo->setId($id);
			
			$insumo = new InsumoSucursal();
			$insumo->setId_producto($id_producto);
			$insumo->Eliminar();
			
			$resp = $insumo->Eliminar();

			if ($resp) {
				echo'<script>

					swal({
						  type: "success",
						  title: "Insumo Eliminado Correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

					</script>';
			} else {
				echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Eliminar insumo !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumo";

							}
						})

			  	</script>';
			}
		}
	}

	public function Ver() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id_producto = $_GET['id'];
			$productos = new Producto();
			$productos->setId($id_producto);
			$detallesPro = $productos->MostrarProductosId();
			require_once 'views/productos/ver.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Ver producto !",
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
	
	public function verinsumo() {
		require_once 'views/layout/menu.php';
		if ($_GET['id']) {
			$id = $_GET['id'];
			$insumo = new Insumo();
			$insumo->setId($id);
			$detallesInsumo = $insumo->MostrarInsumosId();
			require_once 'views/productos/verinsumo.php';
		} else {
			echo'<script>

					swal({
						  type: "error",
						  title: "¡Al Ver insumo !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
		}

		require_once 'views/layout/copy.php';
	}

}
