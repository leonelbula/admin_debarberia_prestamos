<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Detalles Sucuarsal
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Detalles Sucursal</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>sucursal/">
          <button class="btn btn-primary" >

          volver

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
		  <div class="panel panel-default">
			  <div class="panel-heading"><h4>Informacion de la Sucursal</h4></div>
				<ul class="list-group">			  
				<?php while ($row = $detallesSucursal ->fetch_object()):

				 ?>
			  
					<li class="list-group-item"><h4><b>Nombre:</b> <?= strtoupper($row->nombre)?></h4></li>				 
				  <li class="list-group-item"><h4><b>Direccion:</b> <?= strtoupper($row->direccion)?></h4></li>
				  <li class="list-group-item"><h4><b>Departamento:</b> <?= strtoupper($row->departamento)?></h4></li>
				  <li class="list-group-item"><h4><b>Ciudad:</b></b> <?= strtoupper($row->ciudad)?></h4></li>				  
				  <li class="list-group-item"><h4><b>Fecha Registro:</b> <?= $row->fecha_inicio?></h4></</li>
				 
				  <?php endwhile; ?>
			  </ul>
		  </div>

		   <div class="row invoice-info">
				
				<div class="col-sm-6 invoice-col">	
                <h3><strong>VALOR INVENTARIO:</strong> <?= number_format($valorInventario->total) ?></h3>
										
				  <address>                 
					  <h3><strong>UTILIDAD  GENERADA: </strong>  <?= number_format($utilidad = 40) ?> <br></h3>
                 <hr>
					  <h3><strong>VENTAS TOTALES: </strong> <?= number_format($utilidad) ?> <br></h3>
					  	
				  </address>                                
                <hr>
               
                
				</div>
			 </div>			

      </div>
	</div>
        
    </div>

  </section>

</div>
