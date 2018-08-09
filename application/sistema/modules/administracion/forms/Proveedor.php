<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Administracion_Form_Proveedor extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Text("nombre");
        $element->setLabel("Nombre *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("nombre_corto");
        $element->setLabel("Nombre corto *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("telefono");
        $element->setLabel("Teléfono");
        $this->addElement($element);

        $element = new Zend_Form_Element_Textarea("info_adicional");
        $element->setLabel("Información relacionada");
        $this->addElement($element);


        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}