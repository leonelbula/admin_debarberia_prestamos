<div class="content-wrapper">        
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
                    
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" class="formularioTraslado" id="formulario" method="POST" action="actulizartraslado">
							<?php 
							
							while ($row1 = $detallesTraslado->fetch_object()) :
								
						
							
							?>
							<input type="hidden" name="idTraslado" value="<?= $row1->id?>"/>
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<label>Sucursal(*):</label>								
								<select id="idcliente" name="idSucursal" class="form-control selectpicker" data-live-search="true" required>
									<option value="">Seleccionar cliente</option>
									<?php 
										$listaSucursal = sucursalController::listaSucursal();
										while ($row = $listaSucursal->fetch_object()) :
									?>
										<option value="<?=$row->id ?>" <?= $row->id == $row1->id_sucursal ? 'selected' : ''?>><?= $row->nombre ?></option>
									<?php 
									endwhile;
									 ?>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Fecha(*):</label>
								<input type="date" class="form-control" name="fecha_hora" id="fecha_hora" value="<?= $row1->fecha?>">
							</div>
							
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<a data-toggle="modal" href="#myModal">           
									<button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Artículos</button>
								</a>
							</div>

							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
									<thead style="background-color:#A9D0F5">
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio Costo</th>                                   
                                    <th>Subtotal</th>
									 <th>Accion</th>
									</thead>
									<tbody class="nuevoProductoTraslado">
										<?php
										
										$listaProducto = json_decode($row1->detalles,TRUE);
										foreach ($listaProducto as $key => $value) {
											$producto = productosController::VerProdutoId($value['id']);
											while ($row2 = $producto->fetch_object()) {
												$cantidad = (int)$row2->cantidad;
											}
											$stock = $cantidad + (int)$value['cantidad'];
											
											echo '<tr>
													<td class="valorivap">'.$value['codigo'].'<input  class="valoriva" type="hidden" name="valoriva"  /></td>
													<td class="costop">'.$value['descripcion'].'<input  class="costo" type="hidden" name="costo"  value="'.$value['precio'].'"/></td>						
													<td class="ingresoCantidad"><input type="number" class="CantidadProd" name="CantidadProd"  stock="'.$stock.'"  value="'.$value['cantidad'].'" /></td>							
													<td class="precio"><input type="number" class="costoProducto" name="costoProducto" value="'.$value['precio'].'" readonly/></td>
													<td class="nuevototalp"><input type="text" class="nuevototalT"  name="nuevototalT"  value="'.$value['subtotal'].'" readonly></td>
													<td><button class="btn btn-danger quitarProducto" idProducto="'.$value['id'].'"><i class="fa fa-times"></i></button></td>
													<input  class="nombreProduc" type="hidden" name="nombreProduc" value="'.$value['descripcion'].'"/>
													<input  class="idProductoVenta" type="hidden" name="idProductoVenta" value="'.$value['id'].'"/>
													<input  class="codigo" type="hidden" name="codigo" value="'.$value['codigo'].'"/>
											</tr>';
										}
										?>
									</tbody>              
									<input type="hidden" id="listaProductos" name="listaProductos">
					              
									<tfoot>
                                    <th></th>                                  
                                    <th></th>
                                    <th></th>									
                                    <th>TOTAL</th>
                                    <th><h4 id="total"></h4><input type="hidden" name="totalTraslado" id="totalTraslado" value="<?= $row1->total?>">
									<input type="text" class="form-control input-lg nuevoTotalTraslado" id="nuevoTotalTraslado" name="nuevoTotalTraslado" value="<?= $row1->total?>" readonly/></th> 
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>
							<?php endwhile; ?>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
								<a href="<?= URL_BASE ?>compras/trasladomercancia">
								<button id="btnCancelar" class="btn btn-danger" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
								</a>
							</div>
                        </form>
                    </div>
                    <!--Fin centro -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Seleccione un Artículo</h4>
			</div>
			<div class="modal-body">
				<table  class="table table-bordered table-striped dt-responsive tablaProductoTraslado">
					<thead>
					<th>#</th>
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Costo</th>
					<th>Stok</th>					
					<th>Accion</th>		
					</thead>
					<tbody>

					</tbody>

				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>        
		</div>
    </div>
</div>  