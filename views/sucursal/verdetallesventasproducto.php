<div class="content-wrapper">        
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3>VENTAS DE PRODUCTOS</h3>
					</div>
					<?php
					
						while ($row1 = $detalles-> fetch_object()) :
							
					 ?>

                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" class="formularioVenta" id="formulario" >
							<input type="hidden" name="id_venta" value="<?= $row1->id ?>" />
								<input type="hidden" name="numregistro" value="<?= $row1->num_factura ?>" />
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<label>Sucursal(*):</label>	
								<input type="text" class="form-control" name="sucursal" id="sucursal" value="<?= $_SESSION['sucursal']->nombre ?>" readonly="">
								
									<!--									<option value="">Seleccionar Client</option>-->
									<?php
									$id = $_SESSION['sucursal']->id;
									
									?>
				
							</div>
							<input type="hidden" name="idSucursal" id="idsucursal" value="<?= $id ?>" />
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Fecha(*):</label>
								<input type="date" class="form-control" name="fecha" id="fecha" value="<?= $row1->fecha ?>">
							</div>

							<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
								
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
									<tbody class="nuevoProducto">
										<?php 
											$listaProductos = json_decode($row1->detalles ,TRUE);
											
											 foreach ($listaProductos as $key => $value) {
												 $id_producto = $value['id'];
												 $id_sucursal = $id;
												$productos = sucursalController::verproductosucursal($id_producto,$id_sucursal);
												while ($row = $productos ->fetch_object()) {
													$cantidad = (int)$row->cantidad;
												}
												
											 $stock = (int)$value['cantidad'] + $cantidad;
											 
												 
										echo '<tr>
												<td class="valorivap">'.$value['codigo'].'<input  class="valoriva" type="hidden" /></td>
												<td class="costop">'.$value['descripcion'].'<input  class="costo" type="hidden" name="costo"  value="'.$value['costo'].'"/></td>						
												<td class="ingresoCantidad"><input type="number" class="nuevaCantidadProducto" name="nuevaCantidadProducto" stock="'.$stock.'" value="'.$value['cantidad'].'"readonly /></td>							
												<td class="precio"><input type="number" class="precioProducto" name="precioProducto" value="'.$value['precio'].'" readonly/></td>							
												<td class="descuentop"><input type="number" class="descuento" id="descuentoProdu" name="descuento" value="'.$value['descuento'].'" readonly/></td>							
												<td class="nuevototalp"><input type="text" class="nuevototal"  name="nuevototal"  value="'.$value['precio'].'" readonly></td>
												<td></td>
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
                                    <th><h4 id="total"></h4><input type="hidden" name="totalVenta" id="totalVenta">
										<input type="text" class="form-control input-lg nuevoTotalProducto" id="nuevoTotalVenta" name="nuevoTotalProducto" value="<?= $row1->totalventa ?>" readonly/></th> 
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>
							<?php endwhile; ?>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
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
