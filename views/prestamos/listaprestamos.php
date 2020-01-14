<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Lista Prestamos
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Prestamo</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?= URL_BASE ?>prestamos/relizarprestamo">
					<button class="btn btn-primary">
						Nuevo Prestamo
					</button>
				</a>
		 
      </div>
		

      <div class="box-body">
         
		  <table id="tablasPrestamos" class="table table-bordered table-striped dt-responsive tablasPrestamos" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>CLIENTE</th>   			 
			  <th>FECHA</th>
			  <th>INTERES</th>
			  <th>PLAZO</th>
			  <th>VALOR</th>
			  <th>TOTAL A PAGAR</th>
			  <th>VALOR CUOTA</th>
			  <th>FECHA VENCIMIENTO</th>
			  <th>SALDO</th>
               <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			  
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Prestamos
        </div>

  </section>

</div>


