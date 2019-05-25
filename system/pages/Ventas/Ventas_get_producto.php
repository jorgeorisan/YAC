<?php
$lineId = rand(1000, 100000);
?>
    <tr class="producto" lineid="<?php echo $lineId; ?>">
        <?php
            if(!$manual){ ?> 
                <input type="hidden" class="totales" name="total_producto[]" value="<?php echo ($cantidad * $precioventa); ?>"/>
            <?php 
            }
        ?>    
        <input type="hidden" class=""        name="tipoprecio[]"  value="<?php echo $tipoprecio; ?>"/>
        <input type="hidden"                 name="cantidad[]"    value="<?php echo $cantidad; ?>"/>
        <input type="hidden"                 name="id_producto[]" value="<?php echo $id_producto; ?>"/>
        <input type="hidden"                 name="id_productotienda[]" value="<?php echo $id_productotienda; ?>"/>
        <td style="padding-left: 20px;"><?php echo $cantidad; ?></td>
        <td><?php echo $codigo;   ?></td>
        <td><?php echo $nombre;   ?></td>
        <td>
            <div  title='Existentes con este precio: <?php echo $existenciatienda ?>'>
                $<?php echo number_format($precioventa, 2) ?>
            </div>
        </td>
        <td>
            <?php
                if(!$manual){
                ?> 
                    $<?php echo number_format($cantidad * $precioventa, 2); ?> 
                <?php 
                }else{ ?>
                    <input type="text" style="width: 50px" class="totales" onblur=" calcTotal();" name="total_producto[]"
                       value="0"/>
                <?php 
                } 
            ?>
        </td>
        <td class='borrar-td'>
            <a href='javascript:void(0);' class='btn btn-danger borrar-producto' lineid='<?php echo $lineId ?>'> 
                <i class='glyphicon glyphicon-trash'></i> </a>
        </td>
    </tr>





