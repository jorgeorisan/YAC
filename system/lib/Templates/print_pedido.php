<?php
$obj = new Pedido();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Pedido","index"));
}
$status = htmlentities($data['status']);
switch ($status) {
	case 'active':
		$status = 'Pendiente';
		$class  = 'label label-danger';
		break;
	case 'Validado':
		$status = 'Validado '.$data['fecha_validacion'];
		$class  = 'label label-success'; 
		break;
	case 'delete':
		$status = 'Cancelado';
		$class  = 'label label-warning';
		break;
	default:
		$class  = '';
		break;
} 

$objprov = new Proveedor();
$dataprov = $objprov->getTable($data['id_proveedor']);

$objalm = new Almacen();
$dataalma = $objalm->getTable($data['id_almacen']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.ico" rel="shortcut icon">
    <title>Maximus Body Shop</title>
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
                            <img src="<?php echo ASSETS_URL; ?>/img/logo.png" border="0" height="80" width="160"/>
                        </td>
                        <td style="width:40%; text-align:center;border:none;">
                            <h3>MAXIMUS BODY SHOP S, RL DE CV</h3>
                            <p style=" line-height:1.5em; font-weight:bold;">CALZADA DEL HUESO #777<br />
                                COLONIA: GRANJAS COAPA
                                DEL, TLALPAN C.P. 14330<br />
                                Tel.: (52)(55)56 03-1783 Correo:clinica@maximus.mx<br>
                                Horario de Servicio: L-V 09 Hrs. a 18 Hrs.<br>
                                Sabado  09 Hrs. a 18 Hrs.
                            </p>
                        </td>
                        <td style="width:32%;border:none;">
                            <table style="width:100%; text-align:center;">
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Folio No.</td>
                                    <td colspan="2" style="color:red;"><?php echo $data["id"]; ?></td>
                                </tr>
                                
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                    <td colspan="2" style=""><?php echo date("Y-m-d",strtotime($data["fecha_alta"])); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
                                    <td colspan="2"><?php echo htmlentities($data['usuarioalta']); ?></td>
                                </tr>

                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Almacen </td>
                                    <td colspan="2"><?php echo htmlentities($data['almacen']); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Validacion </td>
                                    <td colspan="2" class="<?php echo $class; ?>"><?php echo $status; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%;">
                    <tr>
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL PEDIDO </td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Nombre: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($data['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Validacion: </td>
                        <td colspan=""><?php echo htmlentities($data['fecha_validacion']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Proveedor: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($dataprov['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Almacen: </td>
                        <td colspan=""><?php echo htmlentities($dataalma['nombre']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">REFACCIONES DEL PEDIDO : </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:100%;">
                            <table style="height: 100%;width:100%;">
                                <tr>
                                    <td colspan="6" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Refacciones </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Costo Uni.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Precio Uni.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total Costo</td>
                                </tr>
                                <?php 
                                $objref = new PedidoRefaccion();
                                $dataref = $objref->getAllArr($id);
                                $totalrefaccion = 0 ;
                                foreach($dataref as $row) {
                                    $nombre = htmlentities($row['refaccion']) ;
                                    $status = htmlentities($row['status']);
                                    switch ($row['status']) {
                                        case 'delete':
                                            $status = 'Cancelado';
                                            $class  = 'cancelada';
                                            break;
                                        default:
                                            $class  = '';
                                            $totalrefaccion+= $row['totalcosto'];
                                            break;
                                    } 
                                ?>
                                <tr class="<?php echo $class; ?>">
                                    <td><?php echo htmlentities($row['cantidad']); ?></td>
                                    <td><?php echo htmlentities($nombre); ?></td>
                                    <td><?php echo htmlentities($row['costo']); ?></td>
                                    <td><?php echo htmlentities($row['precio']); ?></td>
                                    <td><?php echo htmlentities($row['totalcosto']); ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style='font-weight:bold;'>Total:</td>
                                    <td><strong><?php echo $totalrefaccion; ?></strong></td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        
    </table>
    <div style="width:90%; margin:0 auto;padding:1px 2px;border:1px solid #d0d0cf;">
        <p style="text-align:justify;">Los precios indicados en esta orden no incluyen IVA. No nos hacemos responsables por fallas mecanicas y electricas derivadas por el desgaste natural del vehiculo, ni por pertenencias olvidadas. El presente documento es expedido por el consumidor como pagare a favor del prestador del servicio el importe de este documento el dia de la entrega del vehiculo. Indispensable presentar identificacion oficial vigente para poder realizar la entrega del vehiculo.<br> No nos hacemos responsables por objetos personales olvidades en el vehiculo no reportados a recepcion, ni manifestado en el inventario. </p>
        <p></p>
    </div>
</body>

</html>