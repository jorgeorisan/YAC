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
$id = '';
if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];

$cita     = '';
$paciente = '';
$id_cita  = '';
$totalpagado = 0;
$fecha_inicial = date('Y-m-d H:i');

if($id){
    $obj = new Paciente();
    $paciente = $obj->getTable($id);
    $objHistorial = new Historial();
    $historial = $objHistorial->getTable($paciente['id_paciente']);
}
$date     = $motivo = $seguimiento = $receta = $recomendaciones ='';

if(isset($request['params']['id_cita'])){
    $id_cita=$request['params']['id_cita'];
    $citas = new Cita();
    $cita  = $citas->getTable($id_cita);
    $fecha_inicial = ($cita['fecha_inicial'])           ? $cita['fecha_inicial'] : $fecha_inicial;
    $seguimiento   = ($cita['id_historialtratamiento']) ? "Seguimiento-> " : "";
    $motivo        = $cita['motivo'];
    
    $objhisttrat          = new HistorialTratamiento();
    $datatrat             = $objhisttrat->getTable($cita['id_historialtratamiento']);
    $cita['id_historial'] = $datatrat['id_historial'];

    $objhist       = new Historial();
    $datahistorial = $objhist->getTable($cita['id_historial']);
    $receta          = $datahistorial['receta'];
    $recomendaciones = $datahistorial['recomendaciones'];
    
    $pacientes = new Paciente();
    
    $id_paciente=$cita['id_paciente'];
	$paciente  = $pacientes->getTable($id_paciente);
}

if(isPost()){
    if(isset($_POST['main-form'])){
        $obj = new Paciente();
        $id = $obj->updateAll($id,getPost());
        $urlredirect=make_url("Pacientes","view",array('id'=>$id));
    }
    if(isset($_POST['main-form2'])){
        $obj = new Historial();
        if(isset($_POST['seguimiento']))
            $id = $obj->updateAll($_POST['seguimiento'],getPost());
        else
            $id  = $obj->addAll(getPost());

        $urlredirect=make_url("Historial","view",array('id'=>$id));
    }

    
    //$id=240;
   
    if ($id > 0){
        informSuccess(true, $urlredirect);
    }else{
        informError(true,make_url("Pacientes","index"));
    }
}
$nombrepaciente = ($paciente) ? $paciente['nombre'].' '.$paciente['apellido_pat'].' '.$paciente['apellido_mat'] : '';

