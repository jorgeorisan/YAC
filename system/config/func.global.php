<?php
// include autoloader
if(isset($_SESSION['user_id'])){
  $base = explode('system', $directory);
  require './vendor/autoload.php';
}
/**
 * set document type
 * @param string $type type of document
 */

function isauth(){
    if ($_SESSION['user_id']>0){
        return true;
    }else{
        return false;
    }
}
function set_content_type($type = 'application/json') {
    header('Content-Type: '.$type);
}

/**
 * Read CSV from URL or File
 * @param  string $filename  Filename
 * @param  string $delimiter Delimiter
 * @return array            [description]
 */
function read_csv($filename, $delimiter = ",") {
    $file_data = array();
    $handle = @fopen($filename, "r") or false;
    if ($handle !== FALSE) {
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $file_data[] = $data;
        }
        fclose($handle);
    }
    return $file_data;
}

/**
 * Print Log to the page
 * @param  mixed  $var    Mixed Input
 * @param  boolean $pre    Append <pre> tag
 * @param  boolean $return Return Output
 * @return string/void     Dependent on the $return input
 */
function plog($var, $pre=true, $return=false) {
    $info = print_r($var, true);
    $result = $pre ? "<pre>$info</pre>" : $info;
    if ($return) return $result;
    else echo $result;
}

/**
 * Log to file
 * @param  string $log Log
 * @return void
 */
function elog($log, $fn = "debug.log") {
 //   $fp = fopen($fn, "a");
  //  fputs($fp, "[".date("d-m-Y h:i:s")."][Log] $log\r\n");
   // fclose($fp); 
}



/*  Validation functions  */
function formatValidateEmail($e){
  if (preg_match("/^([a-z09-_.]{1,50}@)$/",$e)){
    return true;
  }else{
    return false;
  }

}
function formatValidateToken($t){
  if (preg_match("/^[a-zA-Z0-9]{4,4}-[a-zA-Z0-9]{4,4}-[a-zA-Z0-9]{4,4}$/",$t)){
    return true;
  }else{
    return false;
  }
}
function formatValidatePassword($p){
  if (preg_match("/^\S{8,30}$/",$p) ){
    return true;
  }else{
    return false;
  }
}
 function redirect($url){
  global $db;  
  if (!$db->connect_errno) {
    $db->close();
  }
  header("Location: ".$url);  

 }

function informSuccess( $redirect = true, $redirectUrl = null, $page = 'index'){
  switch ($page) {

    case 'index':
      $page = "/".$page;
      $page = $page."?m=1";
      break;

    default:
      $page = "";
      $page = $page."&m=1";
     
      break;
  }
    redirect($redirectUrl.$page);
}
function informError( $redirect = true, $redirectUrl = null, $page = 'index'){
        $page="/".$page;
      redirect($redirectUrl.$page."?m=2");
}
function informPermiss( $redirect = true, $redirectUrl = null, $page = 'index'){
        $page="/".$page;
      redirect($redirectUrl.$page."?m=3");
}
/*****/////**********/
/** CATALOGOS GENERALES/////////////*/
 
  function getTipoPago(){
    $arrayStatus = array();
    $arrayStatus["Efectivo"]        = "Efectivo";
    $arrayStatus["Tarjeta Credito"] = "Tarjeta Credito";
    $arrayStatus["Tarjeta Debito"]  = "Tarjeta Debito";
    $arrayStatus["Apartado"]        = "Apartado";
    $arrayStatus["Credito"]         = "Credito";
    $arrayStatus["Otro"]            = "Otro";

    return $arrayStatus;
  }
  function getComsiones(){
    $arrayStatus = array();
    $arrayStatus["0.06"] = "6%";
    $arrayStatus["0.6"]  = "60%";
    $arrayStatus["0.7"]  = "70%";
    $arrayStatus["1"]    = "100%";
    return $arrayStatus;
  }
  

