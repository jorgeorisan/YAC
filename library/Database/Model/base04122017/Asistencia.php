<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Database_Model_Asistencia', 'doctrine');

/**
 * Database_Model_Base_Asistencia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_asistencia
 * @property string $id_usuario
 * @property date $fecha
 * @property string $tipo
 * @property timestamp $hora
 * @property Database_Model_Usuario $Usuario
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Database_Model_Base_Asistencia extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('asistencia');
        $this->hasColumn('id_asistencia', 'integer', 4, array(
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
             'notnull' => true,
             'autoincrement' => false,
             ));
        $this->hasColumn('fecha', 'date', null, array(
             'type' => 'date',
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('tipo', 'string', 45, array(
             'type' => 'string',
             'length' => 45,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             ));
        $this->hasColumn('hora', 'timestamp', null, array(
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
        $this->hasOne('Database_Model_Usuario as Usuario', array(
             'local' => 'id_usuario',
             'foreign' => 'id_usuario'));
    }
}