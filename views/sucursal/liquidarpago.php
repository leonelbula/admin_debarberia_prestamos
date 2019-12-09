<div class="content-wrapper">
    <div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Panel Pagos 
				<small></small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">sucursal</a></li>
				<li class="active">ventana de navegacion</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">        

			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">PAGOS DE SERVICIOS</h3>
				</div>
				<div class="box-body">
					<?php 
					$id_sucursal = $_SESSION['sucursal']->id;
					$estilista = estilistaController::estilistas($id_sucursal);
					
					foreach ($estilista as $key => $value) :
						
										
					?>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<a href="<?= URL_BASE?>sucursal/pagoservicio&id=<?= $value['id']?>" class="small-box-footer">
							<div class="small-box  bg-green">

								<div class="inner">
									<h3><?= $value['id']?></h3>

									<p><?= $value['nombre']?></p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="<?= URL_BASE?>sucursal/pagoservicio&id=<?= $value['id']?>" class="small-box-footer">PAGAR <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</a>
					</div>
					<?php endforeach; ?>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</section>
		<!-- /.content -->
    </div>
    <!-- /.container -->
</div>
<!-- /.conten