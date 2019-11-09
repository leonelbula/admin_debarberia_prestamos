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
<!-- Select2 -->


<script src="<?= URL_BASE ?>assets/js/ventaServicios.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaclientes.js"></script>
<script src="<?= URL_BASE ?>assets/js/tablaPrestamos.js"></script>
<script src="<?= URL_BASE ?>assets/js/prestamos.js"></script>

  
</body>
</html>
