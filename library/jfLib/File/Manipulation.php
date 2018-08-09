<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 30/03/11
 * Time: 12:15
 * To change this template use File | Settings | File Templates.
 */

class jfLib_File
{

    public static function getFileContents($url = null)
    {

        if ($url) {
            $filename = $url;
            $handle = fopen($filename, 'r');
            $data = fread($handle, filesize($filename));
            return $data;
        } else {
            return null;
        }
    }

}