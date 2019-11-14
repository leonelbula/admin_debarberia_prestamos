<div class="content-wrapper">
    
  <section class="content-header">
      
    <h1>
      Detalles Proveedor
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Detalles Proveedor</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?=URL_BASE?>proveedor/">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">

          volver

          </button>
		  </a>
      </div>
		

      <div class="box-body">
         
		  <div class="panel panel-default">
			  <div class="panel-heading"><h4>Informacion de Proveedor</h4></div>
				<ul class="list-group">			  
				<?php while ($row = $detallesProveedor ->fetch_object()):

				 ?>
			  
					<li class="list-group-item"><h4><b>Nombre:</b> <?= strtoupper($row->nombre)?></h4></li>
				  <li class="list-group-item"><h4><b>Nit:</b> <?=$row->nit?></h4></li>
				  <li class="list-group-item"><h4><b>Direccion:</b> <?= strtoupper($row->direccion)?></h4></li>
				  <li class="list-group-item"><h4><b>Departamento:</b> <?= strtoupper($row->departamento)?></h4></li>
				  <li class="list-group-item"><h4><b>Ciudad:</b></b> <?= strtoupper($row->ciudad)?></h4></li>				  
				  <li class="list-group-item"><h4><b>Telefono:</b> <?= $row->telefono?></h4></</li>
				 
				  <?php endwhile; ?>
			  </ul>
		  </div>

   

      </div>
	</div>
        
    </div>

  </section>

</div>
