<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Registrar nueva sucursal
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Registrar Nuevo Sucursal</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>sucursal/">
					<button class="btn btn-primary">

						Cancelar

					</button>
				</a>
			</div>


			<div class="box-body">


				<div class="row">
					<form action="<?= URL_BASE ?>sucursal/guardar" method="POST" >
						<div class="col-md-6">

							<div class="box box-danger">
								<div class="box-header">
									<h3 class="box-title">Informacion de la sucursal</h3>
								</div>
								<div class="box-body">

									<!-- Date dd/mm/yyyy -->
									<div class="form-group">
										<label>Nombre:</label>

										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-user"></i>
											</div>
											<input type="text" class="form-control" name="nombre" required>
										</div>
										<!-- /.input group -->
									</div>

									<div class="form-group">
										<label>Direccion:</label>

										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bookmark-o"></i>
											</div>
											<input type="text" class="form-control" name="direccion" required>
										</div>
										<!-- /.input group -->
									</div>
									<div class="form-group">
										<label>Departamento:</label>

										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bookmark-o"></i>
											</div>
											<input type="text" class="form-control" name="departamento" required>
										</div>
										<!-- /.input group -->
									</div>
									<div class="form-group">
										<label>Ciudad:</label>

										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-bookmark-o"></i>
											</div>
											<input type="text" class="form-control" name="ciudad" required>
										</div>
										<!-- /.input group -->
									</div>
									<!-- /.form group -->

									<!-- phone mask -->
									<div class="form-group">
										<label>fecha de inicio:</label>

										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="date" class="form-control" name="fecha" required>
										</div>
										<!-- /.input group -->
									</div>

								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->

							<button class="btn btn-primary" type="submit">
								Guardar 
							</button>
							<!-- /.box -->

						</div>

					</form>
				</div>
				<!-- /.row -->

			</div>

		</div>

	</section>

</div>