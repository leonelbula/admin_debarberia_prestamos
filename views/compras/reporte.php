<div class="content-wrapper">

	<section class="content-header">

		<h1>
			Reportes 
		</h1>

		<ol class="breadcrumb">

			<li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Reportes</li>

		</ol>

	</section>

	<section class="content">

		<div class="box">

			<div class="box-header with-border">

<!--				<div class="input-group">

					<button type="button" class="btn btn-default" id="daterange-btn1">

						<span>
							<i class="fa fa-calendar"></i> Rango de fecha
						</span>

						<i class="fa fa-caret-down"></i>

					</button>

				</div>-->

				
			</div>
			<div class="box-body">
        
        <div class="row">

          <div class="col-xs-12">           
            

          </div>

           <div class="col-md-6 col-xs-12">
             
            
			
			<button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalPagosPeriodo">

				Compras por Periodo

			</button>
			   &nbsp;&nbsp;&nbsp;
			   <button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalProdventas">

				Compras  por Proveedor 

			</button>
			             

           </div>

            <div class="col-md-6 col-xs-12">
             
            <button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalVentasClientes">

				Compras por Sucursal

			</button>
				&nbsp;&nbsp;&nbsp;
			<button class="btn  btn-primary  btn-lg " data-toggle="modal" data-target="#modalVentasClientes">

				r Sucursal

			</button>					

           </div>
			<br>
			<br>
			
           <div class="col-md-6 col-xs-12">
             
            
			             

           </div>
			<div class="col-md-6 col-xs-12">
             
            

           </div>
          
        </div>

      </div>

			

		</div>

	</section>

</div>





<div id="modalPagosPeriodo" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/pagosporperiodo.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Ventas por periodo</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>

<div id="modalProdventas" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/prestamosentregados.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Ventas por Productos</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>

<div id="modalVentasClientes" class="modal fade" role="dialog">

	<div class="modal-dialog">

		<div class="modal-content">

			<form role="form" action="<?= URL_BASE ?>extensiones/tcpdf/pdf/prestamosclientes.php" method="GET" target="_blank" >

				<!--=====================================
				CABEZA DEL MODAL
				======================================-->

				<div class="modal-header" style="background:#3c8dbc; color:white">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Ventas por Clientes</h4>

				</div>

				<!--=====================================
				CUERPO DEL MODAL
				======================================-->

				<div class="modal-body">

					<div class="box-body">


						<div class="form-group">
							<label>Fecha Inicial:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaInicial">
							</div>
							<!-- /.input group -->
						</div>  
						<div class="form-group">
							<label>Fecha Final:</label>

							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control" name="fechaFinal" >
							</div>
							<!-- /.input group -->
						</div>

					</div>

				</div>

				<!--=====================================
				PIE DEL MODAL
				======================================-->

				<div class="modal-footer">

					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

					<button type="submit" class="btn btn-primary">Mostrar</button>

				</div>

			</form>     

		</div>

	</div>

</div>