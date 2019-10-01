<table class="table">
<?php  foreach($data as $row) {
           
            ?>
            <tr >
                <td>
                    <a href="javascript:seleccionarpersona(<?php echo $row['id_persona'] ?>)"><?php echo htmlentities($row['nombre'].' '.$row['ap_paterno'].' '.$row['ap_materno'])?></a></td>
                <td><a href="javascript:seleccionarpersona(<?php echo $row['id_persona'] ?>)"><?php echo htmlentities($row['email'])?></a></td>
                <td><a href="javascript:seleccionarpersona(<?php echo $row['id_persona'] ?>)"><?php echo htmlentities($row['telefono']) ?></a></td>
                <td><a href="javascript:seleccionarpersona(<?php echo $row['id_persona'] ?>)"><?php echo htmlentities($row['ciudad']." ".$row['estado']." Col. ".$row['colonia']." Calle. ".$row['calle']." Num. ".$row['num_exterior']." ".$row['num_interior']) ?></a></td>
                
             
            </tr>
<?php } ?>
</table>
