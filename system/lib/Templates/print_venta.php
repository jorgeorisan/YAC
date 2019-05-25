<?php
//include left panel (navigation)
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Venta","index"));


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

    <script type="text/javascript">
        window.print();
    </script>

    <style type="text/css">
        body {
            font-family: Arial;
            font-size: 11px;
        }
        table {
            font-family: Arial;
            font-size: 11px;
        }
        title{
            font-family: Arial;
            font-size: 12px;
        }
    </style>
</head>
<body style="text-align: center; width: 175px;">
    <table style="text-align:center; width:100%">
        <tr>
            <td colspan="2">
                <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="Yo Amo Comprar" style="width:150px; height:40">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label style="font-size: 10px"> <?php echo $ubicacion ?>
                </label>
            </td>
        </tr>
        <tr>
            <th>Folio</th>
            <td> <strong> <u><?php echo $data['folio']; ?></u></strong></td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td><?php echo $data['fecha']; ?></td>
        </tr>
        <tr>
            <th>Vendedor</th>
            <td><?php
                echo  $datauser['id_usuario']; ?></td>
        </tr>
        <tr>
            <th>Cliente</th>
            <td><?php echo $datacliente['nombre']." ".$datacliente['ap_materno']." ".$datacliente['ap_paterno']; ?></td>
        </tr>
        <tr>
            <th>Tipo Pago</th>
            <td><?php echo $data['tipo']; ?></td>
        </tr>
        <?php if($data['tipo']=="Credito") {
                $totalpagado = $obj->getpagado($id);
            ?>
            <tr>
                <th>Abono Inicial</th>
                <td><?php echo $totalpagado; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <h3>Artículos</h3>
    <table style="width:200px">
        <tbody>
            <tr>
                <th>Cant.</th>
                <th style="width: 70px">Producto</th>
                <th>Sub.</th>
                <th>Total</th>

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

                $total += $row['total'];
                ?>
                <tr >
                    <td> <?php echo $row['cantidad']; ?></td>
                    <td> <?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                    <td>$<?php echo number_format($row['total']/$row['cantidad'], 0); ?></td>
                    <td>$<?php echo number_format($row['total'], 0); ?></td>
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
                <td colspan="" align="right"><strong><?php echo number_format($total, 2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" align="right"><strong>Descuento $</strong></td>
                <td colspan="" align="right"><strong><?php echo number_format($data['descuento'], 2); ?></strong></td>
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
    <p class="title" style="    width: 200px;">
        <?php 
        if($data['tipo']=="Credito") { ?>
            GRACIAS POR SU COMPRA<br>
            USTED CUENTA CON 30 DIAS A PARTIR DE HOY PARA RECOGER SU PRODUCTO, AL FINALIZAR EL PERIODO DE TIEMPO EL ABONO NO ES REEMBOLSABLE.
            <?php 
        }ELSE{ ?>
            GRACIAS POR SU COMPRA<br>
            REVISE SU PRODUCTO,
            SALIDA LA MERCANCIA NO SE ACEPTAN DEVOLUCIONES

        <?php
        } ?>
    </p>
</body>
</html>