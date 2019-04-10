<?php
/**
* @Filename:  CambiarContrasenia.php
* Location:   modules/adminsitracions/forms
* Function:   Provee una forma para poder editar la contraseña del usuario que 
*             inicio sesión
* @author:    Giovanni Alberto García
* @version:   1.0
*/

/**
* This class 
* Function:  
*/
class Usuarios_Form_CambiarContrasenia extends Zend_Form{

  public function __construct() { 
    parent::__construct();

    $this->setMethod('post');

    $oldPass = $this->createElement('password', 'old_password');
    $oldPass->setLabel('Contraseña actual')
    ->setAttrib('class','form-control')
    ->setAttrib('placeholder','Sólo letras y espacios')
    ->setAttrib('maxlength','45')
    ->setAttrib('autocomplete','off')
    ->addValidator('StringLength',array('max' => 45))
    ->addDecorator(array('row'=>'HtmlTag'),array(
      'tag'=>'div','class'=>'form-group'));
    
    $newPass = $this->createElement('password', 'new_password');
    $newPass->setLabel('Contraseña nueva')
    ->setAttrib('class','form-control')
    ->setAttrib('placeholder','Sólo letras y espacios')
    ->setAttrib('maxlength','45')
    ->setAttrib('autocomplete','off')
    ->addValidator('StringLength',array('max' => 45))
    ->addDecorator(array('row'=>'HtmlTag'),array(
      'tag'=>'div','class'=>'form-group')); 

    $confPass = $this->createElement('password', 'conf_password');
    $confPass->setLabel('Confirmación')
    ->setAttrib('class','form-control')
    ->setAttrib('placeholder','Sólo letras y espacios')
    ->setAttrib('maxlength','45')
    ->setAttrib('autocomplete','off')
    ->addValidator('StringLength',array('max' => 45))
    ->addDecorator(array('row'=>'HtmlTag'),array(
      'tag'=>'div','class'=>'form-group'));

    $submit = new Zend_Form_Element_Submit('submit');
    $submit->setAttrib('class','btn btn-success');

    // Add elements to form:
    $this->addElement($oldPass)
    ->addElement($newPass)
    ->addElement($confPass)
    ->addElement($submit);

    // add common filters (the method erases all)
    $this->setElementFilters(array(
      'StripTags','StringTrim')
    );
  } 

  /**
  * This method is going to check if rfc is not in database
  * @param $data the data form to validate
  * @return true if is valid and false if not
  */
  public function isValid($data){
    $isValid = parent::isValid($data);

    // Verificar si la nueva contraseña no es muy corta
    $new = $this->getValue('new_password');
    if(strlen($new)<8){
      $this->getElement('new_password')->addError('La contraseña debe tener al menos 8 caracteres.');
      $isValid = false;
    }

    // Verificar si la nueva contraseña y la confirmación son iguales
    $conf = $this->getValue('conf_password');
    if($new != $conf){
      $this->getElement('conf_password')->addError('Las contraseñas no coindiden.');
      $isValid = false;
    }

    return $isValid;
  }

}

?>