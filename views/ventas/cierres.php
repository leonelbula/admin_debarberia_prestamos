<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Iniciar punto de ventas
        
      </h1>
      <ol class="breadcrumb">
			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
			<li><a>Ventas</a></li>

	 </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">      
								  
        </div>
        <div class="box-body">
			<table id="puntoventas" class=" table table-bordered table-striped dt-responsive tablasCierreCaja" style="width:100%">
					<thead>
						<tr>
							<th>#Id</th>
							<th>Sucursal</th>
							<th>fecha Inicio</th>
							<th>fecha Cierre</th>
							<th>Total Gastos</th>
							<th>Valor Total </th>
							<th>Total Entregado</th>
							<th>Diferencia</th>	
							<th>Imprimir</th>	
						</tr>
					</thead>
					<tbody>
						
					</tbody>
			</table>
						
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Iniciar Ventas
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="modalIniciarPos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

		<form action="<?=URL_BASE?>puntoventa/guardarinicioventa" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Inicar venta Diaria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">
			  <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
				 <input type="hidden" name="id_sucursal" value="<?=$_SESSION['sucursal']->id?>"	/>		  

                <input type="date" name="fecha" placeholder="fecha"  value="<?= date('Y-m-d')?>" disabled class="form-control input-lg"  />

              </div> 

            </div>     
			  <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" name="basecaja"  placeholder="Ingrese valor caja base" class="form-control input-lg" required />

              </div> 

            </div>     

          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Iniciar Ventas</button>

        </div>

      </form>

    
    </div>

  </div>

</div>
  
   <div id="modalCerrarPos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">
    
    <div class="modal-content">

		<form action="<?=URL_BASE?>puntoventa/guardarcierreventa" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        
        <div class="modal-header" style="background:#3c8dbc; color:white">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Cerrar venta Diaria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="box-body">
			  <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
				 <input type="hidden" name="id_sucursal" value="<?=$_SESSION['sucursal']->id?>"	/>		  
                <input type="date" name="fecha" placeholder="fecha"  value="<?= date('Y-m-d')?>" disabled class="form-control input-lg"  />

              </div> 

            </div>     
			  <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" name="caja"  placeholder="Ingrese Valor total" class="form-control input-lg" required />

              </div> 

            </div>     

          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cerrar Ventas</button>

        </div>

      </form>

    
    </div>

  </div>

</div>
  <script>
	$(function () {
    $('#puntoventas').DataTable()   
  })

</script>
