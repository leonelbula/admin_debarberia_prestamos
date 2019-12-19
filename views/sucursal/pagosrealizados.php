<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Lista Pagos realizados Barbero
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Pagos barbero</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?= URL_BASE ?>sucursal/liquidarpago">
					<button class="btn btn-primary">
						Nuevo Pago
					</button>
				</a>
		 
      </div>
		

      <div class="box-body">
         
		  <table id="tablasPrestamos" class="table table-bordered table-striped dt-responsive tablasPagosSucursal" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>NOMBRE</th>   			 
			  <th>FECHA</th>
			  <th>VALOR ENTREGADO</th>
			  <th>VALOR TOTAL</th>

            </tr>

          </thead>
		   <tbody>
			  
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Pagos Barberos
        </div>

  </section>

</div>

