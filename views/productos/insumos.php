<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor de Insumos
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Pincipal</a></li>
        <li><a>Insumos</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">lista de Insumos</h3>

        </div>
		  <div class="box-body">
			  <div class="box-header with-border">
				  <a href="<?= URL_BASE ?>productos/registrarinsumo">
					  <button class="btn btn-primary">

						  Nuevo Insumo

					  </button>
				  </a>
			  </div>
        </div>
		   <div class="box-body">
		  <table class=" table table-bordered table-striped dt-responsive " style="width:100%">
        <thead>
            <tr>
				<th>#</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Costo</th>				
				<th>Stock</th> 
				<th>acciones</th>
            </tr>
        </thead>		
    </table>
		   </div>
        <!-- /.box-body -->
        <div class="box-footer">
          insumos
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
