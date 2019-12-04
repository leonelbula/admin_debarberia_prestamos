<div class="content-wrapper">        
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
                    
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" class="formularioVenta" id="formulario" method="POST" action="guardarventasservicio">
							<div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<label>Cliente(*):</label>								
								<select id="idcliente" name="idCliente" class="form-control selectpicker" data-live-search="true" required>
<!--									<option value="">Seleccionar Client</option>-->
									<?php 
										$id = $_SESSION['sucursal']->id;
										$listaSucursal = sucursalController::listaclientes();
										while ($row = $listaSucursal->fetch_object()) {
											echo '<option value="'.$row->id.'">'.$row->nombre.'</option>';
										}
									 ?>
								</select>
							</div>
							<input type="hidden" name="idSucursal" id="idsucursal" value="<?=$id?>" />
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<label>Fecha(*):</label>
								<input type="date" class="form-control" name="fecha" id="fecha" value="<?= date('Y-m-d')?>">
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
                                    <th>Precio</th>
									<th>Descuento</th> 
                                    <th>Subtotal</th>
									 <th>Accion</th>
									</thead>
									<tbody class="nuevoProducto">
										
									</tbody>              
									<input type="hidden" id="listaProductos" name="listaProductos">
					              
									<tfoot>
                                    <th></th>                                  
                                    <th></th>
                                    <th></th>									
                                    <th>TOTAL</th>
                                    <th><h4 id="total"></h4><input type="hidden" name="totalVenta" id="totalVenta">
									<input type="text" class="form-control input-lg nuevoTotalProducto" id="nuevoTotalVenta" name="nuevoTotalProducto" value="0" readonly/></th> 
									</tfoot>
									<tbody>

									</tbody>
								</table>
							</div>

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
				<table  class="table table-bordered table-striped dt-responsive tablaproductoventa">
					<thead>
					<th>#</th>					
					<th>Codigo</th>	
					<th>Descripcion</th>
					<th>Stock</th>
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