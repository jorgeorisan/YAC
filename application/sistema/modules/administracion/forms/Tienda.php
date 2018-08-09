<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Administracion_Form_Tienda extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Text("nombre");
        $element->setLabel("Nombre *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("telefono");
        $element->setLabel("Telefono");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("info_adicional");
        $element->setLabel("Informacion Adicional");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("ubicacion");
        $element->setLabel("Ubicacion");
        $this->addElement($element);

        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}