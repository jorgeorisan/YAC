<?php

//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Editar usuario";

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
												<label class="input"> <i class="icon-append fa fa-user"></i>
													<input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo htmlentities($data['nombre']); ?>">
												</label>
											</section>
											
											<section>
												<label class="input"> <i class="icon-append fa fa-list-alt"></i>
													<input type="text" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo htmlentities($data['direccion']); ?>">
												</label>
											</section>
											<section>
												<label class="label">Selecciona el Perfil</label>
												<select style="width:100%" class="select2" name="id_usuario_tipo" id="id_usuario_tipo">
													<option value="">Selecciona</option>
													<?php 
													$obj = new UsuarioTipo();
													$list=$obj->getAllArr();
													if (is_array($list) || is_object($list)){
														foreach($list as $val){
																$selected = "";
															if ($data['id_usuario_tipo'] == $val['id_usuario_tipo'] )  $selected = "selected";
															
															echo "<option ".$selected ." value='".$val['id_usuario_tipo']."'>".htmlentities($val['usuario_tipo'])."</option>";
														}
													}
													 ?>
												</select>
											</section>
											<section>
												<label class="label">Selecciona el tienda</label>
												<select style="width:100%" class="select2" name="id_tienda" id="id_tienda">													
													<?php 
													$obj = new Tienda();
													$list=$obj->getAllArr();
													if (is_array($list) || is_object($list)){
														foreach($list as $val){
															$selected = "";
															if ($data['id_tienda'] == $val['id_tienda'] ) {
																$selected = "selected";
															}
															echo "<option value='".$val['id_tienda']."' $selected >".htmlentities($val['nombre'])."</option>";
														}
													}
													 ?>
												</select>
											</section>
											<section>
												<label class="label">Comision</label>
												<select style="width:100%" class="select2 " name="comision"  id="comision">
													<?php 
													$list= getComsiones();
													if (is_array($list)){
														foreach($list as $key => $val){
															$selected= ($data['comision'] == $key) ? "selected" :'';
															echo "<option value='".$key."' $selected >".htmlentities($val)."</option>";
														}
													}
													?>
												</select>
											</section>
											<section>
												<label class="label">Mostrar costos</label>
												<select style="width:100%" class="select2" name="costos" id="costos">
													<option value='0' <?php echo ($data['costos'] == 0 ) ? 'selected' : ''; ?>>No</option>
													<option value='1' <?php echo ($data['costos'] == 1 ) ? 'selected' : ''; ?>>Si</option>
														
												</select>
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
		
		var email = $("#email").val();
		if (email == ""){ notify("info","Se necesita un email"); return false; }
		
		var x = $("#nombre").val();
		if (x == ""){ notify("warning","Se necesita un nombre"); return false; }
			
		var x = $("#apellido_pat").val();
		if (x == ""){ notify("warning","Se necesita un apellido"); return false; }

		var idclinica = $("#id_tienda").val();
		if (idclinica == ""){ notify("info","Se necesita un tienda"); return false; }
	
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