$fecha_final   = strtotime ( '+1 hour' , strtotime ( $fecha_inicial ) ) ;
$fecha_final   = date('Y-m-d H:i',$fecha_final);

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
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <form id="main-form" class="" role="form" method=post action="">     
                <input type="hidden" name='main-form' value="1">    
                    <article class="col-sm-12 col-md-12 col-lg-12"  id="">
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
                                                <label for="name">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')" value="<?php echo $paciente['email']; ?>">                                                          
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle"  id="calle" onkeypress="nextFocus('calle', 'num_ext')" value="<?php echo $paciente['calle']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" id="colonia" onkeypress="nextFocus('colonia', 'ciudad')" value="<?php echo $paciente['colonia']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Alergias</label>
                                                <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" onkeypress="nextFocus('alergias', 'fecha_nac')"  value="<?php echo $paciente['alergias']; ?>">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Paterno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_pat" id="apellido_pat" onkeypress="nextFocus('apellido_pat', 'apellido_mat')" value="<?php echo $paciente['apellido_pat']; ?>" >                                                                                               
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
                                                <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha nacimiento" name="fecha_nac" id="fecha_nac" onkeypress="nextFocus('fecha_nac', 'antecedentes_pat')" value="<?php echo $paciente['fecha_nac']; ?>">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Materno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_mat" id="apellido_mat" onkeypress="nextFocus('apellido_mat', 'email')"  value="<?php echo $paciente['apellido_mat']; ?>">                                                                                               
                                            </div>
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
                                                <input type="text" class="form-control" placeholder="CP" name="cp" id="cp" onkeypress="nextFocus('cp', 'alergias')" value="<?php echo $paciente['cp']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Antecedentes patologicos</label>
                                                <input type="text" class="form-control" placeholder="Antecedentes Patologicos" name="antecedentes_pat" id="antecedentes_pat" onkeypress="nextFocus('antecedentes_pat', 'savenewclient')"  value="<?php echo $paciente['antecedentes_pat']; ?>" >                                                                                               
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
                                <div class="jarviswidget" id="wid-id-antheredo" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
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
                                                        <input type="text" class="form-control" placeholder="Escolaridad" name="escolaridad"  id="escolaridad" value="<?php echo $paciente['escolaridad']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-5">
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
                                                <input type="text" class="form-control" placeholder="Madre" name="ant_madre" id="ant_madre" value="<?php echo $paciente['ant_madre']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Padre" name="ant_padre" id="ant_padre" value="<?php echo $paciente['ant_padre']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Abuelos Paternos" name="ant_abuelospaternos" id="ant_abuelospaternos" value="<?php echo $paciente['ant_abuelospaternos']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
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
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Fecuencia de Baño" name="frec_banio" id="frec_banio" value="<?php echo $paciente['frec_banio']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Fecuencia de cambio de ropa" name="frec_ropa" id="frec_ropa" value="<?php echo $paciente['frec_ropa']; ?>">                                                                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Fecuencia de lavado de dientes" name="frec_dientes" id="frec_dientes" value="<?php echo $paciente['frec_dientes']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Numero de Veces" name="vecese_dientes" id="vecese_dientes" value="<?php echo $paciente['vecese_dientes']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Auxiliares de limpieza" name="aux_limpieza" id="aux_limpieza" value="<?php echo $paciente['aux_limpieza']; ?>">                                                                                               
                                            </div> 
                                            <div class="form-group">
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
                                                <input type="text" class="form-control" placeholder="Numero de Gestacion" name="num_gesta" id="num_gesta" value="<?php echo $paciente['num_gesta']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tipo de Gestacion" name="tipo_gesta" id="tipo_gesta" value="<?php echo $paciente['tipo_gesta']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tiempo de Gestacion" name="tiempo_gesta" id="tiempo_gesta" value="<?php echo $paciente['tiempo_gesta']; ?>">                                                                                               
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
                                                        <label class="col-md-12 control-label">Tipo de Parto</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select class="select2" name="tipo_parto">
                                                            <option <?php echo ($paciente['tipo_parto']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['tipo_parto']=="Eutocico") ? "selected": '';?> value="Eutocico">Eutocico</option>
                                                            <option <?php echo ($paciente['tipo_parto']=="Distocico") ? "selected": '';?> value="Distocico">Distocico</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Utilizacion de Forceps</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select class="select2" name="forceps">
                                                            <option <?php echo ($paciente['forceps']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['forceps']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['forceps']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Cesarea</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <select class="select2" name="cesarea">
                                                            <option <?php echo ($paciente['cesarea']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['cesarea']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['cesarea']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Motivo Cesarea" name="motivo_cesarea" id="motivo_cesarea" value="<?php echo $paciente['motivo_cesarea']; ?>">                                                                                               
                                            </div>
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
                                                <input type="text" class="form-control" placeholder="Tiempo y Motivo Incubadora" name="tiempo_incubadora" id="tiempo_incubadora" value="<?php echo $paciente['tiempo_incubadora']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">A seno materno</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="seno_materno">
                                                            <option <?php echo ($paciente['seno_materno']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['seno_materno']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['seno_materno']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tiempo" name="tiempo_seno" id="tiempo_seno"  value="<?php echo $paciente['tiempo_seno']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Biberon</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="biberon">
                                                            <option <?php echo ($paciente['biberon']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['biberon']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['biberon']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tiempo" name="tiempo_biberon" id="tiempo_biberon"  value="<?php echo $paciente['tiempo_biberon']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Endulzo la leche</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="endulzo_leche">
                                                            <option <?php echo ($paciente['endulzo_leche']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['endulzo_leche']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['endulzo_leche']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Con que" name="tipo_endulzante" id="tipo_endulzante"  value="<?php echo $paciente['tipo_endulzante']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Ablactacion</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="ablactacion">
                                                            <option <?php echo ($paciente['ablactacion']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['ablactacion']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['ablactacion']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Incio" name="ablactacion_inicio" id="ablactacion_inicio"  value="<?php echo $paciente['ablactacion_inicio']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Incio Alimantacion Solida</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="alimentacion_solida">
                                                            <option <?php echo ($paciente['alimentacion_solida']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['alimentacion_solida']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['alimentacion_solida']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
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
                                                <input type="text" class="form-control" placeholder="Inicio Denticion" name="inicio_denticion" id="inicio_denticion"  value="<?php echo $paciente['inicio_denticion']; ?>">                                                                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Tratamiento dental previo</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <select class="select2" name="tratamiento_previo">
                                                            <option <?php echo ($paciente['tratamiento_previo']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['tratamiento_previo']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['tratamiento_previo']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tipo" name="tipo_tratamiento_previo" id="tipo_tratamiento_previo"  value="<?php echo $paciente['tipo_tratamiento_previo']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Aplicacion de Floruro</label>
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
                                <div class="jarviswidget" id="wid-id-habitat" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                    <header> <h2>Habitat (Condiciones de Vivienda)</h2></header>
                                    <div>
                                        <div class="jarviswidget-editbox"></div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tipo Construccion" name="tipo_construccion" id="tipo_construccion"  value="<?php echo $paciente['tipo_construccion']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Num. Habitaciones" name="num_habitaciones" id="num_habitaciones"  value="<?php echo $paciente['num_habitaciones']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Num. Personas" name="num_personas" id="num_personas"  value="<?php echo $paciente['num_personas']; ?>">                                                                                               
                                                    </div>
                                                </div>                                                   
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Servicios</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <select class="select2" name="servicios">
                                                            <option <?php echo ($paciente['servicios']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['servicios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['servicios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Cuenta con animales</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <select class="select2" name="animales">
                                                            <option <?php echo ($paciente['animales']=="") ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php echo ($paciente['animales']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php echo ($paciente['animales']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tipo" name="especie_animales" id="especie_animales"  value="<?php echo $paciente['especie_animales']; ?>">                                                                                               
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
                                                        <input type="text" class="form-control" placeholder="Pulso xmin." name="pulso_signos" id="pulso_signos"  value="<?php echo $paciente['pulso_signos']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="T.A mm/Hg" name="ta_signos" id="ta_signos" value="<?php echo $paciente['ta_signos']; ?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="F.C. xmin." name="fc_signos" id="fc_signos" value="<?php echo $paciente['fc_signos']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="T. C." name="t_signos" id="t_signos" value="<?php echo $paciente['t_signos']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            <label >Somatometria</label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Peso kg." name="peso_soma" id="peso_soma" value="<?php echo $paciente['peso_soma']; ?>">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
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
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Nacimiento</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_nacimiento">
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_nacimientodet" value="<?php  echo $paciente['inm_nacimientodet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">2 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_dosmeses">
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_nacimiento']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_dosmesesdet" value="<?php  echo $paciente['inm_dosmesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">4 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_cuatromeses">
                                                            <option <?php  echo ($paciente['inm_cuatromeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_cuatromeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_cuatromeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_cuatromesesdet" value="<?php  echo $paciente['inm_cuatromesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">6 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_seismeses">
                                                            <option <?php  echo ($paciente['inm_seismeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_seismeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_seismeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_seismesesdet" value="<?php  echo $paciente['inm_seismesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">7 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_sietemeses">
                                                            <option <?php  echo ($paciente['inm_sietemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_sietemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_sietemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_sietemesesdet" value="<?php  echo $paciente['inm_sietemesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">12 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_docemeses">
                                                            <option <?php  echo ($paciente['inm_docemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_docemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_docemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_docemesesdet" value="<?php  echo $paciente['inm_docemesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">18 meses</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_dieciochoemeses">
                                                            <option <?php  echo ($paciente['inm_dieciochoemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_dieciochoemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_dieciochoemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_dieciochoemesesdet" value="<?php  echo $paciente['inm_dieciochoemesesdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">4 Años</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_cuatroanios">
                                                            <option <?php  echo ($paciente['inm_cuatroanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_cuatroanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_cuatroanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_cuatroaniosdet" value="<?php  echo $paciente['inm_cuatroaniosdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">7 Años</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_sieteanios">
                                                            <option <?php  echo ($paciente['inm_sieteanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_sieteanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_sieteanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_sieteaniosdet" value="<?php  echo $paciente['inm_sieteaniosdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">11 Años</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <select class="select2"  name="inm_onceanios">
                                                            <option <?php  echo ($paciente['inm_onceanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php  echo ($paciente['inm_onceanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php  echo ($paciente['inm_onceanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_onceaniosdet" value="<?php  echo $paciente['inm_onceaniosdet'];?>">                                                                                               
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
                </form>
            </section>
        </div>
        <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">   
                <div class="well ">
                    <header>
                            <h2><i class="fa fa-tooth"></i>&nbsp;<?php echo $page_title. ' '.$seguimiento.$motivo ?></h2>
                    </header>
                    <fieldset>          
                        <form id="" class="" role="form" method='post' action="" >    
                            <input type="hidden" id="id_cita" name="id_cita" value="<?php echo $id_cita;?>">
                            <input type="hidden"  name='main-form2' value="1"> 
                            <input type="hidden" id="total" name="total" value="0">
                            <input type="hidden" id="total_deuda" name="total_deuda" value="0">
                            <?php if($seguimiento) { ?>
                                <input type="hidden"  name="seguimiento" id="seguimiento"  value="<?php echo $cita['id_historial'];?>">
                            <?php } ?>
                            <section id="widget-grid2" class="">
                               
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-diagnostico">
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
                                                            if($seguimiento){
                                                                $objhistdiag     = new HistorialDiagnostico();
                                                                $datadiagnostico = $objhistdiag->getAllArr($cita['id_historial']);
                                                                foreach($datadiagnostico as $row) {
                                                                    if ($row['status'] == 'deleted')  continue;
                                                                    $referencias = $row['referencias_json'];
                                                                    if ( $referencias ){
                                                                        echo "<input type='hidden'  class='referecias_seguimiento'   detalles='".$row['detalles']."' value='".$referencias."'>";
                                                                    }
                                                                } 
                                                            }
                                                        ?>   
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
                                                        <table style="width:100%">
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
                                                                                    <img style="width:50px;height:50px" class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                    <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                                
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
                                                                                <img class='imagendiente' id='imagen_parte<?php echo $numdiente;?>' src="<?php echo ASSETS_URL; ?>/img/parte.png"  alt="Diente" usemap="#image-map<?php echo $numdiente;?>">
                                                                            
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
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-receta">
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
                                <article class="col-sm-12 col-md-12 col-lg-12"  id="article-tratamiento">
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
                                                        <?php if($seguimiento){ ?>
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
                                                    <table style='width:100%' class='table-striped table-bordered table-hover' id="conttratamiento">
                                                        <thead>    
                                                            <tr>
                                                                <th style="width: 7%;">Cant.</th>
                                                                <th style="width: 20%">Dientes</th>
                                                                <th style="width: 20%;">Tratamientos</th>
                                                                <th style="width: 8%">Precio</th>
                                                                <th style="width: 8%">Total</th>
                                                                <th style="width: 15%">Cita Propuesta</th>
                                                                <th>Status</th>
                                                                <th class="borrar-td" ></th>
                                                            </tr>
                                                            <?php
                                                                if($seguimiento){
                                                                    $objhistdiag     = new HistorialTratamiento();
                                                                    $dataTratamiento = $objhistdiag->getAllArr($cita['id_historial']);
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
                                                                                <textarea type='text' style='width: 150px; height: 50px;' placeholder="Detalles"  name='detalles_tratamiento[]' ><?php echo  $row['detalles']?> </textarea>
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
                                                                            <td><input type='number' style='width: 70px;' class='form-control costotratamiento' name='precio_tratamiento[]' id="precio_tratamiento<?php echo $lineId ?>" value='<?php echo $row['precio'] ?>' placeholder='00.00'></td>
                                                                            <td><input type='number' style='width: 70px;' class='form-control totaltratamiento' name='total_tratamiento[]'  id="total_tratamiento<?php echo $lineId ?>" value='<?php echo $row['total'] ?>' placeholder='00.00'></td>
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
                                                        </thead>
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
                                                    if($seguimiento){
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
                                                                $datapagos = $objhistpagos->getAllArr($cita['id_historial']);
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
                            </section>                                       
                        </form>
                    </fieldset>
                    
                    <footer>
                        <div class="form-actions" style="text-align: center">
                            <div class="row">
                               <div class="col-md-12">
                                    <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                        Cancelar
                                    </button>
                                    <button class="btn btn-primary btn-md" type="button" onclick=" validateForm2();">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
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
    function validateForm()
    {
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");
        var telefono = $("input[name=telefono]").val();
        if ( ! telefono )  return notify("info","El telefono es requerido");

           
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
        validateForm2 =function(){
            
            var totaldeuda    = $("#total_deuda").val();
            var pago          = $("#monto").val();
            
            if ( parseFloat(pago) > parseFloat(totaldeuda) ) {
                        return notify("info","El monto no puede ser mayor a la deuda actual");    
            }
            if(!$('#id_cita').val()){
               notify('error','es necesaria una cita para la consulta')     
            }else{
            }
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
               
                
                if(referencia=='Co' || referencia == 'PP'){
                    //se pinta todo el diente
                    get_diagnostico(diente,function(){   
                        $("[diente"+diente+"]").each(function(){
                            var parte = $(this).attr("title");
                            $(this).mapster('set',true);   
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
                    $("#conttratamiento").append(response);
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
                var id = $(this).val();
                var lineid = $(this).attr('lineid'); 
                
                $("#fecha_realizado"+lineid).val('');
                if( $(this).val() != 'active' ){
                    $("#fecha_realizado"+lineid).attr("type","text");
                    $("#fecha_realizado"+lineid).val(AnyoHoy+'-'+MesHoy+'-'+DiaHoy+' '+Hoy.getUTCHours()+':'+Hoy.getMinutes());
                }
                if( $(this).val() == 'Realizado' ){
                    $("#fecha_recomendada"+lineid).val("");
                    
                }
            }
        });
       
        <?php 
        if($seguimiento){
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
