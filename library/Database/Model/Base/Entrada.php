<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_Entrada', 'doctrine');

/**
 * Database_Model_Base_Entrada
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_entrada
 * @property timestamp $fecha_registro
 * @property timestamp $fecha
 * @property float $costo_total
 * @property float $total
 * @property string $concepto
 * @property string $folio
 * @property string $referencia
 * @property integer $cancelado
 * @property string $id_usuario
 * @property integer $id_tienda
 * @property string $comentarios
 * @property string $status
 * @property string $ticket_items
 * @property Database_Model_Usuario $Usuario
 * @property Database_Model_Tienda $Tienda
 * @property Doctrine_Collection $EntradaProducto
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_Entrada extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('entrada');
        $this->hasColumn('id_entrada', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('fecha_registro', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('fecha', 'timestamp', null, array(
             'type' => 'timestamp',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('costo_total', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('total', 'float', null, array(
             'type' => 'float',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('concepto', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => 'Entrada de Almacen',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('folio', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('referencia', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('cancelado', 'integer', 1, array(
             'type' => 'integer',
             'length' => 1,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_usuario', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('id_tienda', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'default' => '6',
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('comentarios', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
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
             'default' => 'SOLICITADO',
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('ticket_items', 'string', null, array(
             'type' => 'string',
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
        $this->hasOne('Database_Model_Usuario as Usuario', array(
             'local' => 'id_usuario',
             'foreign' => 'id_usuario'));

        $this->hasOne('Database_Model_Tienda as Tienda', array(
             'local' => 'id_tienda',
             'foreign' => 'id_tienda'));

        $this->hasMany('Database_Model_EntradaProducto as EntradaProducto', array(
             'local' => 'id_entrada',
             'foreign' => 'id_entrada'));
    }
}