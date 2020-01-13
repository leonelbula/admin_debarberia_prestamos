<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Gestor de cuenta 
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor estado de cuenta</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">
		<div class="box-header with-border">
		  <a href="<?=URL_BASE?>proveedor/estadocuenta">
          <button class="btn btn-primary">

           Cancelar

          </button>
		  </a>
      </div>
		<div class="row invoice-info">
				
				<div class="col-sm-4 invoice-col">	
					<?php 				  
					
						  
					 $id_vendedor = $_GET['id'];
					 $datosVendedor = ventasproductoController::ListaVendedoresId($id_vendedor);
					
					 foreach ($datosVendedor as $key => $value) {
						 $nombreVendedor = $value['nombre'];
						 $nit = $value['nit'];
					 }
					
					 ?>   
					<h3>&nbsp;&nbsp;&nbsp;<strong>Nombre:</strong> <?= $nombreVendedor ?></h3>
				  <address>					 
					  <h4>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nit: </strong> <?= $nit ?> <br></h4>
					 				
				  </address>
				</div>
			 </div>
		

      <div class="box-body">
         
        <table class="table table-bordered table-striped dt-responsive tablaestadocuentaprovedor" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>			 
              <th>N° factura</th>
			  <th>Fecha</th>
			  <th>A 30 días</th>
			  <th>A 45 días</th>
			  <th>A 60 días</th>
			  <th>mas de 61 días</th>
			  <th>Valor</th>
			  <th>Saldo</th> 			  
               <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			   <tr>   		   
			   <?php 
			   
			   while ($row =  $listaEstado ->fetch_object()) :
				  ?>
				  <td><?= $row->id?></td>
				  <td>Factura N°<?= $row->num_factura?></td>
				  <td><?= $row->fecha?></td>				  
				   <?php
				 $fechaAct = date('Y-m-d');
				 $fecha = $row->fecha;
				 $fechaActual = strtotime('+30 day', strtotime($fecha));
				 $fechaNueva = date('Y-m-d', $fechaActual);
				 $fechaActual2 = strtotime('+45 day', strtotime($fecha));
				 $fechaNueva2 = date('Y-m-d', $fechaActual2);
				 $fechaActual3 = strtotime('+60 day', strtotime($fecha));
				 $fechaNueva3 = date('Y-m-d', $fechaActual3);
				 $fechaActual4 = strtotime('+61 day', strtotime($fecha));
				 $fechaNueva4 = date('Y-m-d', $fechaActual4);
				 
				 
				 
				 if ($fechaNueva >= $fechaAct) {
					 echo '<td>'.number_format($row->saldo).'</td>'; 
				 } else{
					 echo '<td>0</td>';
				 }if ($fechaNueva2 >= $fechaAct && $fechaNueva < $fechaAct) {
					  echo '<td>'.number_format($row->saldo).'</td>'; 
				 } else{
					 echo '<td>0</td>';
				 }if ($fechaNueva3 >= $fechaAct && $fechaNueva < $fechaAct && $fechaNueva2 < $fechaAct) {
					  echo '<td>'.number_format($row->saldo).'</td>'; 
				 } else{
					 echo '<td>0</td>';
				 }if ($fechaNueva4 <= $fechaAct) {
					  echo '<td>'.number_format($row->saldo).'</td>'; 
				 } else {
					echo '<td>0</td>';
				 }
			 				
			   
				 ?>
               
				  <td><?= number_format($row->totalventa) ?></td>
				  <td><?= number_format($row->saldo) ?></td>

				  		  
                  <td>
					  <div class="btn-group">
						  <a href="<?=URL_BASE?>ventasproducto/abonosfactura&id=<?= $row->id?>">
							  <button class="btn btn-warning btnEditarCategoria">
								  <i class="fa fa-eye"></i> Ver Abonos
							  </button>
						  </a>
						  <?php if($row->saldo > 0):?>
						  <a href="<?=URL_BASE?>ventasproducto/abonarfactura&id=<?= $row->id ?>">
							  <button class="btn btn-primary btnEditarCategoria">
								  <i class="fa fa-edit"></i> Abonar
							  </button>
						  </a>
						 <?php endif; ?>
					  </div>
				  </td>
                </tr>
				<?php endwhile; ?>
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Cuentas 
        </div>

  </section>

</div>

