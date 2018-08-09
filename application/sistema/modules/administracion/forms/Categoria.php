<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Administracion_Form_Categoria extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Text("categoria");
        $element->setLabel("Nombre *");
        $element->setRequired(TRUE);
        $this->addElement($element);


        $element = new Zend_Form_Element_Text("descuento");
        $element->setLabel("Descuento por categoría (0-100 %)");
        $this->addElement($element);

        $element = new Zend_Form_Element_Select("descuento_activado");
        $element->setLabel("Descuento activado *");
        $element->setRequired(TRUE);
        $element->addMultiOption("0", "No");
        $element->addMultiOption("1", "Sí");
        $this->addElement($element);


        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}