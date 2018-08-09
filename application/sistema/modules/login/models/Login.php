<?php
/** 
 * @author Joe
 * 
 * 
 */
class Login_Model_Login implements Zend_Auth_Adapter_Interface {
	//TODO - Insert your code here
	const NOT_FOUND_MESSAGE = "Tu cuenta no existe";
    const BAD_PW_MESSAGE = "La contraseña es invalida";
    const NOT_ACTIVE_MESSAGE = "No has activado tu cuenta";
    
    /**
     *
     * @var Login_Model_User
     */
    protected $user;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     *
     * @var string
     */
    protected $password;

    public function __construct($username , $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result
     */
    public function authenticate()
    {
        try
        {
            $this->user = Login_Model_Auth::authenticate($this->username, $this->password);
        }
        catch (Exception $e)
        {
            if ($e->getMessage() == Login_Model_Auth::WRONG_PW)
                return $this->result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, self::BAD_PW_MESSAGE);
            if ($e->getMessage() == Login_Model_Auth::NOT_FOUND)
                return $this->result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, self::NOT_FOUND_MESSAGE);
            if ($e->getMessage() == Login_Model_Auth::NOT_ACTIVE)
                return $this->result(Zend_Auth_Result::FAILURE_UNCATEGORIZED, self::NOT_ACTIVE_MESSAGE);
        }
        return $this->result(Zend_Auth_Result::SUCCESS);
    }

    /**
     * Factory for Zend_Auth_Result
     *
     *@param integer    The Result code, see Zend_Auth_Result
     *@param mixed      The Message, can be a string or array
     *@return Zend_Auth_Result
     */
    public function result($code, $messages = array()) {
        if (!is_array($messages)) {
            $messages = array($messages);
        }

        return new Zend_Auth_Result(
            $code,
            $this->user,
            $messages
        );
    }
}