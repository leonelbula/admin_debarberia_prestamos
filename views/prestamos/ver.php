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
					$valorPrestamo = $row->valortotal;
					
					$id = $row->id_cliente;
					 $datosCliente = prestamosController::listaClienteId($id);
					
					 foreach ($datosCliente as $key => $value) {
						 $nombre = $value['nombre'];
					 }
			
			?>
		  <a href="<?=URL_BASE?>prestamos/">
          <button class="btn btn-primary">

           Cancelar

          </button>
		  </a>
			<?php if($row->saldo > 0):?>		
			 
			<a href="<?= URL_BASE ?>prestamos/abonar&id=<?= $_GET['id'] ?>">
				<button class="btn btn-primary ">
					<i class="fa fa-dollar"></i> Abonar
				</button>
			</a>
			<?php endif; ?>
		</div>
		<div class="box-header with-border">
			 <div class="row invoice-info">
				
				<div class="col-sm-4 invoice-col">	
					<h3><strong>Nombre:</strong> <?= $nombre ?></h3>
										
				  <address>
					  <h4><strong>Fecha de Entrega: </strong> <?= $row->fecha_entrega?> <br></h4>
					  <h4><strong>Fecha Vencimiento: </strong> <?= $row->fecha_vencimiento?> <br></h4>
					   <h4><strong>Plazo: </strong> <?= $row->num_cuotas?> Dias<br></h4>
					  <h4><strong>Numero de Registro: </strong><?= $row->id?> <br></h4>
					  <h4><strong>Valor del prestamo : </strong> <?= number_format($row->valor) ?><br></h4>
					  <h4><strong>Total a Pagar : </strong> <?= number_format($row->valortotal) ?> <br></h4>	
					  <h4><strong>Saldo : </strong> <?= number_format($row->saldo) ?> <br></h4>	
				  </address>
				</div>
			 </div>
			<?php 				  
					
			endwhile;
					 
			 ?>   
		</div>
		

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablaestadocuentaprestamo" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">N°</th>			 
              <th>Fecha abono</th>
			  <th>Valor abono</th> 			  		
			 		  
              <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			   <?php 
							   
			  $i = 1;
			 
			   foreach ($listaAbono as $key => $value):			  
			   				
				 ?>
                <tr>
                  <td><?= $i++ ?></td>
				  <td><?= $value['fecha']?></td>
				  <td><?= number_format($value['valor'])?></td>			  
				    	  
                  <td>
					  <div class="btn-group">
						  <a href="<?=URL_BASE?>prestamos/editarabono&id=<?= $value['id']?>">
							  <button class="btn btn-warning btnEditarCategoria">
								  <i class="fa fa-pencil"></i> Editar
							  </button>
						  </a>	
						  <a>
							  <button class="btn btn-danger btnEliminarAbono" idabono="<?= $value['id']?>">
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