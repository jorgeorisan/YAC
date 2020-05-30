

    <table class="table table-striped table-bordered table-hover" width="100%" id="example2" >
        <thead>
        <tr>
            <th class = "col-md-1" data-hide="phone,tablet"> ID</th>
            <th class = "col-md-1" data-class="expand"> Codigo</th>
            <th class = "col-md-1" data-hide="phone"> Nombre</th>
            <th class = "col-md-1" data-hide=""> Marca</th>
            <th class = "col-md-1" data-hide="phone,tablet"> Categ.</th>
            <?php if($_SESSION['user_info']['costos']) { ?>
                <th class = "col-md-1" data-hide="phone,tablet"> Costo</th>
            <?php } ?>
            <th class = "col-md-1" data-hide="phone,tablet"> Mayoreo</th>
            <th class = "col-md-1" data-hide="phone,tablet"> Precio</th>
            <th class = "col-md-1" data-hide="phone,tablet"> Exist.</th>
            <th class = "col-md-1" data-hide="phone,tablet">Action</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($productostienda as $row): ?>
            <tr>
                <td><?php echo htmlentities($row['id_producto'])?></td>
                <td><?php echo htmlentities($row['codinter'])?></td>
                <td><?php echo htmlentities($row['nombre'])?></td>
                <td><?php echo htmlentities($row['marca']) ?></td>
                <td><?php echo htmlentities($row['categoria']) ?></td>
                <?php if($_SESSION['user_info']['costos']) { ?>
                    <td><?php echo htmlentities($row['costo']) ?></td>
                <?php } ?>
                <td><?php echo htmlentities($row['preciomayoreo']) ?></td>
                <td><?php echo htmlentities($row['precio']) ?></td>
                <td><?php echo htmlentities($row['existenciastienda'].'/'.$row['existencias']) ?></td>
                <td barcode="<?php echo htmlentities($row['codinter']); ?>">
                    <a class="btn btn-success" href="#myModal" onclick="" > <i class="fa fa-check"></i></a> 
                </td>
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