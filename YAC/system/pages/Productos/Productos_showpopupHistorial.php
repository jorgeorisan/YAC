<table class="table table-striped table-bordered table-hover" width="100%" id="example2" >
    <thead>
    <tr>
        <th>ID</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Existencia Anterior</th>
        <th>Existencia</th>
        <th>Tienda</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($datah as $row): ?>
        <tr>
            <td><?php echo htmlentities($row['id_historialinventario'])?></td>
            <td><?php echo htmlentities($row['codinter'])?></td>
            <td><?php echo htmlentities($row['nombre'])?></td>
            <td><?php echo htmlentities($row['existencia_anterior']) ?></td>
            <td><?php echo htmlentities($row['existencia']) ?></td>
            <td><?php echo htmlentities($row['tienda']) ?></td>
            <td><?php echo htmlentities($row['id_usuario']) ?></td>
            <td><?php echo htmlentities($row['fecha_registro']) ?></td>
            <td><?php ?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script>
    $(document).ready(function () {
        $("[barcode]").click(function (e) {
            $("#barcode").val($(this).attr("barcode")).focus();
            $('#myModal').modal('hide');
        });
        $('#example2').dataTable();
    });
   
</script>