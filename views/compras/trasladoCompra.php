<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor Traslado Mercancia
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
        <li><a>TrasladoMercancia</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">lista de traslado</h3>

        </div>
		  <div class="box-body">
			  <div class="box-header with-border">
				  <a href="<?= URL_BASE ?>compras/nuevotraslado">
					  <button class="btn btn-primary">

						  Nuevo Traslado

					  </button>
				  </a>
			  </div>
        </div>
		   <div class="box-body">
		  <table class=" table table-bordered table-striped dt-responsive tablaTraslado" style="width:100%">
        <thead>
            <tr>
				<th>#</th>
				<th>Fecha</th>
                <th>N° Traslado</th>
                <th>Sucursal</th>                
				<th>Valor</th>						
				<th>acciones</th>
            </tr>
        </thead>		
    </table>
		   </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Traslados
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
