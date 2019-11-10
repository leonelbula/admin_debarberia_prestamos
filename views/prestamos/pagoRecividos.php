<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Pagos recibidos diario

		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Pagos recibidos diario</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<?php 
				while ($row = $detalles ->fetch_object()) {
					$totalPagos = $row->total;
				}
				
				?>

			</div>
			<div class="box-body">

				<div class="row">

					<div class="col-xs-12">           
						<div class="box-body">
							<div class="form-group">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-th"></i></span>

									<input type="date" value="<?= date('Y-m-d') ?>" style="height:50px;font-size: 30px;" disabled class="form-control input-lg"  />

								</div> 

							</div>     
							<div class="form-group">

								<div class="input-group">

									<span class="input-group-addon"><i class="fa fa-th"></i></span>

									<input type="text" value="<?= number_format($totalPagos) ?>" class="form-control input-lg"  style="height:50px;font-size: 30px;" disabled />
									
								</div> 

							</div>     


						</div>

					</div>


				</div>

			</div>



		</div>

	</section>

</div>
