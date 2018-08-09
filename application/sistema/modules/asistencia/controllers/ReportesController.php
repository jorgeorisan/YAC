<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 22/11/11
 * Time: 10:45
 *
 */

class Asistencia_ReportesController extends jfLib_Controller
{

    function indexAction()
    {

        $form = new Asistencia_Form_Reporte();

        $from = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }


        $form->from->setValue($from);

        $form->populate($this->_request->getParams());
        $query = array();
        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query = Doctrine_Query::create()
                    ->from("Database_Model_Asistencia")
                    ->where("DATE(hora) = '$from'")
                    ->andWhere("id_usuario = ?", $id_usuario)
                    ->execute();
        }

        $this->view->query = $query;
        $this->view->form = $form;

    }

    function graficoAction()
    {
        $form = new Asistencia_Form_ReporteGrafico();


        $form->populate($this->_request->getParams());

        $this->view->form = $form;
    }

    function feedAction()
    {
        $this->_setAjaxJSONReponse();

        $from = date("Y-m-d", $this->_request->getParam("start"));
        $to = date("Y-m-d", $this->_request->getParam("end"));
        $query = array();
        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query = Doctrine_Query::create()
                    ->select("*, TIME(hora) AS hour")
                    ->from("Database_Model_Asistencia")
                    ->where("hora >= '$from'")
                    ->where("hora <= '$to'")
                    ->andWhere("id_usuario = ?", $id_usuario)
                    ->execute();
        }

        $events = array();
        $eventCount = 0;
        foreach ($query as $obj) {


            if ($obj->tipo == "Entrada") {
                $events[$eventCount]['allDay'] = false;
                $events[$eventCount]['title'] = $obj->id_usuario . " | " . $obj->Usuario->nombre;
                $events[$eventCount]['start'] = $obj->hora;
                $events[$eventCount]['title'] .= " Entrada: " . $obj->hour;
            } elseif ($obj->tipo == "Salida") {
                $events[$eventCount]['end'] = $obj->hora;
                $events[$eventCount]['title'] .= " Salida: " . $obj->hour;
                $eventCount++;
            }


        }
        $json = Zend_Json::encode($events);


        echo $json;
    }

}