<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 10/01/11
 * Time: 19:08
 * To change this template use File | Settings | File Templates.
 */

class Default_Model_IndexReport
{

    protected $_user = null;

    public $_startDate = null, $_endDate = null;

    function __construct($user = null, $startDate = null, $endDate = null)
    {
        $this->_user = $user;
        $now = Zend_Date::now();
        if ($startDate) {
            $this->_startDate = $startDate;
        } else {
            $this->_startDate = $now->toString("YYYY-MM-dd");
        }
        if ($endDate) {
            $this->_endDate = $endDate;
        } else {
            $this->_endDate = $now->toString("YYYY-MM");

        }
        $this->_startDate .= " 00:00:00";


        $this->_endDate .= "-".$this->getLastDay($now->toString("MM"))." 23:59:59";

    }

    function getPedidosQuery()
    {
        return Doctrine_Query::create()
                ->from("Sistema_Model_Pedidos")
                ->where("tipo='Pedido'")
                ->andWhere("status ='Pendiente'")
                ->andWhere("fecha <= '$this->_endDate'")->execute();

    }

    function getPrepedidosQuery()
    {
        
        return Doctrine_Query::create()
                ->from("Sistema_Model_Pedidos")
                ->where("tipo='Pre-pedido'")
                ->andWhere("status ='Pendiente'")
                ->andWhere("fecha <= '$this->_endDate'")->execute();

    }

    function getSurtidosQuery()
    {

        return Doctrine_Query::create()
                ->from("Sistema_Model_Pedidos")
                ->where("status ='Surtido'")
                ->andWhere("fecha <= '$this->_endDate'")->execute();

    }

    function getLastDay($month=0){
        $month=(int) $month;

        $arr[1]=31;
        $arr[2]=28;
        $arr[3]=31;
        $arr[4]=30;
        $arr[5]=31;
        $arr[6]=30;
        $arr[7]=31;
        $arr[8]=31;
        $arr[9]=30;
        $arr[10]=31;
        $arr[11]=30;
        $arr[12]=31;

        return $arr[$month];

    }


}
