<div class="content-wrapper">
	<section class="content-header">

		<h1>
			Registrar Nuevo Producto
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Editar Nuevo Producto</li>

		</ol>

	</section>
	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>inventario/">
					<button class="btn btn-primary">

						Cancelar

					</button>
				</a>
			</div>


			<div class="box-body">
				<div class="col-md-8">
					<?php 
					
					while ($row2 = $detallesProductos->fetch_object()):						
						
					?>
					<form class="formularioProducto" action="<?= URL_BASE ?>ventasproducto/actualizarproducto" enctype="multipart/form-data" method="POST">
						<input type="hidden" name="id_producto" value="<?=$row2->id?>"/>
							
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo">Codigo:</label>
									<?php
										$detallesParrametros = ParametrosController::ListaParrametros();
										while ($row1 = $detallesParrametros->fetch_object()) {
											$estado = $row1->generar_codigo;
										}
										?>
									<input type="text" class="form-control" name="codigo" value="<?=$row2->codigo?>" id="codigo" <?=($estado == 1)?'disabled':''?>>
								</div>	
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="costo">Costo:</label>
									<input type="number" class="form-control costo" value="<?=$row2->costo?>"  name="costo" id="costo" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" name="nombre" value="<?=$row2->nombre?>" id="nombre" required>
						</div>

						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="contidadMin">Stop Minimo:</label>
									<input type="number" class="form-control" value="<?=$row2->stock_minimo?>" name="cantidamin" required>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Utilidad 1">% de Utilidad :</label>
									<input type="number" class="form-control Utilidad"  name="Utilidad" value="<?=$row2->porcentaje_utilidad?>" id="Utilidad1" required>
								</div>
							</div>
						</div>						
					
									
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="fiestapatronal">Cantidad Inicial:</label>
									<input type="number" class="form-control" name="cantidainicial" value="<?=$row2->cantidad?>" id="fiesta" >
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="Precio1_Iva">Precio de venta:</label>
									<input type="number" class="form-control precio_venta" value="<?=$row2->precio_venta?>" name="Precio1_Iva" id="precio_venta" disabled>
								</div>
							</div>	
							
						</div>
						
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo_vendedor">Codigo del Vendeedor:</label>
									<input type="number" class="form-control" name="codigo_vendedor" value="<?=$row2->codigo_vendedor?>" id="limites" required>
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
									  <option value="<?=$rowP->id?>" <?= $row2->id_vendedor == $rowP->id ?'selected':''?>><?=$rowP->nombre?></option>
									  <?php endwhile; ?>                
              
                 
								 </select>
								</div>
							</div>

						</div>
												
						<button type="submit" class="btn btn-primary">Editar</button>
					</form>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
</div>