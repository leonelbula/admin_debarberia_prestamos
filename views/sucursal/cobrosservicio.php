<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Nuevo Cobro servicio

		</h1>

		<ol class="breadcrumb">

			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Crear</li>

		</ol>

	</section>

	<section class="content">

		<div class="row">

			<!--=====================================
			EL FORMULARIO
			======================================-->

			<div class="col-lg-6 col-xs-12">

				<div class="box box-success">

					<div class="box-header with-border"></div>
					<?php
					$id = $_GET['id'];

					$estilista = estilistaController::estilistasId($id);

					while ($row = $estilista->fetch_object()) {
						$idestilista = $row->id;
						$nombreEstilista = $row->nombre;
					}
					?>

					<form class="formularioCobro" action="guardarcobro" metohd="POST">

						<div class="box-body">

							<div class="box">								

								<div class="form-group">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-user"></i></span> 
										<input type="hidden" name="idEstilista" value="<?= $idestilista ?>"/>
										<input type="text" class="form-control" value="<?= $nombreEstilista ?>" readonly/>

									</div>

								</div> 			


								<div class="form-group row nuevoServicio">

								</div>
								<input type="hidden" id="listaServicio" name="listaServicio">								

								<button type="button" class="btn btn-default hidden-lg " data-toggle="modal" data-target="#modal-default">Agregar servicio</button>

								<hr>
								<div class="row">									

									<div class="col-xs-8 pull-right">

										<table class="table">

											<thead>

												<tr>													
													<th></th>     
													<th>Total</th>     
												</tr>

											</thead>

											<tbody>

												<tr>
													<td></td>													
													<td style="width: 50%">

														<div class="input-group">

															<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

															<input type="text" class="form-control input-lg" id="nuevoTotal" name="nuevoTotal" total="" placeholder="00000" readonly required>

															<input type="hidden" name="total" id="total">


														</div>

													</td>

												</tr>

											</tbody>

										</table>

									</div>

								</div>

								<hr>

								<br>

							</div>

						</div>

						<div class="box-footer">

							<button type="submit" class="btn btn-primary pull-right">Guardar</button>

						</div>

					</form>

				</div>

			</div>

			<!--=====================================
			LA TABLA 
			======================================-->

			<div class="col-lg-6 hidden-md hidden-sm hidden-xs">

				<div class="box box-warning">

					<div class="box-header with-border"></div>

					<div class="box-body">

						<table class="table table-bordered table-striped dt-responsive tablaCobroServicio">

							<thead>

								<tr>
									<th style="width: 10px">#</th>
									<th>Imagen</th>
									<th>Código</th>
									<th>Descripcion</th>
									<th>Valor</th>									
									<th>Acciones</th>
								</tr>

							</thead>

							<tbody>


							</tbody>

						</table>

					</div>

				</div>


			</div>

		</div>

	</section>

</div>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista servicios</h4>
			</div>
			<div class="modal-body">
                <table class="table table-bordered table-striped dt-responsive tablaCobroServicio">

					<thead>

						<tr>
							<th style="width: 10px">#</th>
							<th>Imagen</th>
							<th>Código</th>
							<th>Descripcion</th>
							<th>Valor</th>									
							<th>Acciones</th>
						</tr>

					</thead>

					<tbody>


					</tbody>

				</table>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>