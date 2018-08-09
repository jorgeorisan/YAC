<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:50
 *
 */

class Facturas_Form_Reporte extends Zend_Form
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


        $element = new Zend_Form_Element_Select("id_usuario");
        $element->setLabel("Vendedor");
        $element->setRequired(TRUE);
        $element->addMultiOption("", "Favor de seleccionar");
        foreach (Database_Model_Usuario::getAll() as $obj) {
            $element->addMultiOption($obj->id_usuario, $obj->nombre);
        }
        $this->addElement($element);

       /* $element = new Zend_Form_Element_Select("id_tienda");
        $element->setLabel("Tienda");
        $element->setRequired(TRUE);
        $element->addMultiOption("", "Favor de seleccionar");
        foreach (Database_Model_Tienda::getAll2() as $obj) {
            $element->addMultiOption($obj->id_tienda, $obj->nombre);
        }
        $this->addElement($element);*/



        $this->addElement(new Zend_Form_Element_Submit("Generar"));
    }

}