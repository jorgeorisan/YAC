 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Ver clinica";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");


if(isset($request['params']['id'])   && $request['params']['id']>0)
    $id=$request['params']['id'];
else
    informError(true,make_url("Catalogos","clinica"));

$obj = new Clinica();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Catalogos","clinica"));
}

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Clinica"] = APP_URL."/Catalogos/clinica"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-12 col-md-12 col-lg-12"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-eye"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form id="main-form" class="" role="form" method=post 
                                action="<?php echo make_url("Catalogos","clinicaedit",array('id'=>$id));?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">
                                    <input type="text" class="" name="idClinica" hidden>
                                    <fieldset>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Nombre del Clinica</label>
                                                <input type="text" class="form-control" placeholder="Nombre Clinica" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>">                                                    
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Calle</label>
                                                <input type="text" class="form-control" placeholder="Calle" name="calle" value="<?php echo $data['calle']; ?>">                        
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Exterior</label>
                                                <input type="text" class="form-control" placeholder="Número exterior" name="numext" value="<?php echo $data['numext']; ?>">                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Número Interior</label>
                                                <input type="text" class="form-control" placeholder="Número interior" name="numinte" value="<?php echo $data['numinte']; ?>">                                                                       
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Colonia</label>
                                                <input type="text" class="form-control" placeholder="Colonia" name="colonia" value="<?php echo $data['colonia']; ?>">                                                           
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Ciudad</label>
                                                <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php echo $data['ciudad']; ?>"> 
                                            </div>
                                        </div>  
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado" name="estado" value="<?php echo $data['estado']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">CP</label>
                                                <input type="text" maxlength="5" class="form-control" id="cp" placeholder="CP" name="cp" value="<?php echo $data['cp']; ?>">                                                                                                                                                       
                                            </div>
                                            <div class="form-group">
                                                <label for="name">RFC</label>
                                                <input type="text" class="form-control" placeholder="RFC" name="rfc" value="<?php echo $data['rfc']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Correo</label>
                                                <input type="email" class="form-control" placeholder="example@email.com" name="correo" value="<?php echo $data['correo']; ?>">                                                                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Teléfono</label>
                                                <input type="text" class="form-control" placeholder="" name="telefono" value="<?php echo $data['telefono']; ?>">                                                                                                                     
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Logotipo</label>
                                                <input type="file" class="form-control"  id="imagen1" name="logo" onchange="vistaPrevia(this, 'logoClinicaPrev');" multiple>
                                                <fieldset id="logoClinicaPrev" class="0">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
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
    
    function validateForm()
    {
        var nombre = $("input[name=nombre]").val();
        if ( ! nombre )  return notify("info","El nombre es requerido");

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
