 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Editar Puesto";

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
    informError(true,make_url("Catalogos","usuariotipo"));

$obj = new UsuarioTipo();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Catalogos","usuariotipo"));
}
if(isPost()){
    $obj = new UsuarioTipo();
    $id = $obj->updateAll($id,getPost());
    if( $id  ) {
         informSuccess(true, make_url("Catalogos","usuariotipo"));
    }else{
        informError(true, make_url("Catalogos","usuariotipoedit",array('id'=>$id)),"usuariotipoedit");
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Personal Puesto"] = APP_URL."/Catalogos/usuariotipo"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                 <article class="col-sm-12 col-md-6 col-lg-6"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-edit"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form id="main-form" class="" role="form" method=post action="<?php echo make_url("Catalogos","usuariotipoedit",array('id'=>$id));?>" onsubmit="return checkSubmit();" enctype="multipart/form-data">
                                   <div class="tl-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Puesto</label>
                                                <input type="text" class="form-control" placeholder="Nombre puesto" name="usuario_tipo" value="<?php echo htmlentities($data['usuario_tipo']); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
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
                                            <div id="resultado"></div>
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
    function validateForm()
    {
        var nombre = $("input[name=usuario_tipo]").val();
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
