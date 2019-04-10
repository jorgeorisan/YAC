<?php
/**
 * @Filename:  Usuario.php
 * Location:   modules/compras/forms
 * Function:   Ofrece una forma para usuarios
 * @author:    Giovanni Alberto García
 * @version:   1.0
 */

/**
 * Esta clase ofrece una forma para usurios
 * Function: Ofrece la construcción y validación de la misma
 */
class Usuarios_Form_Usuario extends Zend_Form
{

    /**
     * El constructor de la forma
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('post');

        $login = $this->createElement('text', 'id_usuario');
        $login->setLabel('Usuario ID')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras, números y espacios')
            ->setAttrib('maxlength', '45')
            ->setAttrib('autocomplete', 'off')
            ->setRequired(true)

            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $username = $this->createElement('text', 'responsable');
        $username->setLabel('Nombre completo')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras y espacios')
            ->setAttrib('maxlength', '45')
            ->setAttrib('autocomplete', 'off')
            ->setRequired(true)
            ->addValidator('Alpha', false, array('allowWhiteSpace' => true))
            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $password = $this->createElement('password', 'password');
        $password->setLabel('Contraseña')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras y espacios')
            ->setAttrib('maxlength', '45')
            ->setAttrib('autocomplete', 'off')
            ->setRequired(true)
            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $confirmation = $this->createElement('password', 'confirmation');
        $confirmation->setLabel('Confirmación')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras y espacios')
            ->setAttrib('maxlength', '45')
            ->setAttrib('autocomplete', 'off')
            ->setRequired(true)
            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $nombre = $this->createElement('text', 'nombre');
        $nombre->setLabel('Nombre')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras y espacios')
            ->setAttrib('maxlength', '45')
            ->setAttrib('autocomplete', 'off')
            ->setRequired(true)
            ->addValidator('Alpha', false, array('allowWhiteSpace' => true))
            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $responsable = $this->createElement('text', 'responsable');
        $responsable->setLabel('Responsable')
            ->setAttrib('class', 'form-control')
            ->setAttrib('placeholder', 'Sólo letras y espacios')
            ->setRequired(true)
            ->addValidator('Alpha', false, array('allowWhiteSpace' => true))
            ->addValidator('StringLength', array('max' => 45))
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));

        $email = $this->createElement('text', 'email');
        $email->setLabel('Email')
            ->setAttrib('class', 'form-control')
            ->addDecorator(array('row' => 'HtmlTag'), array(
                'tag' => 'div', 'class' => 'form-group'));


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-success');

        // Add elements to form:
        $this->addElement($login)
            ->addElement($username)
            ->addElement($nombre)
            ->addElement($responsable)
            ->addElement($email)
            ->addElement($password)
            ->addElement($confirmation)
            ->addElement($submit);

        // add common filters (the method erases all)
        $this->setElementFilters(array(
                'StripTags', 'StringTrim')
        );
    }


    /**
     * Este método validará la forma
     * @param $data Los datos a validar
     * @return true si es válida y false si no
     */
    public function isValid($data)
    {
        $isValid = parent::isValid($data);

        //verificar que el id_usuario sea único
        $id_usuario = $this->getValue('id_usuario');
        $u = Doctrine_Query::create()
            ->from('Database_Model_Usuario')
            // no se haya eliminado
            ->where('activo = 1')
            ->andwhere('id_usuario = ?', $id_usuario)
            ->execute();
        // extraemos los objetos
        $u = $u->toArray();
        // Si existe uno activo
        if (!empty($u)) {
            $this->getElement('id_usuario')->addError(sprintf('El ID %s ya está registrado.', $id_usuario));
            $isValid = false;
        }

        $pass = $this->getValue('password');
        $conf = $this->getValue('confirmation');
        //Verificar si la contraseña es de al menos 8 caracteres
        if (strlen($pass) < 8) {
            $this->getElement('password')->addError('Las contraseña debe tener al menos 8 caracteres');
            $isValid = false;
        }
        // Verifica si las contraseñas coinciden
        if ($pass != $conf) {
            $this->getElement('confirmation')->addError('Las contraseñas no coinciden');
            $isValid = false;
        }

        return $isValid;
    }

}

?>