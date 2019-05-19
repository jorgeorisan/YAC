<?php
//echo time();

include_once( CONFIG_DIR . '/classes/auth.class.php' );
session_destroy ();
session_start(); 
$shownote=0;
$showerror=0;
// LOGIN LOGIC
//print_r($_POST);//die;
#header("Location: ".make_url("Start"));
// 
#die;

if ( isset($_POST['email']) )  {
	$shownote=1;
	//echo "AAA";
	;
	$a=new Auth();
	$a->setEmail ( $_POST['email'] );
	$a->updateToken();
   // print_r($a);die;
 	if ($a->getToken() !== ""  ){
 		//print_r($a);die;
    	require_once(SYSTEM_DIR."/lib/mailfunctions.php");
			$email = $a->getEmail();
			$token = $a->getToken();	    
			$to      = $a->getEmail();
			$subject = 'YAC - Password Recovery';

			$link=make_url("Login","ChangePassword",array('token'=>$token,'email'=>$email));


			$message = file_get_contents(SYSTEM_DIR.'/lib/Templates/ResetPasswordEmail.html');
			$message = str_replace("__TOKEN__", $token, $message);
			$message = str_replace("__URL__",   $link , $message); 
			$message = str_replace("__EMAIL__",   $email , $message); 

			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=UTF-8\r\n";
			$headers .= "From: <no-reply@geohti.com>\r\n";
			$headers .= "X-Clinica: 1\r\n";	
			$headers .= 'X-Mailer: PHP/' . phpversion();
			$headers .= "Bcc: jororisan@gmail.com\r\n";	
                    
				
			//sendMail("jorge.orihuela@geohti.com", $subject, $message, $headers); 
			mail($to, $subject, $message, $headers); 
			//echo $message;
   			
	}else{ 
		// to protect against username enumeration
    	sleep(rand(1,4));
	}
} elseif ( isset($_POST['email']) ){
	$showerror=1; 
}


//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Reset Password  - Login ";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include(SYSTEM_DIR . "/inc/header.php");

?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->


<div id="main" class="main" role="main" style="background-image: #323950;">
<img style="position: fixed;width: 100%;height: 100%;" src="<?php echo ASSETS_URL; ?>/img/Fondo.png">
	<!-- MAIN CONTENT -->
	<div id="content" class="containerNOT">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>	
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"">
			<?php if ($shownote===1 ){?>
			<section><div class="alert alert-success fade in W">
											<button class="close" data-dismiss="alert">
												×
											</button>
											<i class="fa-fw fa fa-check"></i>
											<strong>Success</strong>  Check your email for instructions.
										</div></section>
			<?php
			}
			if ($showerror===1){
			?>
			<section>
				<div class="alert alert-warning fade in W">
					<button class="close" data-dismiss="alert">
						×
					</button>
					<i class="fa-fw fa fa-warning"></i>
					<strong>Error</strong> Invalid Email.
				</div>
			</section>
			<?php }?>
			<br>

				<div class="well no-padding">
					<form action="<?php echo make_url("Login","ResetPassword",array('action'=>'reset','uid'=>uniqid())) ?>" id="login-form" class="smart-form client-form" method="POST">
						<header>
							<strong>Reset Password<strong>
						</header>
						<fieldset>
							<section>
								<label class="label">E-mail</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="email">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
							</section>
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<a class="btn btn-info" href="<?php echo make_url("Login","index") ?>">Login</a>
						</footer>
					</form>
				</div>
			</div> 
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  col-xl-4""></div>	
		</div>
	</div>
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<?php 
	//include required scripts
	include(SYSTEM_DIR . "/inc/scripts.php"); 
?>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">
	runAllForms();

	$(function() {
		// Validation
		$("#login-form").validate({
			// Rules for form validation
			rules : {
				email : {
					required : true,
					email : true
				} 
			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});
</script>

<?php 
	//include footer
	include(SYSTEM_DIR . "/inc/close-html.php"); 
