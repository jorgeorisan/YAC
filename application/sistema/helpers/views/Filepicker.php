<?php
/**
 * @author JFHE
 *
 *
 */
class Sistema_View_Helper_Filepicker extends Zend_View_Helper_Abstract
{
    //TODO - Insert your code here
    function filepicker($name, $val = "")
    {
        echo '<span id="badge-'.$name.'" class="badge badge-success" style="display:none;">Archivo cargado exitosamente :)</span>';
        echo '<input type="hidden" value="' . $val . '" name="' . $name . '" id="' . $name . '" />';
        echo '<input class="btn" onchange="document.getElementById(\'' . $name . '\').value=event.fpfile.url;document.getElementById(\'badge-' . $name . '\').style.display=\'block\';"
                                           data-fp-container="modal"
                                           data-fp-apikey="ATJG0tbQsTjuBPI4yA9Vxz" type="filepicker">';

    }

}