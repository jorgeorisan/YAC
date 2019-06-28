<?php
$obj = new Traspaso();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Traspasos","index"));
}

$tienda = new Tienda();
$datatienda = $tienda->getTable($data['id_tiendaanterior']);
$datatiendaanterior = $tienda->getTable($data['id_tienda']);

$usuario = new Usuario();
$datauser = $usuario->getTable($data['id_user']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/corazon.ico" rel="shortcut icon">
    <title>Yo Amo Comprar</title>
    <script type="text/javascript">
        window.print();
    </script>
    <style>
        body { font-family:"Arial",sans-serif; font-size:11px;color:#666;}
        table td table td{ padding:4px 6px;border:1px solid #d0d0cf; line-height:1em; height:1em;}
        th {background-color:#d0d0cf; font-weight:bold;padding:4px 6px;border:1px solid #d0d0cf; line-height:1.5em; height:1em;}
        p { margin:0;}
        .td-inventario{
                height: 0em;
        }
    </style>
</head>

<body>
    <table style="width:100%;">
        <tr>
            <td>
                <table>
                    <tr>
                        <td height="100" style="width:15%;border:none;">
                            <img src="<?php echo ASSETS_URL; ?>/img/logo.png" border="0" height="80" width="260"/>
                        </td>
                        <td style="width:40%; text-align:center;border:none;">
                            <h3>Yo Amo Comprar</h3>
                            <p style=" line-height:1.5em; font-weight:bold;"><?php echo $datatienda['ubicacion']?><br />
                                Zitacuaro,Mich., Mexico<br>
                                Tel.7151108800<br>
                                R.F.C:AARL921226DJ6
                            </p>
                        </td>
                        <td style="width:32%;border:none;">
                            <table style="width:100%; text-align:center;">
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Folio No.</td>
                                    <td colspan="2" style="color:red;"><?php echo $data["folio"]; ?></td>
                                </tr>
                                
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                    <td colspan="2" style=""><?php echo date("Y-m-d H:i:s",strtotime($data["fecha"])); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
                                    <td colspan="2"><?php echo htmlentities($datauser['id_usuario']); ?></td>
                                </tr>

                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Tienda </td>
                                    <td colspan="2"><?php echo htmlentities($datatienda['nombre']); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Total Costo</td>
                                    <td colspan="2">$<?php echo htmlentities($data['costo_total']); ?></td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%;" class="table table-striped table-bordered table-hover">
                    <tr>
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DE LA ENTRADA</td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tienda Origen: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($datatienda['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Status: </td>
                        <td colspan=""><?php echo htmlentities($data['status']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tienda Destino: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($datatiendaanterior['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Observaciones: </td>
                        <td colspan=""><?php echo $data['comentarios']; ?></td>
                    </tr>
                        <tr>
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">PRODUCTOS DE ENTRADA : </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:100%;">
                            <table style="height: 100%;width:100%;">
                                <tr>
                                    <td colspan="11" style="background-color:#d0d0cf; font-weight:bold; text-align: center"> </td>
                                </tr>
                                <tr>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cantidad Ant/Nva</td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Mayoreo </td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Precio </td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total </td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Status</td>
                                    </tr>
                                    <?php 
                                    $objpv = new TraspasoProducto();
                                    $datapv = $objpv->getAllArr($id,true);
                                    $totalgral  =  $totalcostogral = $totalutigral = 0;
                                    foreach($datapv as $row) {
                                        $objproductos = new Producto();
                                        $dataproducto = $objproductos->getTable($row['id_producto']);
                                        $totalcosto   = $row['totalcosto'];
                                        $total        = $row['cantidad']*$row['precio'];
                                        $utilidad        = $total - $totalcosto;
                                        $status = htmlentities($row['status']);
                                        switch ($status) {
                                            case 'BAJA':
                                                $status = 'Cancelado';
                                                $class  = 'cancelada';
                                                break;
                                            default:
                                                $class  = '';
                                                $totalcostogral += $totalcosto;
                                                $totalgral      += $total;
                                                $totalutigral   += $total - $totalcosto;
                                                break;
                                        } 
                                        ?>
                                        <tr class="<?php echo $class; ?>">
                                            <td><?php echo htmlentities($row['cantidad_anterior']).'/'.htmlentities($row['cantidad']); ?></td>
                                        
                                            <td><?php echo htmlentities($dataproducto['codinter']).'|'.htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                            
                                            <td><?php echo htmlentities($row['mayoreo']); ?></td>
                                            <td><?php echo htmlentities($row['precio']); ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo htmlentities($row['status'])."<br>".$row['fecha_validacion']; ?></td>
                                           
                                        </tr>

                                    <?php
                                    } 
                                ?>
                                <tr>  
                                    <td colspan="3"></td>
                                    <td style='font-weight:bold;'>Total:</td>
                                    <td><strong><?php echo $totalgral; ?></strong></td>
                                   
                                    <td></td> 
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        
    </table>
</body>

</html>