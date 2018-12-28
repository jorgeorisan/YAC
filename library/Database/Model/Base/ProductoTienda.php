<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_ProductoTienda', 'doctrine');

/**
 * Database_Model_Base_ProductoTienda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_productotienda
 * @property float $existencias
 * @property string $status
 * @property integer $tienda_id_tienda
 * @property integer $id_producto
 * @property float $alerta_minima
 * @property string $fecha_actualizacion
 * @property string $usuario_actualizacion
 * @property Database_Model_Producto $Producto
 * @property Database_Model_Tienda $Tienda
 * @property Doctrine_Collection $ProductosVenta
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_ProductoTienda extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('producto_tienda');
        $this->hasColumn('id_productotienda', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('existencias', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
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
        $this->hasColumn('tienda_id_tienda', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '13',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_producto', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('alerta_minima', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('fecha_actualizacion', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('usuario_actualizacion', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
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
        $this->hasOne('Database_Model_Producto as Producto', array(
             'local' => 'id_producto',
             'foreign' => 'id_producto'));

        $this->hasOne('Database_Model_Tienda as Tienda', array(
             'local' => 'tienda_id_tienda',
             'foreign' => 'id_tienda'));

        $this->hasMany('Database_Model_ProductosVenta as ProductosVenta', array(
             'local' => 'id_productotienda',
             'foreign' => 'id_productotienda'));
    }
}