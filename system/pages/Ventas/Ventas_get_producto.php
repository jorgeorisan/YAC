<?php
$lineId = rand(1000, 100000);
?>
    <tr class="producto" lineid="<?php echo $lineId; ?>">
        <input type="hidden" class=""        name="costototal[]"  value="<?php echo ($cantidad * $costo); ?>"/>
        <input type="hidden" class="totales" name="total[]"       value="<?php echo ($cantidad * $precioventa); ?>"/>
        <input type="hidden" class=""        name="tipoprecio[]"  value="<?php echo $tipoprecio; ?>"/>
        <input type="hidden"                 name="cantidad[]"    value="<?php echo $cantidad; ?>"/>
        <input type="hidden"                 name="id_producto[]" value="<?php echo $id_producto; ?>"/>
        <td style="padding-left: 20px;"><?php echo $cantidad; ?></td>
        <td><?php echo $codigo;   ?></td>
        <td><?php echo $nombre;   ?></td>
        <td><div  title='Existentes con este precio: <?php echo $existenciatienda ?>'>$<?php echo number_format($precioventa, 2) ?></div></td>
        <td> $<?php echo number_format($cantidad * $precioventa, 2); ?> </td>
        <td class='borrar-td'>
            <a href='javascript:void(0);' class='btn btn-danger borrar-producto' lineid='<?php echo $lineId ?>'> 
                <i class='glyphicon glyphicon-trash'></i> </a>
        </td>
    </tr>





