<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'gettratamiento':
				if( isset($_GET["title"]) ){
					ob_start();
					include(SYSTEM_DIR.'/pages/Historial/Historial_gettratamiento.php' );
					
					
					$html = ob_get_contents();
					ob_end_clean();

					if( $html ){
							echo $data=$html;
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