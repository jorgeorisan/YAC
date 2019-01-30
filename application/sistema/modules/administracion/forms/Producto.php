<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 22:04
 *
 */

class Administracion_Form_Producto extends Zend_Form
{

    function __construct($options = null)
    {
        parent::__construct($options);

        $element = new Zend_Form_Element_Select("id_categoria");
        $element->setLabel("Categoría *");
        $element->setRequired(true);
        $element->setAttrib("class","selectnvo");
      //  $element->addMultiOption("", "Favor de seleccionar");
        foreach (Database_Model_Categoria::getAll() as $obj) {
            $element->addMultiOption($obj->id_categoria, $obj->categoria);
        }
        $this->addElement($element);

        $element = new Zend_Form_Element_Select("id_proveedor");
        $element->setLabel("Seccion *");
        $element->setRequired(true);
        $element->setAttrib("class","selectnvo");
       // $element->addMultiOption("1", "No asignado");
        foreach (Database_Model_Proveedor::getAll() as $obj) {
            $element->addMultiOption($obj->id_proveedor, $obj->nombre_corto);
        }
        $this->addElement($element);

        $element = new Zend_Form_Element_Select("id_marca");
        $element->setLabel("Marca *");
        $element->setRequired(true);
        $element->setAttrib("class","selectnvo");
        $element->addMultiOption("1", "No asignada");
        foreach (Database_Model_Marca::getAll() as $obj) {
            $element->addMultiOption($obj->id_marca, $obj->nombre);
        }
        $this->addElement($element);

        /*$element = new Zend_Form_Element_Select("tienda_id_tienda");
        $element->setLabel("Tienda *");
        $element->setRequired(true);

       // foreach (Database_Model_Tienda::getAll2() as $obj) {
            $element->addMultiOption("6", "BODEGA1");
            $element->addMultiOption("7", "BODEGA2");
       // }
        $this->addElement($element);
*/


        $element = new Zend_Form_Element_Text("codbarras");
        $element->setLabel("Código de barras ");
        //$element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("codinter");
        $element->setLabel("Codigo Interno *");
        $element->setRequired(TRUE);
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("nombre");
        $element->setLabel("Nombre *");
        $element->setRequired(TRUE);
        $this->addElement($element);

     /* $element = new Zend_Form_Element_Text("existencias");
        $element->setLabel("Existencias *");
        $element->setRequired(TRUE);
        $this->addElement($element); */


        $element = new Zend_Form_Element_Text("costo");
        $element->setLabel("Costo");
        $this->addElement($element);

        $element = new Zend_Form_Element_Text("precio");
        $element->setLabel("Precio *");
        $element->setRequired(TRUE);

        $this->addElement($element);

        $element = new Zend_Form_Element_Text("precio_descuento");
        $element->setLabel("Precio Mayoreo *");
        $element->setRequired(TRUE);
        
        $this->addElement($element);
        $element = new Zend_Form_Element_Text("precio_costo");
        $element->setLabel("Precio Costo ");

        $this->addElement($element);




        $element = new Zend_Form_Element_Select("paquete");
        $element->setLabel("Es un Paquete");
        $element->setRequired(TRUE);

        $element->setAttrib("class","selectnvo");
        $element->addMultiOption("0", "No");
        $element->addMultiOption("1", "Sí");
        $this->addElement($element);


        /* $element = new Zend_Form_Element_Text("precio_descuento");
         $element->setLabel("Precio descuento");
         $this->addElement($element);

         $element = new Zend_Form_Element_Select("descuento_activado");
         $element->setLabel("Descuento activado *");
         $element->setRequired(TRUE);
         $element->addMultiOption("0", "No");
         $element->addMultiOption("1", "Sí");
         $this->addElement($element);
 */
        $element = new Zend_Form_Element_Text("alerta_minima");
        $element->setLabel("Alerta de mínimo inventario *");
        $element->setRequired(TRUE);
        $element->setValue(1);
        $this->addElement($element);


        $this->addElement(new Zend_Form_Element_Submit("Aceptar"));

    }

}