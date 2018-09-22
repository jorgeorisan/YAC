<?php

/**
 * @author Dinkbit
 *
 *
 */
class Login_IndexController extends Zend_Controller_Action
{

    //TODO - Insert your code here
    public function indexAction()
    {
       


        $loginAttempts = new Zend_Session_Namespace('loginAtempts');
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_redirect('/');
        }

        if ($this->_request->getPost('next')) {
            $referer = $this->_request->getPost('next');
        } else {
            if (isset($_SERVER['HTTP_REFERER'])) {
                $referer = $_SERVER['HTTP_REFERER'];
            } else {
                $referer = "/";
            }
        }

        if ($loginAttempts->numberOfPageRequests >= 2) {
            $captcha = true;
        } else {
            $captcha = false;
        }

        $loginForm = new Login_Form_Login(null, array("next" => $referer, "captcha" => $captcha));

        //Checamos si se hizo un POST
        if ($this->_request->isPost()) {
            //Guardamos los datos del post en una variable
            $formData = $this->_request->getPost();

            //Checamos si el formulario fue llenado correctamente
            if ($loginForm->isValid($formData)) {
                $username = $this->_request->getPost('username');
                $password = $this->_request->getPost('password');

                // do the authentication
                $adapter = new Login_Model_Login($username, $password);
                $result = $auth->authenticate($adapter);
                if ($result->isValid()) {
                    // success : store database row to auth's storage system
                    // (not the password though!)
                    $randId = self::generateRandID();

                    $data = $result->getIdentity();

                    $data->session_id = $randId;

                    $auth->getStorage()->write($data);
                    $data->save();
                    $iObje = new Database_Model_BitacoraAccesos();
                    $iObje->id_usuario=$username;
                    $iObje->save();

                    if ($this->_request->getPost('next')) {
                        $this->_redirect($this->_request->getPost('next'));
                    } else {
                        $this->_redirect('/index');
                    }
                } else {
                    $message = $result->getMessages();
                    if (isset($loginAttempts->numberOfPageRequests)) {
                        $loginAttempts->numberOfPageRequests++;
                    } else {
                        $loginAttempts->numberOfPageRequests = 1; // first time
                    }
                    $this->_helper->messenger('error', $message[0]);
                }
            } else {
                // Llena los campos llenados correctamente
                $loginForm->populate($formData);
            }
        }

        $this->view->form = $loginForm;
    }

    public function generateRandID()
    {
        return md5(self::generateRandStr(16));
    }

    public function generateRandStr($length)
    {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }
}

?>