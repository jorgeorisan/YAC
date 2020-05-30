		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php echo ASSETS_URL; ?>/js/plugin/pace/pace.min.js"></script>

		<!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script> -->

		<!-- IMPORTANT: APP CONFIG -->
		<script src="<?php echo ASSETS_URL; ?>/js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo ASSETS_URL; ?>/js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo ASSETS_URL; ?>/js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo ASSETS_URL; ?>/js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="<?php echo ASSETS_URL; ?>/js/plugin/fastclick/fastclick.min.js"></script>

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- Demo purpose only -->
<!--		<script src="<?php echo ASSETS_URL; ?>/js/NOTdemo.min.js"></script> -->

		<!-- MAIN APP JS FILE -->
		<script src="<?php echo ASSETS_URL; ?>/js/app.min.js"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
<!--		<script src="<?php echo ASSETS_URL; ?>/js/speech/NOTvoicecommand.min.js"></script>	-->

		<!-- SmartChat UI : plugin -->
<!--		<script src="<?php echo ASSETS_URL; ?>/js/smart-chat-ui/NOTsmart.chat.ui.min.js"></script> -->
<!--		<script src="<?php echo ASSETS_URL; ?>/js/smart-chat-ui/NOTsmart.chat.manager.min.js"></script> -->

		<!-- Toastr: JQuery based toasts -->
		<script src="<?php echo ASSETS_URL; ?>/js/toastr/toastr.js"></script>

		<!-- DATETIMEPICKER-->

		<script src="<?php echo ASSETS_URL; ?>/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
		<script src="<?php echo ASSETS_URL; ?>/js/bootstrap-datetimepicker/locales/bootstrap-datetimepicker.fr.js"></script>
		<!--END DATETIMEPICKER-->
		<script type="text/javascript">
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			function redirectAfterToast(url)
			{
				window.setTimeout(function(){

			 // Move to a new location or you can do something else
			 	window.location.replace(url);

			}, 1500);
			}
			function showWarning(message)
			{
				toastr.options.positionClass="toast-top-left";
		 		toastr.options.closeDuration = 1500;
		 		toastr.options.debug = false,
		 		toastr.options.newestOnTop = false,
		 		toastr.options.progressBar = false,
		 		toastr.options.positionClass = "toast-top-center",
		 		toastr.options.preventDuplicates = false,
		 		toastr.options.onclick = null,
		 		toastr.options.showDuration=300,
		 		toastr.options.hideDuration=1000,
		 		toastr.options.timeOut = 5000,
		 		toastr.options.extendedTimeOut = 1000,
		 		toastr.options.showEasing = "swing",
		 		toastr.options.hideEasing = "linear",
		 		toastr.options.showMethod = "fadeIn",
		 		toastr.options.hideMethod = "fadeOut"

				toastr.warning(message);
			}
			function showSuccess(message)
			{
				toastr.options.positionClass="toast-top-left";
		 		toastr.options.closeDuration = 1500;
		 		toastr.options.debug = false,
		 		toastr.options.newestOnTop = false,
		 		toastr.options.progressBar = false,
		 		toastr.options.positionClass = "toast-top-center",
		 		toastr.options.preventDuplicates = false,
		 		toastr.options.onclick = null,
		 		toastr.options.showDuration=300,
		 		toastr.options.hideDuration=1000,
		 		toastr.options.timeOut = 5000,
		 		toastr.options.extendedTimeOut = 1000,
		 		toastr.options.showEasing = "swing",
		 		toastr.options.hideEasing = "linear",
		 		toastr.options.showMethod = "fadeIn",
		 		toastr.options.hideMethod = "fadeOut"

				toastr.success(message);
			}
			function showError(message)
			{
				toastr.options.positionClass="toast-top-left";
		 		toastr.options.closeDuration = 1500;
		 		toastr.options.debug = false,
		 		toastr.options.newestOnTop = false,
		 		toastr.options.progressBar = false,
		 		toastr.options.positionClass = "toast-top-center",
		 		toastr.options.preventDuplicates = false,
		 		toastr.options.onclick = null,
		 		toastr.options.showDuration=300,
		 		toastr.options.hideDuration=1000,
		 		toastr.options.timeOut = 5000,
		 		toastr.options.extendedTimeOut = 1000,
		 		toastr.options.showEasing = "swing",
		 		toastr.options.hideEasing = "linear",
		 		toastr.options.showMethod = "fadeIn",
		 		toastr.options.hideMethod = "fadeOut"

				toastr.error(message);
			}
			/*/ Config */
			var config = {
				base: $('#base').val()
			};

			function redirectAfterToast(url)
			{
				window.setTimeout(function(){
			 // Move to a new location or you can do something else
			 	window.location.replace(url);
			}, 1500);
			}

			function notify( type = "success", msg = "", options = {} )
			{
				if(type=="error"){ type='danger'; }
				$.notifyDefaults({
					type: type,
					animate: {
						enter: 'animated flipInY',
						exit: 'animated flipOutX'
					}
				});
				setTimeout(function() {
					$.notifyClose();
				}, 3000);
				if ( type == "success" ) {
					var notify=$.notify({
						title: ( options.title != undefined ? options.title : '<strong>Exito!</strong>'),
						message: msg
					});
				} else if ( type == "danger" ) {
					var notify=$.notify({
						title: ( options.title != undefined ? options.title : '<strong>Error!: A ocurrido un error en el proceso. </strong>'),
						message: msg
					});
					setTimeout(function() {
						$.notifyClose();
					}, 5000);
				} else if ( type == "info" ) {
					var notify=$.notify({
						title: ( options.title != undefined ? options.title : '<strong>Info:</strong>'),
						message: msg
					});
				} else if ( type == "warning" ) {
					var notify=$.notify({
						title: ( options.title != undefined ? options.title : '<strong>Advertencia:</strong>'),
						message: msg
					});
					setTimeout(function() {
						$.notifyClose();
					}, 5000);
				} else {
					var notify=$.notify({
						id: null, 
						class: '',
						title: '',
						titleColor: '',
						titleSize: '',
						titleLineHeight: '',
						message: msg,
						messageColor: '',
						messageSize: '',
						messageLineHeight: '',
						backgroundColor: '',
						theme: 'light', // dark
						color: '', // blue, red, green, yellow
						icon: '',
						iconText: '',
						iconColor: '',
						image: '',
						imageWidth: 50,
						maxWidth: null,
						zindex: null,
						layout: 1,
						balloon: false,
						close: true,
						closeOnEscape: false,
						closeOnClick: false,
						rtl: false,
						position: 'bottomRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
						target: '',
						targetFirst: true,
						toastOnce: false,
						timeout: 5000,
						animateInside: true,
						drag: true,
						pauseOnHover: true,
						resetOnHover: false,
						progressBar: true,
						progressBarColor: '',
						progressBarEasing: 'linear',
						overlay: false,
						overlayClose: false,
						overlayColor: 'rgba(0, 0, 0, 0.6)',
						transitionIn: 'fadeInUp',
						transitionOut: 'fadeOut',
						transitionInMobile: 'fadeInUp',
						transitionOutMobile: 'fadeOutDown',
						buttons: {},
						inputs: {},
						onOpening: function () {},
						onOpened: function () {},
						onClosing: function () {},
						onClosed: function () {}
					});			
				}
			}
			function borrar(url){ 
				swal({
                    title: "Estas seguro?",
				 	text: "Deseas eliminar este registro?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Si, Eliminar!',
                    closeOnConfirm: true
	                },
	                function(){
	                    swal("Eliminado!", "Eliminado con exito!", "Exito");
	                    location.href=url;
	                }
            	);
			}
			var statSend = false;
	        function checkSubmit() {
	            if (!statSend) {
	                statSend = true;
	                return true;
	            } else {
	                alert("Form sending...");
	                return false;
	            }
	        }
			function validateEmailStructure( email ) {
					expr = /^([a-zA-Z0-9_\.\-+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if ( ! expr.test(email) ) {
						return;
					}
					return true;
			}

			$(document).ready(function() {
				pageSetUp();
			});

			var notifysessiontype=<?php echo (isset($_GET["m"])) ? $_GET["m"]: 0 ;?>;
			if(notifysessiontype==1){
				notify('success',"El registro se ha guardado correctamente");
			 	var url = window.location.href;
    			var res = url.split("&");
    			history.pushState(null, "", res[0]);
    			var res = url.split("?");
			 	history.pushState(null, "", res[0]);
			}
			if(notifysessiontype==2){
				notify('error');
			 	var url = window.location.href;
    			var res = url.split("&");
    			history.pushState(null, "", res[0]);
    			var res = url.split("?");
			 	history.pushState(null, "", res[0]);
			}
			if(notifysessiontype==3){
				notify('error','No tienes permiso para acceder a esta seccion');
			 	var url = window.location.href;
    			var res = url.split("&");
    			history.pushState(null, "", res[0]);
    			var res = url.split("?");
			 	history.pushState(null, "", res[0]);
			}
		</script>

