<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Detalles venta sucursal
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Detalles venta sucursal</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>sucursal/ventas">
          <button class="btn btn-primary" >

          volver

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
		  <div class="panel panel-default">
			  <div class="panel-heading"><h4>Informacion de venta Sucursal</h4></div>
				<ul class="list-group">			  
				<?php while ($row = $detalleSucursal ->fetch_object()):
					$id_sucursal = $row->id;
				 ?>
					<li class="list-group-item"><h3><b>NOMBRE SUCURSAL:</b> <?= strtoupper($row->nombre)?></h3></li>	
				  <?php endwhile; ?>
				  
			  </ul>
			  <div class="col-sm-6 invoice-col">
					<?php
					$id = $id_sucursal;
					$valorVenta = sucursalController::ventasdiarioproductossucursal($id);
					$valorServicio = sucursalController::ventasdiarioserviciossucursal($id);
					?>
                <h3><strong>VENTA SERVICIO:</strong> <?= number_format($valorServicio->total) ?></h3>
										
				  <address>                 
					  <h3><strong>VENTA PRODUCTOS: </strong>  <?= number_format($valorVenta->total) ?> <br></h3>
                 <hr>
					  <h3><strong>VENTAS TOTAL: </strong> <?= number_format($valorVenta->total + $valorServicio->total) ?> <br></h3>
					  	
				  </address>                                
                <hr>
               
                
				</div>
		  </div>

		   <div class="row invoice-info">
								
			 </div>			

      </div>
	</div>
        
    </div>

  </section>

</div>
