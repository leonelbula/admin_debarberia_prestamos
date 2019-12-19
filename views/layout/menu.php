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
	  <span class="logo-mini"><b><?php if(isset($_SESSION['sucursal']->nombre)){echo strtoupper($_SESSION['sucursal']->nombre);}else{echo'ADMIN';}?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php if(isset($_SESSION['sucursal']->nombre)){echo strtoupper($_SESSION['sucursal']->nombre);}else{echo'ADMIN';}?></b></span>
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
                  <a href="<?=URL_BASE?>usuario/salir" class="btn btn-default btn-flat">salir</a>
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
                
		<?php
		if (isset($_SESSION['sucursal'])) { ?>
		
		 <li><a href="<?=URL_BASE?>frontend/principal"><i class="fa fa-dashboard"></i> PRINCIPAL</a></li>  
		
		 <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>PUNTO DE VENTAS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>puntoventa/"><i class="fa fa-circle-o"></i>Iniciar Ventas</a></li>                      
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa fa-th"></i> <span>REALIZAR AVANCES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">           
			<li><a href="<?=URL_BASE?>sucursal/listaavences"><i class="fa fa-circle-o"></i> LISTA AVANCES ACTUAL</a></li>
<!--			<li><a href="sucursal/avancerealizado"><i class="fa fa-circle-o"></i> AVANCES REALIZADOS</a></li>-->
           
          </ul>
        </li>
		  <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>GASTOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>gastos/"><i class="fa fa-circle-o"></i> GASTOS</a></li>            
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>LIQUIDAR PAGO</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>sucursal/liquidarpago"><i class="fa fa-circle-o"></i> NUEVO PAGO</a></li>
            <li><a href="<?=URL_BASE?>sucursal/pagosrealizados"><i class="fa fa-circle-o"></i> PAGOS REALIZADOS</a></li>                   
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>PRODUCTOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>sucursal/productossucursal"><i class="fa fa-circle-o"></i> PRODUCTOS</a></li>           
            <li><a href="<?=URL_BASE?>sucursal/insumossucursal"><i class="fa fa-circle-o"></i> LISTA INSUMOS</a></li>            
          </ul>
        </li>
		<?php } else { ?>
					
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>SUCURSALES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>sucursal/"><i class="fa fa-circle-o"></i> LISTA SUCURSALES</a></li>
			<li><a href="<?=URL_BASE?>sucursal/ventassucursal"><i class="fa fa-circle-o"></i> VENTA ACTUAL</a></li>
          </ul>
        </li>        
		<li class="treeview">
          <a href="#">
            <i class="fa fa fa-th"></i> <span>VENTAS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">           
			<li><a href="<?=URL_BASE?>ventas/ventassucursal"><i class="fa fa-circle-o"></i> VENTAS POR SUCURSAL</a></li>
            <li><a href="<?=URL_BASE?>ventas/resportes"><i class="fa fa-circle-o"></i> REPORTES</a></li>
          </ul>
        </li>     
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>PRODUCTOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>productos/"><i class="fa fa-circle-o"></i> PRODUCTOS</a></li>
            <li><a href="<?=URL_BASE?>productos/categoria"><i class="fa fa-circle-o"></i> CATEGORIA</a></li>
            <li><a href="<?=URL_BASE?>productos/insumos"><i class="fa fa-circle-o"></i> LISTA INSUMOS</a></li>            
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>SERVICIOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>servicios/"><i class="fa fa-circle-o"></i> SERVICIOS</a></li>
			<li><a href="<?=URL_BASE?>servicios/reporte"><i class="fa fa-circle-o"></i> REPORTES</a></li>                      
          </ul>
        </li>		
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>PROVEEDOR</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>proveedor/"><i class="fa fa-circle-o"></i> PROVEEDORES</a></li>
            <li><a href="<?=URL_BASE?>proveedor/estadocuenta"><i class="fa fa-circle-o"></i> ESTADO DE CUENTA</a></li>                   
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>COMPRAS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="<?=URL_BASE?>compras/"><i class="fa fa-circle-o"></i> LISTA DE COMPRAS</a></li>
            <li><a href="<?=URL_BASE?>compras/trasladomercancia"><i class="fa fa-circle-o"></i> TRASLADOS SUCURSAL</a></li>
            <li><a href="<?=URL_BASE?>compras/reportescompra"><i class="fa fa-circle-o"></i> REPORTES</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>EMPLEADOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>empleados/"><i class="fa fa-circle-o"></i> LISTA DE EMPLEADO</a></li>	 
          </ul>
        </li> 
		<li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>PRESTAMOS EMPLEADOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>sucursal/prestamossucursal"><i class="fa fa-circle-o"></i> LISTA PRESTAMOS</a></li>			
	
          </ul>
        </li>       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>PRESTAMOS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>prestamos/"><i class="fa fa-circle-o"></i>LISTA DE PRESTAMOS</a></li>			
            <li><a href="<?=URL_BASE?>prestamos/relizarprestamo"><i class="fa fa-circle-o"></i>REALIZAR PRESTAMOS</a></li>
			<li><a href="<?=URL_BASE?>prestamos/cliente"><i class="fa fa-circle-o"></i>CLIENTES</a></li>
            <li><a href="<?=URL_BASE?>prestamos/estadocuenta"><i class="fa fa-circle-o"></i> ESTADO DE CUENTA</a></li>
            <li><a href="<?=URL_BASE?>prestamos/pagorecividos"><i class="fa fa-circle-o"></i> PAGOS RECIBIDOS</a></li>
			<li><a href="<?=URL_BASE?>prestamos/reportes"><i class="fa fa-circle-o"></i> REPORTES</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>PARAMETROS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=URL_BASE?>parametros/"><i class="fa fa-circle-o"></i> CONFIGURACIONES</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      <?php
		
		}
		?>
	  </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
