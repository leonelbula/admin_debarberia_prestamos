<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Realizar prestamos

		</h1>
		<ol class="breadcrumb">
			<li><a href="<?=URL_BASE?>principal"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?=URL_BASE?>sucursal">Avances</a></li>
			<li class="active">Realizar Prestamos</li>
		</ol>
    </section>

    <!-- Main content -->
    <section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Realizar Prestamos</h3>
				<?php 
				$idSucursal = $_SESSION['sucursal']->id;
				
				while ($row1 = $detalles->fetch_object()) {
					if($idSucursal == $row1->id_sucursal){
						$id_estilista = $row1->id_estilista;
						$fecha = $row1->fecha;
						$valor = $row1->valor;
					}else{
						$id_estilista = 0;
						$fecha = date('Y-m-d');
						$valor = 0;
					}
					
				}
				
				?>

			</div>
			<div class="box-body">
				<div class="box-header with-border">
					<a href="<?= URL_BASE ?>sucursal/veravance&id=<?=$id_estilista?>">
						<button class="btn btn-primary">

							Cancelar

						</button>
					</a>
				</div>
				<div class="box box-default">				

					<div class="col-md-6">
						<form method="POST" class="" action="<?= URL_BASE ?>sucursal/actulizaravance">						
							<input type="hidden" name="id" value="<?=$_GET['id']?>" />
							<div class="form-group">
								<label>SELECIONE EL EMPLEADO</label>
								<select class="form-control select2" style="width: 100%;" name="idEmpleado" required>
									<option value="0">Seleccione un Empleado</option>
									<?php
									$id = $_SESSION['sucursal']->id;
									$listaCliente = empleadosController::estilistas($id);

									while ($row = $listaCliente->fetch_object()) :
										?>
										<option value="<?= $row->id ?>"<?= $row->id == $id_estilista ? 'selected' : '' ?>><?= $row->nombre ?></option>
									<?php endwhile; ?>
								</select>
								<input type="hidden" name="id_sucursal" value="<?=$id?>" />
							</div>	
							<div class="form-group">
								<label>Fecha entrega:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="date" class="form-control" name="fechaEntrega" value="<?= $fecha ?>" readonly="">
								</div>
								<!-- /.input group -->
							</div>
													
													
							<div class="form-group">
								<label>Valor Avance:</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-dollar"></i>
									</div>
									<input type="text" class="form-control valorPrestamo" name="valor" value=<?=$valor?> style="height:50px;font-size: 30px;" required>
								</div>
								<!-- /.input group -->
							</div> 
							
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