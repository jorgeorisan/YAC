<?php
/**
 * @author Joe
 *
 *
 */
class Doctores_Action_Helper_Dbdate extends Zend_Controller_Action_Helper_Abstract {
	//TODO - Insert your code here
	function direct($date) {
		$locale = new Zend_Locale('es_MX');
        $format = new Zend_Date($date, $locale);
        return $format->toString('YYYY-MM-dd');
	}

}

?>