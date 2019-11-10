<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Estado de Cuenta
	</h1>
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      
      <li class="active"> Estado de Cuenta</li>
    </ol>

  </section>

  <section class="content">

    <div class="box">  
		<div class="box-header with-border">
			<?php 
			
         while ($row1 = $totalPrestamos->fetch_object()) {
                  $totalP = $row1->total; 
                  $totalU = $row1->utilidad;
               }
			while ($row = $detalles->fetch_object()):
					$capital = $row->total;				
					$utilidad = $row->utilidad;
               $totalCoutas = $row->totalCuota
			
               
			?>
         
		  			
		</div>
		<div class="box-header with-border">
			 <div class="row invoice-info">
				
				<div class="col-sm-6 invoice-col">	
                <h3><strong>CAPITAL INVERTIDO:</strong> <?= number_format($capital) ?></h3>
										
				  <address>                 
					  <h3><strong>UTILIDAD A GENERAR: </strong>  <?= number_format($utilidad) ?> <br></h3>
                 <hr>
					  <h3><strong>TOTAL: </strong> <?= number_format($utilidad + $capital) ?> <br></h3>
					  	
				  </address>                                
                <hr>
                <hr>
                <address>                 
					  <h3><strong>COBROS DIARIOS A RECIBIR: </strong>  <?= number_format($totalCoutas) ?> <br></h3>
                 <hr>
					  <h3><strong>TOTAL PRESTAMOS COBRADOS: </strong> <?= number_format($totalP) ?> <br></h3>
                 <h3><strong>TOTAL UTILIDAD RECIBIDA: </strong> <?= number_format($totalU) ?> <br></h3>
					  	
				  </address>
				</div>
			 </div>
			<?php 				  
					
			endwhile;
					 
			 ?>   
		</div>
		

      <div class="box-body">
         
        

      </div>
		
        
    </div>
	  <div class="box-footer">
          Abono a Prestamo
        </div>

  </section>

</div>

	
