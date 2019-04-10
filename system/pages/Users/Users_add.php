<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add user";

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
if(isPost()){
	if(isPost()){
	    $obj = new User();
	    if(!$obj->userExists($_POST['email']))
		{
		    $id=$obj->addAll(getPost());
		    if($id>0){
		        informSuccess(true,  make_url("Permisos","asignar",array('id'=>$id) ));
		    }else{
		        informError(true,make_url("Users","index"));
		    }
		}else{
			informError(true,make_url("Users","index"));
		}
	}
}
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	 <?php $breadcrumbs["Users"] = APP_URL."/Users/index"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
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
                            <i class="fa fa-plus"></i> </span><h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
							<div class="jarviswidget-editbox" style=""></div>
                                <div class="widget-body">
									<form id="main-form" class="smart-form" role="form" method=post action="<?php echo make_url("Users","add");?>" onsubmit="return checkSubmit();">
										<section>
											<label class="input"> <i class="icon-append fa fa-envelope"></i>
												<input type="email" id="email" name="email" placeholder="Email">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-asterisk"></i>
												<input type="password" id="password" autocomplete='off' name="password" placeholder="Password">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-undo"></i>
												<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirmar Password">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="nombre" name="nombre" placeholder="Nombre">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="apellido_pat" name="apellido_pat" placeholder="Apellido Paterno">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" id="apellido_mat" name="apellido_mat" placeholder="Apellido Materno">
											</label>
										</section>
										<section>
											<label class="input"> <i class="icon-append fa fa-list-alt"></i>
												<input type="text" id="direccion" name="direccion" placeholder="Direccion">
											</label>
										</section>
										<section>
											<label class="label">Selecciona el perfil</label>
											<select style="width:100%" class="select2" name="id_usertype" id="id_usertype">
												<option value="">Selecciona</option>
												<?php 
												$obj = new UserType();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
														echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
													}
												}
												 ?>
											</select>
										</section>
										<section>
											<label class="label">Selecciona la  clinica</label>
											<select style="width:100%" class="select2" name="id_clinica" id="id_clinica">
												<?php 
												$obj = new Clinica();
												$list=$obj->getAllArr();
												if (is_array($list) || is_object($list)){
													foreach($list as $val){
														echo "<option value='".$val['id']."'>".$val['nombre']."</option>";
													}
												}
												 ?>
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
	function existadmin(email, callback){
        if ( ! email ) return;
        if ( ! validateEmailStructure( email ) )
            return notify('warning', 'Email no es valido.');

        $.get(config.base+"/Users/ajax/?action=get&object=existadmin&email=" + email, null, function (response) {
        		if ( response == 1){
					$("#email").val('');
					notify('warning', 'Este email ya existe favor de intentar con otro');
					return false;
				}else{
					if(callback){
						try { callback(); }
						catch(err) {
                        	console.log(err.message);
                    	}
					}
				}     
        });
	}
	function validateForm()	{
		var email 		= $("#email").val();
		var id_usertype = $("#id_usertype").val();
		if (email == "")	   return notify("info","Se necesita un email"); 
		if (id_usertype == "") return notify("info","Se necesita un Perfil"); 
			existadmin(email,function(){
				var p1 = $("#password").val();
			    var p2 = $("#confirmpassword").val();
				var x = $("#password").val();
				var espacios = false;
				var cont = 0;
				if (p1.length == 0 || p2.length == 0) {  notify('warning',"Se necesita un password"); return false;  }
			        //ambas contraceñas coincidan
			    if ( p1 != p2 ) { notify('warning',"El password no coincide"); return false; } 
		    
				var x = $("#nombre").val();
				if (x == ""){ notify("warning","Se necesita un nombre"); return false; }
					
				var x = $("#apellido_pat").val();
				if (x == ""){ notify("warning","Se necesita un apellido"); return false; }
			
			    $("#main-form").submit();		
			});
		
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
