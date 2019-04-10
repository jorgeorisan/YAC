<?php
$obj = new Vehiculo();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Vehiculo","index"));
}
$nomclinica      = "";
$nommarca       = "";
$nomsubmarca    = "";
$nomaseguradora = "";
$nompaciente     = "";
$domicilio      = "";
$telefono       = ""; 
$email          = ""; 
$nombreasesor   = "";
if($data["id_user"]){
    $objacesor = new User();
    $dataasesor = $objacesor->getTable($data["id_user"]);
    if($dataasesor){ $nombreasesor   = $dataasesor["nombre"] ." ". $dataasesor["apellido_pat"]; }
}
if($data["id_clinica"]){
    $objclinica = new Clinica();
    $dataclinica = $objclinica->getTable($data["id_clinica"]);
    if($dataclinica){ $nomclinica = $dataclinica["nombre"]; }
}
if($data["id_marca"]){
    $objmarca = new Categoria();
    $datamarca = $objmarca->getTable($data["id_marca"]);
    if($datamarca){ $nommarca = $datamarca["nombre"]; }
}
if($data["id_marca"]){
    $objsubmarca = new Marca();
    $datasubmarca = $objsubmarca->getTable($data["id_marca"]);
    if($datasubmarca){ $nomsubmarca = $datasubmarca["nombre"]; }
}
if($data["id_aseguradora"]){
    $objaseguradora = new Aseguradora();
    $dataaseguradora = $objaseguradora->getTable($data["id_aseguradora"]);
    if($dataaseguradora){ $nomaseguradora = $dataaseguradora["nombre"]; }
}
if($data["id_paciente"]){
    $objpaciente = new Paciente();
    $datapaciente = $objpaciente->getTable($data["id_paciente"]);
    if($datapaciente){
        $nompaciente = $datapaciente["nombre"] ." ". $datapaciente["apellido_pat"] ." ". $datapaciente["apellido_mat"];
        $domicilio = $datapaciente["ciudad"]." ".$datapaciente["estado"]. " Col." .$datapaciente["colonia"] ." Call." .$datapaciente["calle"]." ".$datapaciente["num_ext"]. " " .$datapaciente["num_int"];
        $telefono = $datapaciente["telefono"];
        $email = $datapaciente["email"];
    }
}
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
                            <p style=" line-height:1.0em; font-weight:bold;">CALZADA DEL HUESO #777<br />
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
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:40%;">Orden No.:</td><td colspan="2" style="color:red;"><?php echo $data["id"]; ?></td>
                                </tr>
                            
                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;">Fecha</td>
                                    <td colspan="2" style=""><?php echo date("Y-m-d"); ?></td>
                                </tr>
                            <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Acesor </td><td colspan="2"><?php echo htmlentities($nombreasesor); ?></td>
                                </tr>

                                <tr>
                                    <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Torre </td><td colspan="2"><?php echo htmlentities($nomclinica); ?></td>
                                </tr>
                                <?php 
                                if($nomaseguradora){
                                    ?>
                                    <tr>
                                        <td style="background-color:#d0d0cf; font-weight:bold; text-align:left; width:30%;"> Aseguradora </td><td colspan="2"><?php echo htmlentities($nomaseguradora); ?></td>
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
                <table style="width:100%;">
                <?php 
                    if($nomaseguradora){
                        ?>
                    <tr>
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">SINIESTRO </td>
                    </tr>
                    <tr>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Poliza: </td>
                        <td colspan="1" style="width:30%;"><?php echo htmlentities($data["PolizaNum"]); ?></td>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Reporte: </td>
                        <td colspan="1"><?php echo htmlentities($data["ReporteNum"]); ?></td>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Siniestro: </td>
                        <td colspan="1"><?php echo htmlentities($data["siniestro"]); ?></td>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Deducible: </td>
                        <td colspan="1">MXN <?php echo truncateFloat($data["deducible"],2); ?></td>
                    </tr>
                <?php 
                    }
                        ?>
                    <tr>
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL CLIENTE </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Nombre: </td>
                        <td colspan="2" style="width:30%;"><?php echo htmlentities($nompaciente); ?></td>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Alta Vehiculo: </td>
                        <td colspan="1"><?php echo date("Y-m-d",strtotime($data["fecha_alta"])); ?></td>
                        <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Fecha Promesa Vehiculo: </td>
                        <td colspan="1"><?php echo date("Y-m-d",strtotime($data["fecha_promesa"])); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Domicilio: </td><td colspan="6"><?php echo htmlentities($domicilio) ; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tel.: </td><td colspan="2" style="width:30%;"><?php echo htmlentities($telefono) ?></td>
                        <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Email : </td><td colspan="2"><?php echo htmlentities($email); ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL VEHICULO </td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Categoria: </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($nommarca) ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Modelo : </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($nomsubmarca) ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Año: </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($data['modelo'])  ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vin : </td>
                        <td colspan="" style="width:20%;"><?php echo htmlentities($data['vin']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Placas: </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($data['placas_num']) ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Color : </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($data['color']) ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Kilometraje: </td>
                        <td colspan="" style="width:10%;"><?php echo htmlentities($data['kilometraje']) ?></td>
                        <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Matricula : </td>
                        <td colspan="" style="width:20%;"><?php echo htmlentities($data['matricula'])  ?></td>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <table style="width: 100%">
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Transmision</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">A/C</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vestiduras</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Int. Ele.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo Rin.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tipo Dir.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Gasolina</td>
                                </tr> 
                                <tr>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['TransmisionTipo'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['FuncionamientoAC'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['VestidurasTipo'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['InteriorTipo'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['RinTipo'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['DirTipo'])  ?></td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Gasolina'])  ?></td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%;    border-spacing: 0px;">
                    <tr>
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">PRESUPUESTO </td>
                    </tr>
                
                    <tr>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="6" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Refacciones </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Costo</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                </tr>
                                <?php 
                                $objref = new VehiculoRefaccion();
                                $dataref = $objref->getAllArr($id);
                                $totalrefaccion = 0 ;
                                foreach($dataref as $row) {
                                    $totalrefaccion+= $row['total_aprox'];  
                                    $nombre = $row['nombre'] ;
                                    if($row['detalles']){
                                        $nombre=$row['detalles'];
                                    } 
                                    $status = htmlentities($row['status']);
                                    switch ($row['status']) {
                                        case 'active':
                                            $status = 'Pendiente';
                                            $class  = 'label label-danger';
                                            break;
                                        case 'Realizado':
                                            $class  = 'label label-success';
                                            break;
                                        case 'Stand-By':
                                            $class  = 'label label-warning';
                                            break;
                                        default:
                                            $class  = '';
                                            break;
                                    } 
                                ?>
                                <tr>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo htmlentities($row['cantidad']); ?></td>
                                    <td><?php echo htmlentities($nombre); ?></td>
                                    <td><?php echo truncateFloat(htmlentities($row['costo_aprox']),2); ?></td>
                                    <td><?php echo truncateFloat(htmlentities($row['total_aprox']),2); ?></td>
                                    <td><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style='font-weight:bold;'>Total:</td>
                                    <td><strong><?php echo truncateFloat($totalrefaccion,2); ?></strong></td>
                                    <td></td>
                                </tr>
                               
                            </table>
                        </td>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="5" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Servicios </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Status</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Codigo</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Servicio</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Fecha</td>
                                </tr>
                                <?php 
                                $objser = new VehiculoServicio();
                                $dataser = $objser->getAllArr($id);
                                $totalservicio = 0 ;
                                foreach($dataser as $row) {
                                    $totalservicio+= $row['total'];   
                                    $nombre = $row['nombre'] ;
                                    if($row['detalles']){
                                        $nombre=$row['detalles'];
                                    }
                                    $status = htmlentities($row['status']);
                                    switch ($row['status']) {
                                        case 'active':
                                            $status = 'Pendiente';
                                            $class  = 'label label-danger';
                                            break;
                                        case 'Realizado':
                                            $class  = 'label label-success';
                                            break;
                                        case 'Stand-By':
                                            $class  = 'label label-warning';
                                            break;
                                        default:
                                            $class  = '';
                                            break;
                                    } 
                                ?>
                                <tr>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo htmlentities($row['codigo']); ?></td>
                                    <td><?php echo htmlentities($nombre); ?></td>
                                    <td><?php echo truncateFloat(htmlentities($row['total']),2); ?></td>
                                    <td><?php echo date("Y-m-d",strtotime($row['created_date'])); ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style='font-weight:bold;'>Total:</td>
                                    <td><strong><?php echo truncateFloat($totalservicio,2); ?></strong></td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="" style="background-color:#d0d0cf; font-weight:bold; text-align: center">
                        Total con letra:(<?php echo numtoletras($totalrefaccion+$totalservicio)?>)
                        </td>
                        <td>
                            <table style='width:100%'>
                                <tr>
                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align:right">Total General</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">
                                    <?php
                                    echo $totalrefaccion+$totalservicio;
                                    ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
       
    </table>
  
    <div style="width:90%; margin:0 auto;padding:1px 2px;border:1px solid #d0d0cf;">
        <p style="text-align:justify;font-weight:bold;">Nota: Esta cotizacion es mas IVA en caso de facturar. 
        <br>Esta cotizacion y los precios antes mencionados son basados al tipo de daño que presenta la unidad por lo tanto no son fijos, son variables. </p>
        <p></p>
    </div>
</body>

</html>