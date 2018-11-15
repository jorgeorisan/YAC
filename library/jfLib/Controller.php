<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 07/06/11
 * Time: 17:53
 *
 */

class jfLib_Controller extends Zend_Controller_Action
{
    public $_loggedUser = null;

    function init()
    {
        parent::init();

        if ($this->_loggedUser = $this->_helper->profile()) {
            //DO SOMETHING
        }
        
        $this->view->request = Zend_Controller_Front::getInstance()->getRequest();
    }

    function _getSuccessMessage()
    {
        return "La acción se realizó con éxito";
    }

    function _informError($exception = null, $message = null, $redirect = false, $redirectUrl = null)
    {
        if (!$message) {
            $message = "La acción no se realizó con éxito, favor de intentar mas tarde.";
        }
        $this->_helper->messenger("error", $message);

        if ($exception) {
            echo $exception;
        }

        if ($redirect) {
            $to = $this->_request->getModuleName() . "/" . $this->_request->getControllerName();
            if ($redirectUrl) {
                $to = $redirectUrl;
            }
            $this->_redirect($to);
        }
    }

    function _informSuccess($message = null, $redirect = true, $redirectUrl = null)
    {
        if (!$message) {
            $message = $this->_getSuccessMessage();
        }
        $this->_helper->messenger("success", $message);

        if ($redirect) {
            $to = $this->_request->getModuleName() . "/" . $this->_request->getControllerName();
            if ($redirectUrl) {
                $to = $redirectUrl;
            }
            $this->_redirect($to);
        }

    }

    function _setJSONResponse()
    {

        header("Content-type: text/json");

    }

    function _setAjaxJSONReponse()
    {

        $this->_disableAllLayouts();
        $this->_setJSONResponse();
    }

    function _disableLayout()
    {
        $this->_helper->layout()->disableLayout();
    }

    function _disableView()
    {
        $this->_helper->viewRenderer->setNoRender(true);
    }

    function _disableAllLayouts()
    {
        $this->_disableLayout();
        $this->_disableView();
    }

    function _getActionUrl($action = "")
    {
        return $this->_request->getBaseUrl() . "/" . $this->_request->getModuleName() . "/" . $this->_request->getControllerName() . "/" . $action;
    }

    function sendErrorMail($message, $title = "CONTAINER HOUSE")
    {
        mail("fernando.hernandez@tigears.com", $title, $message."\nRequest:\n".print_r($this->_request->getParams(),true));
    }

}