<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Gestor de abono a prestamos
		</h1>
		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Gestor estado de abonos</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">  
			<div class="box-header with-border">
				<?php
				while ($row = $detalles->fetch_object()):
					$totalSericio = (int)$row->total;

					$id_estilista = $row->id_estilista;

					$datosCliente = empleadosController::estilistasId($id_estilista);
					
					$valorCuota = sucursalController::consultaPrestamo($id_estilista);
					$valorTotalAvance = sucursalController::consulataAvances($id_estilista);
					
					if($valorCuota->num_rows != 0){
						while ($row1 = $valorCuota->fetch_object()) {
							$cuota = (int)$row1->totalcuota;
						}
					}else{
						$cuota = 0;
					}
					if($valorTotalAvance->num_rows != 0){
						while ($row1 = $valorTotalAvance->fetch_object()) {
							$avances = (int)$row1->total;
						}
					}else{
						$avances = 0;
					}
				
					$totalDeduciones = $cuota + $avances;
				
					
					if($totalSericio < $totalDeduciones){
						$msn = '<div class="alert alert-danger" role="alert">
									Sea generado un saldo pendiente a descontar !
								</div>';
						$valorEntregar = $totalSericio - $totalDeduciones;
					}else{
						$msn = '<div class="alert alert-success" role="alert">
									Saldo a Favor!
								</div>';
						$valorEntregar = $totalSericio - $totalDeduciones;
					}
					
					
					foreach ($datosCliente as $key => $value) {
						$nombre = $value['nombre'];
					}
					?>
					<a href="<?= URL_BASE ?>sucursal/listaavences">
						<button class="btn btn-primary">

							Cancelar

						</button>
					</a>			
				</div>
				<div class="box-header with-border">
					<div class="row invoice-info">

						<div class="col-sm-4 invoice-col">	
							<h3><strong>Nombre:</strong> <?= $nombre ?></h3>

							<address>
								<h4>A la Fecha: <strong> <?= date('Y-md') ?> </strong><br></h4>								 
								<h4>TOTAL GENERADO: <strong> <?= number_format($totalSericio) ?></strong> <br></h4>	
								<h4>AVANCES REALIZADO <strong>- <?= number_format($avances) ?> </strong><br></h4>
								<h4>COUTA DE PRESTAMO: <strong>- <?= number_format($cuota) ?> </strong><br></h4>	
								<hr>
								<h3>TOTAL: <strong> <?= number_format($valorEntregar) ?></strong></h3> <br><?= $msn;?>
							</address>
						</div>
					</div>
	<?php
endwhile;
?>   
			</div>


			<div class="box-body">
				<div class="col-sm-4 invoice-col">
					<table class="table table-bordered table-striped dt-responsive tablasAvancesDetallesSucursal" width="100%">

						<thead>

							<tr>

								<th style="width:10px">N°</th>			 
								<th>Fecha </th>
								<th>Valor </th> 			  		

							</tr>

						</thead>
						<tbody>
<?php
$i = 1;

foreach ($listaServicio as $key => $value):
	?>
								<tr>
									<td><?= $i++ ?></td>
									<td><?= $value['fecha'] ?></td>
									<td><?= number_format($value['valor']) ?></td>	  


								</tr>
							<?php endforeach; ?>
						</tbody>

					</table> 
				</div>
			</div>


		</div>
		<div class="box-footer">
			Abono a Prestamo
        </div>

	</section>

</div>

<script>
	$(function () {
		$('.tablaestadocuentaprestamo').DataTable()
	})
</script>