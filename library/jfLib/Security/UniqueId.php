<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 24/10/11
 * Time: 16:24
 *
 */

class jfLib_Security_UniqueId
{


    public static function generate($id)
    {
        $length = 11;
        $idLength = 7;

        $min = 1;
        $max =9;

        for($k = 0; $k<$length-$idLength-1; $k++){
            $max*=10;
            $min*=10;
        }


        return jfLib_Security_AlphaId::alphaid(str_pad(rand($min,$max), $length-$idLength-1, '0', STR_PAD_LEFT).str_pad($id, $idLength, '0', STR_PAD_LEFT));
    }




}