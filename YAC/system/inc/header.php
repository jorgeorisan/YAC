<!DOCTYPE html>
<html lang="en-us" <?php echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_html_prop), $page_html_prop)) ;?>>
	<head>
		<?php 
			$url_node = ASSETS_URL. '/node_modules/';
		?>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/> 
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> <?php echo $page_title != "" ? $page_title." - " : ""; ?>Yo Amo Comprar </title>
		<meta name="description" content="">
		<meta name="author" content="">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/fontawesome-pro/css/all.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support is under construction-->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-rtl.min.css">

		<!-- Toastr JQuery based toasts-->
		<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/css/toastr.css" />

		

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/your_style.css"> -->

		<?php

			if ($page_css) {
				foreach ($page_css as $css) {
					echo '<link rel="stylesheet" type="text/css" media="screen" href="'.ASSETS_URL.'/css/'.$css.'">';
				}
			}

		

		?>


		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<!--		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/NOTcss/demo.min.css"> -->

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>/img/favicon/corazon.ico?a" type="image/x-icon">
		<link rel="icon" href="<?php echo ASSETS_URL; ?>/img/favicon/corazon.ico?a" type="image/x-icon">

		<!-- GOOGLE FONT -->

		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad-retina.png">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

		<!-- Link to Google CDNs jQuery + jQueryUI; fall back to local -->
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- notify alert-->
		<script src="<?php echo ASSETS_URL; ?>/js/bootstrap-notify/bootstrap-notify.min.js"></script>
		<!--para lo del sweetalert eliminar y mensajitos -->
		<script src="<?php echo ASSETS_URL; ?>/sweetalert-master/lib/sweet-alert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/sweetalert-master/lib/sweet-alert.css">
		<!-- estilos globales del proyecto -->
		<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>/css/main.css">
		<!-- estilos globales del proyecto -->

		
		<script src="<?php echo $url_node; ?>jquery.tabulator/dist/js/tabulator.min.js"></script>
		
	</head>
	<body <?php echo implode(' ', array_map(function($prop, $value) {
			return $prop.'="'.$value.'"';
		}, array_keys($page_body_prop), $page_body_prop)) ;?>  class=" smart-style-7 ">
		<!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
			 You can also add different skin classes such as "smart-style-1", "smart-style-2" etc...-->
		<?php
			if (!$no_main_header) {

		?>
		<?php
			$objEntrada = new Entrada();
			$dataentradaspendientes = $objEntrada->getReporteEntradasPendientes();
			$totalentradas = ($dataentradaspendientes) ? count($dataentradaspendientes) : 0 ;
			
			$objTraspaso  = new Traspaso();   
			$datatraspasospendientes = $objTraspaso->getReporteTraspasosPendientes();
			$totaltraspasos = ($datatraspasospendientes) ? count($datatraspasospendientes) : 0 ;
			$alertashow=false;
			if( $totalentradas || $totaltraspasos ){
				$alertashow=true;
			}
		?>
		
				<!-- HEADER -->
				<header id="header" style="">
					<div id="logo-group">
						<input type="text" id="base" value="<?php echo APP_URL; ?>" hidden>
						<!-- PLACE YOUR LOGO HERE -->
						<span id="logo" style="margin-top: 5px;"> 
							<img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="Yo Amo Comprar" style="width:150px "> 
						</span>
					</div>
					
					<!-- projects dropdown -->
					<div class="project-context hidden-xs">
						<div class="col-sm-5  col-xs-5">
							<div class="" style="padding: 7px; font-size: 8px;">
								<?php echo $_SESSION['user_info']['tienda']."-".$_SESSION['user_info']['usuario_tipo']; ?>
							</div>
						</div>
						<span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">
							<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
								<span class="label" style="color: #3276b1;">Alertas <?php if($alertashow){?> <span style="color:red"><i class="glyphicon glyphicon-info-sign fa-2x"></i></span> <?php } ?></span>
							</a>
						</span>


						<!-- Suggestion: populate this list with fetch and push technique -->
						<ul class="dropdown-menu">

							<li class="divider"></li>
							<!--<li>
								<a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
							</li>-->
						</ul>
						<!-- end dropdown-menu-->

					</div>
					<!-- end projects dropdown -->

					<!-- pulled right: nav area -->
					<div class="pull-right">
						
						<!-- logout button -->
						<div id="logout" class="btn-header transparent pull-right">
							<span> <a href="<?php echo make_url("Login") ?>" title="Sign Out" data-action="userLogout" data-logout-msg="Estas seguro que deseas salir?"><i class="fa fa-sign-out"></i></a> </span>
						</div>
						
						<div id="change-password" class="btn-header pull-right">
							<span> <a class=""  title="Cambiar de Sucursal"  href="<?php echo make_url("Usuarios","changestore",array('id'=>$_SESSION['user_id'])); ?>"><i class="fa fa-random"></i></a> </span>
						</div>
						<!-- collapse menu button -->
						<div id="hide-menu" class="btn-header pull-right">
							<span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
						</div>
						<!-- end collapse menu -->

						<!-- #MOBILE -->
						<!-- Top menu profile link : this shows only when top menu is active -->
						<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
							<li class="">
								<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
									<img src="<?php echo ASSETS_URL; ?>/img/avatars/sunny.png" alt="John Doe" class="online" />
								</a>
								<ul class="dropdown-menu pull-right">
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="profile.php" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="login.php" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
									</li>
								</ul>
							</li>
						</ul>

					
						<!-- end logout button -->
						<?php  if (FALSE){?>
						<!-- search mobile button (this is hidden till mobile view port) -->
						<div id="search-mobile" class="btn-header transparent pull-right">
							<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
						</div>
						<!-- end search mobile button -->

						<!-- input: search field -->
						
						<form action="<?php echo APP_URL; ?>/search.php" class="header-search pull-right">
							<input type="text" name="param" placeholder="Find reports and more" id="search-fld">
							<button type="submit">
								<i class="fa fa-search"></i>
							</button>
							<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
						</form>
						<?php } ?>
						<!-- end input: search field -->

						<!-- fullscreen button -->
						<div id="fullscreen" class="btn-header transparent pull-right">
							<span> <a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i></a> </span>
						</div>
						<!-- end fullscreen button -->

						<!-- #Voice Command: Start Speech -->
						<div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs hidden">
							<div>
								<a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a>
								<div class="popover bottom"><div class="arrow"></div>
									<div class="popover-content">
										<h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
										<h4 class="vc-title-error text-center">
											<i class="fa fa-microphone-slash"></i> Voice command failed
											<br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
											<br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
										</h4>
										<a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a>
										<a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a>
									</div>
								</div>
							</div>
						</div>
						<!-- end voice command -->

						<!-- multiple lang dropdown : find all flags in the flags page -->

						<ul class="header-dropdown-list hidden-xs hidden">
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-us" alt="United States"> <span> English (US) </span> <i class="fa fa-angle-down"></i> </a>
								<ul class="dropdown-menu pull-right">
									<li class="active">
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-us" alt="United States"> English (US)</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-fr" alt="France"> Français</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-es" alt="Spanish"> Español</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-de" alt="German"> Deutsch</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-jp" alt="Japan"> 日本語</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-cn" alt="China"> 中文</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-it" alt="Italy"> Italiano</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-pt" alt="Portugal"> Portugal</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-ru" alt="Russia"> Русский язык</a>
									</li>
									<li>
										<a href="javascript:void(0);"><img src="<?php echo ASSETS_URL; ?>/img/blank.gif" class="flag flag-kr" alt="Korea"> 한국어</a>
									</li>
								</ul>
							</li>
						</ul>

						<!-- end multiple lang -->

					</div>
					<!-- end pulled right: nav area -->

				</header>
				<!-- END HEADER -->

				<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
				Note: These tiles are completely responsive,
				you can add as many as you like
				-->
				
				<div id="shortcut">
					<ul>
					
						<li>
							<a href="<?php echo APP_URL; ?>/Entradas/index" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-person-dolly fa-4x"></i> <span>Entradas por Validar <span class="label pull-right bg-color-darken"><?php echo $totalentradas ?></span></span> </span> </a>
						</li>
						<li>
							<a href="<?php echo APP_URL; ?>/Traspasos/index" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-exchange-alt fa-4x"></i> <span>Traspasos por Validar<span class="label pull-right bg-color-darken"><?php echo $totaltraspasos ?></span> </span> </span> </a>
						</li>
						<li>
							<a href="<?php echo APP_URL; ?>/profile.php" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
						</li>
					</ul>
				</div>

				<!-- END SHORTCUT AREA -->

		<?php
			}
		?>