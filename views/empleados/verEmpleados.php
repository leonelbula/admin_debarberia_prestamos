<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Empeados
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Empleados</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>empleados/">
					<button class="btn btn-primary" >

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading">Informacion del Empleado</div>
					<ul class="list-group">			  
						<?php while ($row = $detallesEmpleado->fetch_object()):
							
							$id = $row->id_sucursal;
							$detallesSucursal = sucursalController::SucursalId($id);
							
							while ($row1 = $detallesSucursal->fetch_object()) {
								$sucursal = $row1->nombre;
							}
							?>
							<li class="list-group-item"> <h4><b>CODIGO:</b> <?= $row->id ?></h4></li>						
							<li class="list-group-item"><h4><b>NOMBRE:</b> <?= strtoupper($row->nombre) ?></h4></li>
							<li class="list-group-item"><h4><b>IDENTIFICACION :</b><?= $row->nit ?></h4></li>							
							<li class="list-group-item"><h4><b>DIRECCION :</b> <?= strtoupper($row->direccion) ?></h4></li>							
							<li class="list-group-item"><h4><b>TELEFONO:</b> <?= $row->telefono ?></h4></li>
							<li class="list-group-item"><h4><b>SUCURSAL:</b> <?= strtoupper($sucursal) ?></h4></li>
							
							<?php endwhile; ?>
					</ul>
				</div>



			</div>
		</div>

</div>

</section>

</div>
