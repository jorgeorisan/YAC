<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/10/11
 * Time: 23:15
 *
 */

class Asistencia_RegistroController extends jfLib_Controller
{

    function indexAction()
    {
        $last = "Salida";

        $lastQuery = Doctrine_Query::create()
                ->select("MAX(id_asistencia) ultimo")
                ->from("Database_Model_Asistencia")
                ->where("DATE(hora) = DATE(NOW())")
                ->andWhere("id_usuario = ?", $this->_loggedUser->id_usuario)
                ->fetchOne();


        if ($lastQuery->ultimo) {

            $lastObj = Doctrine_Core::getTable("Database_Model_Asistencia")->findOneBy("id_asistencia", $lastQuery->ultimo);
            $last = $lastObj->tipo;
        }
        if ($last == "Salida") {
            $tipo = "Entrada";
        } else {
            $tipo = "Salida";
        }

        $query = Doctrine_Query::create()
                ->from("Database_Model_Asistencia")
                ->where("DATE(hora) = DATE(NOW())")
                //->andWhere("id_usuario = ?", $this->_loggedUser->id_usuario)
                ->orderBy("id_asistencia DESC")
                ->execute();
        if ($this->_request->isPost()) {

            $obj = new Database_Model_Asistencia();

            $obj->id_usuario =$this->_request->getPost("id_usuario");
            $obj->tipo = $this->_request->getPost("tipo");

            try {
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
            }
        }

        $this->view->query = $query;
        $this->view->last = $last;
    }

    function entradaAction()
    {

        $obj = new Database_Model_Asistencia();

        $obj->id_usuario = $this->_loggedUser->id_usuario;
        $obj->tipo = "Entrada";

        try {
            $obj->save();

            $this->_informSuccess();
        } catch (Exception $e) {
            $this->_informError($e, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }

    }

    function salidaAction()
    {

        $obj = new Database_Model_Asistencia();

        $obj->id_usuario = $this->_loggedUser->id_usuario;
        $obj->tipo = "Salida";

        try {
            $obj->save();
            $this->_informSuccess();
        } catch (Exception $e) {

            $this->_informError($e, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }

    }

}