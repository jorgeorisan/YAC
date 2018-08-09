<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 01/12/11
 * Time: 13:58
 * 
 */
 
class Asistencia_Form_Registro extends Zend_Form{

    function __construct($options = null, $tipo= null)
    {
        parent::__construct($options);

        $this->setAttrib("method", "get");

        $element = new Zend_Form_Element_Text("id_usuario");
        $element->setLabel("Usuario");
        $element->setRequired(TRUE);
        $element->setAttrib("class", "small-input");
        $this->addElement($element);


        $element = new Zend_Form_Element_Password("password");
        $element->setLabel("Password");
        $element->setRequired(TRUE);
        $this->addElement($element);



        $this->addElement(new Zend_Form_Element_Submit("$tipo"));

        

    }

}