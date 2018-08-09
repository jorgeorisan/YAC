<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 09/04/12
 * Time: 17:07
 *
 */

class Supersecure_IndexController extends jfLib_Controller
{
    function int(){
        /********************para lo del email*************************/
        // $your_password = 'XYmL_TzmZPsJneAIw3IQTA';
        $your_password = 'Ao5N7oQ0rb3yOw/1TaD7Big8aTEZkI8YYrRgeWX1wOcW';

        //SMTP server configuration
        $smtpHost = 'email-smtp.us-east-1.amazonaws.com';
        $smtpConf = array(
            'auth' => 'login',
            'ssl' => 'tls',
            'username' => 'AKIAIN6BNSRLL23ZV5SQ', //El de la cuenta
            'password' => $your_password,
            'port' => 25
        );
        $transport = new Zend_Mail_Transport_Smtp($smtpHost, $smtpConf);
        Zend_Mail::setDefaultTransport($transport);

    }
    function indexAction(){
    $this->_disableLayout();

    }
}