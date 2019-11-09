<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Registrar Nuevo Abono
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Registrar Nuevo Abono</li>

		</ol>

	</section>

	<section class="content">

		<?php
		foreach ($detalles as $key => $value):

			$id = $value['id_cliente_p'];

			$datosCliente = prestamosController::listaClienteId($id);

			foreach ($datosCliente as $key => $valueP) {
				$nombre = $valueP['nombre'];
			}
			$idPrestamo = $value['id_prestamo'];

			$detallesPrestamo = prestamosController::detallesPrestamo($idPrestamo);
			while ($row = $detallesPrestamo->fetch_object()) {
				$valorCouta = $row->valorcuota;
				$saldo = $row->saldo;
			}
			?>

			<div class="box">

				<div class="box-header with-border">
					<a href="<?= URL_BASE ?>prestamos/verprestamo&id=<?=  $value['id_prestamo'] ?>">
						<button class="btn btn-primary">

							Cancelar

						</button>
					</a>
				</div>


				<div class="box-body">


					<div class="row">
						<form action="<?= URL_BASE ?>prestamos/actulizarabono" method="POST" >						

							<div class="col-md-8">
								<input type="hidden" name="id" value="<?= $value['id'] ?>"/> 	
								<input type="hidden" name="idPrestamo" value="<?= $value['id_prestamo'] ?>"/> 
								<input type="hidden" name="abonoAnterio" value="<?= $value['valor'] ?>"/> 
								<div class="box box-danger">
									<div class="box-header">
										<h3 class="box-title">Informacion de Cliente</h3>
									</div>
									<div class="box-body">
										<div class="col-md-6">
											<!-- Date dd/mm/yyyy -->
											<div class="form-group">
												<label>Cliente:</label>

												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-user"></i>
													</div>
													<input type="text" class="form-control" value="<?= $nombre ?>" name="nombre"  style="height:50px;font-size: 20px;" disabled>
												</div>
												<!-- /.input group -->
											</div>
											<div class="form-group">
												<label>Fecha del Abono:</label>

												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="date" class="form-control" name="fecha"  value="<?= $value['fecha'] ?>"  style="height:50px;font-size: 20px;" required>
												</div>
												<!-- /.input group -->
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Valor de la cuota:</label>

												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-tag"></i>
													</div>
													<input type="text" class="form-control" value="<?= number_format($valorCouta) ?>" name="valorCouta" style="height:50px;font-size: 20px;" disabled>

												</div>
												<!-- /.input group -->
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Saldo factura</label>

												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-tag"></i>
													</div>
													<input type="text" class="form-control" value="<?= number_format($saldo) ?>"  style="height:50px;font-size: 20px;" disabled>
												</div>
												<!-- /.input group -->
											</div>
										</div>

										<!-- /.form group -->
									<?php endforeach; ?>
									<!-- Date mm/dd/yyyy -->
									<div class="form-group">
										<label>Valor abono:</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-tag"></i>
											</div>
											<input type="number" class="form-control" name="valor" value="<?= $value['valor'] ?>" style="height:50px;font-size: 30px;" required>
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