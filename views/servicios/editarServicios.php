<div class="content-wrapper">
	<section class="content-header">

		<h1>
			Registrar Nuevo Servicio
		</h1>

		<ol class="breadcrumb">

			<li><a href="<?= URL_BASE ?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

			<li class="active">Editar Nuevo Servicio</li>

		</ol>

	</section>
	<section class="content">

		<div class="box">

			<div class="box-header with-border">
				<a href="<?= URL_BASE ?>servicios/">
					<button class="btn btn-primary">

						Cancelar

					</button>
				</a>
			</div>


			<div class="box-body">
				<div class="col-md-8">
					<form class="formularioInsumo" action="<?= URL_BASE ?>servicios/actualizar" enctype="multipart/form-data" method="POST">
						<?php 
						
							while ($row = $detallesServicio->fetch_object()):
							
						 ?>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="codigo"></label>
									<input type="hidden" name="id" value="<?=$row->id?>" />
									<input type="text" class="form-control" disabled>
								</div>	
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="costo">Valor:</label>
									<input type="number" class="form-control costo" name="valor" value="<?= $row->valor?>"  required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" name="nombre" id="nombre" value="<?= $row->nombre?>" required>
						</div>
							
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
              
									<div class="panel">SUBIR IMAGEN</div>

									<input type="file" class="nuevaImagen" name="nuevaImagen">

									<p class="help-block">Peso máximo de la imagen 2MB</p>

									

								  </div>
							</div>	
							<div class="col-xs-6">
								<div class="form-group">
										<div class="panel">Vista Previa.</div>
										<input type="hidden" name="fotoActual" value="<?= $row->img?>"/>
										<?php if(!empty($row->img)): ?>
											<img src="<?=URL_BASE?>imagen/cortes/<?= $row->img?>" class="img-thumbnail previsualizar" width="100px">
										<?php else: ?>
											<img src="<?=URL_BASE?>imagen/servicios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
										<?php endif; ?>
								</div>
							</div>

						</div>
													
						<?php endwhile; ?>
						<button type="submit" class="btn btn-primary">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>


