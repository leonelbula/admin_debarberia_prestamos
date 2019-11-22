<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Lista Empleados
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Gestor Empleados</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">

						Agregar Empleados

					</button>
				</a>
				<a>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBarbero">

						Agregar Barbero

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="col-xs-6">
					<h4>Lista Empleados</h4>
					<table class="table table-bordered table-striped dt-responsive tablaempleados" width="100%">

						<thead>

							<tr>
								<th style="width:10px">Codigo</th>
								<th>fecha Ingreso</th>  			 
								<th>Nombre</th>	
								<th>telefono</th>
								<th>Sucursal</th>
								<th>Acciones</th>
							</tr>

						</thead>
						<tbody>

						</tbody>

					</table> 
				</div>
				<div class="col-xs-6">
					<h4>Lista Barberos</h4>
					<table class="table table-bordered table-striped dt-responsive tablabarbero" width="100%">

						<thead>

							<tr>

								<th style="width:10px">Codigo</th>
								<th>fecha Ingreso</th>  			 
								<th>Nombre</th>	
								<th>telefono</th>	
								<th>Sucursal</th>	
								<th>Acciones</th>
							</tr>

						</thead>
						<tbody>

						</tbody>

					</table> 
				</div>
			</div>


		</div>
		<div class="box-footer">
			Empleados
        </div>

	</section>

</div>

<!--=====================================
MODAL AGREGAR EMPLEADOS
======================================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>empleados/registrarempleado" enctype="multipart/form-data">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar Empleado</h4>

				</div>

				<div class="modal-body">

					<div class="box-body">
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<?php $sucursal = sucursalController::listaSucursal() ?>
								<select class="form-control "  name="idsucursal" required>
									<option value="">Selecione una Sucursal</option>
									<?php
									while ($row = $sucursal->fetch_object()) {
										echo '<option value="' . $row->id . '">' . $row->nombre . '</option>';
									}
									?>						


								</select>

							</div> 

						</div>      

						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-user"></i></span>

								<input type="text" class="form-control input-lg " placeholder="Ingresar Nombre" name="nombre" required> 

							</div> 

						</div>   
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<input type="number" class="form-control input-lg" placeholder="identificacion" name="identificacion" required> 

							</div> 

						</div>      
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-phone"></i></span>

								<input type="number" class="form-control input-lg " placeholder="Ingresar telefono" name="telefono" required> 

							</div> 

						</div>      
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-map-o"></i></span>

								<input type="text" class="form-control input-lg " placeholder="Ingresar la direccion" name="direccion" required> 

							</div> 

						</div> 
						<div class="form-group">
							<label for="Categoria">Fecha de ingreso :</label>
							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

								<input type="date" class="form-control input-lg "  name="fechaingreso" required> 

							</div> 

						</div>      


					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Guardar</button>

				</div>

			</form>


		</div>

	</div>

</div>

<!--=====================================
MODAL AGREGAR BARBERO
======================================-->

<div id="modalAgregarBarbero" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form method="post" action="<?= URL_BASE ?>empleados/registrarbarbero" enctype="multipart/form-data">

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Agregar Barbero</h4>

				</div>

				<div class="modal-body">

					<div class="box-body">
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<?php $sucursal = sucursalController::listaSucursal() ?>
								<select class="form-control "  name="idsucursal" required>
									<option value="">Selecione una Sucursal</option>
									<?php
									while ($row = $sucursal->fetch_object()) {
										echo '<option value="' . $row->id . '">' . $row->nombre . '</option>';
									}
									?>						


								</select>

							</div> 

						</div>      

						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-user"></i></span>

								<input type="text" class="form-control input-lg " placeholder="Ingresar Nombre" name="nombre" required> 

							</div> 

						</div>   
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-th"></i></span>

								<input type="number" class="form-control input-lg" placeholder="identificacion" name="identificacion" required> 

							</div> 

						</div>      
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-phone"></i></span>

								<input type="number" class="form-control input-lg " placeholder="Ingresar telefono" name="telefono" required> 

							</div> 

						</div>      
						<div class="form-group">

							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-map-o"></i></span>

								<input type="text" class="form-control input-lg " placeholder="Ingresar la direccion" name="direccion" required> 

							</div> 

						</div> 
						<div class="form-group">
							<label for="Categoria">Fecha de ingreso :</label>
							<div class="input-group">

								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

								<input type="date" class="form-control input-lg "  name="fechaingreso" required> 

							</div> 

						</div>      


					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Guardar</button>

				</div>

			</form>


		</div>

	</div>

</div>