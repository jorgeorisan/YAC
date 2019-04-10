<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'existadmin':
			if( isset($_GET["email"]) ){
				$u = new User();
				if($u->userExists($_GET['email'])){
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
		
		default:
			# code...
			break;
	}
	
}

?>