<?php
$errormessage="";

if ( isset($request['params']['email'])  && isset($_POST['password']) && isset($_POST['passwordConfirm']) &&  isset($request['params']['token']) ){
//  $errormessage.=" a ";
	if ($_POST['password']!==$_POST['passwordConfirm']){$errormessage="<p>Passwords do not match</p>";}
	if (!formatValidatePassword($_POST['password'])){$errormessage="<p>Password must be atleast 8 characters and contain no spaces.</p>";}
	if ($errormessage==""){
		$errormessage.=" b ";
        $a = new Auth();
        if ($a->resetPassword($request['params']['email'],$request['params']['token'],$_POST['password'])){
        	redirect(make_url("Login","index",array('message'=>'Your password has been changed. Please login.')));
        	die;
		}else{
			$errormessage="<p>Invalid email - token pair.</p>";
		}
	}
}

if ($errormessage!=""  ){
$errormessage='<section><div class="alert alert-warning fade in W">
								<button class="close" data-dismiss="alert">
									×
								</button>
								<i class="fa-fw fa fa-warning"></i>
								<strong>Error</strong> '.$errormessage.' 
							</div></section>';

}



// 
 
/*
function login_auth($em,$p){
	$con=start_connection();
	$sql="SELECT id,email,first_name,last_name,initials FROM users WHERE deleted=0 AND enabled=1 AND email = '".mysqli_real_escape_string($con,$em)."' AND password = '".password_hash($p, PASSWORD_DEFAULT)."'";
	$res=call_SP($con,$sql);
	#print_r($res);die;
	$data=getRow($con,$res); 
	 $id=1;
	 $_SESSION['user_id']=$id;
	 $_SESSION['user_info']=array('id'=>$data[0],'email'=>$data[1],'first_name'=>$data[2],'last_name'=>$data[3],'initials'=>$data[4]);
	 close_connection($con);
	return $id;

}
*/
 



require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Password Recovery";

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
<header id="header">
	<!--<span id="logo"></span>-->
 

	

</header>

<div id="main" role="main">

	<!-- MAIN CONTENT -->
	<div id="content" class="containerNOT">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>	
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"">
			   <?php echo $errormessage; ?>
				<div class="well no-padding">
					<form action="<?php echo make_url("Login","ChangePassword",$request['params']) ?>" id="login-form" class="smart-form client-form" method="POST">
						<header>
							Change Password
						</header>

						<fieldset>
							
							<section>
								<label class="label">E-mail</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="email" name="emaildisabled" disabled="disabled" value="<?=htmlentities($request['params']['email'])?>">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
							</section>

							<section>
								<label class="label">Token</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="input" name="tokendisabled" disabled="disabled"  value="<?=htmlentities($request['params']['token'])?>">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your token</b> </label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password" id="password" >
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note"> 
								</div>
							</section>

							<section>
								<label class="label">Confirm Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="passwordConfirm" id="passwordConfirm" >
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
								<div class="note"> 
								</div>
							</section>
 
						</fieldset>
						<footer>
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
						</footer>
						<input type="hidden" name="email"  value="<?=htmlentities($request['params']['email'])?>">
						<input type="hidden" name="token"   value="<?=htmlentities($request['params']['token'])?>">
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
				},
				token : {
					required : true,
					minlength : 3,
					maxlength : 20
				},

				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
				passwordConfirm : {
					required : true,
					minlength : 3,
					maxlength : 20,
					equalTo : '#password'
				}

			},

			// Messages for form validation
			messages : {
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				token : {
					required : 'Please enter token'
				}
				password : {
					required : 'Please enter a password'
				},
				passwordConfirm : {
					required : 'Please confirm password'
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
?>

