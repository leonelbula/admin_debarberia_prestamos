<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Lista sucrsales
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Gestor Sucursal</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>sucursal/registrar">
					<button class="btn btn-primary">

						Agregar Sucursal

					</button>
				</a>
			</div>


			<div class="box-body">

				<table id="tablasucursal" class="table table-bordered table-striped dt-responsive tablasucursal" width="100%">

					<thead>

						<tr>

							<th style="width:10px">Codigo</th>
							<th>Nombre</th>  			 
							<th>direccion</th>
							<th>Ciudad</th>
							<th>Departamento</th>
							<th>Fecha Registro</th>
							<th>Acciones</th>

						</tr>

					</thead>
					<tbody>

					</tbody>

				</table> 

			</div>


		</div>
		<div class="box-footer">
			Pedidos
        </div>

	</section>

</div>
