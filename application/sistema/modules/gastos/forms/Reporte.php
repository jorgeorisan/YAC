<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:50
 *
 */

class Gastos_Form_Reporte extends Zend_Form
{


    function __construct($options = null, $agents = null)
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






        $this->addElement(new Zend_Form_Element_Submit("Generar"));
    }

}