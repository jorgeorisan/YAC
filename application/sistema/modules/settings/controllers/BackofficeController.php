<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 28/06/11
 * Time: 00:43
 * 
 */
 
class Settings_BackofficeController extends jfLib_Controller{
    function init(){
        parent::init();

        if($this->_loggedUser->id_usuario_tipo != "2"){
            $this->_informError(null,"Usted no tiene permisos para ingresar.",TRUE,"/");
        }
    }
    function manageAction(){

        $this->view->table=$this->_request->getParam("table");
    }

}