<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor de abono a prestamos
	</h1>
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor estado de abonos</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">  
		<div class="box-header with-border">
			<?php 
			
		
			while ($row = $detalles->fetch_object()):
					$valorAvance = $row->total;
					
					$id = $row->id_estilista;
			
					$datosCliente = empleadosController::estilistasId($id);
					
					 foreach ($datosCliente as $key => $value) {
						 $nombre = $value['nombre'];
					 }
					
			
			?>
		  <a href="<?=URL_BASE?>sucursal/listaavences">
          <button class="btn btn-primary">

           Cancelar

          </button>
		  </a>			
		</div>
		<div class="box-header with-border">
			 <div class="row invoice-info">
				
				<div class="col-sm-4 invoice-col">	
					<h3><strong>Nombre:</strong> <?= $nombre ?></h3>
										
				  <address>
					  <h4><strong>Fecha de Entrega: </strong> <?= $row->fecha?> <br></h4>								 
					  <h4><strong>Total: </strong> <?= number_format($valorAvance) ?> <br></h4>	
					 
				  </address>
				</div>
			 </div>
			<?php 				  
					
			endwhile;
					 
			 ?>   
		</div>
		

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablasAvancesDetallesSucursal" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">N°</th>			 
              <th>Fecha </th>
			  <th>Valor </th> 			  		
			 		  
              <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			   <?php 
							   
			  $i = 1;
			 
			   foreach ($listaAvances as $key => $value):			  
			   				
				 ?>
                <tr>
                  <td><?= $i++ ?></td>
				  <td><?= $value['fecha']?></td>
				  <td><?= number_format($value['valor'])?></td>			  
				    	  
                  <td>
					  <div class="btn-group">
						  <a href="<?=URL_BASE?>sucursal/editaravance&id=<?= $value['id']?>">
							  <button class="btn btn-warning ">
								  <i class="fa fa-pencil"></i> Editar
							  </button>
						  </a>	
						  <a>
							  <button class="btn btn-danger btnEliminarAvence" idabono="<?= $value['id']?>">
								  <i class="fa fa-times"></i> Eliminar
							  </button>
						  </a>	
						 
					  </div>
				  </td>
                </tr>
				<?php endforeach; ?>
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Abono a Prestamo
        </div>

  </section>

</div>

	<script>
  $(function () {
    $('.tablaestadocuentaprestamo').DataTable()   
  })
</script>