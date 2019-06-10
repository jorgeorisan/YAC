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
    $obj = new Persona();
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
                                                <input type="text" class="form-control datepicker" data-dateformat='yy-mm-dd' autocomplete="off" placeholder="Fecha nacimiento" name="fecha_nac" id="fecha_nac" onkeypress="nextFocus('fecha_nac', 'antecedentes_pat')">                                                                                               
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
                                <div class="jarviswidget" id="wid-id-antheredo" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-collapsed="true">
                                    <header><h2> Adicionales</h2></header>
                                    <div>
                                        <div class="jarviswidget-editbox"></div>
                                        <div class="widget-body">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <select class="select2" name="sexo">
                                                            <option value="">Selecciona sexo</option>
                                                            <option value="Femenino">Femenino</option>
                                                            <option value="Masculino">Masculino</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <select class="select2" name="grupo_sanguineo">
                                                            <option value="">Tipo Sangre</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Estado civil</label>
                                                <select class="select2" name="edo_civil">
                                                    <option value="">Selecciona</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Union libre">Union libre</option>
                                                    <option value="Divorciado">Divorciado</option>
                                                    <option value="Viudo">Viudo</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Escolaridad" name="escolaridad"  id="escolaridad" >                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" placeholder="Ocupacion" name="ocupacion" id="ocupacion">
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
                                                <input type="text" class="form-control" placeholder="Madre" name="ant_madre" id="ant_madre">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Padre" name="ant_padre" id="ant_padre">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Abuelos Paternos" name="ant_abuelospaternos" id="ant_abuelospaternos">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Abuelos Maternos" name="ant_abuelosmaternos" id="ant_abuelosmaternos">                                                                                               
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
                                                <input type="text" class="form-control" placeholder="Fecuencia de Baño" name="frec_banio" id="frec_banio">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Fecuencia de cambio de ropa" name="frec_ropa" id="frec_ropa">                                                                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Fecuencia de lavado de dientes" name="frec_dientes" id="frec_dientes">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Numero de Veces" name="vecese_dientes" id="vecese_dientes">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Auxiliares de limpieza" name="aux_limpieza" id="aux_limpieza">                                                                                               
                                            </div> 
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tipo de pasta dental" name="pasta_dental" id="pasta_dental">                                                                                               
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
                                                <input type="text" class="form-control" placeholder="Numero de Gestacion" name="num_gesta" id="num_gesta">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tipo de Gestacion" name="tipo_gesta" id="tipo_gesta">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tiempo de Gestacion" name="tiempo_gesta" id="tiempo_gesta">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Eutocico">Eutocico</option>
                                                            <option value="Distocico">Distocico</option>
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Motivo Cesarea" name="motivo_cesarea" id="motivo_cesarea">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Bolsa de oxigeno">Bolsa de oxigeno</option>
                                                            <option value="Ventilacion asistida con ambu">Ventilacion asistida con ambu</option>
                                                            <option value="Intubacion">Intubacion</option>
                                                            <option value="Medicamentos">Medicamentos</option>
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Tiempo y Motivo Incubadora" name="tiempo_incubadora" id="tiempo_incubadora">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Reflujo Esofagico" name="reflujo_esofagico" id="reflujo_esofagico">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tiempo" name="tiempo_seno" id="tiempo_seno">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tiempo" name="tiempo_biberon" id="tiempo_biberon">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Con que" name="tipo_endulzante" id="tipo_endulzante">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Incio" name="ablactacion_inicio" id="ablactacion_inicio">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Incio" name="alimentacion_solida_inicio" id="alimentacion_solida_inicio">                                                                                               
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
                                                <input type="text" class="form-control" placeholder="Inicio Denticion" name="inicio_denticion" id="inicio_denticion">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tipo" name="tipo_tratamiento_previo" id="inicio_tratamiento_previo">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
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
                                                        <input type="text" class="form-control" placeholder="Tipo Construccion" name="tipo_construccion" id="tipo_construccion">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Num. Habitaciones" name="num_habitaciones" id="num_habitaciones">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Num. Personas" name="num_personas" id="num_personas">                                                                                               
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
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
                                                            <option value="">Selecciona</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Tipo" name="especie_animales" id="especie_animales">                                                                                               
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
                                                        <input type="text" class="form-control" placeholder="Pulso xmin." name="pulso_signos" id="pulso_signos">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="T.A mm/Hg" name="ta_signos" id="ta_signos">                                                                                               
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="F.C. xmin." name="fc_signos" id="fc_signos">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="T. C." name="t_signos" id="t_signos">                                                                                               
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            <label >Somatometria</label>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Peso kg." name="peso_soma" id="peso_soma">                                                                                               
                                                    </div> 
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Talla m." name="talla_soma" id="talla_soma">                                                                                               
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
                                                            <option <?php // echo ($data['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_nacimiento']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_nacimiento']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_nacimientodet" value="<?php // echo $data['inm_nacimientodet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_nacimiento']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_nacimiento']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_nacimiento']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_dosmesesdet" value="<?php // echo $data['inm_dosmesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_cuatromeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_cuatromeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_cuatromeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_cuatromesesdet" value="<?php // echo $data['inm_cuatromesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_seismeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_seismeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_seismeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_seismesesdet" value="<?php // echo $data['inm_seismesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_sietemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_sietemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_sietemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_sietemesesdet" value="<?php // echo $data['inm_sietemesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_docemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_docemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_docemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_docemesesdet" value="<?php // echo $data['inm_docemesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_dieciochoemeses']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_dieciochoemeses']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_dieciochoemeses']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_dieciochoemesesdet" value="<?php // echo $data['inm_dieciochoemesesdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_cuatroanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_cuatroanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_cuatroanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_cuatroaniosdet" value="<?php // echo $data['inm_cuatroaniosdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_sieteanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_sieteanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_sieteanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_sieteaniosdet" value="<?php // echo $data['inm_sieteaniosdet'];?>">                                                                                               
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
                                                            <option <?php // echo ($data['inm_onceanios']=="")   ? "selected": '';?> value="">Selecciona</option>
                                                            <option <?php // echo ($data['inm_onceanios']=="Si") ? "selected": '';?> value="Si">Si</option>
                                                            <option <?php // echo ($data['inm_onceanios']=="No") ? "selected": '';?> value="No">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Detalles" name="inm_onceaniosdet" value="<?php // echo $data['inm_onceaniosdet'];?>">                                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset> 
                    </div>
                    <?php  } ?>
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
