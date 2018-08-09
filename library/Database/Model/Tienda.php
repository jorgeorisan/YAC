<?php

/**
 * Database_Model_Tienda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Database_Model_Tienda extends Database_Model_Base_Tienda
{
    public static function getById($id)
    {
        return Doctrine_Core::getTable("Database_Model_Tienda")->findOneBy("id_tienda", $id);
    }
    function getAll2()
    {
        return Doctrine_Core::getTable(get_class())->findAll();
    }

    public static function getAll()
    {
        $arr = array();

        foreach (Doctrine_Query::create()
                     ->from(get_class())
                     ->orderBy("id_tienda ")
                     ->execute() as $obj) {
            $arr[$obj->id_tienda] = $obj->nombre;
        }

        return $arr;
    }
    public static function getAllorigen()
    {
        $arr = array();
        $arr["6"]="BODEGA1";
        foreach (Doctrine_Query::create()
                     ->from(get_class())
                    ->where("id_tienda!=6")
                     ->orderBy("id_tienda desc")
                     ->execute() as $obj) {
            $arr[$obj->id_tienda] = $obj->nombre;
        }

        return $arr;
    }
    public static function getAlldestino()
    {
        $arr = array();
        $arr["2"]="Hacienda";
        foreach (Doctrine_Query::create()
                     ->from(get_class())
                     ->where("id_tienda!=2")
                     ->orderBy("id_tienda desc")
                     ->execute() as $obj) {
            $arr[$obj->id_tienda] = $obj->nombre;
        }

        return $arr;
    }
    public static function getAllT()
    {
        $arr = array();

        foreach (Doctrine_Query::create()
                     ->from(get_class())
                    ->where("status='ACTIVA'")
                    ->andWhere("id_tienda!=14")
                     ->orderBy("id_tienda desc")
                     ->execute() as $obj) {
            $arr[$obj->id_tienda] = $obj->nombre;
        }

        return $arr;
    }
   
}