<?php
/** 
 * @author Joe
 * 
 * 
 */
class Login_LogoutController extends Zend_Controller_Action {
	//TODO - Insert your code here
	public function indexAction()
	{
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(TRUE);
		$auth = Zend_Auth::getInstance();
		if (!$auth->hasIdentity()) {
			$this->_redirect('/login');
		}
		$auth->clearIdentity();
        $loginAttempts = new Zend_Session_Namespace('loginAtempts');
        if(isset($loginAttempts->numberOfPageRequests)){
           unset($loginAttempts->numberOfPageRequests);
        }
		$this->_redirect('/login');
	}

}

?>