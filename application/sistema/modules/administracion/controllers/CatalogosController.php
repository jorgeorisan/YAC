<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_CatalogosController extends jfLib_Controller
{

    function init()
    {
        parent::init();
        $this->view->datauserlogged=$this->_loggedUser;

    }

    function indexAction()
    {

    }



}