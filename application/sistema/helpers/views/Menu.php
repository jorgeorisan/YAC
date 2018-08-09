<?php
/** 
 * @author Joe
 * 
 * 
 */
class Doctores_View_Helper_Menu extends Zend_View_Helper_Abstract {
	//TODO - Insert your code here
	public function menu($string = "") {
		$front = Zend_Controller_Front::getInstance();
		$module = $front->getRequest()->getModuleName();
		if(trim($string) == ""){
			if($module == "micuenta"){
				return ucfirst('Mi cuenta');
			}elseif ($module == "default"){
				return ucfirst('Landing');
			}else{
				return ucfirst($module);
			}
		}else{
			if ($string == $module) {
				return 'sidebar-menu-active';
			}else{
				return 'sidebar-menu-list';
			}
		}
		
	}

}

?>