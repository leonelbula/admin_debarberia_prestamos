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
                        <form name="formulario" class="formularioVentasVendedor" id="formularioVentasVendedor" method="POST" action="">
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="hidden" name="id_venta" value="<?= $row1->id ?>" />
								<label>Venededor(*):</label>								
								<select id="idcliente" name="idVendedor" class="form-control selectpicker" data-live-search="true" required readonly>
									<option value="">Seleccionar Vendedor</option>
									<?php 
										$listaVendedores = ventasproductoController::ListaVendedores();
										while ($row = $listaVendedores->fetch_object()) { ?>
											<option value="<?=$row->id ?>" <?=$row->id == $row1->id_vendedor ? 'selected':'' ?>><?=$row->nombre?></option>';
									<?php }	 ?>
								</select>
							</div>
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Fecha(*):</label>
                        <input type="date" class="form-control" name="fecha" id="fecha_hora" value="<?= date('Y-m-d')?>" readonly>
							</div>						
							
							

							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
									<thead style="background-color:#A9D0F5">
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>                                   
                                    <th>Subtotal</th>
									 <th>Accion</th>
									</thead>
									<tbody class="nuevoProductoVendedor">
										<?php 
											$listaProductos = json_decode($row1->detalles ,TRUE);
											
											 foreach ($listaProductos as $key => $value) {
												 $id = $value['id'];
												 
												$productos = ventasproductoController::verproducto($id);
												while ($row = $productos ->fetch_object()) {
													$cantidad = (int)$row->cantidad;
												}
												
											 $stock = (int)$value['cantidad'] + $cantidad;
											 
												 
										echo '<tr>
													<td class="valorivap">'.$value['codigo'].'<input  class="valoriva" type="hidden" name="valoriva"  /></td>
													<td class="costop">'.$value['descripcion'].'<input  class="costo" type="hidden" name="costo"  value="'.$value['costo'].'" readonly/></td>						
													<td class="ingresoCantidad"><input type="number" class="CantidadProd" name="CantidadProd"  stock="'.$stock.'"  value="'.$value['cantidad'].'" readonly /></td>							
													<td class="precio"><input type="number" class="costoProducto" name="costoProducto" value="'.$value['precio'].'" readonly/></td>
													<td class="nuevototalp"><input type="text" class="nuevototalT"  name="nuevototalT"  value="'.$value['precio'].'" readonly></td>
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
                                    <th><h4 id="total"></h4><input type="hidden" name="totalVendedor" id="totalVendedor">
									<input type="text" class="form-control input-lg nuevoTotalVendedor" id="nuevoTotalVendedor" name="nuevoTotalVendedor" value="0" readonly/></th> 
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>
<?php endwhile; ?>
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<a href="<?= URL_BASE ?>ventasproducto/">
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
				<table  class="table table-bordered table-striped dt-responsive tablaProductoVendedor">
					<thead>
					<th>#</th>
					<th>Codigo</th>
					<th>Nombre</th>					
					<th>Precio</th>
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