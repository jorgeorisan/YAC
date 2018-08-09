<?php
/**
 * @author Joe
 *
 *
 */
class Doctores_View_Helper_Pid extends Zend_View_Helper_Abstract {
	//TODO - Insert your code here
	function pid($value, $places = 6){
        // Function written by Marcus L. Griswold (vujsa)
        // Can be found at http://www.handyphp.com
        // Do not remove this header!
        if(is_numeric($value)){
            $leading = 0;
            for($x = 1; $x <= $places; $x++){
                $ceiling = pow(10, $x);
                if($value < $ceiling){
                    $zeros = $places - $x;
                    for($y = 1; $y <= $zeros; $y++){
                        $leading .= "0";
                    }
                $x = $places + 1;
                }
            }
            $output = $leading . $value;
        }
        else{
            $output = $value;
        }
        return $output;
    }

}