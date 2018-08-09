<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Administracion_Form_Inventario extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Text("id_producto");
        $element->setLabel("Código de barras *");
        $element->setAttrib("readonly", "readonly");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("producto");
        $element->setLabel("Producto *");
        $element->setAttrib("readonly", "readonly");
        $element->setRequired(true);
        $this->addElement($element);
		
		$element = new Zend_Form_Element_Text("precio");
        $element->setLabel("Precio *");
        $element->setAttrib("readonly", "readonly");
        $element->setRequired(true);
        $this->addElement($element);


        $element = new Zend_Form_Element_Text("cantidad");
        $element->setLabel("Cantidad *");
        $element->setRequired(true);
        $this->addElement($element);

        $element = new Zend_Form_Element_Textarea("comentarios");
        $element->setLabel("Comentarios");
        $this->addElement($element);


        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}