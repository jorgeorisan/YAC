<?php

/**
 * Database_Model_TraspasoProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Database_Model_TraspasoProducto extends Database_Model_Base_TraspasoProducto
{
    public static function getById($id)
    {
        return Doctrine_Core::getTable("Database_Model_TraspasoProducto")->findOneBy("id_traspaso_producto", $id);
    }

}