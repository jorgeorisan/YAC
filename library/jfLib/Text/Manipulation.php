<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 03/02/11
 * Time: 09:54
 * To change this template use File | Settings | File Templates.
 */
 
class jfLib_Text_Manipulation{

    public static function shortenText($text=null,$length=30){
        if($text && strlen(utf8_decode($text))>$length){
            return utf8_encode(substr(utf8_decode($text),0,$length)." ...");
        }else{
            return $text;
        }
    }
}