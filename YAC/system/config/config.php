<?php
if (!isset ($_SESSION) ){ 
	ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
	session_start(); 
}
date_default_timezone_set('America/Mexico_City');
//date_default_timezone_get() . ' => ' . date('e') . ' => ' . date('T');

//configure constants
$directory = realpath(dirname(__FILE__));
$document_root = realpath($_SERVER['DOCUMENT_ROOT']);
$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'];
$app_path=str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));

if(strpos($directory, $document_root)===0) {
    $base_url .= str_replace(DIRECTORY_SEPARATOR, '/', substr($directory, strlen($document_root)));
}
if(isset($_SERVER["SERVER_NAME"])){
	if($_SERVER["SERVER_NAME"]=='138.128.161.42'){
		//$base_url =$base_url."/YAC/" ;
		$base_url =$base_url."/~sistemamyg" ;
 	}
}



defined("APP_URL") 			? null : define("APP_URL", str_replace("/system/config", "", $base_url));
defined("APP_PATH") 		? null : define("APP_PATH", str_replace("/system/config", "", $app_path));
defined("SITE_HOST") 		? null : define("SITE_HOST", ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST']);
defined("ROOT_DIR") 		? null : define("ROOT_DIR", str_replace(DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.'config', "", $directory));
defined("SYSTEM_DIR")       ? null : define("SYSTEM_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "system");
defined("CONFIG_DIR")       ? null : define("CONFIG_DIR", ROOT_DIR . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "config");
//Assets URL, location of your css, img, js, etc. files
defined("ASSETS_URL")       ? null : define("ASSETS_URL", APP_URL );
defined("PRODUCTOS")        ? null : define("PRODUCTOS", ROOT_DIR . DIRECTORY_SEPARATOR . "productosimages");
defined("LOGOS")         	? null : define("LOGOS", ROOT_DIR . DIRECTORY_SEPARATOR . "img");
#echo "<pre>";
#print_r(array(APP_URL,APP_PATH,ROOT_DIR,ASSETS_URL));
#echo "</pre>";#die;

/*  example
APP_URL http://192.168.56.101/blogs
APP_PATH /blogs
SITE_HOST http://192.168.56.101
ROOT_DIR /var/www/html/blogs
SYSTEM_DIR /var/www/html/blogs/system
ASSETS_URL http://192.168.56.101/blogs/assets
*/

 
if (getenv('MYSQL_SOCKET') != null){

	/* Database Production
	MYSQL_DSN: 'mysql:unix_socket=/cloudsql/ill-blogs:us-central1:ill-blogs-20170309 ;dbname=illblogs'
	  MYSQL_SOCKET: '/cloudsql/ill-blogs:us-central1:ill-blogs-20170309'
	  MYSQL_DBNAME:  'illblogs'
	  MYSQL_USER: 'blogs-sql-user'
	  MYSQL_PASSWORD: ''
	*/
	define("ON_GOOGLE", TRUE);
	define("DB_HOST", null);
	define("DB_USER", getenv('MYSQL_USER'));
	define("DB_PASSWORD", getenv('MYSQL_PASSWORD'));
	define("DB_NAME", getenv('MYSQL_DBNAME'));
	define("DB_PORT", null);
	define("DB_SOCKET", getenv('MYSQL_SOCKET'));

}else{

	define("ON_GOOGLE", FALSE);
	/* Database local*/
	defined("DB_HOST") ? null : define("DB_HOST", "127.0.0.1");
	
	if(isset($_SERVER["SERVER_NAME"])){
       // echo "<strong>$url_actual</strong>";
	    if($_SERVER["SERVER_NAME"]!='localhost'){
			
			if($_SERVER["SERVER_NAME"]=='138.128.161.42'){
				
			}else{
				defined("DB_USER") 		? null : define("DB_USER", "xqwmrfeeug");
				defined("DB_PASSWORD") 	? null : define("DB_PASSWORD", "KjnmXJfbz3");
				defined("DB_NAME") 		? null : define("DB_NAME", "xqwmrfeeug");
			}
	    }else{
	    	defined("DB_USER") 		? null : define("DB_USER", "xqwmrfeeug");
			defined("DB_PASSWORD") 	? null : define("DB_PASSWORD", "KjnmXJfbz3");
			defined("DB_NAME") 		? null : define("DB_NAME", "xqwmrfeeug");
	    }
	}
	defined("DB_PORT") ? null : define("DB_PORT", null);
	defined("DB_SOCKET") ? null : define("DB_SOCKET", null);
}

/*  Get parameterencryption */
defined("GET_ENC_PASS") ? null : define("GET_ENC_PASS", "TfdA93p7o0dj2q3MLGUp10TwfdAPa27o0djpUpq3MLGW");
defined("GET_ENC_IV") ? null : define("GET_ENC_IV","PqBfIw05RtjdL093");
defined("GET_SALT") ? null : define("GET_SALT","5rr78oH9wLPfIe03Pjp3pdMfKd75JAru");




//include_once("auth.php");
//include_once( 'classes/db.class.php' );
//include_once( 'classes/user.class.php' );
// open conection
// $db = new db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT,DB_SOCKET);
/*
function start_connection($serverDB=DB_HOST,$userDB=DB_USER,$passDB=DB_PASSWORD,$nameDB=DB_NAME,$portDB=DB_PORT,$socketDB=DB_SOCKET)
{
  //echo 'Connecting: '.$serverDB.' '.$userDB. ' '.$passDB.' '.$nameDB.'<br>';
//  $con = mysqli_connect($serverDB,$userDB, $passDB,$nameDB,$portDB,$socketDB);//
  $con = mysqli_connect(null,$userDB, $passDB,$nameDB,$portDB,$socketDB);
  return $con;
}
*/


require_once("func.global.php");
spl_autoload_register(function ($class_name) {
    include_once CONFIG_DIR.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR. strtolower($class_name ). '.class.php';
});
//include_once( 'classes/db.class.php' );//
//include_once( 'classes/auth.class.php' );
//include_once( 'classes/user.class.php' );
// open conection
if(isset($_SERVER["SERVER_NAME"])){
 	$db = new db(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME,DB_PORT,DB_SOCKET);
 }else{
	$db = new db('127.0.0.1', 'root', '', "xqwmrfeeug",null,null); // para  YAC\system\bin> php .\createTableModel.php  venta Venta
   
}
$db->set_charset('utf8');
     
//echo var_dump($db);
