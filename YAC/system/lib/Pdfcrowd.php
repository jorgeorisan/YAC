<?php
/**
 * Created by PhpStorm.
 * User: jfhernandeze
 * Date: 10/02/14
 * Time: 20:15
 */

include SYSTEM_DIR . "/config/classes/pdfcrowd.class.php";

class jfLib_Pdfcrowd extends PdfCrowd\HtmlToPdfClient
{

    function __construct($username = "jorge_orihuela", $apikey = "0324fe84027ce8a44afc7f2dfbab2c23", $hostname = null)
    {
        parent::__construct($username, $apikey, $hostname);
    }
}