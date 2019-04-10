<?php
/**
 * @Filename:  CambiarSucursal.php
 * Location:   modules/adminsitracion/forms
 * Function:   Ofrece una forma para cambiar sucursal
 * @author:    Giovanni Alberto García
 * @version:   1.0
 */

/**
 * Esta clase ofrece una forma para cambiar la sucursal de los usuarios
 * Function: Ofrece la construcción y validación de la misma
 */
class Administracion_Form_CambiarSucursal extends Zend_Form
{

    /**
     * El constructor de la forma
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('post');

        // obtenemos las sucursales
        $sucursales = Doctrine_Query::create()
            ->from('Database_Model_Sucursal')
            ->where('activo = 1')
            //->andWhere('tipo = "SUCURSAL"')
            ->execute();

        // los convertimos en arreglo
        $suc = array('' => '');
        foreach ($sucursales as $sucursal) {
            $suc[$sucursal->id_sucursal] = $sucursal->nombre;
        }

        $sucursal = $this->createElement('select', 'id_sucursal');
        $sucursal->setLabel('Sucursal')
            ->addMultiOptions($suc)
            ->setAttrib('class', 'form-control chosen-select')
            ->setAttrib('data-placeholder', 'Escoge una sucursal')
            ->setRequired(true)
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        // Add elements to form:
        $this->addElement($sucursal)
            ->addElement($submit);

        // add common filters (the method erases all)
        $this->setElementFilters(array(
                'StripTags', 'StringTrim')
        );
    }

}

?>