<?php
/**
* Formulario Login
*/
class Login_Form_Login extends Zend_Form
{
	public function __construct($options = null, $params = array()) 
	    { 
	        parent::__construct($options);
			
			$username = new Zend_Form_Element_Text('username',array("label"=>"Email",
                    "class"=>"required input-long"));
	        $username->addFilter('StringToLower')
	              ->setRequired(true)
				  ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => 'Porfavor ingresa tu email.')));

			$username->setDecorators(array(
			    'ViewHelper',
			    'Errors',
			    array('HtmlTag', array('tag' => 'span')),
			));
			$username->removeDecorator('label')->removeDecorator('HtmlTag');

	        $password = new Zend_Form_Element_Password('password', array("label"=>"Contraseña",
                    "class"=>"required input-long"));
	        $password->setRequired(true)
	                 ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => 'Porfavor ingresa tu contraseña.')));
			$password->setDecorators(array(
			    'ViewHelper',
			    'Errors',
			    array('HtmlTag', array('tag' => 'span')),
			));
			$password->removeDecorator('label')->removeDecorator('HtmlTag');

            


	        $submit = new Zend_Form_Element_Submit('submit');
	        $submit->setLabel('Entrar');
			$submit->setOptions(array('class' => 'boton'));
			$submit->removeDecorator('label')->removeDecorator('HtmlTag');
			
			if (isset($params['next'])) {
				$this->setAction('/login')
				     ->setMethod('post');
				$next = new Zend_Form_Element_Hidden('next');
		        $next->setValue($params['next']);
				$next->removeDecorator('label')->removeDecorator('HtmlTag');
				$this->addElement($next);
			}
			
	        $this->addElements(array($username, $password, $submit));
	    } 
}

?>