/**** ********************/
/****
Database functions
****/



function start_connection($serverDB=DB_HOST,$userDB=DB_USER,$passDB=DB_PASSWORD,$nameDB=DB_NAME,$portDB=DB_PORT,$socketDB=DB_SOCKET)
{
  //echo 'Connecting: '.$serverDB.' '.$userDB. ' '.$passDB.' '.$nameDB.'<br>';
//  $con = mysqli_connect($serverDB,$userDB, $passDB,$nameDB,$portDB,$socketDB);//
  $con = mysqli_connect(null,$userDB, $passDB,$nameDB,$portDB,$socketDB);
  return $con;
}
function close_connection($con)
{
  mysqli_close($con);
}
function call_SP($con,$query)
{
  $result=mysqli_query($con,$query);
  mysqli_use_result($con);
  return $result;
}
function call_multiple_SP($con,$query)
{
  $result=null;
  if(mysqli_multi_query($con,$query))
    $result=mysqli_store_result($con);

  return $result;
}

function getRow($con,$result)
{
  $row=mysqli_fetch_row($result);
  return $row;
}
function freeResult($con,$result)
{
  do
  {
    $row=mysqli_fetch_array($result);
  }
  while($row);

  
  while(mysqli_more_results($con) && mysqli_next_result($con))
  {
    mysqli_free_result($result);
  }

}

function validateQuery($con,$query)
{
  return mysqli_real_escape_string($con,$query);
}

function fromArray($array, $table, $db, $method )
{
  $data    = array();
  $columns = $values = "";
    foreach ($array as $rowKey => $row) {
      $result = $db->query("SHOW COLUMNS FROM ".$table." WHERE Field = '".$rowKey."'");
      if ($result->num_rows === 1) {
        if($method=="add"){
          if($row || $row==0){
            $columns .= $rowKey.",";
            $values  .= "'".$db->real_escape_string($row)."',";
          }
        } 
        if($method=="update"){
          if($row || $row==0){
            $columns .= $rowKey."='".$db->real_escape_string($row)."',";
            $values  .= "";//no se ocupa
          }
        } 
      }
    }
    $columns = substr($columns, 0, -1);
    $values  = substr($values, 0, -1);
    if ( $columns ){
      $data[0] = $columns;
      $data[1] = $values;
    }
   
    return $data;
}
function getServer($key = null, $default = null)
{
    if (null === $key) {
        return $_SERVER;
    }

    return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
}
function getMethod()
{
    return getServer('REQUEST_METHOD');
}
function getPost($key = null, $default = null)
{
  if (null === $key) {
      return $_POST;
  }

  return (isset($_POST[$key])) ? $_POST[$key] : $default;
}

