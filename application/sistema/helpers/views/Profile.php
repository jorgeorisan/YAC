<?php
/** 
 * @author Joe
 * 
 * 
 */
class Sistema_View_Helper_Profile extends Zend_View_Helper_Abstract {
	//TODO - Insert your code here
	public function profile() {
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
			return $identity;
		}else{
			return false;
		}
	}

}

?>