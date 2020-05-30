<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Historial Del Paciente";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
$id_paciente = '';
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id_paciente=$request['params']['id'];

$cita     = '';
$paciente = '';
$id_cita  = '';
$totalpagado = 0;
$fecha_inicial = date('Y-m-d H:i');

$date     = $motivo = $seguimiento = $receta = $recomendaciones ='';
if($id_paciente){ 
    $pacientes = new Paciente();
    $paciente = $pacientes->getTable($id_paciente);
    if($paciente['id_historial']>0){
        //si el paciente ya tiene un historial lo mostramos
        $objhist       = new Historial();
        $datahistorial = $objhist->getTable($paciente['id_historial']);
        $receta          = $datahistorial['receta'];
        $recomendaciones = $datahistorial['recomendaciones'];
        $id_personal     = $datahistorial['id_personal'];
    }
}

if(isset($request['params']['id_cita'])){
    // si el paciente 
    $id_cita=$request['params']['id_cita'];
    $citas = new Cita();
    $cita  = $citas->getTable($id_cita);
    $fecha_inicial = ($cita['fecha_inicial'])           ? $cita['fecha_inicial'] : $fecha_inicial;
    $seguimiento   = ($cita['id_historialtratamiento']) ? "Seguimiento-> " : "";
    $motivo        = $cita['motivo'];
    
    $objhisttrat          = new HistorialTratamiento();
    $datatrat             = $objhisttrat->getTable($cita['id_historialtratamiento']);
    $cita['id_historial'] = $datatrat['id_historial'];


    $pacientes = new Persona();
    
    $id_paciente=$cita['id_paciente'];
    $id_personal=$cita['id_personal'];
	$paciente  = $pacientes->getTable($id_paciente);
}

