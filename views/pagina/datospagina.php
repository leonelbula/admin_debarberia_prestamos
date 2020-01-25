<div class="content-wrapper">  
	<!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Gestor de Pagina

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>Pagina</a></li>

		</ol>
    </section>

    <!-- Main content -->
    <section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Contenidos 1</h3>

			</div>		  
			<div class="box-body">
				<table class=" table table-bordered table-striped dt-responsive tablaContenidoPagina" style="widtablaContenidoPaginath:100%">
					<thead>
						<tr>
							<th>#</th>                
							<th>Titulo 1</th>
							<th>Tituo 2</th>				
							<th>acciones</th>
						</tr>
					</thead>

				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Pagina 
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
    <!-- /.content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Contenidos 2</h3>

			</div>		  
			<div class="box-body">
				<table class=" table table-bordered table-striped dt-responsive tablaContenidoPagina2" style="widtablaContenidoPaginath:100%">
					<thead>
						<tr>
							<th>#</th>                
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Img</th>
							<th>acciones</th>
						</tr>
					</thead>

				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Pagina 
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Contenidos 2</h3>

			</div>		  
			<div class="box-body">
				<table class=" table table-bordered table-striped dt-responsive tablaContenidoPagina3" style="widtablaContenidoPaginath:100%">
					<thead>
						<tr>
							<th>#</th>                
							<th>Nombre</th>
							<th>Horrario</th>
							<th>Img</th>
							<th>acciones</th>
						</tr>
					</thead>

				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				Pagina 
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
</div>

<div id="modalEditarRegistroContenido" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>pagina/actuizarcontenido" enctype="multipart/form-data">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Editar Contenido</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">

						<input type="hidden" name="id" class="id" />

						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<input type="text" class="form-control input-lg  titulo" placeholder="Ingresar Descripcion 1" name="titulo" required> 

							</div> 

						</div>   
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<textarea class="form-control titulo2" rows="3" name="titulo2">
					
								</textarea>
							</div> 

						</div>    

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Editar</button>

				</div>

			</form>


		</div>

	</div>

</div>

<div id="modalEditarRegistroContenido2" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>pagina/actuizarcontenido2" enctype="multipart/form-data">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Editar Contenido 2</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">

						<input type="hidden" name="id" class="id" />

						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<input type="text" class="form-control input-lg  nombre" placeholder="Ingresar Descripcion 1" name="nombre" required> 

							</div> 

						</div>   
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<textarea class="form-control description" rows="3" name="description">
					
								</textarea>
							</div> 

						</div>  

						<div class="form-group">

							<div class="panel">SUBIR IMAGEN</div>

							<input type="file" class="nuevaImagen" name="editarImagen">							

							<p class="help-block">Peso máximo de la imagen 2MB</p>
							<div class="previsualizarImg"></div>
							<img src="<?= URL_BASE ?>image/dancos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

							<input type="hidden" class="img" name="imagenActual" id="imagenActual">

						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Editar</button>

				</div>

			</form>


		</div>

	</div>

</div>

<div id="modalEditarRegistroContenido3" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>pagina/actuizarcontenido3" enctype="multipart/form-data">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Editar Contenido 3</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">

						<input type="hidden" name="id" class="id" />

						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<input type="text" class="form-control input-lg  nombre" placeholder="Ingresar Descripcion 1" name="nombre" required> 

							</div> 

						</div>   
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<textarea class="form-control horrario" rows="3" name="horrario">
					
								</textarea>
							</div> 

						</div>  

						<div class="form-group">

							<div class="panel">SUBIR IMAGEN</div>

							<input type="file" class="nuevaImagen" name="editarImagen">							

							<p class="help-block">Peso máximo de la imagen 2MB</p>
							<div class="previsualizarImg"></div>
							<img src="<?= URL_BASE ?>image/dancos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

							<input type="hidden" class="img" name="imagenActual" id="imagenActual">

						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Editar</button>

				</div>

			</form>


		</div>

	</div>

</div>
