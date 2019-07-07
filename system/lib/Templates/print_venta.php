<?php
$obj = new Venta();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Ventas","index"));
}

$tienda = new Tienda();
$datatienda = $tienda->getTable($data['id_tienda']);
$ubicacion  = $datatienda['ubicacion']."<br />";
$ubicacion .= "Tel: ".$datatienda['telefono']."<br />";
$ubicacion .= "RFC: ".$datatienda['rfc']."<br />";
$cliente = new Persona();
$datacliente = $cliente->getTable($data['id_persona']);

$usuario = new Usuario();
$datauser = $usuario->getTable($data['id_user']);
$totalpagado = $obj->getpagado($id);
$porcentpagado = ($totalpagado * 100  / $data['total']);

if ($porcentpagado >= 75)
    $class  = 'label label-success';
if (($porcentpagado >= 50 && $porcentpagado < 75) )
    $class  = 'label label-warning';
if ($porcentpagado < 50 )
    $class  = 'label label-danger';
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?php echo $datatienda['nombre']?></title>


    <style type="text/css">
        body {
            font-family: Arial;
            font-size: 11px;
        }
        table {
            font-family: Arial;
            font-size: 11px;
        }
        .title{
            font-family: Arial;
            font-size: 10px;
        }
        .font10{
            font-family: Arial;
            font-size: 10px;
        }
    </style>
</head>
<body style="text-align: center; width: 250px;">
    <table style="text-align:center; width:100%">
        <tr>
            <td colspan="2" style="">
                <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="Yo Amo Comprar" style="width:150px; height:40">
            </td>
        </tr>
        <tr>
            <td colspan="2"  class="font10">
                <label> <?php echo $ubicacion ?> </label>
            </td>
        </tr>
        <tr class="font10">
            <th>Folio</th>
            <td> <strong> <u><?php echo $data['folio']; ?></u></strong></td>
        </tr>
        <tr  class="font10">
            <th>Fecha</th>
            <td><?php echo date('Y-m-d H:m A',strtotime($data['fecha'])); ?></td>
        </tr>
        <tr class="font10">
            <th>Vendedor</th>
            <td><?php echo  $datauser['id_usuario']; ?></td>
        </tr>
        <tr class="font10">
            <th>Cliente</th>
            <td><?php echo $datacliente['nombre']." ".$datacliente['ap_materno']; ?></td>
        </tr>
        <tr class="font10">
            <th>Tipo </th>
            <td><?php echo $data['tipo']; ?></td>
        </tr>
        <?php if($data['tipo']=="Credito" || $data['tipo']=="Apartado") {
                $totalpagado = $obj->getpagado($id);

                $pagosventa = $obj->getpagos($id);

                foreach($pagosventa as $key => $pago){
                    $key ++;
                    $concepto = ($key==1) ? 'Abono Ini.' : date('Y-m-d',strtotime($pago['fecha_abono']));
                    
                   echo "<tr class='font10'>
                            <th>".$concepto."</th>
                            <td>$".number_format($pago['montoabono'],2)."</td>
                        </tr>";

                }
            ?>
            <tr class="font10">
                <th>Pagado</th>
                <td><strong>$<?php echo number_format($totalpagado,2); ?><strong></td>
            </tr>
            <tr class="font10">
                <th>Por Pagar</th>
                <td><strong>$<?php echo number_format($data['total']-$totalpagado,2); ?><strong></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <h3>Artículos</h3>
    <table style="width:250px">
        <tbody>
            <tr>
                <th>Cant.</th>
                <th style="width: 70px">Producto</th>
                <th>Precio</th>
                <th>Importe</th>

            </tr>
            <?php
            $total = 0;
            $costo = 0;
            $totalComision = 0;
            $totalieps=0;
            $totaliva=0;
            $show=0;
            $objpv = new ProductosVenta();
            $datapv = $objpv->getAllArr($data['id_venta']);
            foreach($datapv as $row) :
                if($row['cancelado']) continue;
                $tipoprecio = ($row['tipoprecio']!='Normal') ?  "<br>".htmlentities(ucwords(strtolower($row['tipoprecio']))) : '';
                $precio = number_format($row['total']/$row['cantidad'], 0);

                $total += $row['total'];
                ?>
                <tr class="font10">
                    <td> <?php echo $row['cantidad']; ?></td>
                    <td> <?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                    <td>$<?php echo $precio; ?></td>
                    <td>$<?php echo number_format($row['total'], 0).$tipoprecio; ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
        <?php 
        if($data['descuento']){
            ?>
            <tr> 
                <td colspan="3" align="right"><strong>Subtotal $</strong></td>
                <td colspan="" align="right"><?php echo number_format($total, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Descuento $</strong></td>
                <td colspan="" align="right"><?php echo number_format($data['descuento'], 2); ?></td>
            </tr>
            <?php 
        } 
        $totaldesc = ($data['descuento']) ? $data['descuento'] : 0;
        ?>
       
        <tr>
           
            <td colspan="3" align="right"><strong>Total $</strong></td>
            
            <td colspan="" align="right"><strong><?php echo number_format($total-$totaldesc, 2); ?></strong></td>
            
        </tr>


    </table>
    <p class="title" style="width: 250px;">
        <?php 
        if($data['tipo']=="Credito" || $data['tipo']=="Apartado") { ?>
            GRACIAS POR SU COMPRA<br>
            USTED CUENTA CON 30 DIAS A PARTIR DE HOY PARA RECOGER SU PRODUCTO, AL FINALIZAR EL PERIODO DE TIEMPO EL ABONO NO ES REEMBOLSABLE.
            <?php 
        }else{ ?>
            GRACIAS POR SU COMPRA<br>
            REVISE SU PRODUCTO,
            SALIDA LA MERCANCIA NO SE ACEPTAN DEVOLUCIONES

        <?php
        } ?>
    </p>
    
    <?php if($data['sorteo']=="1" && $data['id_persona']!="2") { ?>
    <br>
    - - - - - - - - - - - - - - - - - - - - - - - - - 
    <br>
        <p class="title" style="width: 250px;">
            Folio participante: <strong><?php echo $data['folio']; ?></strong><br>
            Fecha Compra: <strong><?php  echo date('Y-m-d H:m A',strtotime($data['fecha'])); ?></strong><br>
        </p>
    <?php } ?>
</body>

    <script type="text/javascript">
        window.print();
        <?php 
        if($close=='true'){
            echo "setInterval(function(){ window.close(); }, 2000); ";
        }
        ?>
        
    </script>
</html>