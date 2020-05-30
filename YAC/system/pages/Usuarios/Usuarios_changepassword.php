<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Cambiar Password";

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
    informError(true,make_url("Usuarios","index"));

$obj = new Usuario();
$data = $obj->getTable($id);
if ( !$data ) {
    informError(true,make_url("Usuarios","index"));
}
if(isPost()){
    $obj = new Usuario();
    $id = $obj->updateAll($id,getPost());
    if ( $id ) {
        informSuccess(true, make_url("Usuarios","index"));
    }else{
        informError(true, make_url("Usuarios","edit",array('id'=>$data['id']) ) );
    }
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	 <?php $breadcrumbs["Usuarios"] = APP_URL."/Usuarios/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
            	<article class="col-sm-12 col-md-8 col-lg-6"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
						<!-- Widget ID (each widget will need unique ID)-->
						<header> <span class="widget-icon"> 
                            <i class="fa fa-edit"></i> </span><h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
							<div class="jarviswidget-editbox" style=""></div>
                                <div class="widget-body">
									<form id="main-form" class="smart-form" role="form" method=post action="<?php echo make_url("Usuarios","edit",array('id'=>$data['id']));?>" onsubmit="return checkSubmit();">
										
										<section>
											<label class="input"> <i class="icon-append fa fa-envelope"></i>
												<?php echo htmlentities($data['id_usuario']); ?>
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-list-alt"></i>
												<input type="password" id="password" name="password" placeholder="Nuevo Password" value="">
											</label>
										</section>
										
										<section>
											<label class="input"> <i class="icon-append fa fa-list-alt"></i>
												<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirmar Password" value="">
											</label>
										</section>
									
										<div class="form-actions" style="text-align: center">
	                                        <div class="row">
	                                            <div class="col-md-12">
	                                                <button class="btn btn-default btn-sm" type="button" onclick="window.history.go(-1); return false;">
	                                                    Cancelar
	                                                </button>
	                                                <button class="btn btn-primary btn-sm" type="button" onclick=" validateForm();">
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
		
		var p1 = $("#password").val();
		var p2 = $("#confirmpassword").val();
		var x = $("#password").val();
		var espacios = false;
		var cont = 0;
		if (p1.length == 0 || p2.length == 0) {  notify('warning',"Se necesita un password"); return false;  }
			//ambas contraceñas coincidan
		if ( p1 != p2 ) { notify('warning',"El password no coincide"); return false; } 
		    
	    $("#main-form").submit();		
	}
	$(document).ready(function() {
		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		 *
		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		 *
		 * // activate tooltips
		 * $("[rel=tooltip]").tooltip();
		 *
		 * // activate popovers
		 * $("[rel=popover]").popover();
		 *
		 * // activate popovers with hover states
		 * $("[rel=popover-hover]").popover({ trigger: "hover" });
		 *
		 * // activate inline charts
		 * runAllCharts();
		 *
		 * // setup widgets
		 * setup_widgets_desktop();
		 *
		 * // run form elements
		 * runAllForms();
		 *
		 ********************************
		 *
		 * pageSetUp() is needed whenever you load a page.
		 * It initializes and checks for all basic elements of the page
		 * and makes rendering easier.
		 *
		 */

		 pageSetUp();

	
		/*
		 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
		 * eg alert("my home function");
		 *
		 * var pagefunction = function() {
		 *   ...
		 * }
		 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
		 *
		 * TO LOAD A SCRIPT:
		 * var pagefunction = function (){
		 *  loadScript(".../plugin.js", run_after_loaded);
		 * }
		 *
		 * OR
		 *
		 * loadScript(".../plugin.js", run_after_loaded);
		 */
	})

</script>

<?php
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php");
?>
