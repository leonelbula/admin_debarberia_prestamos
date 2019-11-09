<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Realizar prestamos

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?=URL_BASE?>principal"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?=URL_BASE?>prestamos">Prestamos</a></li>
			<li class="active">Editar Prestamos</li>
		</ol>
    </section>

    <!-- Main content -->
    <section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Realizar Prestamos</h3>


			</div>
			<div class="box-body">
				<div class="box-header with-border">
					<a href="<?= URL_BASE ?>prestamos/">
						<button class="btn btn-primary">

							Cancelar

						</button>
					</a>
				</div>
				<div class="box box-default">				

					<div class="col-md-6">
						<form method="POST" class="formularioPrestamo" action="<?= URL_BASE ?>prestamos/actuizarprestamos">						
							<?php
							while ($row1 = $detalles->fetch_object()):
																					
							?>
							<div class="form-group">
								<input type="hidden" name="id" value="<?= $row1->id?>" />
								<label>SELECIONE EL CLIENTE</label>
								<select class="form-control select2" style="width: 100%;" name="idCliente" required>
									<option value="0">Seleccione un cliente</option>
									<?php
									$listaCliente = prestamosController::listaCliente();

									while ($row = $listaCliente->fetch_object()) :
										?>
										<option value="<?= $row->id ?>" <?= $row1->id_cliente == $row->id ? 'selected':''?>><?= $row->nombre ?></option>
									<?php endwhile; ?>
								</select>
							</div>	
							<div class="form-group">
								<label>Fecha entrega:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="date" class="form-control" name="fechaEntrega" value="<?= $row1->fecha_entrega ?>">
								</div>
								<!-- /.input group -->
							</div>
							<div class="form-group">
								<label>Interes:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-balance-scale"></i>
									</div>
									<input type="number" class="form-control interes" name="interes"  value="<?= $row1->interes ?>"required>
								</div>
								<!-- /.input group -->
							</div>  						
							<div class="form-group">
								<label>Numero de cuotas o dias:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calculator"></i>
									</div>
									<input type="number" class="form-control numCuotas" name="numCuotas" value="<?= $row1->num_cuotas ?>" required>
								</div>
								<!-- /.input group -->
							</div>  							
							<div class="form-group">
								<label>Valor Prestamo:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-dollar"></i>
									</div>
									<input type="text" class="form-control valorPrestamo" name="valorPrestamo" style="height:50px;font-size: 30px;" value="<?= $row1->valor ?>" required>
								</div>
								<!-- /.input group -->
							</div> 
							<div class="form-group">
								<label>Total a pagar:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-dollar"></i>
									</div>
									<input type="text" class="form-control nuevoTotal" id="nuevoTotal" style="height:60px;font-size: 40px;" value="<?= $row1->valortotal ?>" readonly>
								</div>
								<!-- /.input group -->
							</div> 
							<div class="form-group">
								<label>Cuotas Diarias:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-dollar"></i>
									</div>
									<input type="text" class="form-control cuotaDiaria" id="cuotaDiaria"  style="height:60px;font-size: 40px;" value="<?= $row1->valorcuota ?>" readonly>
								</div>
								<!-- /.input group -->
							</div> 
							<?php endwhile; ?>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</form>
					</div>			

				</div>
				<!-- /.box -->

			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				prestamos
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()
		//Datemask dd/mm/yyyy

	})
</script>
