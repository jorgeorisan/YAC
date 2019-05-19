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
        informSuccess(true, make_url("Clientes","view",array('id'=>$id)));
    }else{
        informError(true,make_url("Clientes","index"));
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Cliente"] = APP_URL."/Cliente/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-9 col-md-9 col-lg-9"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
								<form id="main-form" class="" role="form" method=post action="<?php echo make_url("Clientes","add");?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">     
                                    <fieldset>    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nombre *</label>
                                                <input type="text" class="form-control" placeholder="Nombre" required name="nombre" id="nombre" onkeypress="nextFocus('nombre', 'ap_paterno')" value="<?php //echo $data['nombre']; ?>" > 
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="email" id="email" onkeypress="nextFocus('email', 'telefono')" value="<?php //echo $data['email']; ?>">                                                          
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle"  id="calle" onkeypress="nextFocus('calle', 'num_ext')" value="<?php //echo $data['calle']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" id="colonia" onkeypress="nextFocus('colonia', 'ciudad')" value="<?php //echo $data['colonia']; ?>">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Paterno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Paterno" name="ap_paterno" id="ap_paterno" onkeypress="nextFocus('ap_paterno', 'ap_materno')" value="<?php //echo $data['ap_paterno']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono *</label>
                                                <input type="text" class="form-control" required placeholder="Teléfono" name="telefono" id="telefono" onkeypress="nextFocus('telefono', 'estado')" value="<?php //echo $data['telefono']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Exterior</label>
                                                <input type="text" class="form-control" placeholder="Número Exterior" name="num_exterior" id="num_exterior" onkeypress="nextFocus('num_exterior', 'num_interior')" value="<?php //echo $data['num_exterior']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" id="ciudad" onkeypress="nextFocus('ciudad', 'codigo_postal')"  value="<?php //echo $data['ciudad']; ?>">                                                                                               
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="name">Apellido Materno</label>
                                                <input type="text" class="form-control" placeholder="Apellido Materno" name="ap_materno" id="ap_materno" onkeypress="nextFocus('ap_materno', 'email')"  value="<?php //echo $data['ap_materno']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado" name="estado" id="estado"  onkeypress="nextFocus('estado', 'calle')"  value="<?php //echo $data['estado']; ?>" >                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Interior</label>
                                                <input type="text" class="form-control" placeholder="Número Interior" name="num_interior" id="num_interior" onkeypress="nextFocus('num_interior', 'colonia')"   value="<?php //echo $data['num_interior']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">CP</label>
                                                <input type="text" class="form-control" placeholder="codigo postal" name="codigo_postal" id="codigo_postal" onkeypress="nextFocus('codigo_postal', 'alergias')" value="<?php //echo $data['codigo_postal']; ?>" >                                                                                               
                                            </div>
                                        
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Alergias</label>
                                                <input type="text" class="form-control" placeholder="Alergias" name="alergias" id="alergias" onkeypress="nextFocus('alergias', 'savenewclient')" value="<?php //echo $data['alergias']; ?>">                                                                                               
                                            </div>
                                        </div>
                                    </fieldset>  
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
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
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