if(isPost()){
    //si esta entrando es por que ya existe el paciente
    $pacientes = new Paciente();
    $id_paciente = $pacientes->updateAll($_POST['id_paciente'],getPost());
    if($id_paciente>0){}else{ die('no se guardo pacientes');}

    $paciente = $pacientes->getTable($_POST['id_paciente']);
    $historial = new Historial();


    if($paciente['id_historial'])
        $id = $historial->updateAll($paciente['id_historial'],getPost());
    else
        $id  = $historial->addAll(getPost());


    $urlredirect=make_url("Historial","view",array('id'=>$id));

    if ($id > 0){
        informSuccess(true, $urlredirect);
    }else{
        informError(true,make_url("Pacientes","index"));
    }
}
$nombrepaciente = ($paciente) ? $paciente['nombre'].' '.$paciente['apellido_pat'].' '.$paciente['apellido_mat'] : '';
$ano_diferencia = '';
if($paciente['fecha_nac']!="" && $paciente['fecha_nac']!="00-00-0000"){
    list($ano,$mes,$dia) = explode("-",$paciente['fecha_nac']);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<style>
    .tratamiento{
        font-size: 10px;
    }
</style>
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php $breadcrumbs["Citas"] = APP_URL."/Citas/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <form id="main-form" class="" role="form" method='post' action="<?php echo make_url("Pacientes","consulta");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">    
        <input type="hidden" id="id_paciente" name="id_paciente" value="<?php echo $id_paciente;?>">    
        <input type="hidden" id="id_cita" name="id_cita" value="<?php echo $id_cita;?>">
        <input type="hidden" id="total" name="total" value="0">
        <input type="hidden" id="total_deuda" name="total_deuda" value="0">
        <?php if($paciente['id_historial']) { ?>
            <input type="hidden"  name="seguimiento" id="seguimiento"  value="<?php echo $paciente['id_historial'];?>">
        <?php } ?>
        <div id="content">
            <div class="row">     
                <section id="widget-grid" class="">
                    <article class="col-sm-12 col-md-12 col-lg-12"  id="">
                        <h2><strong>Historia Clinica</strong></h2>
                        <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-collapsed="false">
                            <!-- Widget ID (each widget will need unique ID)-->
                            <header><span class="widget-icon"> <i class="fa fa-plus"></i></span><h2><?php echo "Datos Basicos" ?></h2>
                            </header>
                            <div style="display: ;">
                                <div class="jarviswidget-editbox" style=""></div>
                                <div class="widget-body">
                                    <fieldset>    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nombre</label>
                                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'apellido_pat')" value="<?php echo $paciente['nombre']; ?>" > 
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Apellido Paterno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_pat" id="apellido_pat" onkeypress="nextFocus('apellido_pat', 'apellido_mat')" value="<?php echo $paciente['apellido_pat']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Apellido Materno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_mat" id="apellido_mat" onkeypress="nextFocus('apellido_mat', 'email')"  value="<?php echo $paciente['apellido_mat']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle"  id="calle" onkeypress="nextFocus('calle', 'num_ext')" value="<?php echo $paciente['calle']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" id="colonia" onkeypress="nextFocus('colonia', 'ciudad')" value="<?php echo $paciente['colonia']; ?>">                                                                                               
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')" value="<?php echo $paciente['email']; ?>">                                                          
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'estado')" value="<?php echo $paciente['telefono']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Exterior</label>
                                                <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext" id="num_ext" onkeypress="nextFocus('num_ext', 'num_int')" value="<?php echo $paciente['num_ext']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad" onkeypress="nextFocus('ciudad', 'cp')"  value="<?php echo $paciente['ciudad']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Fecha Nacimiento</label>
                                                <input type="text" class="form-control datepicker" data-dateformat='dd-mm-yy' autocomplete="off" placeholder="Fecha nacimiento" name="fecha_nac" id="fecha_nac" onkeypress="nextFocus('fecha_nac', 'antecedentes_pat')" value="<?php echo date('d-m-Y',strtotime($paciente['fecha_nac'])); ?>">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado" name="estado" id="estado"  onkeypress="nextFocus('estado', 'calle')"  value="<?php echo $paciente['estado']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Interior</label>
                                                <input type="text" class="form-control" placeholder="Número Interior" name="num_int" id="num_int" onkeypress="nextFocus('num_int', 'colonia')"   value="<?php echo $paciente['num_int']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">CP</label>
                                                <input type="text" class="form-control" placeholder="CP" name="cp" id="cp" onkeypress="nextFocus('cp', 'fecha_nac')" value="<?php echo $paciente['cp']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Antecedentes patologicos</label>
                                                <input type="text" class="form-control" placeholder="Antecedentes Patologicos" name="antecedentes_pat" id="antecedentes_pat" onkeypress="nextFocus('antecedentes_pat', 'savenewclient')"  value="<?php echo $paciente['antecedentes_pat']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Edad</label>
                                                <input type="text" class="form-control" disabled  placeholder="Edad" name="edad" id="edad"  value="<?php echo $ano_diferencia; ?>">                                                                                               
                                            </div>
                                        </div>
                                    </fieldset>  
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php  if ( $datosavanzados ) {?>
                        <article class="col-sm-12 col-md-12 col-lg-12 paciente-avanzados">
                            <h2><?php echo "Datos Avanzados" ?></h2>
                            <fieldset>    
                                <div class="col-sm-4">
                                    <div class="jarviswidget" id="wid-id-adicionales" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header><h2> Adicionales</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <select class="select2" name="sexo">
                                                                <option <?php echo ($paciente['sexo']=="") ? "selected": '';?> value="">Selecciona sexo</option>
                                                                <option <?php echo ($paciente['sexo']=="Femenino") ? "selected": '';?> value="Femenino">Femenino</option>
                                                                <option <?php echo ($paciente['sexo']=="Masculino") ? "selected": '';?> value="Masculino">Masculino</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <select class="select2" name="grupo_sanguineo">
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="") ? "selected": '';?> value="">Tipo Sangre</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="A+") ? "selected": '';?> value="A+">A+</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="A-") ? "selected": '';?> value="A-">A-</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="B+") ? "selected": '';?> value="B+">B+</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="B-") ? "selected": '';?> value="B-">B-</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="AB+") ? "selected": '';?> value="AB+">AB+</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="AB-") ? "selected": '';?> value="AB-">AB-</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="O+") ? "selected": '';?> value="O+">O+</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="O-") ? "selected": '';?> value="O-">O-</option>
                                                                <option <?php echo ($paciente['grupo_sanguineo']=="No Sabe") ? "selected": '';?> value="No Sabe">No Sabe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Estado civil</label>
                                                    <select class="select2" name="edo_civil">
                                                        <option <?php echo ($paciente['edo_civil']=="") ? "selected": '';?> value="">Selecciona</option>
                                                        <option <?php echo ($paciente['edo_civil']=="Casado") ? "selected": '';?> value="Casado">Casado</option>
                                                        <option <?php echo ($paciente['edo_civil']=="Soltero") ? "selected": '';?> value="Soltero">Soltero</option>
                                                        <option <?php echo ($paciente['edo_civil']=="Union libre") ? "selected": '';?> value="Union libre">Union libre</option>
                                                        <option <?php echo ($paciente['edo_civil']=="Divorciado") ? "selected": '';?> value="Divorciado">Divorciado</option>
                                                        <option <?php echo ($paciente['edo_civil']=="Viudo") ? "selected": '';?> value="Viudo">Viudo</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <label>Escolaridad</label>
                                                            <input type="text" class="form-control" placeholder="Escolaridad" name="escolaridad"  id="escolaridad" value="<?php echo $paciente['escolaridad']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Ocupacion</label>
                                                        <input type="text" class="form-control" placeholder="Ocupacion" name="ocupacion" id="ocupacion" value="<?php echo $paciente['ocupacion']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget" id="wid-id-antheredo" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header><h2> Antecedentes Heredo-Familiares</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="form-group">
                                                    <label>Madre</label>
                                                    <input type="text" class="form-control" placeholder="Madre" name="ant_madre" id="ant_madre" value="<?php echo $paciente['ant_madre']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Padre</label>
                                                    <input type="text" class="form-control" placeholder="Padre" name="ant_padre" id="ant_padre" value="<?php echo $paciente['ant_padre']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Abuelos Paternos</label>
                                                    <input type="text" class="form-control" placeholder="Abuelos Paternos" name="ant_abuelospaternos" id="ant_abuelospaternos" value="<?php echo $paciente['ant_abuelospaternos']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Abuelos Maternos</label>
                                                    <input type="text" class="form-control" placeholder="Abuelos Maternos" name="ant_abuelosmaternos" id="ant_abuelosmaternos" value="<?php echo $paciente['ant_abuelosmaternos']; ?>">                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget" id="wid-id-higiene" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Higiene</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <label>Fecuencia de lavado de dientes</label>
                                                            <input type="text" class="form-control" placeholder="Fecuencia de lavado de dientes" name="frec_dientes" id="frec_dientes" value="<?php echo $paciente['frec_dientes']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Auxiliares de limpieza</label>
                                                    <input type="text" class="form-control" placeholder="Auxiliares de limpieza" name="aux_limpieza" id="aux_limpieza" value="<?php echo $paciente['aux_limpieza']; ?>">                                                                                               
                                                </div> 
                                                <div class="form-group">
                                                    <label>Tipo de pasta dental</label>
                                                    <input type="text" class="form-control" placeholder="Tipo de pasta dental" name="pasta_dental" id="pasta_dental" value="<?php echo $paciente['pasta_dental']; ?>">                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="jarviswidget" id="wid-id-prenatales" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Prenatales</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">                                            
                                                <div class="form-group">
                                                    <label>Numero de Gestacion</label>
                                                    <input type="text" class="form-control" placeholder="Numero de Gestacion" name="num_gesta" id="num_gesta" value="<?php echo $paciente['num_gesta']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiempo de Gestacion</label>
                                                    <input type="text" class="form-control" placeholder="Tiempo de Gestacion" name="tiempo_gesta" id="tiempo_gesta" value="<?php echo $paciente['tiempo_gesta']; ?>">                                                                                               
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Tipo de Parto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select class="select2" name="tipo_parto">
                                                                <option <?php echo ($paciente['tipo_parto']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['tipo_parto']=="Normal") ? "selected": '';?> value="Normal">Normal</option>
                                                                <option <?php echo ($paciente['tipo_parto']=="Cesarea") ? "selected": '';?> value="Cesarea">Cesarea</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Motivo Cesarea</label>
                                                    <input type="text" class="form-control" placeholder="Motivo Cesarea" name="motivo_cesarea" id="motivo_cesarea" value="<?php echo $paciente['motivo_cesarea']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Apgar</label>
                                                    <input type="text" class="form-control" placeholder="Apgar" name="tipo_gesta" id="tipo_gesta">                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget" id="wid-id-perinatales" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Perinatales</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Reanimacion Especial</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select class="select2" name="reanimacion_especial">
                                                                <option <?php echo ($paciente['reanimacion_especial']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['reanimacion_especial']=="Bolsa de oxigeno") ? "selected": '';?> value="Bolsa de oxigeno">Bolsa de oxigeno</option>
                                                                <option <?php echo ($paciente['reanimacion_especial']=="Ventilacion asistida con ambu") ? "selected": '';?> value="Ventilacion asistida con ambu">Ventilacion asistida con ambu</option>
                                                                <option <?php echo ($paciente['reanimacion_especial']=="Intubacion") ? "selected": '';?> value="Intubacion">Intubacion</option>
                                                                <option <?php echo ($paciente['reanimacion_especial']=="Medicamentos") ? "selected": '';?> value="Medicamentos">Medicamentos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget" id="wid-id-posnatales" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Posnatales</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Estubo en incubadora</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <select class="select2" name="incubadora">
                                                                <option <?php echo ($paciente['incubadora']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['incubadora']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php echo ($paciente['incubadora']=="No") ? "selected": '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiempo y Motivo Incubadora</label>
                                                    <input type="text" class="form-control" placeholder="Tiempo y Motivo Incubadora" name="tiempo_incubadora" id="tiempo_incubadora" value="<?php echo $paciente['tiempo_incubadora']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Reflujo Esofagico</label>
                                                    <input type="text" class="form-control" placeholder="Reflujo Esofagico" name="reflujo_esofagico" id="reflujo_esofagico" value="<?php echo $paciente['reflujo_esofagico']; ?>">                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="jarviswidget" id="wid-id-lactancia" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Alimentacion-Lactancia</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Ablactacion</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Incio" name="ablactacion_inicio" id="ablactacion_inicio"  value="<?php echo $paciente['ablactacion_inicio']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Alimentacion Solida</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Inicio</label>
                                                            <input type="text" class="form-control" placeholder="Incio" name="alimentacion_solida_inicio" id="alimentacion_solida_inicio"  value="<?php echo $paciente['alimentacion_solida_inicio']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jarviswidget" id="wid-id-denticion" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Denticion</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Inicio Denticion</label>
                                                    <input type="text" class="form-control" placeholder="Inicio Denticion" name="inicio_denticion" id="inicio_denticion"  value="<?php echo $paciente['inicio_denticion']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Habitos</label>
                                                    <input type="text" class="form-control" placeholder="Habitos" name="denticion_habitos" id="denticion_habitos"  value="<?php echo $paciente['denticion_habitos']; ?>">                                                                                               
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Tratamiento dental previo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <select class="select2" name="tratamiento_previo">
                                                                <option <?php echo ($paciente['tratamiento_previo']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['tratamiento_previo']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php echo ($paciente['tratamiento_previo']=="No") ? "selected": '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Tipo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <select class="select2" name="tipo_tratamiento_previo">
                                                                <option <?php echo ($paciente['tipo_tratamiento_previo']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['tipo_tratamiento_previo']=="Temporal") ? "selected": '';?> value="Temporal">Temporal</option>
                                                                <option <?php echo ($paciente['tipo_tratamiento_previo']=="Permanente") ? "selected": '';?> value="Permanente">Permanente</option>
                                                                <option <?php echo ($paciente['tipo_tratamiento_previo']=="Mixta") ? "selected": '';?> value="Mixta">Mixta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Aplicacion de Floururo</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <select class="select2" name="aplicacion_floruro">
                                                                <option <?php echo ($paciente['aplicacion_floruro']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['aplicacion_floruro']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php echo ($paciente['aplicacion_floruro']=="No") ? "selected": '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="jarviswidget" id="wid-id-higiene" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Exploracion</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <label >Signos Vitales</label>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Pulso xmin.</label>
                                                            <input type="text" class="form-control" placeholder="Pulso xmin." name="pulso_signos" id="pulso_signos"  value="<?php echo $paciente['pulso_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>T.A mm/Hg</label>
                                                            <input type="text" class="form-control" placeholder="T.A mm/Hg" name="ta_signos" id="ta_signos" value="<?php echo $paciente['ta_signos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>F.C. xmin.</label>
                                                            <input type="text" class="form-control" placeholder="F.C. xmin." name="fc_signos" id="fc_signos" value="<?php echo $paciente['fc_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>F. C.</label>
                                                            <input type="text" class="form-control" placeholder="F. C." name="t_signos" id="t_signos" value="<?php echo $paciente['t_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                                <label >Somatometria</label>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Peso kg.</label>
                                                            <input type="text" class="form-control" placeholder="Peso kg." name="peso_soma" id="peso_soma" value="<?php echo $paciente['peso_soma']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Talla m.</label>
                                                            <input type="text" class="form-control" placeholder="Talla m." name="talla_soma" id="talla_soma" value="<?php echo $paciente['talla_soma']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="jarviswidget" id="wid-id-inmunizaciones" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Inmunizaciones</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label">Inmunizaciones</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <select class="select2"  name="inm_nacimiento">
                                                                <option <?php echo ($paciente['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php echo ($paciente['inm_nacimiento']=="Completa") ? "selected": '';?> value="Completa">Completa</option>
                                                                <option <?php echo ($paciente['inm_nacimiento']=="Incompleta") ? "selected": '';?> value="Incompleta">Incompleta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Por que" name="inm_nacimientodet" value="<?php echo $paciente['inm_nacimientodet'];?>">                                                                                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="jarviswidget" id="wid-id-higiene" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                        <header> <h2>Antecedentes Patologicos</h2></header>
                                        <div>
                                            <div class="jarviswidget-editbox"></div>
                                            <div class="widget-body">
                                                <div class="">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label >Efermedades padecidas en los ultimos años y tratamiento</label> 
                                                            <input type="text" class="form-control" placeholder="Efermedades padecidas" name="pat_enfermedades" id="pat_enfermedades"  value="<?php echo $paciente['pat_enfermedades']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label >Esta actualente bajo algun tratamiento medico</label> 
                                                            <input type="text" class="form-control" placeholder="Tratamiento medico" name="pat_tratamiento" id="pat_tratamiento"  value="<?php echo $paciente['pat_tratamiento']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Peso.</label>
                                                            <input type="text" class="form-control" placeholder="Peso" name="pat_peso" id="pat_peso"  value="<?php echo $paciente['pat_peso']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Talla</label>
                                                            <input type="text" class="form-control" placeholder="Talla" name="pat_talla" id="pat_talla" value="<?php echo $paciente['pat_talla']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Grupo Sanguineo</label>
                                                            <input type="text" class="form-control" placeholder="Grupo Sanguineo" name="pat_gruposanguineo" id="pat_gruposanguineo" value="<?php echo $paciente['pat_gruposanguineo']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>R.H.</label>
                                                            <input type="text" class="form-control" placeholder="R.H." name="pat_rh" id="pat_rh" value="<?php echo $paciente['pat_rh']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Hospitalizaciones(Causas)</label> 
                                                                <input type="text" class="form-control" placeholder="Hospitalizaciones" name="pat_hospital" id="pat_hospital"  value="<?php echo $paciente['pat_hospital']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Intervenciones quirurgicas</label> 
                                                                <input type="text" class="form-control" placeholder="Intervenciones" name="pat_intervenciones" id="pat_intervenciones"  value="<?php echo $paciente['pat_intervenciones']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Transfuciones</label> 
                                                                <input type="text" class="form-control" placeholder="Transfuciones" name="pat_transfuciones" id="pat_transfuciones"  value="<?php echo $paciente['pat_transfuciones']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Problemas de coagulacion</label>
                                                            <input type="text" class="form-control" placeholder="Coagulacion" name="pat_coagulacion" id="pat_coagulacion" value="<?php echo $paciente['pat_coagulacion']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Problemas respiratorios</label>
                                                            <input type="text" class="form-control" placeholder="Problemas respiratorios" name="pat_respiratorios" id="pat_respiratorios" value="<?php echo $paciente['pat_respiratorios']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                               
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Traumatismos o Fx del complejo Craneofacial</label>
                                                            <input type="text" class="form-control" placeholder="Traumatismos" name="pat_traumatismos" id="pat_traumatismos" value="<?php echo $paciente['pat_traumatismos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Alergias</label>
                                                            <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" value="<?php echo $paciente['alergias']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Enfermedades sistemicas (hereditarias,congenitas,infectocontagiosas,VIH etc.)</label>
                                                                <input type="text" class="form-control" placeholder="Enfermedades sistemicas" name="pat_sistemicas" id="pat_sistemicas" value="<?php echo $paciente['pat_sistemicas']; ?>">                                                                                               
                                                            </div> 
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Consume tabaco drogas o alcohol?</label>
                                                                <input type="text" class="form-control" placeholder="Consume tabaco drogas o alcohol?" name="pat_consumos" id="pat_consumos" value="<?php echo $paciente['pat_consumos']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label><strong>Mujeres</strong></label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>Menarca</label>
                                                                <input type="text" class="form-control" placeholder="Menarca" name="pat_menarca" id="pat_menarca" value="<?php echo $paciente['pat_menarca']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>Edad</label>
                                                                <input type="text" class="form-control" placeholder="Edad" name="pat_edad" id="pat_edad" value="<?php echo $paciente['pat_edad']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>FUM</label>
                                                                <input type="text" class="form-control" placeholder="FUM" name="pat_fum" id="pat_fum" value="<?php echo $paciente['pat_fum']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>FUP</label>
                                                                <input type="text" class="form-control" placeholder="FUP" name="pat_fup" id="pat_fup" value="<?php echo $paciente['pat_fup']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Embarazos</label>
                                                            <input type="text" class="form-control" placeholder="Embarazos" name="pat_embarazos" id="pat_embarazos" value="<?php echo $paciente['pat_embarazos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Hijos</label>
                                                            <input type="text" class="form-control" placeholder="Hijos" name="pat_hijos" id="pat_hijos" value="<?php echo $paciente['pat_hijos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Abortos</label>
                                                            <input type="text" class="form-control" placeholder="Abortos" name="pat_abortos" id="pat_abortos" value="<?php echo $paciente['pat_abortos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Esta tomando algun anticonceptivo</label>
                                                            <input type="text" class="form-control" placeholder="Anticonceptivo" name="pat_anticonceptivo" id="pat_anticonceptivo" value="<?php echo $paciente['pat_anticonceptivo']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Embarazada actuamente? meses?</label>
                                                            <input type="text" class="form-control" placeholder="Meses de gestacion" name="pat_gestacion" id="pat_gestacion" value="<?php echo $paciente['pat_gestacion']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> 
                        </article>
                    <?php } ?>
                    
                        <article class="col-sm-12 col-md-12 col-lg-12 article-diagnostico">
                            <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-diagnostico" 
                            data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                <header onclick="$('.showdiagnostico').toggle()"> <span class="widget-icon"> 
                                    <i class="far fa-stethoscope"></i> </span><h2>Diagnostico</h2>
                                </header>
                                <div class="showdiagnostico" style="display: ;">
                                <!-- widget edit box -->
                                    <div class="jarviswidget-editbox" style=""></div>
                                    <div class="widget-body" style="overflow:auto">
                                    
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12" id='cont_referencias' style='display:'>
                                                <h2><strong>Diagnostico</strong></h2>
                                                <?php
                                                    if($paciente['id_historial']){
                                                        $objhistdiag     = new HistorialDiagnostico();
                                                        $datadiagnostico = $objhistdiag->getAllArr($paciente['id_historial']);
                                                        foreach($datadiagnostico as $row) {
                                                            if ($row['status'] == 'deleted')  continue;
                                                            $referencias = $row['referencias_json'];
                                                            if ( $referencias ){
                                                                echo "<input type='hidden'  class='referecias_seguimiento'   detalles='".$row['detalles']."' value='".$referencias."'>";
                                                            }
                                                        } 
                                                    }
                                                ?>   
                                                <div class="form-group">
                                                    <label id='medico'>Medico *</label>
                                                    <select style="width:100%" class="select2"  required name="id_personal" id="id_personal">
                                                        <option value="" selected disabled>Selecciona Medico</option>
                                                        <?php 
                                                        $obj = new Personal();
                                                        $list=$obj->getAllArr(2); // medicos
                                                        if (is_array($list) || is_object($list)){
                                                            foreach($list as $val){
                                                                $selected = ($id_personal == $val['id']) ? "selected" : "";
                                                                echo "<option $selected value='".$val['id']."'>".htmlentities($val['nombre'].' '.$val['apellido_pat']." ".$val['apellido_mat'])."</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <table style='width:100%' class='table-striped table-bordered table-hover'>
                                                    <thead>    
                                                        <tr>
                                                            <td style="width:20%">Do: en azul Diente obturado</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Do"></td>
                                                            <td style="width:20%">Co: en azul Corona</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Co"></td>
                                                            <td style="width:20%">TC: en amarillo tratamiento de conductos</td>
                                                            <td style="width:13%"><input type="radio" color="amarillo" class="referencia" name="referencia_opt[]" value="TC"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">C: en rojo Cariados</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="C"></td>
                                                            <td style="width:20%">Pr: en azul Protesis removibles</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Pr"></td>
                                                            <td style="width:20%">F:en rojo fluorosis</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="F"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">A: en azul Ausente</td>
                                                            <td style="width:13%"><input type="radio" color="blanco" class="referencia" name="referencia_opt[]" value="A"></td>
                                                            <td style="width:20%">Inc: en azul incrustacion</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Inc"></td>
                                                            <td style="width:20%">Imp: en azul implante dental</td>
                                                            <td style="width:13%"><input type="radio" color="blanco" class="referencia" name="referencia_opt[]" value="Imp"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">X: en rojo Exodoncia</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="X"></td>
                                                            <td style="width:20%">EP: en rojo Enf. Periodontal</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="EP"></td>
                                                            <td style="width:20%">MB: en rojo Mancha Blanca</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="MB"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">CP: en rojo Caries Penetrante</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="CP"></td>
                                                            <td style="width:20%">FD: en rojo Fractura Dentaria</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="FD"></td>
                                                            <td style="width:20%">Se: en azul Sellador</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Se"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">R: en verde Retenido</td>
                                                            <td style="width:13%"><input type="radio" color="verde" class="referencia" name="referencia_opt[]" value="R"></td>
                                                            <td style="width:20%">MPD: en rojo Mal Posicion Den</td>
                                                            <td style="width:13%"><input type="radio" color="rojo" class="referencia" name="referencia_opt[]" value="MPD"></td>
                                                            <td style="width:20%">SP SR: en azul Surco Profundo</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="SP_SR"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:20%">PP: en azul Pieza de Puente</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="PP"></td>
                                                            <td style="width:20%">PM: en azul perno muñon</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="PM"></td>
                                                            <td style="width:20%">Hp: en azul Hipoplasia de esmalte</td>
                                                            <td style="width:13%"><input type="radio" color="azul" class="referencia" name="referencia_opt[]" value="Hp"></td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>  
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12" id='cont_imagendiente' style="text-align: center;display:">
                                                <h1>Odontograma : <span id="cont_imagen_parte"></span>
                                                <input type="hidden" color='' id="nom_referencia" name="nom_referencia">                                                        
                                                <input type="hidden" id='imagen_diente' name='imagen_diente[]'>
                                                </h1>
                                                <div class="col-sm-12 col-md-12 col-lg-12" style="overflow:auto" >
                                                <table style="width:100%" class='diagramadental'>
                                                    <tr>
                                                        <td>
                                                            <table >
                                                                <tr>
                                                                    <?php 
                                                                    $numdiente='';
                                                                    for($i=18;$i>10;$i--){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">        
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img style="width:50px;height:50px" class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td></td><td></td><td></td>
                                                                    <?php 
                                                                    for($i=55;$i>50;$i--){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">     
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td></td><td></td><td></td>
                                                                    <?php 
                                                                    for($i=85;$i>80;$i--){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">     
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <?php 
                                                                    for($i=48;$i>40;$i--){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">        
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td style="width:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <?php 
                                                                    for($i=21;$i<29;$i++){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">        
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <?php 
                                                                    for($i=61;$i<66;$i++){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">     
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                    <td></td><td></td><td></td>
                                                                </tr>
                                                                <tr>
                                                                    <?php 
                                                                    for($i=71;$i<76;$i++){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                        <td id="contdiente<?php echo $numdiente;?>">     
                                                                            <strong><?php echo $numdiente;?></strong><br>
                                                                            <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                        
                                                                            <map name="image-map<?php echo $numdiente;?>">
                                                                                <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                                <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                                <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                                <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                                <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                            </map>
                                                                        </td>
                                                                        <?php 
                                                                    }
                                                                    ?>
                                                                    <td></td><td></td><td></td>
                                                                </tr>
                                                                <tr>
                                                                    <?php 
                                                                    for($i=31;$i<39;$i++){
                                                                        $numdiente = $i;
                                                                        ?>
                                                                    <td id="contdiente<?php echo $numdiente;?>">        
                                                                        <strong><?php echo $numdiente;?></strong><br>
                                                                        <img class='imagendiente imagen_parte<?php echo $numdiente;?>' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                    
                                                                        <map name="image-map<?php echo $numdiente;?>">
                                                                            <area class='diente' alt="Distal"  title="Distal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="9,40,19,30,17,23,18,17,9,9,4,15,2,26,4,33" shape="poly">
                                                                            <area class='diente' alt="Bucal"   title="Bucal"   diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="19,19,9,8,17,3,26,2,36,4,41,8,32,17,25,16" shape="poly">
                                                                            <area class='diente' alt="Mesial"  title="Mesial"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="32,19,41,9,46,15,49,22,48,32,42,41,32,30,33,24" shape="poly">
                                                                            <area class='diente' alt="Ocusal"  title="Ocusal"  diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="25,24,8" shape="circle">
                                                                            <area class='diente' alt="Lingual" title="Lingual" diente<?php echo $numdiente;?> diente="<?php echo $numdiente;?>" href="" coords="31,30,42,41,31,47,18,47,9,41,18,30,25,33" shape="poly">
                                                                        </map>
                                                                    </td>
                                                                    <?php 
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <table style='width:60%' class='table-striped table-bordered table-hover' id="contdiagnostico">
                                                    <thead>    
                                                        <tr> 
                                                            <th >Selected</th>
                                                            <th >Diagnostico</th>
                                                            <th >Tratamiento</th>
                                                            <th class="borrar-td"></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                <div class="form-group">
                                                    <label for="name">Diagnostico </label>
                                                    <textarea type='text' style='width: 100%; height: 50px;' placeholder="Recomendaciones"  name='recomendaciones' > <?php echo $recomendaciones?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>           
                                </div>
                            </div>
                        </article>
                        <article class="col-sm-12 col-md-12 col-lg-12 article-receta">
                            <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-receta" 
                            data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                <header onclick="$('.showreceta').toggle()"> <span class="widget-icon"> 
                                    <i class="far fa-clipboard-list"></i> </span><h2>Notas De Evolucion</h2>
                                </header>
                                <div class="showreceta" style="<?php echo (!$receta)? 'display: none' : '' ?>">
                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox" style=""></div>
                                    <div class="widget-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Notas De Evolucion </label>
                                                <textarea type='text' style='width: 100%; height: 50px;' placeholder="Notas De Evolucion"  name='receta' ><?php echo $receta?> </textarea>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </article>
                        <article class="col-sm-12 col-md-12 col-lg-12 article-tratamiento">
                            <div class="jarviswidget  jarviswidget-sortable jarviswidget-collapsed" id="wid-tratamiento" 
                            data-widget-deletebutton="false" data-widget-colorbutton="false" data-widget-editbutton="false"  data-widget-fullscreenbutton="false" data-widget-collapsed="false" >
                                <header onclick="$('.showtratamiento').toggle()"> <span class="widget-icon"> 
                                    <i class="far fa-grimace"></i> </span><h2>Tratamiento</h2>
                                </header>
                                <div class="showtratamiento" style="">
                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox" style=""></div>
                                    <div class="widget-body" style="overflow:auto">
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                            <div class="col-sm-11 col-md-11 col-lg-11" style="text-align:right">
                                                <h3 class="total">Total: $<span id="total-global"></span><br> 
                                                <?php if($paciente['id_historial']){ ?>
                                                    Pagos: $<span id="total-pagos"></span><br> 
                                                    Adeudo: $<span id="total-deudatxt"></span>
                                                <?php } ?>
                                            </h3>                              
                                            </div>
                                            <div class="col-sm-11 col-md-1 col-lg-1" style="text-align:right">
                                                <a  class="btn btn-success" id='btnaddtratamiento' href="#" > <i class="fa fa-plus"></i></a>                                          
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-12 col-md-12 col-lg-12" >
                                            <table style='width:100%' class='table-striped table-bordered table-hover' id="cont-tratamiento">
                                                <thead>    
                                                    <tr>
                                                        <th style="width: 7%;">Cant.</th>
                                                        <th style="width: 15%">Dientes</th>
                                                        <th style="width: 20%;">Tratamientos</th>
                                                        <th style="width: 8%">Precio</th>
                                                        <th style="width: 8%">Total</th>
                                                        <th style="width: 15%">Cita Propuesta</th>
                                                        <th>Status</th>
                                                        <th class="borrar-td" ></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if($paciente['id_historial']){
                                                            $objhistdiag     = new HistorialTratamiento();
                                                            $dataTratamiento = $objhistdiag->getAllArr($paciente['id_historial']);
                                                            foreach($dataTratamiento as $row) {
                                                                $status = htmlentities($row['status']);
                                                                $fecharealizado = ($status!='active') ? $row['fecha_realizado'] : '';
                                                                $lineId   = rand(1000, 100000);
                                                                ?>
                                                                <tr class='tratamiento' lineidtratamiento='<?php echo $lineId ?>'>
                                                                    <input type='hidden' name='seguimientotratamiento[]' value="<?php echo 1 ?>">
                                                                    <td>
                                                                        <input type='number' <?php echo ($row['producto']==1) ? 'readonly':'' ?> style='width: 50px;' class="form-control cantidad" name='cantidad[]'  lineid='<?php echo $lineId ?>' id='cantidad<?php echo $lineId ?>' value="<?php echo  $row['cantidad']?>">
                                                                    </td>
                                                                    <td style="text-align: center;">
                                                                        <textarea type='text' style='width: 100px; height: 50px;' placeholder="Detalles"  name='detalles_tratamiento[]' ><?php echo  $row['detalles']?> </textarea>
                                                                    </td>
                                                                    <td> 
                                                                        <select style="width:100%" class="select2 id_tratamiento" name="id_tratamiento[]" lineid='<?php echo $lineId ?>'>
                                                                            <option value="">--Selecciona--</option>
                                                                            <?php 
                                                                                $obj = new Tratamiento();
                                                                                $list=$obj->getAllArr();
                                                                                if (is_array($list) || is_object($list)){
                                                                                    foreach($list as $val){
                                                                                        $selected = ($row['id_tratamiento']==$val['id']) ? "selected" :'';
                                                                                        echo "<option $selected value='".$val['id']."'>".$val['nombre']."</option>";
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type='number' style='width: 80px;' class='form-control costotratamiento' name='precio_tratamiento[]' id="precio_tratamiento<?php echo $lineId ?>" value='<?php echo $row['precio'] ?>' placeholder='00.00'></td>
                                                                    <td><input type='number' style='width: 80px;' class='form-control totaltratamiento' name='total_tratamiento[]'  id="total_tratamiento<?php echo $lineId ?>" value='<?php echo $row['total'] ?>' placeholder='00.00'></td>
                                                                    <td>
                                                                        <div class="cont_status_tratamiento<?php echo $lineId?>" style="<?php echo ($row['producto']==1) ? 'display:none':'' ?>">
                                                                            <input type="text" class="form-control form_datetime" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha Recomendada" name="fecha_recomendada[]" id="fecha_recomendada<?php echo $lineId ?>" value='<?php echo $row['fecha_recomendada'] ?>'>
                                                                        </div>
                                                                    </td>
                                                                    <td> 
                                                                        <div class="cont_status_tratamiento<?php echo $lineId?>" style="<?php echo ($row['producto']==1) ? 'display:none':'' ?>"> 
                                                                            <select style="width:100%" class="select2 status_tratamiento " name="status_tratamiento[]" id="status_tratamiento<?php echo $lineId ?>" lineid='<?php echo $lineId ?>'>
                                                                                <?php 
                                                                                $listref= getStatusTratamiento();
                                                                                if (is_array($listref)){
                                                                                    foreach($listref as $key => $valref){
                                                                                        $selected = ($key == $status) ? " selected ": "";
                                                                                        echo "<option $selected value='".$key."'>".htmlentities($valref)."</option>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <input type="<?php echo ($row['fecha_realizado']) ? 'text' : 'hidden'; ?>" class="form-control form_datetime" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha" name="fecha_realizado[]" id="fecha_realizado<?php echo $lineId ?>" value='<?php echo $fecharealizado ?>'>
                                                                        </div>
                                                                    </td> 
                                                                    <td class='borrar-td' style="text-align: center;">
                                                                        <a href='javascript:void(0);' class='btn btn-danger borrar-tratamiento' lineidtratamiento='<?php echo $lineId ?>'> 
                                                                            <i class='glyphicon glyphicon-trash'></i> </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            } 
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6" >
                                            <div class="text-center"><h4><strong>Datos Pago</strong></h4></div>
                                            <table class="table table-striped table-bordered table-hover">
                                                <tr>
                                                    <th>Tipo Pago</th>
                                                    <td> 
                                                        <select style="width:100%" class="select2 " name="tipo_pago"  id="tipo_pago">
                                                            <?php 
                                                            $listref= getTipoPago();
                                                            if (is_array($listref)){
                                                                foreach($listref as $key => $valref){
                                                                    echo "<option value='".$key."'>".htmlentities($valref)."</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Descuento $</th>
                                                    <td>
                                                        <a href="#" id="solicitar-descuento-gerencial">Show/Hide</a>
                                                        <div id="descuento-gerencial" style="display: none;">
                                                            <input type="number" id="descuento_aplicado" class="form-control" name="descuento_aplicado" placeholder="Descuento"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pago/Abono</th>
                                                    <td><input type="number" id="monto" class="form-control" name="monto" placeholder="Monto"/></td>
                                                </tr>
                                                <tr>
                                                    <th>Comentarios</th>
                                                    <td><input type="text" class="form-control" id="observaciones" name="observaciones"  placeholder="Observaciones"/></td>
                                                </tr>
                                                <tr>
                                                    <th>Fecha Pago</th>
                                                    <td ><input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" name="fecha_pago" id="" value='<?php echo date('Y-m-d')?>'/></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php
                                            if($paciente['id_historial']){
                                                ?>
                                                <div class="col-sm-12 col-md-6 col-lg-6" >
                                                    <div class="text-center"><h4><strong>Historial Pagos</strong></h4></div>
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <tr>
                                                            <th>Monto</th>
                                                            <th>Tipo</th>
                                                            <th>Fecha</th>
                                                            <th>Obs.</th>
                                                        </tr>
                                                    <?php
                                                        $objhistpagos     = new HistorialPagos();
                                                        $datapagos = $objhistpagos->getAllArr($paciente['id_historial']);
                                                        foreach($datapagos as $rowpagos) {
                                                            $totalpagado+=$rowpagos['monto'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rowpagos['monto'] ?></td>
                                                                <td><?php echo $rowpagos['fecha_pago'] ?></td>
                                                                <td><?php echo $rowpagos['tipo_pago'] ?></td>
                                                                <td><?php echo $rowpagos['observaciones'] ?></td>
                                                            </tr>
                                                            <?php
                                                        } 
                                                    ?>
                                                        <tr>
                                                            <td><strong>Total: </strong>$<?php echo number_format($totalpagado,2) ?></td>
                                                            <td colspan="3"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <input type="hidden" id='total_pagado' value="<?php echo $totalpagado ?>">
                                    </div>
                                </div>
                            </div>    
                        </article>
                    </fieldset>
                    <footer>
                        <div class="form-actions" style="text-align: center">
                            <div class="row">
                            <div class="col-md-12">
                                    <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </footer>
                </section>
            </div>
            
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                    <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="100" alt="SmartAdmin">
                    <div id='titlemodal' style="float:right; margin-right: 20px;">
                        <span class="widget-icon"><i class="fa fa-plus"></i> Nuevo</span>
                    </div>
                    
                </h4>
            </div>
            <div class="modal-body no-padding" >
                <div id="contentpopup">

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
    // include page footer
    include(SYSTEM_DIR . "/inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
    //include required scripts
    include(SYSTEM_DIR . "/inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S) -->
<!-- NPM Packages -->
		
<script src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/dist/jquery.imagemapster.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/redist/when.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/core.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/graphics.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/mapimage.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/mapdata.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/areadata.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/areacorners.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/scale.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/node_modules/jquery-imagemapster/src/tooltip.js"></script>

<script>
    var jsonObj = [];
    var color=''; // 1000ff blue   ff0000 red
    var imagediente = $('.imagendiente');
    imagediente.mapster( { 
        fillColor: color, 
        singleSelect: false,
        onClick: function (e) {
            var referencia = $("#nom_referencia").val();
            if(! referencia) return false;
        }
    });
    function nextFocus(inputF, inputS) {
        document.getElementById(inputF).addEventListener('keydown', function(event) {
            if (event.keyCode == 13) {
            document.getElementById(inputS).focus();
            }
        });
    }
   
    function get_datos_tratamiento(id,lineid){
        if ( ! id ) return;

        $.get(config.base+"/Historial/ajax/?action=get&object=get_datos_tratamiento&id=" + id, null, 
            function (response) {
                if ( response ){
                    
                    var json_datostratamiento = JSON.parse(response);
                    var precio   = json_datostratamiento.precio;
                    var producto = json_datostratamiento.producto;
                    $("#status_tratamiento"+lineid).val('active').trigger('change.select2');
                    if (producto==1){
                        $(".cont_status_tratamiento"+lineid).hide(); 
                    }else{
                        $(".cont_status_tratamiento"+lineid).show();
                    }

                    $("#precio_tratamiento"+lineid).val(precio);
                    $("#precio_tratamiento"+lineid).attr('value',precio);
                    $("#total_tratamiento"+lineid).val(precio*  $("#cantidad"+lineid).val());
                    $("#total_tratamiento"+lineid).attr('value',precio);
                    calcTotal();
                }else{
                    notify('error', 'Error al obtener los datos del paciente');
                    return false;
                }     
        });
    }
    calcTotal = function () {
        var totales        = $(".totaltratamiento"); 
        var totaldescuento = ($("#descuento_aplicado").val()>0) ? parseFloat($("#descuento_aplicado").val()) : 0;  
        var total_pagado   = ($("#total_pagado").val()>0) ? parseFloat($("#total_pagado").val()) : 0;    
          
        var total = 0;
        for (var i = 0, len = totales.length; i < len; i++) {
            total = parseFloat(total);
            total += parseFloat($(totales[i]).val());
        }
        total = total-totaldescuento;

        $("#total-global").html(total);
        $("#total-pagos").html(total_pagado);
        $("#total").val(total);
        $("#total_deuda").val(total-total_pagado);
        $("#total-deudatxt").html(total-total_pagado);
    }
   $(document).ready(function() {
        /*GENERALES*/
        //descuentos
        $("#solicitar-descuento-gerencial").click(function () {
            $("#descuento-gerencial").toggle();
            return false;
        });
        $("#descuento_aplicado").change(function () {
            var monto = parseFloat($("#descuento_aplicado").val());
            if (monto > 0 ) {
                calcTotal();
            } else {
                 notify('warning', 'El monto no es correcto');
                 $("#descuento_aplicado").val('')
                 return false;
            }
            return false;
        });

        //end descuentos
        validateForm =function(){
            var nombre = $("input[name=nombre]").val();
            if ( ! nombre )  return notify("info","El nombre es requerido",false,function(){ $("#nombre").focus() });
            var telefono = $("input[name=telefono]").val();
            if ( ! telefono )  return notify("info","El telefono es requerido",false,function(){ $("#telefono").focus() });
            var id_personal = $("#id_personal").val();
            if ( ! id_personal )  return  notify("info","El medico es requerido",false,function(){ $("#medico").focus() });
            
            var totaldeuda    = $("#total_deuda").val();
            var pago          = $("#monto").val();
            
            if ( parseFloat(pago) > parseFloat(totaldeuda) ) {
                        return notify("info","El monto no puede ser mayor a la deuda actual",false,function(){ $("#monto").focus() });    
            }
            $("#main-form").submit(); 
        }
       
        $(document).keydown(function(event) {
            if (event.ctrlKey==true && (event.which == '106' || event.which == '74')) {
                // alert('thou. shalt. not. PASTE!');
                event.preventDefault();
            }
        });
       
        /*   Diagnostico */
        
        get_diagnostico = function(diente,callback){
           
            if ( ! diente ) return false;

            $.get(config.base+"/Historial/ajax/?action=get&object=get_diagnostico&diente=" + diente, null, function (response) {
                if ( response ){
                    $("#contdiagnostico").append(response);
                    callback();
                }else{
                    return notify('error', 'Error al obtener los datos del paciente');
                }     
            }); 
        }
        $('.diente').click(function () {
            var referencia = $("#nom_referencia").val();
            if(! referencia) return notify('warning','Se debe seleccionar primero un diagnostico');
            var diente   = $(this).attr('diente');
            var parte    = $(this).attr('title');
           
            
            if( $("#dienteselect"+diente).length==0){
                // si no existe el objecto se manda llamar
                if(referencia=='Co' || referencia == 'PP' || referencia == 'A' || referencia == 'Imp'){
                    var status=true;
                    if(referencia == 'A' || referencia == 'Imp'){
                        $("#imagen_parte"+diente).attr('src','<?php echo ASSETS_URL; ?>/img/parteverde.png');
                        $(".imagen_parte"+diente).attr('src','<?php echo ASSETS_URL; ?>/img/parteverde.png');
                        status=false;
                    }else{
                        $("#imagen_parte"+diente).attr('src','<?php echo ASSETS_URL; ?>/img/parte.png');
                        $(".imagen_parte"+diente).attr('src','<?php echo ASSETS_URL; ?>/img/parte.png');
                    }
                    //se pinta todo el diente
                    get_diagnostico(diente,function(){   
                        $("[diente"+diente+"]").each(function(){
                            var parte = $(this).attr("title");
                            $(this).mapster('set',status);   
                            item = []
                            item = {diente:diente,parte:parte,referencia:referencia};
                            jsonObj.push(item);              
                        });
                        mostrar_referencias(diente);
                    });
                   
                   
                }else{
                    get_diagnostico(diente,function(){
                        item = []
                        item = {diente:diente,parte:parte,referencia:referencia};
                        jsonObj.push(item); 
                        mostrar_referencias(diente);
                    });
                }
            }else{
                $existe=0;
                for(var i = 0; i < jsonObj.length; i++){
                    if(!jsonObj[i]) continue;
                    if(jsonObj[i].diente == diente && jsonObj[i].parte == parte && jsonObj[i].referencia == referencia)
                        $existe=1;
                }
                if(!$existe){
                    item = []
                    item = {diente:diente,parte:parte,referencia:referencia};
                    jsonObj.push(item); 
                }else{
                    eliminar_referencia(diente,parte,referencia)
                }
                mostrar_referencias(diente);
            }
           
        
		    return false;
		});
        
        $('body').on('click', '.referencia', function(){
            var antreferencia='';
            var diente = $("#imagen_diente").val();
            for(var i = 0; i < jsonObj.length; i++){
                if(!jsonObj[i]) continue;
                if(jsonObj[i].diente == diente)
                    antreferencia=jsonObj[i].referencia ;
            }
            var referencia   = $(this).val();
            $("#nom_referencia").val(referencia);
            
            $("#nom_referencia").attr("color",$(this).attr("color"));
            switch ($("#nom_referencia").attr("color")) {
                case 'blanco':
                    color = 'FFFFFF';
                    break;
                case 'azul':
                    color = '1000ff';
                    break;
                case 'rojo':
                    color = 'ff0000';
                    break;
                case 'amarillo':
                    color = 'ecef00f2';
                    break;
                case 'verde':
                    color = '179700f2';
                    break;
            
                default:
                    break;
            }
            imagediente.mapster('set_options', { 
                fillColor: color
                });
           

            /* esto es para que no se seleccionen dos colores en un diente
                var antreferencia='';
                for(var i = 0; i < jsonObj.length; i++){
                    if(!jsonObj[i]) continue;
                    if(jsonObj[i].diente == diente)
                        antreferencia=jsonObj[i].referencia ;
                }
                console.log(antreferencia +"!="+ referencia);
                if( antreferencia != referencia  && antreferencia!=''){
                    formatear_diente(diente);
                }
            */
           
        });
        function eliminar_referencia(diente,parte,refe) {
            $.map(jsonObj, function(obj,index) {
                var position=jsonObj[index];
                if(obj)
                    if(obj.diente === diente && obj.parte === parte && obj.referencia === refe )
                        delete jsonObj[index];
            });
        }
        function formatear_diente(diente) {
            dientenext = '';
            $.map(jsonObj, function(obj,index) {
                if(obj){
                    if(obj.diente === diente){
                        delete jsonObj[index];
                    }
                }
            });
            var imagediente=$('#imagen_parte'+diente);
            imagediente.mapster('set',false,imagediente.mapster('get'));
            mostrar_referencias(diente);
        }
        function eliminar_diente(diente) {
            dientenext = '';
            $.map(jsonObj, function(obj,index) {
                if(obj){
                    if(obj.diente === diente){
                        delete jsonObj[index];
                        $.map(jsonObj, function(obj2,index) {
                            if(obj2){
                                if(obj2.diente){
                                    dientenext = obj2.diente
                                }
                            }
                        });
                    }
                }
            });
            var imagediente=$('#imagen_parte'+diente);
            imagediente.mapster('set',false,imagediente.mapster('get'));
            if(dientenext)
                dienteselected(dientenext);
        }
        function mostrar_referencias(diente){
            $("#imagen_diente").val(diente);
            var referencias = '';
            var datos  = [];
            var obj = {};
            var ultimareferenciadiente= '';
            for(var i = 0; i < jsonObj.length; i++){
                if(!jsonObj[i]) continue;
                if(jsonObj[i].diente == diente){
                    referencias+=jsonObj[i].diente + '|'+ jsonObj[i].parte + '|' + jsonObj[i].referencia + '\n';
                    datos.push({
                        "diente":jsonObj[i].diente,
                        "parte":jsonObj[i].parte,
                        "referencia":jsonObj[i].referencia
                    });
                    ultimareferenciadiente=jsonObj[i].referencia;
                }
            }
            obj.datos = datos;
            $("#referencias_json"+diente).val(JSON.stringify(obj));            
            $("#referencias"+diente).html(referencias);
            $("#cont_imagen_parte").html(diente);
            if(ultimareferenciadiente){
                $(".referencia").each(function(){
                    var val = $(this).attr("value");
                    if(val==ultimareferenciadiente)
                        $(this).click();
                });
            }
            
               
            //console.log(jsonObj);
		    return false;
        }
        function pinta_odontograma(diente){
           
                for(var i = 0; i < jsonObj.length; i++){
                    if(!jsonObj[i]) continue;
                    if(jsonObj[i].diente == diente){
                        $("[diente"+diente+"]").each(function(){
                            var val = $(this).attr("title");
                            if(jsonObj[i]){
                                if(jsonObj[i].parte==val){
                                    //$(this).click();
                                    $(this).mapster('set',true);
                                }
                            }
                           
                        });
                    }
                } 
            //console.log(jsonObj);
		    return false;
        }
        function dienteselected(diente){
            if(!diente) return false;
            $('#dienteselect'+diente).prop("checked",true);
            mostrar_referencias(diente);
        }
       
            
        $("body").on('click', '.borrar-diagnostico', function (e) {
            e.preventDefault();

            var id = $(this).attr("lineiddiagnostico");
            $("[lineiddiagnostico=" + id + "]").remove();
            eliminar_diente(id);
            
        });
        $("body").on('click', '.radio', function () {
            dienteselected($(this).val());
        });
        get_seguimiento = function(){
            var cont=0;
            $(".referecias_seguimiento").each(function(){
               var json_diente = JSON.parse($(this).val());
               var detallestxt    = $(this).attr("detalles");
               var json_data      = json_diente.datos;
               var diente         = '';
               for(var i = 0; i < json_data.length; i++){ 
                    if(!json_data[i]) continue;
                    item = [];
                    item = {diente:json_data[i].diente,parte:json_data[i].parte,referencia:json_data[i].referencia};
                    jsonObj.push(item);
                    diente=json_data[i].diente;                  
                }
                get_diagnostico(diente,function(){
                    mostrar_referencias(diente);
                    pinta_odontograma(diente);
                });
                
                /*get_diagnostico(diente,true,function(){ 
                    dienteselected(diente);
                    $("#detalles_diagnostico"+diente).html(detallestxt);
                 });
                 */
              
            });
		    return false;
        }

    //**********Clients*************/
       
      
    /*   tratamientos */
        gettratamiento =function(){
            $.get(config.base+"/Historial/ajax/?action=get&object=gettratamiento" , null, function (response) {
                if ( response ){
                    $("#cont-tratamiento").append(response);
                    $(".select2-trat").select2();
                }else{
                    notify('error', 'Error al obtener los datos del paciente');
                    return false;
                }     
            });
        }
        $("body").on('click', '.borrar-tratamiento', function (e) {
            e.preventDefault();
            var id = $(this).attr("lineidtratamiento");
            $("[lineidtratamiento=" + id + "]").remove();
            $("#referencias"+id).html('');
            delete jsonObj;

            calcTotal();
        });
        $("body").on('click', '#btnaddtratamiento', function () {
            gettratamiento(); 
            return false;
        });
        $('body').on('change', '.id_tratamiento', function(){
            if( $(this).val() ){
                var id = $(this).val();
                var lineid = $(this).attr('lineid');
                get_datos_tratamiento(id,lineid);
            }
        });
        $('body').on('change', '.cantidad', function(){
            if( $(this).val() ){
                var lineid = $(this).attr('lineid');
                if($("#precio_tratamiento"+lineid).val()){
                    $("#total_tratamiento"+lineid).val($("#precio_tratamiento"+lineid).val()*  $("#cantidad"+lineid).val());
                    calcTotal();
                }
            }
        });
        $('body').on('change', '.status_tratamiento', function(){
            
            if( $(this).val() ){
                var Hoy       = new Date();
                var AnyoHoy   = Hoy.getFullYear();
                var MesHoy    = Hoy.getMonth();
                var DiaHoy    = Hoy.getDate();

                var MesHoy = (MesHoy < 10) ? '0' + MesHoy : MesHoy;
                var DiaHoy = (DiaHoy < 10) ? '0' + DiaHoy : DiaHoy;
                var id = $(this).val();
                var lineid = $(this).attr('lineid'); 
                $("#fecha_realizado"+lineid).val('');
                if( $(this).val() != 'active' ){
                    $("#fecha_realizado"+lineid).attr("type","text");
                    $("#fecha_realizado"+lineid).val(AnyoHoy+'-'+MesHoy+'-'+DiaHoy+' '+(Hoy.getHours())+':'+Hoy.getMinutes());
                }
                if( $(this).val() == 'Realizado' ){
                    $("#fecha_recomendada"+lineid).val("");
                    
                }
            }
        });
       
        <?php 
        if($paciente['id_historial']>0){
            ?>
            get_seguimiento();
            calcTotal();
            <?php 
        }else{
            ?>
            $("#btnaddtratamiento").click();
            <?php
        }
        ?>
        
        //datetime
        $('.form_datetime').datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            language:  'es',
            weekStart: 0,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 0,
            minuteStep :30
        });
        $(".select2").select2({
            multiple: false,
            header: "Selecciona una opcion",
            noneSelectedText: "Seleccionar",
            selectedList: 1
        });
        
        
       
     
        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    })

</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>
