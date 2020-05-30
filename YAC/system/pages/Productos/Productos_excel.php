<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Productos";

/* ---------------- END PHP Custom Scripts ------------- */

$page='';
//include left panel (navigation)
if(isset($request['params']['jsondata'])){
	$dataJson=json_decode($request['params']['jsondata']);
	$page = $dataJson->page;
}else{
    informError(true,make_url("Productos","index"));
}
  
if(!$page) informError(true,make_url("Productos","index"));

if ($page) {
    include SYSTEM_DIR . "/lib/Templates/excel_".$page.".php";
}
?>