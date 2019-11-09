<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Lista sucrsales
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Sucursal</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		 
      </div>
		

      <div class="box-body">
         
		  <table id="tablasPedido" class="table table-bordered table-striped dt-responsive " width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>Razon Social</th>   			 
			  <th>Telefono</th>
			  <th>Correo</th>
			  <th>Vendedor</th>
			  <th>Tel-Vendedor</th>
               <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			  
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Pedidos
        </div>

  </section>

</div>

<script>
$(function () {
    
    $('#tablasPedido').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
