<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:50
 *
 */

class Facturas_Form_Alta extends Zend_Form
{


    function __construct($options = null, $agents = null)
    {
        parent::__construct($options);

 


        $element = new Zend_Form_Element_Select("id_persona");
        //$element->setLabel("Cliente *");
        $element->setRequired(TRUE);
        $element->setAttrib("class","chzn-select");

        $element->addMultiOption("", "Favor de seleccionar");
        $qry=Doctrine_Query::create()
            ->from("Database_Model_Persona")
            ->where("id_usuario_tipo=1")
            ->andWhere("status ='ACTIVO'")
            ->orderBy("nombre");
        foreach ($qry->execute() as $obj) {
            $element->addMultiOption($obj->id_persona, $obj->id_persona." | ".$obj->razon_social);
        }

        $this->addElement($element);


        $element = new Zend_Form_Element_Select("tipo");
      //  $element->setLabel("Tipo de pago");
        $element->setRequired(TRUE);
        $element->addMultiOption("EFECTIVO", "EFECTIVO");
        $element->addMultiOption("TARJETA", "TARJETA");
        $element->addMultiOption("CHEQUE", "CHEQUE");
        $element->addMultiOption("DEPOSITO", "DEPOSITO");
        $element->addMultiOption("TRANSFERENCIA", "TRANSFERENCIA");
        $element->addMultiOption("NO IDENTIFICADO", "NO IDENTIFICADO");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("digitos");
        //$element->setLabel("Últimos 4 dígitos de Tarjeta/deposito/cheque/transferencia Si no se sabe, dejar en blanco");

        $element->setAttrib("class","small-field");
        $this->addElement($element);
        
        $element = new Zend_Form_Element_Text("fecha");
        $element->setAttrib("width","100px");
       // $element->setLabel("Fecha");
        $element->setRequired(TRUE);
        $element->setValue(date("c"));
        $this->addElement($element);



        $element = new Zend_Form_Element_Text("serie");
        //$element->setLabel("Fecha");
        $element->setAttrib("style","width:100px");
        $element->setAttrib("readonly","readonly");
        $element->setRequired(TRUE);
        $element->setValue("A");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("desde");
        $element->setLabel("Desde");

        // $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("hasta");
        $element->setLabel("Hasta");

        //$element->setRequired(TRUE);
        $this->addElement($element);



        $element = new Zend_Form_Element_Select("condiciones_pago");
        //$element->setLabel("Tipo de comprobante");
        $element->setAttrib("class","chzn-select");
        $element->setRequired(TRUE);
        /* $element->addMultiOption("", "Selecciona");
       $qry=Doctrine_Query::create()
            ->where("status='ACTIVO'")
            ->from("Database_Model_CondicionesPago");
        foreach ($qry->execute() as $obj) {
            $element->addMultiOption($obj->nombre, $obj->nombre);
        }*/
        $element->addMultiOption("EFECTOS FISCALES AL PAGO", "EFECTOS FISCALES AL PAGO");
        $element->addMultiOption("CONTADO", "CONTADO");
        $element->addMultiOption("CREDITO", "CREDITO");
        $element->addMultiOption("20 DIAS", "20 DIAS");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("tipo_cambio");
        //$element->setLabel("Fecha");

        $element->setAttrib("style","width:100px");
        $element->setRequired(TRUE);
        $element->setValue("0");
        $this->addElement($element);

        $element = new Zend_Form_Element_Select("tipo_comprobante");
        //$element->setLabel("Tipo de comprobante");
        $element->setRequired(TRUE);
        $element->addMultiOption("ingreso", "Factura");
        $element->addMultiOption("egreso", "Nota de crédito");
        $this->addElement($element);

        $element = new Zend_Form_Element_Select("moneda");
        $element->setAttrib("class","chzn-select");
        $element->setRequired(TRUE);
        $element->addMultiOption("MXN", "MXN");
        $element->addMultiOption("USD", "USD");
        $element->addMultiOption("EUR", "EUR");
        $element->addMultiOption("GBP", "GBP");
        $element->addMultiOption("JPY", "JPY");
        $this->addElement($element);


        $element = new Zend_Form_Element_Select("forma_pago");
        $element->setAttrib("class","chzn-select");
        $element->setRequired(TRUE);
        // $element->addMultiOption("", "Favor de seleccionar");
        /* $element->addMultiOption("", "Selecciona");
            $qry=Doctrine_Query::create()
                  ->where("status='ACTIVO'")
                  ->from("Database_Model_FormaPago");
              foreach ($qry->execute() as $obj) {
                  $element->addMultiOption($obj->nombre, $obj->nombre);
              }*/
        $element->addMultiOption("PAGO EN UNA SOLA EXHIBICION", "PAGO EN UNA SOLA EXHIBICION");
        $this->addElement($element);





        
        $element = new Zend_Form_Element_Text("subtotal");
        $element->setLabel("Subtotal:");
        $element->setAttrib("class", "small-field");
        $element->removeDecorator("label");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("total");
        $element->setLabel("Total:");
        $element->setAttrib("class", "small-field");
        $element->setRequired(TRUE);
        $element->removeDecorator("label");
        $this->addElement($element);
        
       

        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));
    }

}