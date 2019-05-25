<?php
    $lineId = rand(1000, 100000);
    $show   = (!$_SESSION['user_info']['costos']) ? "display:none" : ''; 
?>
<tr class="producto" lineid="<?php echo $lineId; ?>">
    <input type="hidden"                 name="id_producto[]" value="<?php echo $id_producto; ?>"/>
    <input type="hidden"                 name="id_productotienda[]" value="<?php echo $id_productotienda; ?>"/>
    
    <?php 
        $obj = new Tienda();
        $list=$obj->getAllArr($_SESSION['user_info']['info_adicional']);
        if (is_array($list) || is_object($list)){
            foreach($list as $val){
                ?>
                <td class='<?php echo $val['abreviacion']; ?>'>
                    <input type="number" class='cantidad' style="width:40px" lineid="<?php echo $lineId ?>" abreviacion="<?php echo $val['abreviacion']?>" id='cantidad<?php echo $val['abreviacion'].$lineId ?>' placeholder='0' name="cantidad<?php echo $val['id_tienda']?>[]"  value="<?php echo $cantidad; ?>"/>
                </td>
                <?php
                $cantidad = 0;
            }
        }
    ?>
      
    <td><?php echo $codigo;   ?></td>
    <td><?php echo $nombre;   ?></td>
    <td>
        <div title='Existentes : <?php echo $existenciatienda ?>' style="<?php echo $show ?>">
            $<input type="number" style="width:50px" name="costo[]"   id='costo<?php echo $lineId; ?>'   value="<?php echo ($costo); ?>">
        </div>
    </td>
    <td> $<input type="number" style="width:50px" name="mayoreo[]" id='mayoreo<?php echo $lineId; ?>' value="<?php echo ($mayoreo); ?>"></td>
    <td> $<input type="number" style="width:50px" name="precio[]"  id='precio<?php echo $lineId; ?>'  value="<?php echo ($precio); ?>"></td>
    <td class='borrar-td'>
        <a href='javascript:void(0);' class='btn btn-danger borrar-producto' lineid='<?php echo $lineId ?>'> 
            <i class='glyphicon glyphicon-trash'></i> </a>
    </td>
</tr>





