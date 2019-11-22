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
				<a href="<?= URL_BASE ?>empleados/">
					<button class="btn btn-primary">
						Cancelar
					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="col-xs-6">
					
					<form method="post" action="<?= URL_BASE ?>empleados/actulizarempleado" enctype="multipart/form-data">
					

						<div class="modal-header" style="background:#3c8dbc; color:white">

							

							<h4 class="modal-title">Editar Empleados</h4>

						</div>

						<div class="modal-body">

							<div class="box-body">
								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-th"></i></span>

										<?php 
										while ($row1 = $detallesEmpleado->fetch_object()) :
											
										
										
										$sucursal = sucursalController::listaSucursal() ?>
										<select class="form-control "  name="idsucursal" required>
											<option value="">Selecione una Sucursal</option>
											<?php
											while ($row = $sucursal->fetch_object()) : ?>
												<option value="<?= $row->id ?>" <?= $row->id == $row1->id_sucursal ? 'selected':''?>><?= $row->nombre ?></option>
											<?php endwhile;?>						

										</select>

									</div> 

								</div>      

								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										
										<input type="hidden" name="id" value="<?= $row1->id?>" />

										<input type="text" class="form-control input-lg " placeholder="Ingresar Nombre" value="<?=$row1->nombre?>" name="nombre" required> 

									</div> 

								</div>   
								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-th"></i></span>

										<input type="number" class="form-control input-lg" placeholder="identificacion" value="<?=$row1->nit?>" name="identificacion" required> 

									</div> 

								</div>      
								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-phone"></i></span>

										<input type="number" class="form-control input-lg " placeholder="Ingresar telefono" value="<?=$row1->telefono?>" name="telefono" required> 

									</div> 

								</div>      
								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-map-o"></i></span>

										<input type="text" class="form-control input-lg " placeholder="Ingresar la direccion" value="<?=$row1->direccion?>" name="direccion" required> 

									</div> 

								</div> 
								<div class="form-group">
									<label for="Categoria">Fecha de ingreso :</label>
									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>

										<input type="date" class="form-control input-lg " value="<?=$row1->fecha_ingreso?>" name="fechaingreso" required> 

									</div> 

								</div>      


							</div>

						</div>
	
						<?php endwhile;?>
						<div class="modal-footer">						

							<button type="submit" class="btn btn-primary">Editar</button>

						</div>

					</form>
				</div>

			</div>


		</div>
		<div class="box-footer">
			Editar
        </div>

	</section>

</div>