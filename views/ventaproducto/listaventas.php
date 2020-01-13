<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de Ventas de Productos
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
        <li><a>VENTAS</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">lista de Productos</h3>

        </div>
		  <div class="box-body">
			  <div class="box-header with-border">
				  <a href="<?= URL_BASE ?>ventasproducto/nuevaventa">
					  <button class="btn btn-primary">

						  Nueva Venta

					  </button>
				  </a>
			  </div>
        </div>
		   <div class="box-body">
		  <table class=" table table-bordered table-striped dt-responsive tablaVentaProductovendedor" style="width:100%">
        <thead>
            <tr>
				<th>#</th>
                <th>Codigo</th>
                <th>Fecha</th>	
                <th>Nombre</th>                			
                <th>Valor</th>
                <th>Utilidad</th>
				    <th>Saldo</th> 
				<th>acciones</th>
            </tr>
        </thead>		
    </table>
		   </div>
        <!-- /.box-body -->
        <div class="box-footer">
          productos
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
