<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Entrada";

/* ---------------- END PHP Custom Scripts ------------- */


//include left panel (navigation)
if(isset($request['params']['id'])   && $request['params']['id']>0){
    $id=$request['params']['id'];
    $page=$request['params']['page'];
}else{
    informError(true,make_url("Entradas","index"));
}

  
if(!$page) informError(true,make_url("Entradas","index"));

if ($page) {
    include SYSTEM_DIR . "/lib/Templates/print_".$page.".php";
}
?>