function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias 	= abs($dias); $dias = floor($dias);
    return $dias;
}
function validar_fecha($fecha){
  // metodo para valdar una fecha sea valida
  $valores = explode('-', $fecha);
	
	return count($valores);
}
function isPost()
{
    if ('POST' == getMethod()) {
        return true;
    }

    return false;
}
function delete($id,$module,$table){
  
  $obj        = "";
  $pagereturn = 'index';
  
  switch ($table) {
    case 'taller':               $obj = new Taller();            $pagereturn = $table;    break;
    case 'categoria':            $obj = new Categoria();         $pagereturn = $table;    break;
    case 'marca':                $obj = new Marca();             $pagereturn = $table;    break;
    case 'persona':              $obj = new Persona();                                    break;
    case 'producto':             $obj = new Producto();                                   break;
    case 'usuario':              $obj = new usuario();                                    break;
    case 'permiso':              $obj = new Permiso();                                    break;
    case 'cita':                 $obj = new Cita();                                       break;
    case 'venta':                $obj = new Venta();                                      break;
    case 'productosventa':       $obj = new ProductosVenta();    $pagereturn = $table;    break;
    case 'personalpuesto':       $obj = new PersonalPuesto();    $pagereturn = $table;    break;
    case 'usuariotipo':          $obj = new UsuarioTipo();       $pagereturn = $table;    break;
    case 'entrada':              $obj = new Entrada();                                    break;
    case 'pedido':               $obj = new Pedido();                                     break;
    case 'traspaso':             $obj = new Traspaso();                                   break;
    case 'salida':               $obj = new Salida();                                     break;
    case 'entradaproducto':      $obj = new EntradaProducto();    $pagereturn = $table;   break;
    case 'traspasoproducto':     $obj = new TraspasoProducto();   $pagereturn = $table;   break;
    case 'salidaproducto':       $obj = new SalidaProducto();     $pagereturn = $table;   break;
    case 'pedidoproducto':       $obj = new PedidoProducto();     $pagereturn = $table;   break;
    default:
      echo "no se encontro tabla en func.global ".$table;
      exit;
      break;
  }
  $data = $obj->getTable($id);

  if ( !$data )  informError(true,make_url($module,$pagereturn));

  $array      = [];
  switch ($table) {
    case 'productosventa':
      $array  = array('id'=>$data['id_venta']); 
      $pagereturn = "view";
      break;
    case 'entradaproducto':
      $array  = array('id'=>$data['id_entrada']); 
      $pagereturn = "view";
      break; 
    case 'pedidoproducto':
      $array  = array('id'=>$data['id_pedido']); 
      $pagereturn = "view";
      break;
    case 'traspasoproducto':
      $array  = array('id'=>$data['id_traspaso']); 
      $pagereturn = "view";
      break;
    case 'salidaproducto':
      $array  = array('id'=>$data['id_salida']); 
      $pagereturn = "view";
      break;
    
    default:
      # code...
      break;
  }

  if ( $obj->deleteAll($id) ) { informSuccess( true, make_url($module,$pagereturn,$array) ); }
  else { informError(true,make_url($module,$pagereturn) ); }
  
}
/** CSRF Token **/
function CSRFToken($len=8){
    // should move to cryptographically secure random
    $chars="abcdefghijklmnopqrstuvwxyz";$chars.=strtoupper($chars)."0123456789";
    $token=$chars[rand(0,strlen($chars)-1)];
    for ($i=0;$i<$len;$i++){
      echo $token.=$chars[rand(0,strlen($chars)-1)];
    }
    return $token;
 }
 ////para dar formato de 2 numeros float sin redondeo
 function truncateFloat($number=0, $digitos)
 {
     $raiz = 10;
     $multiplicador = pow ($raiz,$digitos);
     $resultado = ((int)($number * $multiplicador)) / $multiplicador;
     return number_format($resultado, $digitos);

 }

/*** href url get variables routing functions ***/

