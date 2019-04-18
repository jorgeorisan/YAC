<?php
$obj = new Personal();
$data = $obj->getAllServices($fechaini,$fechafin,$id);
?>
<div class="widget-body">
    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
            <tr>
                <th>codigo</th>
                <th>servicio</th>
                <th>Auto</th>
                <th>Fecha Inicial</th>
                <th>Fecha Estimada</th>
                <th>Fecha Final</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(count($data)){
            $totalglobal = $totalglobalserv = 0;
            foreach($data as $lineId => $row) {
                $idpersonal = $row['id_personal'];
               
                $nombre         = htmlentities($row['nombre'].' '.$row['apellido_pat'].' '.$row['apellido_mat']) ;
                $nombrevehiculo =  htmlentities($row['marca']." ".$row['submarca']." - ". $row['modelo']);
                $id_vehiculo    =  htmlentities($row['id_vehiculo']);
                $status         = htmlentities($row['status']);
                $porcentaje ="Fijo";
                $totalserv      = $row['total'];
                switch ($row['forma_pago']) {
                    case 'Fijo':
                        $total = $row['cantidad'];
                        break;
                    default:
                        $total      = $row['total']*($row['cantidad']/100);
                        $porcentaje = $row['cantidad']."%";
                       
                        break;
                }
                $totalglobal+= $total;
                $totalglobalserv+= $totalserv;
            ?>
            <tr class='personal' lineidpersonal='<?php echo $lineId; ?>'>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['servicio']; ?></td>
                <td><?php echo $nombrevehiculo; ?></td>
                <td><?php echo $row['fecha_inicio']; ?></td>
                <td><?php echo $row['fecha_estimada']; ?></td>
                <td><?php echo $row['fecha_fin']; ?></td>
                <td><?php echo number_format($totalserv,2); ?></td>
                
            </tr>

            <?php
            } 
            echo "
            <tr>
                <td></td>  <td></td>  <td></td>  <td></td>  <td></td>  
                <td><strong>Total Serv.</strong></td>
                <td><strong>$ ".number_format($totalglobalserv,2)."</strong></td>
            </tr>
            <tr>
                <td></td>  <td></td>  <td></td>  <td></td>  <td></td>  
                <td><strong>Total Pago</strong></td>
                <td><strong>$ ".number_format($totalglobal,2)."</strong></td>
            </tr>";
        }else{
            echo "<tr ><td colspan=7> No se encontraron resultados</td></tr>";
        }
            ?>
        </tbody>
    </table>
</div>
		
<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>