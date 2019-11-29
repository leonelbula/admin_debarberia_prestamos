<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Principal
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Principal</li>
		</ol>
    </section>
	<?php if (isset($_SESSION['sucursal'])) { ?>
		<section class="content">        

			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">VENTAS DE SERVICIOS</h3>
				</div>
				<div class="box-body">
	<?php
	$id_sucursal = $_SESSION['sucursal']->id;

	$estilista = estilistaController::estilistas($id_sucursal);
	
		?>


						<div class="col-xs-6">
							<div class="box-header with-border">
									<a href="<?= URL_BASE ?>compras/nuevotraslado">
										<button class="btn btn-primary">

											Cobrar Servicio

										</button>
									</a>
								</div>
							<h4>Ventas de servicios</h4>
							<table class="table table-bordered table-striped dt-responsive " width="100%">

								<thead>

									<tr>

										<th style="width:10px">Codigo</th>
										<th>fecha</th>  			 
										<th>Nombre</th>
										<th>valor</th>					


									</tr>

								</thead>
								<tbody>

								</tbody>

							</table> 
						</div>
						<div class="col-xs-6">
							<div class="box-header with-border">
									<a href="<?= URL_BASE ?>sucursal/nuevotraslado">
										<button class="btn btn-primary">

											Nueva Venta

										</button>
									</a>
								</div>
							<h4>Ventas de productos</h4>
							<table class="table table-bordered table-striped dt-responsive " width="100%">

								<thead>

									<tr>

										<th style="width:10px">Codigo</th>
										<th>fecha</th>  			 
										<th>Nombre</th>
										<th>valor</th>					


									</tr>

								</thead>
								<tbody>

								</tbody>

							</table> 
						</div>

	
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>
<?php }else { ?>
		<section class="content">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>150</h3>

							<p>New Orders</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>53<sup style="font-size: 20px">%</sup></h3>

							<p>Bounce Rate</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3>44</h3>

							<p>User Registrations</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3>65</h3>

							<p>Unique Visitors</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- /.row -->
			<!-- /.row -->
			<!-- Main row -->

			<!-- /.row (main row) -->

	    </section>
	<?php
}
?>
    <!-- Main content -->

    <!-- /.content -->
</div>