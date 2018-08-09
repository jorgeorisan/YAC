<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 11/11/12
 * Time: 23:56
 *
 */

class Sistema_Model_Cfdi
{

    public $archivoKey = "tre960930u8a_1306251005s.key";
    public $archivoCer = "00001000000300374108.cer";
    public $passwordKey = "TRE55401920";
    
    public $directorioXML = "xml-3.2";
    public $dir = "trepsi";

	//public $user = "cfdi@789.mx";
	//public $password = "facturascfdi";
    public $user = "cfdi@789.mx";
    public $password = "facturascfdi";

    public $razonSocial = "Trepsi SA de CV";
    public $rfc = "TRE960930U8A";

    public $direccionFiscal = array(
        "calle" => "Av Palo Solo",
        "num_ext" => "14",
        "num_int" => null,
        "colonia" => "Hacienda de las Palmas",
        "ciudad" => "Huixquilucan",
        
        "cp" => "52763",
        "estado" => "Estado de México",
        "pais" => "MÉXICO",
        "localidad" => "Huixquilucan",
        "referencia" => null
    );
    public $regimen = "REGIMEN GENERAL DE LEY PERSONAS MORALES";

    public $generales = null;


    public $datosFiscales = array();
    public $conceptos = array();
    public $translados = array();

    public $receptor = array();

    public $data = array();

    function __construct()
    {
        $this->data["main"] = array(
            "archivoKey" => $this->archivoKey,
            "archivoCer" => $this->archivoCer,
            "passwordKey" => $this->passwordKey,
            "baseDir" => $this->dir,
            "user" => $this->user,
            "password" => $this->password,
            "razonSocial" => $this->razonSocial,
            "rfc" => $this->rfc,
            "direccionFiscal" => $this->direccionFiscal,
            "regimen" => $this->regimen,
        );
    }


    public function setReceptor($razon_social, $rfc, $direccion)
    {
        $this->data["receptor"]["razon_social"] = $razon_social;
        $this->data["receptor"]["rfc"] = $rfc;
        $this->data["receptor"]["direccion"] = $direccion;

    }


    public function setGenerales(
        $serie,
        $folio,
        $fecha,
        $total,
        $subtotal,
        $metodoDePago = "EFECTIVO",
        $numCta = "",
        $formaDePago = "PAGO EN UNA SOLA EXHIBICION",
        $tipo = "ingreso",
        $lugar = "DISTRITO FEDERAL",
        $condicionespago

    )
    {
        $this->data["generales"] = array(
            "serie" => $serie,
            "folio" => $folio,
            "fecha" => $fecha,
            "total" => $total,
            "subtotal" => $subtotal,
            "metodoDePago" => $metodoDePago,
            "formaDePago" => $formaDePago,
            "tipo" => $tipo,
            "lugar" => $lugar,
            "numCta" => $numCta,
            "condiciones_pago" => $condicionespago
        );
    }

    public function addConcepto($cantidad, $nombre, $precioUnitario, $unidad = "PIEZA")
    {

        $this->data["conceptos"][] = array("nombre" => $nombre, "unidad" => $unidad, "cantidad" => $cantidad, "precioUnitario" => $precioUnitario);
    }

    public function setTranslado($monto, $impuesto = "IVA", $tasa = 16)
    {

        $this->data["translado"][] = array(
            "monto" => $monto,
            "impuesto" => $impuesto,
            "tasa" => $tasa
        );
    }

    public function dataJson()
    {

        return Zend_Json::encode($this->data);
    }

    public function timbrar()
    {

        $http = new Zend_Http_Client("http://198.61.227.33/~tigears/rhinoapi/api-new2.php");
        $http->setMethod(Zend_Http_Client::POST);
		$http->setConfig(array('timeout'=>90));
        $http->setParameterPost(array(
            "obj" => $this->dataJson()
        ));
        $response = $http->request();
        //echo "fer".$response->getBody();
//        echo $response->getBody();
//        return;
        return Zend_Json::decode($response->getBody());
    }

    public function timbrarPrueba()
    {
        $http = new Zend_Http_Client("http://198.61.227.33/~tigears/rhinoapi/api-new2.php");
        $http->setMethod(Zend_Http_Client::POST);
        $http->setParameterPost(array(
            "obj" => $this->dataJson(),
            "prueba" => 1
        ));
        $response = $http->request();

        return Zend_Json::decode($response->getBody());
    }
	
	 public function cancelar($uid)
    {
        $this->data["uuid"] = $uid;

        $http = new Zend_Http_Client("http://198.61.227.33/~tigears/rhinoapi/api-new2.php");
        $http->setMethod(Zend_Http_Client::POST);
		 $http->setConfig(array('timeout'=>90));
        $http->setParameterPost(array(
            "obj" => $this->dataJson(),
            "metodo" => "cancelar"
        ));
        $response = $http->request();

        return Zend_Json::decode($response->getBody());
    }



}
