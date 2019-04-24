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
                        <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Tel.: </td><td colspan="2" style="width:30%;"><?php echo htmlentities($telefono) ?></td><td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold;">Email : </td><td colspan="2"><?php echo htmlentities($email); ?></td>
                    </tr>
                    <tr>
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">DATOS DEL VEHICULO : </td>
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
                        <td colspan="8" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">INVENTARIO </td>
                    </tr>
                    <tr>
                        <td class="td-inventario">
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Exteriores </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Faros: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Faros'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llantas: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Llantas'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">1/4 Luces : </td>
                                    <td colspan="" style="width:10%;"><?php  echo htmlentities($data['Lucesch']) ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapones Ctro-Rin : </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Taponesrin'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Antena: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Antena'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Molduras: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Molduras'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Espejos Laterales : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['EspejosLaterales'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Gasolina : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['TaponGasolina'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cristales  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Cristales'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Calaveras
                                    </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Calaveras'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Emblemas : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Emblemas'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Faros de niebla : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['FarosNiebla'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
                                    <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosExt'])  ?></td>
                                </tr>
                            </table>
                        </td>
                        <td  class="td-inventario">
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Interiores </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Limpiadores: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Limpiadores'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cenicero: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Cenicero'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Flasher: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Flasher'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cinturones : </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Cinturones'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Calefaccion: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Calefaccion'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Reclinables: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['Reclinables'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Radio : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Radio'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapetes: </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Tapetes'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Encendedor : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Encendedor'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Vestiduras  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Vestiduras'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Retrovisor : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Retrovisor'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Guantera: </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Guantera'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
                                    <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosInt'])  ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Accesorios </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Gato: </td>
                                    <td colspan="" style="width:10%;"><?php  echo htmlentities($data['Gato'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llanta de Refaccion: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['LlantaRefaccion'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Maneral de gato : </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['ManeralGato'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Control Alarma : </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['AlarmaControl'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Llave de ruedas: </td>
                                    <td colspan="" style="width:10%;"><?php  echo htmlentities($data['LlavedeLlantas'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Equipo A/V: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['EquipoAV'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Kit Herramientas </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Herramientas'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cables P/C  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['CablesPasaCorriente'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Reflejantes  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['SenalesReflejantes'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Dado de seguridad
                                    </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['DadoSeg'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Extintor : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Extinguidor'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;"></td>
                                    <td colspan="" style="width:20%;"></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Comentarios </td>
                                    <td colspan="3" style="width:20%;"><?php echo htmlentities($data['ComentariosAcces'])   ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Componentes Mecanicos </td>
                                    <td colspan="2" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Documentos </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon de Aceite: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['TaponAceite'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tarjeta de Circulacion: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['TarjetaCirc'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Dir. HD: </td>
                                    <td colspan="" style="width:10%;"><?php  echo htmlentities($data['TaponDirHD'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Poliza seguro: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['PolizaSeg']) ."<br>".htmlentities($data['PolizaNum'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Dep. Frenos: </td>
                                    <td colspan="" style="width:10%;"><?php  echo htmlentities($data['TaponDepFrenos'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Manual Propietario: </td>
                                    <td colspan="" style="width:10%;"><?php echo htmlentities($data['ManualProp'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Tapon Limpiaparabrisas: </td>
                                    <td colspan="" style="width:20%;"><?php  echo htmlentities($data['TaponLimpiaparabrisas'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Talon Verificacion: </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['TalonVerif'])   ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Bateria : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Bateria'])."<br>".htmlentities($data['CategoriaBateria'])  ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">No. de Reporte  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['ReporteNum'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Claxon : </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['Claxon'])   ?></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">No. de Siniestro  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['siniestro'])  ?></td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;"> </td>
                                    <td colspan="" style="width:20%;"></td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Deducible  </td>
                                    <td colspan="" style="width:20%;"><?php echo htmlentities($data['deducible'])  ?></td>
                                </tr>
                                <tr>
                                
                                    <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosComp'])   ?></td>
                                    <td colspan="2" style="width:20%;"><?php echo htmlentities($data['ComentariosDoc'])   ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="4" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Refacciones </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Cant.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Refaccion.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Costo Aprox.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total Aprox.</td>
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
                                ?>
                                <tr>
                                    <td><?php echo $row['cantidad']; ?></td>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo $row['costo_aprox']; ?></td>
                                    <td><?php echo $row['total_aprox']; ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td>Total:</td>
                                    <td><strong><?php echo $totalrefaccion; ?></strong></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="height: 100%">
                                <tr>
                                    <td colspan="3" style="width:20%;background-color:#d0d0cf; font-weight:bold; text-align: center">Servicios </td>
                                </tr>
                                <tr>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Codigo.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Servicio.</td>
                                    <td colspan="" style="width:10%;background-color:#d0d0cf; font-weight:bold;">Total.</td>
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
                                ?>
                                <tr>
                                    <td><?php echo $row['codigo']; ?></td>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                </tr>

                                <?php
                                } 
                                ?>
                                    <tr>
                                    <td></td>
                                    <td>Total:</td>
                                    <td><strong><?php echo $totalservicio; ?></strong></td>
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