<?php
/** 
 * @author Joe
 * 
 * 
 */
class Sistema_Action_Helper_Profile extends Zend_Controller_Action_Helper_Abstract {
	//TODO - Insert your code here
	function direct() {
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			return $auth->getIdentity();
		}else{
			return false;
		}
	}

}

?>