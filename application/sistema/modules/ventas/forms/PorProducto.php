<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:50
 *
 */

class Ventas_Form_PorProducto extends Zend_Form
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


        $element = new Zend_Form_Element_Select("id_producto");
        $element->setLabel("Producto");
        $element->setRequired(TRUE);
        $element->addMultiOption("", "Favor de seleccionar");

        foreach (Doctrine_Query::create()
                     ->from("Database_Model_Producto")
                     ->orderBy("nombre ASC")
                     ->execute() as $obj) {
            $element->addMultiOption($obj->id_producto, $obj->codinter." ".$obj->nombre);
        }
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Text("autocomplete");
        $element->setLabel("Selecciona un producto *");
        $element->setRequired(TRUE);
        $element->setAttrib("class", "small-input");
        $element->setAttrib("for", "autocomplete");
        $this->addElement($element);



        $this->addElement(new Zend_Form_Element_Submit("Generar"));
    }

}