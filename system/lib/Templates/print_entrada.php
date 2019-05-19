<?php

$obj = new Entrada();
$data = $obj->getTable($id);
$obj->getstatus($id);
if ( !$data ) {
    informError(true,make_url("Entradas","index"));
}

$tienda = new Tienda();
$datatienda = $tienda->getTable($data['id_tienda']);
$proveedor = new ProveedorCompra();
$dataproveedor = $proveedor->getTable($data['id_proveedorcompra']);

$usuario = new Usuario();
$datauser = $usuario->getTable($data['id_user']);
$totalpagado = $obj->getpagado($id);
$porcentpagado = ($totalpagado * 100  / $data['costo_total']);

if ($porcentpagado >= 75)
    $class  = 'label label-success';
if (($porcentpagado >= 50 && $porcentpagado < 75) )
    $class  = 'label label-warning';
if ($porcentpagado < 50 )
    $class  = 'label label-danger';

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
    <table style="max-width:1280px; width:100%;">
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
                                <?php 
                                if($data['icredito']){
                                    ?>
                                    <tr>
                                        <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Por Pagar</td>
                                        <td colspan="2" class="<?php echo $class; ?>"><?php echo $totalpagado."->".number_format($porcentpagado,0)."%";; ?></td>
                                    </tr>
                                    <?php
                                }?>
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
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Proveedor: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($dataproveedor['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Status: </td>
                        <td colspan=""><?php echo htmlentities($data['status']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tipo pago: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($data['tipo_pago']); ?></td>
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
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant. Ant</td>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Producto</td>
                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Costo </td>
                                    <?php } ?>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Mayoreo </td>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Precio </td>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total </td>
                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Total Costo</td>
                                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold;">Utilidad</td>
                                    <?php } ?>
                                    <td colspan="" style="background-color:#d0d0cf; font-weight:bold;"></td>
                                </tr>
                                <?php 
                                $objpv = new EntradaProducto();
                                $datapv = $objpv->getAllArr($id);
                                $totalgral  =  $totalcostogral = $totalutigral = 0;
                                foreach($datapv as $row) {
                                    $objproductos = new Producto();
                                    $dataproducto = $objproductos->getTable($row['id_producto']);
                                    $totalcosto   = $row['totalcosto'];
                                    $total        = $row['cantidad']*$row['precio'];
                                    $totalcostogral += $totalcosto;
                                    $totalgral      += $total;
                                    $utilidad        = $total - $totalcosto;
                                    $totalutigral   += $total - $totalcosto;
                                
                                ?>
                                    <tr >
                                        <td><?php echo htmlentities($row['cantidad_anterior']); ?></td>
                                        <td><?php echo htmlentities($row['cantidad']); ?></td>
                                        <td><?php echo htmlentities($dataproducto['codinter']); ?></td>
                                        <td><?php echo htmlentities(ucwords(strtolower($row['nombre']))); ?></td>
                                        <?php if($_SESSION['user_info']['costos']) { ?>
                                            <td><?php echo htmlentities($row['costo']); ?></td>
                                        <?php } ?>
                                        <td><?php echo htmlentities($row['mayoreo']); ?></td>
                                        <td><?php echo htmlentities($row['precio']); ?></td>
                                        <td><?php echo $total; ?></td>
                                        <?php if($_SESSION['user_info']['costos']) { ?>
                                            <td><?php echo $totalcosto; ?></td>
                                            <td><?php echo $utilidad; ?></td>
                                        <?php } ?>
                                        <td class='borrar-td'>
                                            <?php if (!$row['cancelado']){ ?> 
                                                <a href="#" title="Cancelar Producto" id="cancelar_Entrada<?php echo $row['id_entrada_producto']; ?>" idEntrada='<?php echo $row['id_entrada_producto']; ?>' folio='<?php echo $row['nombre']; ?>' class="btn btn-danger deleteEntrada"> <i class="fas fa-ban"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php
                                } 
                                ?>
                                <tr>  
                                    <td colspan="4"></td>
                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                        <td></td> 
                                    <?php } ?>
                                    <td ></td> 
                                    <td style='font-weight:bold;'>Total:</td>
                                    <td><strong><?php echo $totalgral; ?></strong></td>
                                    <?php if($_SESSION['user_info']['costos']) { ?>
                                        <td><strong><?php echo $totalcostogral; ?></strong></td>
                                        <td><strong><?php echo $totalutigral; ?></strong></td>
                                    <?php } ?>
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