<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 07/06/11
 * Time: 20:08
 *
 */

class jfLib_Form_Search extends Zend_Form
{

    function __construct($options = null)
    {

        parent::__construct($options);

        $this->setAttrib("method","get");

        $element = new Zend_Form_Element_Text("q");
        $this->addElement($element);

        $this->addElement(new Zend_Form_Element_Submit("Buscar"));

        $element = new Zend_Form_Element_Hidden("p");
        $this->addElement($element);
    }

}