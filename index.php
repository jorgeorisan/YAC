<?php
ob_start();

error_reporting(E_ALL); ini_set('display_errors', 1);

// Olny allow whitelisted IP durring testing
//$allow = array("192.168.56.1","171.66.214.130", "50.16.212.172", "50.242.118.102"); //allowed IPs
#if(!in_array($_SERVER['REMOTE_ADDR'], $allow) ){echo $_SERVER['REMOTE_ADDR'];echo $_SERVER['REMOTE_ADDR'];die; exit;}


// set global variables and load functions and classes
include_once("system/config/config.php");

// parse request
/*
For example if the URL is created with:
 make_url("TestSection","TestPage",array('sample_GET_Var_to_be_encrypted'=>'sample value','something'=>'else'));
 the URL will be:
 TestSection/TestPage/bbp_ucbCG6aPFTgj82cRloHBACOggZfiu7A_LBGjLMb2X6S_X3a1AYHVk3LLjAojL3qW__3f55dfed612c
 The result of unmake_url() will be:
Array
(
    [section] => TestSection
    [page] => TestPage
    [hashpass] => 1
    [path] => TestSection/TestPage
    [params] => Array
        (
            [sample_GET_Var_to_be_encrypted] => sample value
            [something] => else
        )
)
*/
$request=unmake_url();