function make_url($sec='',$pag="index",$params=array()){
    //print_r($sec);
    //print_r($pag);
    //print_r($params);
    if ($params){
      //  echo "\n\n-----HERE----\n\n";
        if (!is_array($params)){  /* allow one non-array variable */
            $tmp=   $params;
            $params=array();
            $params[]=$tmp;
        }
        if (isset($_SESSION) && isset($_SESSION['getCSRF'])){
          $params['getCSRF']=$_SESSION['getCSRF'];
        }
        $url= APP_URL."/" . $sec . "/" . $pag . "/" ;
        if (($sec=="Home")&&($pag=="index")){
            $url= APP_URL."/" ; 
        }
        $params ="?bbp_".urlsafe_b64encode(json_encode($params));
        $url.=$params."__".substr(sha1($url.$params.GET_SALT),0,12); 
    }else {
        if ($pag=="index"){
            $url= APP_URL."/" . $sec ;
        }else{
            $url= APP_URL."/" . $sec . "/" . $pag ;
        }
       // $params ="/?bbp_".urlsafe_b64encode(json_encode(array('ttmp'=>time())));
      #  $url.=$params."__".sha1($url.$params."NOTMATCH".GET_SALT); 
    }   
    return $url;
}
function unmake_url($url=""){
  if ($url==="") $url=SITE_HOST."".$_SERVER['REQUEST_URI'];
  // $tmp=explode("#",$url);$url=$tmp[0];
  // $tmp=explode("?",$url);$url=$tmp[0];
  //echo $url . " url \n ";
  //echo APP_URL . " appurl \n ";;  
  /**default oriferror**/
  $res=array('section'=>"",'page'=>"",'hashpass'=>false,'path'=>'');
  if(strpos($url,APP_URL)===0) {
      $path =  str_replace(APP_URL,"",$url);
    //  echo "\n\n";
    // echo $path ."<<< unmake path\n\n";
      if (preg_match("/((\S+\/)\?bbp_([a-zA-Z0-9-_\.]+))__([a-f0-9]{12,12})/",$url,$mm)){
      //    print_r($mm);
          if (substr(sha1($mm[1].GET_SALT),0,12)===$mm[4]){
              $res['hashpass']=true;
              // echo "\nMATCH\n\n";
              $res['params']=json_decode(urlsafe_b64decode($mm[3]),true);
              // validate getCSRF

              if ( isset($_SESSION) && isset($_SESSION['getCSRF']) && isset($res['params']['getCSRF'])){
                  if (  $res['params']['getCSRF']===$_SESSION['getCSRF']){
                      // valid token
                  }else{ 
                    // invalide getCSRF token wipe
                    $res['params']=array('error'=>'invalidtoken');                  
                  }
              }
              $path =  str_replace(APP_URL,"",$mm[2]);
          }
      }    
      $tmp=explode("/",trim($path,"/"));
  
      if (preg_match("/^([a-zA-Z0-9-_\.]+)$/",$tmp[0]) && $res['section']==""){
            $res['section']=$tmp[0];    
      }
      if ( (count($tmp)>1) && preg_match("/^([a-zA-Z0-9-_\.]+)$/",$tmp[1])   && $res['page']==""){
            $res['page']=$tmp[1];    
      }
      $res['path']=trim($path,"/");
      
  }

  return $res;
}

function urlsafe_b64encode($string)
{
  #$md5=md5($string."sdfi9287342asdf");
  $string=$string;#$md5.$string;
  $data=base64_encode(openssl_encrypt ($string,'aes-256-cbc',GET_ENC_PASS, true, GET_ENC_IV));
  $data = str_replace(array('+','/','='),array('-','_','.'),$data);
  
  return $data;
}
function urlsafe_b64decode($string)
{
  $data = str_replace(array('-','_','.'),array('+','/','='),$string);
  $mod4 = strlen($data) % 4;
  if ($mod4) {
    $data .= substr('====', $mod4);
  }
 
  $data=openssl_decrypt(base64_decode($data),'aes-256-cbc',GET_ENC_PASS, true, GET_ENC_IV);
  
  #$md5=substr($data,0,32);
  #$data=substr($data,32);
  #if ($md5!=md5($data."sdfi9287342asdf")){$data="";}
  return $data;
} 

function respondData( $response = false )
{
    header('HTTP/1.1 200 Success');
    header('Content-Type: application/json');
    $response2 = array([
        "title"=> "paciente as asa 2 ",
        "start"=> "2019-03-28 07:46:00",
        "end"=> "2019-03-28 08:46:00",
        "description"=> "Pendiente",
        "allDay"=> 'false',
        "url"=> "http:\/\/localhost\/GitHub\/Clinica\/Citas\/historial\/?bbp_qd6pRjlBkr-WlB0OzgNCmZDd9G-I8udyNz3CcFT-c5TG_R3mVQ3mmJ4qE98RUO7o__34f4bb483caa",
        "icon"=> 'fa-check'
    ]);
    die( json_encode($response) );
}
