<?php

/**
 * Database_Model_Producto
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Database_Model_Producto extends Database_Model_Base_Producto
{

    /**
     * @static
     * @param $id
     * @return Database_Model_Producto
     */
    public static function getById($id)
    {
        return Doctrine_Core::getTable("Database_Model_Producto")->findOneBy("id_producto", $id);
    }
    public static function getByCodbar($id)
    {
        $arr = Doctrine_Query::create()
            ->from(get_class())
            ->where("codbarras=?",$id)
            ->orWhere("codinter=?",$id)
            ->fetchOne();




        return $arr;
       // return Doctrine_Core::getTable("Database_Model_Producto")->findOneBy("codbarras", $id);
    }
    public static function getAllArr()
    {
        $arr = array();
        foreach (Doctrine_Query::create()
                     ->from(get_class())
                     ->orderBy("nombre ASC")
                     ->execute() as $obj) {
            $arr[$obj->id_producto] = $obj->nombre."-".$obj->Marca->nombre;
        }

        return $arr;
    }
    public static function getAll()
    {
        $arr = array();
        foreach (Doctrine_Query::create()
                     ->from(get_class())
                     ->orderBy("nombre ASC")
                     ->execute() as $obj) {
            $arr[$obj->id_producto] =$obj->nombre;
        }

        return $arr;
    }

    public function getexistencias()
    {
        $query = Doctrine_Query::create()
            ->select("ifnull(sum(existencias),0) totexistencias")
            ->from("Database_Model_ProductoTienda")
            ->where("id_producto=?",$this->id_producto)
            ->andWhere("tienda_id_tienda=13")
            ->execute();//verificamos si es adminisrador

        foreach($query as $objt){
            $totexistencias=$objt["totexistencias"];
        }
        return $totexistencias;
    }

}