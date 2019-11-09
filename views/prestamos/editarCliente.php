<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Editar Cliente
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Editar Cliente</li>
		</ol>
	</section>

	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>prestamos/cliente">
					<button class="btn btn-primary">
						Cancelar
					</button>
				</a>
			</div>
			<div class="box-body">
				<div class="row">
					<form action="<?= URL_BASE ?>prestamos/actualizarcliente" method="POST" >
						<div class="col-md-6">

							<div class="box box-danger">
								<div class="box-header">
									<h3 class="box-title">Informacion del Clieente</h3>
								</div>
								<div class="box-body">
									<?php
									while ($row1 = $detallesCliente->fetch_object()):
										?>

										<div class="form-group">
											<label>Nombre:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-user"></i>
												</div>
												<input type="hidden" value="<?= $row1->id ?>" name="id">
												<input type="text" class="form-control" value="<?= $row1->nombre ?>" name="nombre" required>
											</div>											
										</div>										
										<div class="form-group">
											<label>Nit - CC:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-tag"></i>
												</div>
												<input type="text" class="form-control" value="<?= $row1->nit ?>" name="nit" required>
											</div>											
										</div>										
										<div class="form-group">
											<label>Direccion:</label>

											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-bookmark-o"></i>
												</div>
												<input type="text" class="form-control" value="<?= $row1->direccion ?>"  name="direccion" required>
											</div>
											<!-- /.input group -->
										</div>										
										<div class="form-group">
											<label>Ciudad:</label>
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-bookmark-o"></i>
												</div>
												<input type="text" class="form-control" value="<?= $row1->ciudad ?>"  name="ciudad" required>
											</div>										
										</div>

										<div class="form-group">
											<label>Telefono:</label>

											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-phone"></i>
												</div>
												<input type="text" class="form-control" value="<?= $row1->telefono ?>"  name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
											</div>											
										</div>									


										<button class="btn btn-primary" type="submit">
											Editar cliente
										</button>
									</div>									
								</div>
							</div>						

						<?php endwhile; ?>

					</form>
				</div>				
			</div>
		</div>
	</section>

</div>