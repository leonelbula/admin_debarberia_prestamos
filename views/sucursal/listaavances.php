<div class="content-wrapper">
    <input type="hidden" name="idSucursal" id="idsucursal" value="<?=  $_SESSION['sucursal']->id ?>" />
  <section class="content-header">
      
    <h1>
      Lista Avance
    </h1>
 
    <ol class="breadcrumb">

      <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Avances</li>
      
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
		  <a href="<?= URL_BASE ?>sucursal/relizaravance">
					<button class="btn btn-primary">
						Nuevo Avance
					</button>
				</a>
		 
      </div>
		

      <div class="box-body">
         
		  <table id="tablasPrestamos" class="table table-bordered table-striped dt-responsive tablasAvancesSucursal" width="100%">

          <thead>
            
            <tr>
              
              <th style="width:10px">Codigo</th>
              <th>EMPLEADO</th>   			 
			  <th>FECHA</th>			 
			  <th>VALOR</th> 
              <th>Acciones</th>

            </tr>

          </thead>
		   <tbody>
			  
		   </tbody>

        </table> 

      </div>
		
        
    </div>
	  <div class="box-footer">
          Avences
        </div>

  </section>

</div>


