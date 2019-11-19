<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Insumo
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Insumo</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>productos/insumos">
					<button class="btn btn-primary" >

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading">Informacion del Insumo</div>
					<ul class="list-group">			  
						<?php
						while ($row = $detallesInsumo->fetch_object()):
							?>
							<li class="list-group-item"> <h4><b>CODIGO:</b> <?= $row->codigo ?></h4></li>
							<li class="list-group-item"><h4><b>COSTO:</b> <?= $row->costo ?></h4></li>
							<li class="list-group-item"><h4><b>NOMBRE:</b> <?= strtoupper($row->nombre) ?></h4></li>									
							<li class="list-group-item"><b>STOCK:</b><h4> <?= $row->stock ?></h4></li>
							<li class="list-group-item"><b>CODIGO VENDEDOR:</b><h4> <?= $row->codigo_vendedor ?></h4></li>

						<?php endwhile; ?>
					</ul>
				</div>



			</div>
		</div>

</div>

</section>

</div>
