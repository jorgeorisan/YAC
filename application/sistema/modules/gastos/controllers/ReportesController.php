<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 20/10/11
 * Time: 10:46
 *
 */

class Gastos_ReportesController extends jfLib_Controller
{
    function init()
    {
        parent::init();


    }

    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function indexAction()
    {
        $this->_onlyAdmin();
        $form = new Gastos_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());

        $query = Doctrine_Query::create()
                ->from("Database_Model_Gasto")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'");



        $this->view->query = $query->execute();
        $this->view->form = $form;

    }



}