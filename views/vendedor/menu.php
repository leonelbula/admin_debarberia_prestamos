<?php
if (!isset($_SESSION['identity'])) {
	echo'<script>

					swal({
						  type: "success",
						  title: "Cerrado el sistema",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "'.URL_BASE.'";

							}
						})

	</script>';
	//header('Location:' . URL_BASE);
}
?>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?=URL_BASE?>frontend/principal" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
	  <span class="logo-mini"><b></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navegación</span>
      </a>	  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">        
        
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Hay  notificaciones</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
					  <a href="" class="actualizarNotificaciones" item="producto_stock">
                      <i class="fa fa-shopping-cart text-red"></i> Hay Productos Stock bajo
                    </a>
                  </li>                  
<!--                  <li>
                    <a href="" class="actualizarNotificaciones" item="cliente_mora">
                      <i class="fa fa-users text-red"></i>  Tienes Clientes mora
                    </a>
                  </li>                        -->
                </ul>
              </li>              
            </ul>
          </li>         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              
              <span class="hidden-xs"><?= $_SESSION['identity']->nombre ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">                

                <p>
                  <?= $_SESSION['identity']->nombre ?>
                 
                </p>
              </li>           
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=URL_BASE?>vendedores/salir" class="btn btn-default btn-flat">salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">    
     
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
             
				
	  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
