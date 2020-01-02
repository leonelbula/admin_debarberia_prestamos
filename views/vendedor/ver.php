<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Productos
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Productos</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>productos/">
					<button class="btn btn-primary" >

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading">Informacion del Producto</div>
					<ul class="list-group">			  
						<?php while ($row = $detallesPro->fetch_object()):
							
							$id = $row->id_categoria;
							$categoriade = productosController::MostarCategoria($id);
							
							while ($row1 = $categoriade->fetch_object()) {
								$categoria = $row1->nombre;
							}
							?>
						<li class="list-group-item"> <h4><b>CODIGO:</b> <?= $row->codigo ?></h4></li>
							<li class="list-group-item"><h4><b>COSTO:</b> <?= $row->costo ?></h4></li>
							<li class="list-group-item"><h4><b>NOMBRE:</b> <?= strtoupper($row->nombre) ?></h4></li>
							<li class="list-group-item"><h4><b>PRECIO VENTA :</b><?= number_format($row->precio_venta) ?> --- <b>Utilidad :</b></b> <?= strtoupper($row->porcentaje_utilidad) ?> %</h4></li>							
							<li class="list-group-item"><b>CATEGORIA :</b></b> <?= strtoupper($categoria) ?></li>							
							<li class="list-group-item"><b>GANANCIA:</b><h4> <?= $row->utilidad ?></h4></li>
							<li class="list-group-item"><b>CODIGO VENDEDOR:</b><h4> <?= $row->codigo_vendedor ?></h4></li>
							
							<?php endwhile; ?>
					</ul>
				</div>



			</div>
		</div>

</div>

</section>

</div>