//HOLA
//PRUEBA DE COMENTARIO EN BRANCH
/*
=====================================
Routing section
  maps requested URLs to pages and checks authorization
=====================================
*/
//$_SESSION['user_id']=1;
// Authorized user routing
    //if ( isset ($_SESSION['user_id']) && $_SESSION['user_id'] * 1 > 0 ){
    $dir="";//si esta en carpeta
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ){
     // echo  "sesion=".$_SESSION['user_id'];

      //default page to load
      $page     = "Home_index.php";
      $page_num = 0;
      $page2    = ($request['page'])? $request['page'] : 'index';

    
      if ($request['section']==='Clientes'){
        $page = "Clientes_index.php";
        $dir  = "Clientes";//si esta en carpeta
        if ($request['page']==='add')      { $page = "Clientes_add.php";      }
        if ($request['page']==='addpopup') { $page = "Clientes_addpopup.php";  }
        if ($request['page']==='edit')     { $page = "Clientes_edit.php";     }
        
      }
      if ( $request['section'] === 'Catalogos' ) {
        $page = "Catalogos_clinica.php";
        $dir  = "Catalogos";//si esta en carpeta
        if ($request['page'] === 'clinica')        { $page = "Catalogos_clinica.php"; }
        if ($request['page'] === 'marca')          { $page = "Catalogos_marca.php";  }
        if ($request['page'] === 'categoria')      { $page = "Catalogos_categoria.php";  }
        if ($request['page'] === 'usuariotipo')    { $page = "Catalogos_usuariotipo.php";  }
      }
      if ($request['section']==='Usuarios'){
        $page = "Usuarios_index.php";
        $dir  = "Usuarios";//si esta en carpeta

        if ($request['page']==='show') { $page = "Usuarios_show.php"; }
        if ($request['page']==='add')  { $page = "Usuarios_add.php" ; }
        if ($request['page']==='edit') { $page = "Usuarios_edit.php"; }
        if ($request['page']==='ajax') { $page = "Usuarios_ajax.php"; }
       
      }
      if ($request['section']==='Permisos'){
        $page = "Permisos_index.php";
        $dir  = "Permisos";//si esta en carpeta
        if ($request['page']==='add')    { $page = "Permisos_add.php"; }
        if ($request['page']==='edit')   { $page = "Permisos_edit.php"; }
        if ($request['page']==='ajax')   { $page = "Permisos_ajax.php"; }
        if ($request['page']==='asignar'){ $page = "Permisos_asignar.php"; }
      }
      if ($request['section']==='Personal'){
        $page = "Personal_index.php";
        $dir  = "Personal";//si esta en carpeta
        if ($request['page']==='add')      { $page = "Personal_add.php";      }
        if ($request['page']==='edit')     { $page = "Personal_edit.php";     }
      }
      if ($request['section']==='Citas'){
        $page = "Citas_index.php";
        $dir  = "Citas";//si esta en carpeta
        if ($request['page']==='add')      { $page = "Citas_add.php";      }
        if ($request['page']==='edit')     { $page = "Citas_edit.php";     }
        if ($request['page']==='view')     { $page = "Citas_view.php";     }
      }
      if ($request['section']==='Historial'){
        $page = "Historial_index.php";
        $dir  = "Historial";//si esta en carpeta
        if ($request['page']==='consulta') { $page = "Historial_consulta.php"; }
        if ($request['page']==='view')     { $page = "Historial_view.php";     }
      }
      if ($request['section']==='Productos'){
        $page = "Productos_index.php";
        $dir  = "Productos";//si esta en carpeta
        if ($request['page']==='add')      { $page = "Productos_add.php";      }
        if ($request['page']==='edit')     { $page = "Productos_edit.php";     }
        if ($request['page']==='addpopup') { $page = "Productos_addpopup.php";  }
        
      }
      if ($request['section']==='Ventas'){
        $page = "Ventas_index.php";
        $dir  = "Ventas";//si esta en carpeta
        if ($request['page']==='add')      { $page = "Ventas_add.php";      }
        if ($request['page']==='edit')     { $page = "Ventas_edit.php";     }
        if ($request['page']==='view')     { $page = "Ventas_view.php"; }
        if ($request['page']==='credito')  { $page = "Ventas_credito.php"; }
        
      }
     
      //delete pages
      if(isset($request['params']['id'])){
        if( $id = $request['params']['id'] ) {
          $table = explode("delete", $request['page']);
         
          if(count($table)>1){
            delete($id,$request['section'],$table[0]);
          }
        }
      }

      //*****permisos de usuario  */***///
      if($request['section']!='Home' && $request['section']!='Examples' && $request['page']!="" && $request['page']!="ajax" && $request['page']!="print" ){
        
        $objpermuser = new PermisoUsuario();
        
        $datapermuser  = $objpermuser->getpermisouser($_SESSION['user_id'],$request['section'],$page2);
        if ( !$datapermuser ) {
          echo "ERROR permisos".$_SESSION['user_id']."------".$request['section']."-----".$page2;
          exit;
          informPermiss(true,make_url("Home","index"));
        }
      }
      
      //end delete
           /******  DEV ROUTING  ******/
      $request['page']=($request['page'])? $request['page']: 'index';
      
      if (file_exists("system/pages/".$dir."/".$request['section']."_".$request['page'].".php")){
        $page = $dir."/".$request['section']."_".$request['page'].".php";
        
      }elseif(file_exists($dir."/system/pages/".$request['section']."_index.php")){
        $page = $dir."/".$request['section']."_index.php";
        
      }elseif(file_exists("system/pages/".$request['section']."_index.php")){
        $page = $request['section']."_index.php";
        
      }else{}

      
      /***/


    }else{
      // Unauthenticated user
      // go to login page
      
        $page="Login_index.php";
        switch ($request['section']) {
          case 'Login':
            $dir="";//si esta en carpeta
            if ($request['page']==='ResetPassword' ){$page="Login_ResetPassword.php";}
            if ($request['page']==='ChangePassword' ){$page="Login_ChangePassword.php";}
            break;
          case 'Register':
            $page="Register_index.php";
            if ($request['section']==='Register' ){
                $page="Register_index.php";
                $dir="";//si esta en carpeta
            }
            break;
          case 'Clientes':
            if ($request['page']==='addpopup'){
              $dir  = "Clientes";//si esta en carpeta
              $page = "Clientes_adpopup.php";      
            }
            break;
          case 'Vehiculos':            
            if ($request['page']==='print'){ 
              $dir  = "Vehiculos";//si esta en carpeta 
              $page = "Vehiculos_print.php";      
            }
            break;
          default:
            
            break;
        }
       
        #die;
        if($dir)  $page = $dir."/".$page;

        
    }
   
// Public user
//echo "========session=".$_SESSION['user_id']."<pre>".print_r(unmake_url())."</pre>";
if( isset($request['path']) && preg_match("/\.php$/",$request['path']) && file_exists(  ROOT_DIR . "/1_example_pages/" . $request['path'])){
  //echo ROOT_DIR . "/1_example_pages/" . $request['path'];

  include_once(ROOT_DIR . "/1_example_pages/" . $request['path']);
}elseif (file_exists("system/pages/".$page)){
 
  include_once("system/pages/".$page);
}else{}

// close database
if (!$db->connect_errno) {
   // $db->close();
}
ob_end_flush();
