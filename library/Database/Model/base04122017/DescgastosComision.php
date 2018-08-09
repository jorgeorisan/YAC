<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_DescgastosComision', 'doctrine');

/**
 * Database_Model_Base_DescgastosComision
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_descgastos_comision
 * @property float $monto
 * @property integer $id_comisiones_vendedor
 * @property string $concepto
 * @property timestamp $fecha_registro
 * @property string $status
 * @property Database_Model_ComisionesVendedor $ComisionesVendedor
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_DescgastosComision extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('descgastos_comision');
        $this->hasColumn('id_descgastos_comision', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('monto', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_comisiones_vendedor', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('concepto', 'string', 100, array(
             'type' => 'string',
             'length' => 100,
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
        $this->hasColumn('status', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'ACTIVO',
             'notnull' => false,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Database_Model_ComisionesVendedor as ComisionesVendedor', array(
             'local' => 'id_comisiones_vendedor',
             'foreign' => 'id_comisiones_vendedor'));
    }
}