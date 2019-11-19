<div class="content-wrapper">
	<section class="content-header">

		<h1>
			Registrar Nuevo Producto
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Registrar Nuevo Producto</li>

		</ol>

	</section>
	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>productos/insumos">
					<button class="btn btn-primary">

						Cancelar

					</button>
				</a>
			</div>


			<div class="box-body">
				<div class="col-md-8">
					<form class="formularioInsumo" action="<?= URL_BASE ?>productos/actulizarinsumo" enctype="multipart/form-data" method="POST">
						<?php while ($row = $detallesInsumo->fetch_object()) :
							
						 ?>
						<input type="hidden" name="id" value="<?=$row->id?>" />
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo">Codigo:</label>
									<?php
										$detallesParrametros = parametrosController::ListaParrametros();
										while ($row1 = $detallesParrametros->fetch_object()) {
											$estado = $row1->generar_codigo;
										}
										?>
									<input type="text" class="form-control" name="codigo" id="codigo" <?=($estado == 1)?'disabled':''?> value="<?= $row->codigo?>">
								</div>	
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="costo">Costo:</label>
									<input type="number" class="form-control costo" name="costo" id="costo" value="<?= $row->costo?>" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" name="nombre" id="nombre" value="<?= $row->nombre?>" required>
						</div>
							
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="fiestapatronal">Cantidad Inicial:</label>
									<input type="number" class="form-control" name="cantidainicial" value="<?= $row->cantidad?>"  required>
								</div>
							</div>	
							<div class="col-xs-6">
								<div class="form-group">
									<label for="contidadMin">Stop Minimo:</label>
									<input type="number" class="form-control" name="cantidamin" value="<?= $row->stock?>"  required>
								</div>
							</div>

						</div>
						
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo_vendedor">Codigo del Vendeedor:</label>
									<input type="text" class="form-control" name="codigo_vendedor" value="<?= $row->codigo_vendedor?>">
								</div>
							</div>
								<div class="col-xs-6">
								<div class="form-group">
									<label for="fechaexpiracion">Vendedor:</label>
									<select class="form-control select2" name="id_vendedor" style="width: 100%;">
										<option  value="0" selected="selected">Seleciones Proveedor</option>
										<option  value="0">No Registrar proveedor</option>
									  <?php 
											$proveedor = proveedorController::listaProveedor();
											while ($rowP = $proveedor->fetch_object()):							

										?>
									  <option value="<?=$rowP->id?>"<?= $rowP->id == $row->id_vendedor ? 'selected':''?>><?=$rowP->nombre?></option>
									  <?php endwhile; ?>                
              
                 
								 </select>
								</div>
							</div>

						</div>					
						<?php endwhile; ?>
						<button type="submit" class="btn btn-primary">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>


