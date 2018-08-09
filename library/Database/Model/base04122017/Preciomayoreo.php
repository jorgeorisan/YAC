<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_Preciomayoreo', 'doctrine');

/**
 * Database_Model_Base_Preciomayoreo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $CLAVE
 * @property string $PRODUCTO
 * @property decimal $PRECIO
 * @property string $PEDIDO
 * @property integer $id
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_Preciomayoreo extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('preciomayoreo');
        $this->hasColumn('CLAVE', 'string', 12, array(
             'type' => 'string',
             'length' => 12,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PRODUCTO', 'string', 36, array(
             'type' => 'string',
             'length' => 36,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('PRECIO', 'decimal', 5, array(
             'type' => 'decimal',
             'length' => 5,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'scale' => '2',
             ));
        $this->hasColumn('PEDIDO', 'string', 10, array(
             'type' => 'string',
             'length' => 10,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}