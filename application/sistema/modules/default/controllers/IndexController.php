<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 21/02/11
 * Time: 07:22
 * To change this template use File | Settings | File Templates.
 */

class IndexController extends Zend_Controller_Action
{


    function indexAction()
    {
        $this->_redirect("ventas/administrar/alta");
    }
}