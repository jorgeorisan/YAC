<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/10/11
 * Time: 23:01
 *
 */

class ReportesController extends jfLib_Controller
{

    function indexAction()
    {

    /*    $alertasInventario = Doctrine_Query::create()
            ->from("Database_Model_Producto")
            ->where("existencias <= alerta_minima")
            ->execute();

        $str = "Los productos siguientes tienen pocas existencias:";

        foreach ($alertasInventario as $obj) {
            $str .= "<br /><strong>" . $obj->nombre . "</strong> hay  <strong>" . $obj->existencias . "</strong> y el mínimo es <strong>" . $obj->alerta_minima."</strong>";
        }

        if(count($alertasInventario)){
            $this->_informError(null, $str);
        }

  */
    }


}