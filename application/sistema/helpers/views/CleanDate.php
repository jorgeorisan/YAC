<?php
class Doctores_View_Helper_CleanDate extends Zend_View_Helper_Abstract { 
    function CleanDate($date, $format = 'short')
    {
		switch ($format){
			case "short":
				$locale = new Zend_Locale('es_MX');
       			$format = new Zend_Date($date, $locale);
				return $format->toString('dd MMM YYYY');
				break;
			case "long":
				$locale = new Zend_Locale('es_MX');
       			$format = new Zend_Date($date, $locale);
				return $format->toString('dd MMM YYYY HH:mm:ss');
				break;
		}
    } 
} 