                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php

while ($row = $totalVentasProductos-> fetch_object()) {
  $totalventas = number_format($row->total);
}   

while ($row = $totalCompra-> fetch_object()) {
  $totalcompras = number_format($row->total);
} 
 
while ($row = $totalProductos-> fetch_object()) {
  $totalproducto = number_format($row->total);
} 
while ($row = $totalVentaServicios-> fetch_object()) {
  $totalVentaServicio = number_format($row->total);
} 


?>



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
	<?php if (isset($_SESSION['sucursal'])) {		
		 
			$id_sucursal = $_SESSION['sucursal']->id;
			$detalles = puntoventaController::ventasActivas($id_sucursal);
			if(isset($detalles)!=0){
				while ($row = $detalles->fetch_object()) {
				$estado = $row->estado;
				}
			}else{
				$estado = 0;			}
			
			
		?>
		<section class="content">        

			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">VENTAS DE SERVICIOS</h3>
				</div>
				<div class="box-body">
	
						<div class="col-xs-6">
							<div class="box-header with-border">
								<?php if(isset($estado) == 1){  ?>
									<a href="<?= URL_BASE ?>sucursal/ventaservicio">
										<button class="btn btn-primary">

											Cobrar Servicio

										</button>
									</a>
								<?php } ?>
								</div>
							<h4>Ventas de servicios</h4>
							<table class="table table-bordered table-striped dt-responsive  VentaServicioSucursalP" width="100%">

								<thead>

									<tr>

										<th style="width:10px">#</th>
										<th>fecha</th>  			 
										<th>Nombre</th>
										<th>valor</th>
										<th>Acciones</th>

									</tr>

								</thead>
								<tbody>

								</tbody>

							</table> 
						</div>
						<div class="col-xs-6">
							<div class="box-header with-border">
								<?php if(isset($estado) == 1){  ?>
									<a href="<?= URL_BASE ?>sucursal/nuevaventa">
										<button class="btn btn-primary">

											Nueva Venta

										</button>
									</a>
								<?php } ?>
								</div>
							<h4>Ventas de productos</h4>
							<table class="table table-bordered table-striped dt-responsive tablaVentaProductoSuc" width="100%">

								<thead>

									<tr>

										<th style="width:10px">Codigo</th>
										<th>fecha</th>  			 
										<th>Numero</th>
										<th>valor</th>	
										<th>Accion</th>	


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
							<h3><?=$totalproducto?></h3>

							<p>Total Productos</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?=URL_BASE?>productos/" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?=$totalventas?><sup style="font-size: 20px"></sup></h3>

							<p>Ventas de Productos</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?=URL_BASE?>ventas/ventassucursal" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?= $totalVentaServicio?></h3>

							<p>Ventas de Servicios</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?=URL_BASE?>ventas/ventassucursal" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?= $totalcompras?></h3>

							<p>Total Compras</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="<?=URL_BASE?>compras/" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
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