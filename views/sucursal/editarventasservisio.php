<div class="content-wrapper">        
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<?php
					
						while ($row1 = $detalles-> fetch_object()) :
							
					 ?>
                    
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" class="formularioServicio" id="formulario" method="POST" action="actualizarventasservicio">
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<label>Realizado por(*):</label>	
								<input type="hidden" name="id_venta" value="<?= $row1->id ?>" />
								<input type="hidden" name="numregistro" value="<?= $row1->num_venta ?>" />
								
								<select id="idcliente" name="idBarbero" class="form-control selectpicker" data-live-search="true" required>
									<option value="">Seleccionar Barbero</option>
									<?php 
										$id = $_SESSION['sucursal']->id;
										$listaSucursal = estilistaController::estilistas($id);
										while ($row = $listaSucursal->fetch_object()) :
										?>
											<option value="<?=$row->id ?>"<?= $row->id == $row1->id_estilista ? 'selected': '' ?> ><?= $row->nombre ?></option>
									<?php 	
											endwhile;
									 ?>
								</select>
							</div>
							<input type="hidden" name="idSucursal" value="<?=$id?>" />
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Fecha(*):</label>
								<input type="date" class="form-control" name="fecha" id="fecha" value="<?= date('Y-m-d')?>">
							</div>
							
							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<a data-toggle="modal" href="#myModal">           
									<button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Servicio</button>
								</a>
							</div>

							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
									<thead style="background-color:#A9D0F5">
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
									<th>Descuento</th> 
                                    <th>Subtotal</th>
									 <th>Accion</th>
									</thead>
									<tbody class="nuevoServicio">
										<?php 
											$listaProductos = json_decode($row1->detalle ,TRUE);
											
											 foreach ($listaProductos as $key => $value) {
																				 
												 
										echo '<tr>
												<td class="valorivap">'.$value['codigo'].'<input  class="valoriva" type="hidden" name="valoriva"  /></td>
												<td class="costop">'.$value['descripcion'].'<input  class="costo" type="hidden" name="costo"  value="'.$value['precio'].'"/></td>							
												<td class="ingresoCantidad"><input type="number" class="CantidadProd" name="CantidadProd"  value="1" /></td>						
												<td class="precio"><input type="number" class="costoProducto" name="costoProducto" value="'.$value['precio'].'"/></td>						
												<td class="descuentop"><input type="number" class="descuento" id="descuentoProduC" name="descuento" value="0"/></td>
												<td class="nuevototalp"><input type="text" class="nuevototalC"  name="nuevototalC"  value="'.$value['precio'].'" readonly></td>
												<td><button class="btn btn-danger quitarServicio" idServicio="'.$value['id'].'"><i class="fa fa-times"></i></button></td>
												<input  class="nombreProduc" type="hidden" name="nombreProduc" value="'.$value['descripcion'].'"/>
												<input  class="idProductoVenta" type="hidden" name="idProductoVenta" value="'.$value['id'].'"/>
												<input  class="codigo" type="hidden" name="codigo" value="'.$value['codigo'].'"/>
											</tr>';
											 }
										?>
									</tbody>              
									<input type="hidden" id="listaServicio" name="listaServicio">
					              
									<tfoot>
                                    <th></th>                                  
                                    <th></th>
                                    <th></th>									
                                    <th>TOTAL</th>
                                    <th><h4 id="total"></h4><input type="hidden" name="totalServicio" id="totalServicio">
									<input type="text" class="form-control input-lg nuevoTotalServicio" id="nuevoTotalServicio" name="nuevoTotalServicio" value="0" readonly/></th> 
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>
							<?php endwhile; ?>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
								<a href="<?= URL_BASE ?>frontend/principal">
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
				<h4 class="modal-title">Seleccione un servicio</h4>
			</div>
			<div class="modal-body">
				<table  class="table table-bordered table-striped dt-responsive tablaCobroServicio">
					<thead>
					<th>#</th>
					<th>imagen</th>
					<th>Codigo</th>	
					<th>Descripcion</th>	
					<th>Precio</th>								
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