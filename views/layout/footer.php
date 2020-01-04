<script>
  $(function () {
  
    $('#ventas').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<input type="hidden" value="<?php echo URL_BASE; ?>" id="rutaOculta">
<?php if(isset($_SESSION['sucursal'])){ ?>
<input type="hidden" name="idSucursal" id="idsucursal" value="<?=  $_SESSION['sucursal']->id ?>" />
<?php }else{?>
<input type="hidden" name="idSucursal" id="idsucursal" value="0" />
<?php } ?>

<?php if(isset($_SESSION['identity'])){ ?>
<input type="hidden" name="idvendedor" id="idvendedor" value="<?=  $_SESSION['identity']->id ?>" />
<?php }else{?>
<input type="hidden" name="idvendedor" id="idvendedor" value="0" />
<?php } ?>

<script src="<?= URL_BASE ?>assets/js/ventaServicios.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaclientes.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaPrestamos.js"></script>
<script src="<?= URL_BASE ?>assets/js/prestamos.js"></script>
<script src="<?= URL_BASE ?>assets/js/productos.js"></script>
<script src="<?= URL_BASE ?>assets/js/proveedor.js"></script>
<script src="<?= URL_BASE ?>assets/js/sucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/insumos.js"></script>
<script src="<?= URL_BASE ?>assets/js/empleados.js"></script>
<script src="<?= URL_BASE ?>assets/js/barbero.js"></script>
<script src="<?= URL_BASE ?>assets/js/funcionesCompras.js"></script>
<script src="<?= URL_BASE ?>assets/js/proveedorCompra.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaCompras.js"></script>
<script src="<?= URL_BASE ?>assets/js/traslados.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaTraslado.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaServicios.js"></script>
<script src="<?= URL_BASE ?>assets/js/funcionesServicios.js"></script>
<script src="<?= URL_BASE ?>assets/js/funcionesComponentes.js"></script>
<script src="<?= URL_BASE ?>assets/js/cobrosServicio.js"></script>
<script src="<?= URL_BASE ?>assets/js/ventaProductos.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaPrestamosSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/avancesSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaVentaServicioSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaVentaProductoSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/pagosSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/productosSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaInsumoSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/cierreSucursal.js"></script>
<script src="<?= URL_BASE ?>assets/js/pagosServicio.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaVentaProducto.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaVentasServicio.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablavendedor.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaProductosVentas.js"></script>
<script src="<?= URL_BASE ?>assets/js/ventasVendedor.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaventasvendedor.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablavendedorcompras.js"></script>


</body>
</html>
