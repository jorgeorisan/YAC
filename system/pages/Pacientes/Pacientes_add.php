<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Nuevo paciente";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
include(SYSTEM_DIR . "/inc/nav.php");
if(isPost()){
    $obj = new Paciente();
    $id=$obj->addAll(getPost());
    if($id>0){
        informSuccess(true, make_url("Pacientes","index"));
    }else{
        informError(true,make_url("Pacientes","index"));
    }
}

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Paciente"] = APP_URL."/Paciente/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <form id="main-form" class="" role="form" method=post action="<?php echo make_url("Pacientes","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'apellido_pat')" > 
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')">                                                          
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle"  id="calle" onkeypress="nextFocus('calle', 'num_ext')">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" id="colonia" onkeypress="nextFocus('colonia', 'ciudad')">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Alergias</label>
                                                <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" onkeypress="nextFocus('alergias', 'fecha_nac')">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Paterno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellido_pat" id="apellido_pat" onkeypress="nextFocus('apellido_pat', 'apellido_mat')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input type="text" class="form-control" placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'estado')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Exterior</label>
                                                <input type="text" class="form-control" placeholder="Número Exterior" name="num_ext" id="num_ext" onkeypress="nextFocus('num_ext', 'num_int')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad" onkeypress="nextFocus('ciudad', 'cp')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Fecha Nacimiento</label>
                                                <input type="text" class="form-control datepicker" data-dateformat='dd-mm-yy' autocomplete="off" placeholder="Fecha nacimiento" name="fecha_nac" id="fecha_nac" onkeypress="nextFocus('fecha_nac', 'antecedentes_pat')">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Materno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Materno" name="apellido_mat" id="apellido_mat" onkeypress="nextFocus('apellido_mat', 'email')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado" name="estado" id="estado"  onkeypress="nextFocus('estado', 'calle')"  >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Interior</label>
                                                <input type="text" class="form-control" placeholder="Número Interior" name="num_int" id="num_int" onkeypress="nextFocus('num_int', 'colonia')"  >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">CP</label>
                                                <input type="text" class="form-control" placeholder="CP" name="cp" id="cp" onkeypress="nextFocus('cp', 'alergias')" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Antecedentes patologicos</label>
                                                <input type="text" class="form-control" placeholder="Antecedentes Patologicos" name="antecedentes_pat" id="antecedentes_pat" onkeypress="nextFocus('antecedentes_pat', 'savenewclient')">                                                                                               
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
                                                                <option <?php //echo ($paciente['sexo']=="") ? "selected": '';?> value="">Selecciona sexo</option>
                                                                <option <?php //echo ($paciente['sexo']=="Femenino") ? "selected": '';?> value="Femenino">Femenino</option>
                                                                <option <?php //echo ($paciente['sexo']=="Masculino") ? "selected": '';?> value="Masculino">Masculino</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <select class="select2" name="grupo_sanguineo">
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="") ? "selected": '';?> value="">Tipo Sangre</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="A+") ? "selected": '';?> value="A+">A+</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="A-") ? "selected": '';?> value="A-">A-</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="B+") ? "selected": '';?> value="B+">B+</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="B-") ? "selected": '';?> value="B-">B-</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="AB+") ? "selected": '';?> value="AB+">AB+</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="AB-") ? "selected": '';?> value="AB-">AB-</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="O+") ? "selected": '';?> value="O+">O+</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="O-") ? "selected": '';?> value="O-">O-</option>
                                                                <option <?php //echo ($paciente['grupo_sanguineo']=="No Sabe") ? "selected": '';?> value="No Sabe">No Sabe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Estado civil</label>
                                                    <select class="select2" name="edo_civil">
                                                        <option <?php //echo ($paciente['edo_civil']=="") ? "selected": '';?> value="">Selecciona</option>
                                                        <option <?php //echo ($paciente['edo_civil']=="Casado") ? "selected": '';?> value="Casado">Casado</option>
                                                        <option <?php //echo ($paciente['edo_civil']=="Soltero") ? "selected": '';?> value="Soltero">Soltero</option>
                                                        <option <?php //echo ($paciente['edo_civil']=="Union libre") ? "selected": '';?> value="Union libre">Union libre</option>
                                                        <option <?php //echo ($paciente['edo_civil']=="Divorciado") ? "selected": '';?> value="Divorciado">Divorciado</option>
                                                        <option <?php //echo ($paciente['edo_civil']=="Viudo") ? "selected": '';?> value="Viudo">Viudo</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <label>Escolaridad</label>
                                                            <input type="text" class="form-control" placeholder="Escolaridad" name="escolaridad"  id="escolaridad" value="<?php //echo $paciente['escolaridad']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Ocupacion</label>
                                                        <input type="text" class="form-control" placeholder="Ocupacion" name="ocupacion" id="ocupacion" value="<?php //echo $paciente['ocupacion']; ?>">
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
                                                    <input type="text" class="form-control" placeholder="Madre" name="ant_madre" id="ant_madre" value="<?php //echo $paciente['ant_madre']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Padre</label>
                                                    <input type="text" class="form-control" placeholder="Padre" name="ant_padre" id="ant_padre" value="<?php //echo $paciente['ant_padre']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Abuelos Paternos</label>
                                                    <input type="text" class="form-control" placeholder="Abuelos Paternos" name="ant_abuelospaternos" id="ant_abuelospaternos" value="<?php //echo $paciente['ant_abuelospaternos']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Abuelos Maternos</label>
                                                    <input type="text" class="form-control" placeholder="Abuelos Maternos" name="ant_abuelosmaternos" id="ant_abuelosmaternos" value="<?php //echo $paciente['ant_abuelosmaternos']; ?>">                                                                                               
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
                                                            <input type="text" class="form-control" placeholder="Fecuencia de lavado de dientes" name="frec_dientes" id="frec_dientes" value="<?php //echo $paciente['frec_dientes']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Auxiliares de limpieza</label>
                                                    <input type="text" class="form-control" placeholder="Auxiliares de limpieza" name="aux_limpieza" id="aux_limpieza" value="<?php //echo $paciente['aux_limpieza']; ?>">                                                                                               
                                                </div> 
                                                <div class="form-group">
                                                    <label>Tipo de pasta dental</label>
                                                    <input type="text" class="form-control" placeholder="Tipo de pasta dental" name="pasta_dental" id="pasta_dental" value="<?php //echo $paciente['pasta_dental']; ?>">                                                                                               
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
                                                    <input type="text" class="form-control" placeholder="Numero de Gestacion" name="num_gesta" id="num_gesta" value="<?php //echo $paciente['num_gesta']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiempo de Gestacion</label>
                                                    <input type="text" class="form-control" placeholder="Tiempo de Gestacion" name="tiempo_gesta" id="tiempo_gesta" value="<?php //echo $paciente['tiempo_gesta']; ?>">                                                                                               
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
                                                                <option <?php //echo ($paciente['tipo_parto']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['tipo_parto']=="Normal") ? "selected": '';?> value="Normal">Normal</option>
                                                                <option <?php //echo ($paciente['tipo_parto']=="Cesarea") ? "selected": '';?> value="Cesarea">Cesarea</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Motivo Cesarea</label>
                                                    <input type="text" class="form-control" placeholder="Motivo Cesarea" name="motivo_cesarea" id="motivo_cesarea" value="<?php //echo $paciente['motivo_cesarea']; ?>">                                                                                               
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
                                                                <option <?php //echo ($paciente['reanimacion_especial']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['reanimacion_especial']=="Bolsa de oxigeno") ? "selected": '';?> value="Bolsa de oxigeno">Bolsa de oxigeno</option>
                                                                <option <?php //echo ($paciente['reanimacion_especial']=="Ventilacion asistida con ambu") ? "selected": '';?> value="Ventilacion asistida con ambu">Ventilacion asistida con ambu</option>
                                                                <option <?php //echo ($paciente['reanimacion_especial']=="Intubacion") ? "selected": '';?> value="Intubacion">Intubacion</option>
                                                                <option <?php //echo ($paciente['reanimacion_especial']=="Medicamentos") ? "selected": '';?> value="Medicamentos">Medicamentos</option>
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
                                                                <option <?php //echo ($paciente['incubadora']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['incubadora']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php //echo ($paciente['incubadora']=="No") ? "selected": '';?> value="No">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tiempo y Motivo Incubadora</label>
                                                    <input type="text" class="form-control" placeholder="Tiempo y Motivo Incubadora" name="tiempo_incubadora" id="tiempo_incubadora" value="<?php //echo $paciente['tiempo_incubadora']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label>Reflujo Esofagico</label>
                                                    <input type="text" class="form-control" placeholder="Reflujo Esofagico" name="reflujo_esofagico" id="reflujo_esofagico" value="<?php //echo $paciente['reflujo_esofagico']; ?>">                                                                                               
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
                                                            <input type="text" class="form-control" placeholder="Incio" name="ablactacion_inicio" id="ablactacion_inicio"  value="<?php //echo $paciente['ablactacion_inicio']; ?>">                                                                                               
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
                                                            <input type="text" class="form-control" placeholder="Incio" name="alimentacion_solida_inicio" id="alimentacion_solida_inicio"  value="<?php //echo $paciente['alimentacion_solida_inicio']; ?>">                                                                                               
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
                                                    <input type="text" class="form-control" placeholder="Inicio Denticion" name="inicio_denticion" id="inicio_denticion"  value="<?php //echo $paciente['inicio_denticion']; ?>">                                                                                               
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Habitos</label>
                                                    <input type="text" class="form-control" placeholder="Habitos" name="denticion_habitos" id="denticion_habitos"  value="<?php //echo $paciente['denticion_habitos']; ?>">                                                                                               
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
                                                                <option <?php //echo ($paciente['tratamiento_previo']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['tratamiento_previo']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php //echo ($paciente['tratamiento_previo']=="No") ? "selected": '';?> value="No">No</option>
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
                                                                <option <?php //echo ($paciente['tipo_tratamiento_previo']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['tipo_tratamiento_previo']=="Temporal") ? "selected": '';?> value="Temporal">Temporal</option>
                                                                <option <?php //echo ($paciente['tipo_tratamiento_previo']=="Permanente") ? "selected": '';?> value="Permanente">Permanente</option>
                                                                <option <?php //echo ($paciente['tipo_tratamiento_previo']=="Mixta") ? "selected": '';?> value="Mixta">Mixta</option>
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
                                                                <option <?php //echo ($paciente['aplicacion_floruro']=="") ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['aplicacion_floruro']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                                <option <?php //echo ($paciente['aplicacion_floruro']=="No") ? "selected": '';?> value="No">No</option>
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
                                                            <input type="text" class="form-control" placeholder="Pulso xmin." name="pulso_signos" id="pulso_signos"  value="<?php //echo $paciente['pulso_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>T.A mm/Hg</label>
                                                            <input type="text" class="form-control" placeholder="T.A mm/Hg" name="ta_signos" id="ta_signos" value="<?php //echo $paciente['ta_signos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>F.C. xmin.</label>
                                                            <input type="text" class="form-control" placeholder="F.C. xmin." name="fc_signos" id="fc_signos" value="<?php //echo $paciente['fc_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>F. C.</label>
                                                            <input type="text" class="form-control" placeholder="F. C." name="t_signos" id="t_signos" value="<?php //echo $paciente['t_signos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                                <label >Somatometria</label>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Peso kg.</label>
                                                            <input type="text" class="form-control" placeholder="Peso kg." name="peso_soma" id="peso_soma" value="<?php //echo $paciente['peso_soma']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Talla m.</label>
                                                            <input type="text" class="form-control" placeholder="Talla m." name="talla_soma" id="talla_soma" value="<?php //echo $paciente['talla_soma']; ?>">                                                                                               
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
                                                                <option <?php //echo ($paciente['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                                <option <?php //echo ($paciente['inm_nacimiento']=="Completa") ? "selected": '';?> value="Completa">Completa</option>
                                                                <option <?php //echo ($paciente['inm_nacimiento']=="Incompleta") ? "selected": '';?> value="Incompleta">Incompleta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Por que" name="inm_nacimientodet" value="<?php //echo $paciente['inm_nacimientodet'];?>">                                                                                               
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
                                                            <input type="text" class="form-control" placeholder="Efermedades padecidas" name="pat_enfermedades" id="pat_enfermedades"  value="<?php //echo $paciente['pat_enfermedades']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label >Esta actualente bajo algun tratamiento medico</label> 
                                                            <input type="text" class="form-control" placeholder="Tratamiento medico" name="pat_tratamiento" id="pat_tratamiento"  value="<?php //echo $paciente['pat_tratamiento']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Peso.</label>
                                                            <input type="text" class="form-control" placeholder="Peso" name="pat_peso" id="pat_peso"  value="<?php //echo $paciente['pat_peso']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Talla</label>
                                                            <input type="text" class="form-control" placeholder="Talla" name="pat_talla" id="pat_talla" value="<?php //echo $paciente['pat_talla']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Grupo Sanguineo</label>
                                                            <input type="text" class="form-control" placeholder="Grupo Sanguineo" name="pat_gruposanguineo" id="pat_gruposanguineo" value="<?php //echo $paciente['pat_gruposanguineo']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>R.H.</label>
                                                            <input type="text" class="form-control" placeholder="R.H." name="pat_rh" id="pat_rh" value="<?php //echo $paciente['pat_rh']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Hospitalizaciones(Causas)</label> 
                                                                <input type="text" class="form-control" placeholder="Hospitalizaciones" name="pat_hospital" id="pat_hospital"  value="<?php //echo $paciente['pat_hospital']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Intervenciones quirurgicas</label> 
                                                                <input type="text" class="form-control" placeholder="Intervenciones" name="pat_intervenciones" id="pat_intervenciones"  value="<?php //echo $paciente['pat_intervenciones']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label >Transfuciones</label> 
                                                                <input type="text" class="form-control" placeholder="Transfuciones" name="pat_transfuciones" id="pat_transfuciones"  value="<?php //echo $paciente['pat_transfuciones']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Problemas de coagulacion</label>
                                                            <input type="text" class="form-control" placeholder="Coagulacion" name="pat_coagulacion" id="pat_coagulacion" value="<?php //echo $paciente['pat_coagulacion']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Problemas respiratorios</label>
                                                            <input type="text" class="form-control" placeholder="Problemas respiratorios" name="pat_respiratorios" id="pat_respiratorios" value="<?php //echo $paciente['pat_respiratorios']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                               
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Traumatismos o Fx del complejo Craneofacial</label>
                                                            <input type="text" class="form-control" placeholder="Traumatismos" name="pat_traumatismos" id="pat_traumatismos" value="<?php //echo $paciente['pat_traumatismos']; ?>">                                                                                               
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Alergias</label>
                                                            <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" value="<?php //echo $paciente['alergias']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Enfermedades sistemicas (hereditarias,congenitas,infectocontagiosas,VIH etc.)</label>
                                                                <input type="text" class="form-control" placeholder="Enfermedades sistemicas" name="pat_sistemicas" id="pat_sistemicas" value="<?php //echo $paciente['pat_sistemicas']; ?>">                                                                                               
                                                            </div> 
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Consume tabaco drogas o alcohol?</label>
                                                                <input type="text" class="form-control" placeholder="Consume tabaco drogas o alcohol?" name="pat_consumos" id="pat_consumos" value="<?php //echo $paciente['pat_consumos']; ?>">                                                                                               
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
                                                                <input type="text" class="form-control" placeholder="Menarca" name="pat_menarca" id="pat_menarca" value="<?php //echo $paciente['pat_menarca']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>Edad</label>
                                                                <input type="text" class="form-control" placeholder="Edad" name="pat_edad" id="pat_edad" value="<?php //echo $paciente['pat_edad']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>FUM</label>
                                                                <input type="text" class="form-control" placeholder="FUM" name="pat_fum" id="pat_fum" value="<?php //echo $paciente['pat_fum']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>FUP</label>
                                                                <input type="text" class="form-control" placeholder="FUP" name="pat_fup" id="pat_fup" value="<?php //echo $paciente['pat_fup']; ?>">                                                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Embarazos</label>
                                                            <input type="text" class="form-control" placeholder="Embarazos" name="pat_embarazos" id="pat_embarazos" value="<?php //echo $paciente['pat_embarazos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Hijos</label>
                                                            <input type="text" class="form-control" placeholder="Hijos" name="pat_hijos" id="pat_hijos" value="<?php //echo $paciente['pat_hijos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Abortos</label>
                                                            <input type="text" class="form-control" placeholder="Abortos" name="pat_abortos" id="pat_abortos" value="<?php //echo $paciente['pat_abortos']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Esta tomando algun anticonceptivo</label>
                                                            <input type="text" class="form-control" placeholder="Anticonceptivo" name="pat_anticonceptivo" id="pat_anticonceptivo" value="<?php //echo $paciente['pat_anticonceptivo']; ?>">                                                                                               
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Embarazada actuamente? meses?</label>
                                                            <input type="text" class="form-control" placeholder="Meses de gestacion" name="pat_gestacion" id="pat_gestacion" value="<?php //echo $paciente['pat_gestacion']; ?>">                                                                                               
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
    </div>
</div>
<!-- END MAIN PANEL -->

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

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
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

        $("#main-form").submit();       
    }
    $(document).ready(function() {
    
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
