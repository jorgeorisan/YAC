<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 09/04/12
 * Time: 17:07
 *
 */

class Supersecure_VentasController extends jfLib_Controller
{
    function aesconderAction()
    {
        $this->view->query = Doctrine_Query::create()
            ->from("Database_Model_Venta")
            ->where("tipo = ?", "Efectivo")
            ->andWhere("factura = 0")
            ->andWhere("no_calculable = 0")
            ->execute();
    }

    function escondidasAction()
    {
        $this->view->query = Doctrine_Query::create()
            ->from("Database_Model_Venta")
            ->andWhere("no_calculable = 1")
            ->execute();
    }

    function esconderAction()
    {
        $this->_disableView();
        $obj = Database_Model_Venta::getById($this->_request->getParam("id"));

        $obj->no_calculable = 1;

        try {
            $obj->save();
            $this->_informSuccess(null, true, "supersecure/ventas/aesconder");
        } catch (Exception $e) {
            $this->_informError();
        }
    }

    function revivirAction()
    {
        $this->_disableView();
        $obj = Database_Model_Venta::getById($this->_request->getParam("id"));

        $obj->no_calculable = 0;

        try {
            $obj->save();
            $this->_informSuccess(null, true, "supersecure/ventas/escondidas");
        } catch (Exception $e) {
            $this->_informError();
        }
    }
}