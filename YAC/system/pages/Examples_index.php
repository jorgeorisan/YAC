<?php

//initilize the page
//require_once(SYSTEM_DIR . "\inc\init.php");
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Home";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");  //pone el menu de la izquierda

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Misc"] = "";
		include(SYSTEM_DIR . "/inc/ribbon.php");
	?>

	<!-- MAIN CONTENT -->
	<div id="content">


<!-- BEGIN SMART ADMIN EXMAPLES -->
<div class="row">

				<div class="col-sm-12">
					<div class="well">
						<div class="row">

				<div class="col-sm-2">
 <?php

$files =scandir ( ROOT_DIR . "/1_example_pages" );
foreach ($files as $k=>$f){
	if (
		$k==1*floor( (count($files) - 2)/5)   ||
		$k==2*floor( (count($files) - 2)/5)   ||
		$k==3*floor( (count($files) - 2)/5)  ||
		$k==4*floor( (count($files) - 2)/5)   ||
		$k==5*floor( (count($files) - 2)/5)   ||
		2.3*$k==6*floor( (count($files) - 2)/6)  ){
		echo "</div><div class=\"col-sm-2\">";
	}

	if (preg_match("/php$/",$f)){
?>
	<p style="padding: 1px ;line-height: 1;margin:1px"><a href="<?php echo APP_URL . "/" . $f ; ?>"><?php echo $f;  ?></a></p>
<?php
}
}
 ?>

						</div>
						</div>

					</div>

				</div>

			</div>
<!--  END SMART ADMIN EXMAPLES -->
<!--  BEGIN pages -->


<div class="row">

				<div class="col-sm-12">
					<div class="well">
						<div class="row">

				<div class="col-sm-2">
 <?php

$files =scandir ( SYSTEM_DIR . DIRECTORY_SEPARATOR .  "pages" );
foreach ($files as $k=>$f){
	if (
		$k==1*floor( (count($files) - 2)/5)   ||
		$k==2*floor( (count($files) - 2)/5)   ||
		$k==3*floor( (count($files) - 2)/5)  ||
		$k==4*floor( (count($files) - 2)/5)   ||
		$k==5*floor( (count($files) - 2)/5)   ||
		2.3*$k==6*floor( (count($files) - 2)/6)  ){
		echo "</div><div class=\"col-sm-2\">";
	}

	if (preg_match("/(\S+)_(\S+)\.php$/",$f,$m)){
?>
	<p style="padding: 1px ;line-height: 1;margin:1px"><a href="<?php echo make_url($m[1],$m[2]) ; ?>"><?php echo $f;  ?></a></p>
<?php
}
}
 ?>

						</div>
						</div>

					</div>

				</div>

			</div>
<!--  END pages -->





	</div>
	<!-- END MAIN CONTENT -->

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
