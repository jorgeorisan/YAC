<?php
    $lineId = rand(1000, 100000);
    $show   = (!$_SESSION['user_info']['costos']) ? "display:none" : ''; 
?>
<tr class="producto" lineid="<?php echo $lineId; ?>">
    <input type="hidden"                 name="id_producto[]" value="<?php echo $id_producto; ?>"/>
    <input type="hidden"                 name="id_productotienda[]" value="<?php echo $id_productotienda; ?>"/>
    
    <td>
    <?php echo $existenciatienda; ?>/<input type="number" readonly class='cantidad' style="width:40px" lineid="<?php echo $lineId ?>"  placeholder='0' name="cantidad[]"  value="<?php echo $cantidad; ?>"/>
    </td>        
      
    <td><?php echo $codigo;   ?></td>
    <td><?php echo $nombre;   ?></td>
    <td>
        <div title='Existentes : <?php echo $existenciatienda ?>' style="<?php echo $show ?>">
            $<input type="number" style="width:50px;" name="costo[]" readonly  id='costo<?php echo $lineId; ?>'   value="<?php echo ($costo); ?>">
        </div>
    </td>
    <td> $<input type="number" style="width:50px" name="mayoreo[]" readonly id='mayoreo<?php echo $lineId; ?>' value="<?php echo ($mayoreo); ?>"></td>
    <td> $<input type="number" style="width:50px" name="precio[]"  readonly id='precio<?php echo $lineId; ?>'  value="<?php echo ($precio); ?>"></td>
    <td class='borrar-td'>
        <a href='javascript:void(0);' class='btn btn-danger borrar-producto' lineid='<?php echo $lineId ?>'> 
            <i class='glyphicon glyphicon-trash'></i> </a>
    </td>
</tr>





