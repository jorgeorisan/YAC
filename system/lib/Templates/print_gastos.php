<?php
$obj = new Gastos();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Gastos","index"));
}
$status = htmlentities($data['status']);
switch ($status) {
	case 'active':
		$status = 'Activo';
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


$objuser = new User();
$datauser = $objuser->getTable($data['id_user']);

$objgastostipo = new GastosTipo();
$datagastostipo = $objgastostipo->getTable($data['id_gastostipo']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/corazon.ico" rel="shortcut icon">
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
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Tipo Gasto </td>
                                    <td colspan="2"><?php echo htmlentities($datagastostipo['nombre']); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                    <td colspan="2" style=""><?php echo date("Y-m-d",strtotime($data["fecha_alta"])); ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Usuario </td>
                                    <td colspan="2"><?php echo htmlentities($datauser['nombre']); ?></td>
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
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS</td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Concepto: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($data['nombre']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;"> </td>
                        <td colspan="" style="width:30%;"></td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Comentarios: </td>
                        <td colspan="" style="width:30%;"><?php echo htmlentities($data['comentarios']); ?></td>
                        <td colspan="" style="width:20%;background-color:#d0d0cf; font-weight:bold;"> </td>
                        <td colspan="" style="width:30%;"></td>
                    </tr>
                        <tr>
                        <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">CONCEPTOS </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="width:100%;">
                            <table style="height: 100%;width:100%;">
                                <tr>
                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Tipos </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo Gasto</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Detalles</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                </tr>
                                <?php 
                                $objref = new GastosRegistros();
                                $dataref = $objref->getAllArr($id);
                                $totalrefaccion = 0 ;
                                foreach($dataref as $row) {
                                                                                                
                                    $objgastostipo = new GastosTipo();
                                    $datagastostipo = $objgastostipo->getTable($row['id_gastostipo']);
                                    $nombre = htmlentities($datagastostipo['nombre']) ;
                                    $status = htmlentities($row['status']);
                                    switch ($row['status']) {
                                        case 'delete':
                                            $status = 'Cancelado';
                                            $class  = 'cancelada';
                                            break;
                                        default:
                                            $class  = '';
                                            $totalrefaccion+= $row['total'];
                                            break;
                                    } 
                                ?>
                                <tr class="<?php echo $class; ?>">
                                    <td><?php echo htmlentities($row['cantidad']); ?></td>
                                    <td><?php echo htmlentities($nombre); ?></td>
                                    <td><?php 
                                        if ( $nombre == 'Pago de nomina'){
                                            $folionomina = '';
                                            if( $row['detalles'] > 0 ){
                                                $nomina = new Nomina();
                                                $nominarow = $nomina->getTable($row['detalles']);
                                                $folionomina = $nominarow['nombre'];
                                            }
                                            ?>
                                            <a class="" href="<?php echo make_url("Nomina","view",array('id'=>$row['detalles'])); ?>"><?php echo htmlentities( $folionomina ); ?></a>
                                        <?php  
                                        }else{
                                            echo htmlentities($row['detalles']);
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo htmlentities($row['total']); ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                <tr>
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
</body>

</html>