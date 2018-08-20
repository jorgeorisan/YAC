<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Ventas_Form_Cliente extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $this->setAttrib("method", "get");

        $element = new Zend_Form_Element_Text("from");
        $element->setLabel("Desde *");
        $element->setRequired(TRUE);
        $element->setAttrib("class", "small-input");
        $element->setAttrib("datepicker", "past");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("to");
        $element->setLabel("Hasta *");
        $element->setRequired(TRUE);
        $element->setAttrib("class", "small-input");
        $element->setAttrib("datepicker", "past");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("autocomplete");
        $element->setLabel("Nombre del Cliente *");
        $element->setRequired(TRUE);
        $element->setAttrib("class", "small-input");
        $element->setAttrib("for", "autocomplete");
        $this->addElement($element);



        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}