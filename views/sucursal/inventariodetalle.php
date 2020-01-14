<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Detalles Inventario sucursal
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Detalles Inventario sucursal</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>sucursal/valorinventario">
					<button class="btn btn-primary" >

						volver

					</button>
				</a>
			</div>


			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading"><h4>Informacion de Inventario Sucursal</h4></div>
					<ul class="list-group">			  
						<?php
						while ($row = $detallesSucursal->fetch_object()):
							$id_sucursal = $row->id;
							?>
							<input type="hidden" name="idSucursal" id="idsucursal" value="<?= $id_sucursal ?>" />
							<li class="list-group-item"><h3><b>NOMBRE SUCURSAL:</b> <?= strtoupper($row->nombre) ?></h3></li>	
<?php endwhile; ?>

					</ul>
					<div class="col-sm-6 invoice-col">
						<br>
						<table class=" table table-bordered table-striped dt-responsive tablaprouctosSucursal" style="width:100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Codigo</th>
									<th>Nombre</th>                
									<th>Categoria</th>
									<th>Precio venta</th>
									<th>Stock</th> 

								</tr>
							</thead>		
						</table>

					</div>

					<div class="row invoice-info">

					</div>			

				</div>
			</div>

			<div class="box-body">

				<div class="panel panel-default">
					<div class="panel-heading"><h4>Informacion de Insumos Sucursal</h4></div>
					<ul class="list-group">			  
						<?php
						while ($row = $detallesSucursal->fetch_object()):
							$id_sucursal = $row->id;
							?>
							<input type="hidden" name="idSucursal" id="idsucursal" value="<?= $id_sucursal ?>" />
							<li class="list-group-item"><h3><b>NOMBRE SUCURSAL:</b> <?= strtoupper($row->nombre) ?></h3></li>	
<?php endwhile; ?>

					</ul>
					<div class="col-sm-6 invoice-col">
						<br>
						<table class=" table table-bordered table-striped dt-responsive tablaInsumoSucursal" style="width:100%">
							<thead>
								<tr>
									<th>#</th>               
									<th>Nombre</th>
									<th>Stock</th> 				
								</tr>
							</thead>		
						</table>

					</div>

					<div class="row invoice-info">

					</div>			

				</div>
			</div>

		</div>

	</section>

</div>
