<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Ventas_Form_Factura extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Text("num_factura");
        $element->setLabel("Número de factura *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("razon_social");
        $element->setLabel("Razón social *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("rfc");
        $element->setLabel("RFC *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("calle");
        $element->setLabel("Calle *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("num_ext");
        $element->setLabel("Número exterior *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("num_int");
        $element->setLabel("Número interior");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("colonia");
        $element->setLabel("Colonia *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("ciudad");
        $element->setLabel("Ciudad / Delegación *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("estado");
        $element->setLabel("Estado *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("codigo_postal");
        $element->setLabel("Código postal *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("fecha");
        $element->setLabel("Fecha *");
        $element->setAttrib("datepicker", "true");
        $element->setValue(date("Y-m-d"));
        $element->setRequired(TRUE);
        $this->addElement($element);

        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}