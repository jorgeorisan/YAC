<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_BitacoraAccesos', 'doctrine');

/**
 * Database_Model_Base_BitacoraAccesos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_bitacoraaccesos
 * @property string $id_usuario
 * @property timestamp $fecha_registro
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_BitacoraAccesos extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('bitacora_accesos');
        $this->hasColumn('id_bitacoraaccesos', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('id_usuario', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('fecha_registro', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}