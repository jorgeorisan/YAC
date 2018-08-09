<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:48
 *
 */

class Facturas_AdministrarController extends jfLib_Controller
{
    function indexAction()
    {

        $form = new jfLib_Form_Search();
        $form->populate($this->_request->getParams());
        // Defining initial variables
        if ($this->_request->getParam('p')) {
            $currentPage = $this->_request->getParam('p');
        } else {
            $currentPage = 1;
        }

        $resultsPerPage = 50;
        $url = $this->view->baseUrl($this->_request->getModuleName() . "/" . $this->_request->getControllerName());

        $query = Doctrine_Query::create()
            ->from("Database_Model_Factura")
            ->orderBy("id_factura DESC");

        if ($q = $this->_request->getParam("q")) {
            $query->where("id_factura = '$q'")
                ->orWhere("id_persona LIKE '%$q%'");
        }

        $pagerLayout = new jfLib_Paginator(
            new Doctrine_Pager(
                $query,
                $currentPage,
                $resultsPerPage
            ),
            new Doctrine_Pager_Range_Sliding(array(
                'chunk' => 5
            )),
            $url
        );
        $pagerLayout->setTemplate('<a href="{%url}?p={%page_number}">{%page}</a>');
        $pager = $pagerLayout->getPager();


        $this->view->query = $pager->execute();
        $this->view->paginator = $pagerLayout;

        $this->view->form = $form;
    }

    function altaAction()
    {

        $form = new Facturas_Form_Alta();

        if ($this->_request->getParam("mostrador") == "true") {
             $var= Doctrine_Query::create()
                ->select("SUM(total) as total")
                ->from("Database_Model_Venta")
                ->where("DATE(fecha) = DATE(NOW())")
                ->andWhere("cancelado != 1")

                ->fetchOne();
        }
        $this->view->ventasHoy=$var;
        $tienda = $this->_loggedUser->id_tienda;
        if ($this->_request->getParam("id_tienda")) {
            $tienda = $this->_request->getParam("id_tienda") ;
        }
        $this->view->id_tienda=$tienda;
        $folio = Doctrine_Query::create()
            ->from("Database_Model_DatosFacturacion")
            ->where("id_datos_facturacion = 1" )
            ->fetchOne();
        $this->view->folio=$folio->folio_actual+1;
        if ($this->_request->getParam("id_venta") ) {
        //este es el folio
            //$venta = Database_Model_Venta::getByFolio($this->_request->getParam("id_venta"));
            $venta= Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("folio =?",$this->_request->getParam("id_venta"))
                ->andWhere("id_tienda=?",$tienda)
                ->execute();
            $this->view->venta = $venta;
            $totalProds = 0;
            foreach ($venta->ProductosVenta as $prod) {
                $totalProds += $prod->total;
            }
            $this->view->descuento = $venta->total / $totalProds;
        }else{
            if($fechaini=$this->_request->getParam("desde")){
                $fechafin=$this->_request->getParam("hasta");
                $venta= Doctrine_Query::create()
                    ->from("Database_Model_Venta")
                    ->andwhere("DATE(date_format(str_to_date(`fecha`,'%Y-%m-%d'),'%Y-%m-%d')) >= '$fechaini'")
                    ->andwhere("DATE(date_format(str_to_date(`fecha`,'%Y-%m-%d'),'%Y-%m-%d')) <= '$fechafin'")
                    ->andWhere("id_tienda=?",$tienda)
                    ->andWhere("cancelado != 1")
                    ;
                $this->view->venta = $venta->execute();
    //echo  $venta->getSqlQuery();
                $totalProds = 0;
                foreach ($venta->ProductosVenta as $prod) {
                    $totalProds += $prod->total;
                }
                $this->view->descuento = $venta->total / $totalProds;
            }
        }

        if ($this->_request->isPost()) {

            $transaction = new jfLib_Doctrine_UnitOfWork();

            if ($form->isValid($this->_request->getParams())) {


                $cantidades = $this->_request->getPost("q");
                $nombres = $this->_request->getPost("nombre");
                $precios_uni = $this->_request->getPost("precio_unitario");
                $precios_tot = $this->_request->getPost("precio_total");


                for ($i = 0; $i < count($cantidades); $i++) {
                    try {
                        $items[] = array(
                            "cantidad" => $cantidades[$i],
                            "nombre" => $nombres[$i],
                            "precio_unitario" => $precios_uni[$i],
                            "precio_total" => $precios_tot[$i]
                        );
                    } catch (Exception $e) {
                    }
                }

                $cliente = Doctrine_Core::getTable("Database_Model_Persona")->findOneBy("id_persona", $this->_request->getPost("id_persona"));
                $api = new Sistema_Model_Cfdi();

                $clientearr = $cliente->toArray();
                $clientearr["num_exterior"] = trim($cliente->num_exterior);
                $clientearr["num_interior"] = trim($cliente->num_interior);
                $api->setReceptor($cliente->razon_social, trim($cliente->rfc), $clientearr);

                $datos = Doctrine_Core::getTable("Database_Model_DatosFacturacion")
                    ->findOneBy("predeterminado", 1);
                $api->setGenerales(
                    $datos->serie
                    , ++$datos->folio_actual
                    , $this->_request->getPost("fecha")
                    , $this->_request->getPost("total")
                    , $this->_request->getPost("subtotal")
                    , $this->_request->getPost("tipo")
                    , $this->_request->getPost("digitos") == "" ? null : $this->_request->getPost("digitos")
                    ,$this->_request->getPost("forma_pago")
                    , $this->_request->getPost("tipo_comprobante")
                    , "DISTRITO FEDERAL"
                    , $this->_request->getPost("condiciones_pago")
                );

                for ($i = 0; $i < count($cantidades); $i++) {
                    try {

                        $api->addConcepto($cantidades[$i], trim($nombres[$i]), $precios_uni[$i]);
                    } catch (Exception $e) {
                        echo $e;
                    }
                }


                $impuesto="";
                $tasa="";
                $ivamonto="";
                $iepsmonto="";
                if($this->_request->getPost("montoiva")){
                    $ivamonto = $this->_request->getPost("montoiva");
                    $impuesto="IVA";
                    $tasa=16;
                    $api->setTranslado($ivamonto,$impuesto,$tasa);
                }
                if($this->_request->getPost("montoieps")){
                    $iepsmonto = $this->_request->getPost("montoieps");
                    $impuesto="IEPS";
                    $tasa=8;
                    $api->setTranslado($iepsmonto,$impuesto,$tasa);
                }
                if($this->_request->getPost("montoiva")==0&&$this->_request->getPost("montoieps")==0){
                  
                    $impuesto="IVA";
                    $tasa=0;
                    $api->setTranslado(0,$impuesto,$tasa);
                }



                $response = $api->timbrar();

                //            return;
                if ($response["codigo"] != "0") {
                    $this->_informError(null, "No se pudo generar la factura. Código: " . $response["codigo"] . " Mensaje: " . $response["mensaje"]);
                    print_r($response);
                    return;
                }


                $factura = new Database_Model_Factura();

                $factura->folio = $datos->folio_actual;
                $factura->serie = $datos->serie;
                $factura->id_persona = $cliente->id_persona;
                $factura->id_usuario = $this->_loggedUser->id_usuario ;
                $factura->subtotal = ($this->_request->getPost("subtotal"));
                $factura->total = $this->_request->getPost("total");
                $factura->tipo_comprobante = $this->_request->getPost("tipo_comprobante");
                $factura->impuestos = number_format($this->_request->getPost("total") - $this->_request->getPost("subtotal"), 2, "", ".");
                $factura->urlpdf = $response["urlpdf"];
                $factura->urlxml = $response["urlxml"];
                $factura->iva = $ivamonto;
                $factura->ieps = $iepsmonto;
                $factura->exentos = $this->_request->getPost("montoexentos");
                $factura->fechainicial = $fechaini;
                $factura->fechafinal = $fechafin;
                $transaction = new jfLib_Doctrine_UnitOfWork();

                $transaction->registerModelForCreateOrUpdate($factura);
                $transaction->registerModelForCreateOrUpdate($datos);

//                if (isset($venta->id_venta)) {
//                    $venta->id_factura = $factura->folio;
//                    $transaction->registerModelForCreateOrUpdate($venta);
//                }

                $mail = new Zend_Mail("UTF-8");

                $mail->setSubject("Su factura");

                if ($cliente->email) {
                    $mail->addTo($cliente->email);
                }
                $mail->addCc("guillermo@trepsi.com.mx");
                $mail->addBcc("aaron@trepsi.com.mx;guillermo@trepsi.com.mx;jorge.orihuela@tigears.com");

                $mail->setFrom("no-reply@trepsi.com");
                $mail->setBodyHtml("<H1>SU FACTURA ESTA LISTA</H1><a href='" . $factura->urlpdf . "'>PDF</a><br /><a href='" . $factura->urlxml . "'>XML</a>");

                try {
                    try {
                        //$datos->folio_actual=$datos->folio_actual+1;
                        $datos->save();
                    } catch (Exception $e) {
                        echo $e;
                    }
                    $factura->save();

                    $mail->send();
                    //$transaction->commitAll();

                    $this->_informSuccess($response["mensaje"]);

                } catch (Exception $e) {
                    $this->_informError($e);
                }


            } else {
                echo "Error de validación";
            }
        }

        $this->view->form = $form;
    }

    function cancelarAction()
    {
        $this->_disableView();
        $obj = Doctrine_Core::getTable("Database_Model_Factura")
            ->findOneBy("id_factura", $this->_request->getParam("id"));

        $xml = file_get_contents($obj->urlxml);
        $array = Facturas_Model_XML2Array::createArray($xml);

        $uuid = ($array["cfdi:Comprobante"]["cfdi:Complemento"]["tfd:TimbreFiscalDigital"]["@attributes"]["UUID"]);

        $api = new Sistema_Model_Cfdi();

        $response = $api->cancelar($uuid);

        if ($response["codigo"] != "0") {
            $this->_informError(null, "No se pudo generar la factura. Código: " . $response["codigo"] . " Mensaje: " . $response["mensaje"]);
            print_r($response);
            return;
        }
        $obj->cancelada = 1;

        try {
            $obj->id_usuariocancelacion = $this->_loggedUser->id_usuario;
            $obj->fecha_cancelacion = date('Y-m-d h:i:s');
            $obj->save();

            $this->_informSuccess($response["mensaje"]);
        } catch (Exception $e) {
            echo $e;
        }


    }


    function verAction()
    {
        if (!$id = $this->_request->getParam("id")) {
            $this->_informError(null, "No puedes accesar al objeto que deseas.");
        }


        $form = new Facturas_Form_Archivos();

        $obj = Doctrine_Query::create()
            ->from("Database_Model_Factura")
            ->where("id_factura = ?", $id)
            ->fetchOne();
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $archivos = Zend_Json::decode($obj->archivos);
            if (!$archivos) {
                $archivos = array();
            }

            if ($form->file1->receive()) {
                $info = $form->file1->getFileInfo();
                if ($info ["file1"] ["name"]) {
                    $archivos[] = array(
                        "id" => time() . "-" . rand(100, 1000),
                        "archivo" => $info ["file1"] ["name"]
                    );
                }

            }


            $obj->archivos = Zend_Json::encode($archivos);

            try {
                $obj->save();
                $this->_informSuccess(null, false);
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }


        $this->view->form = $form;
        $this->view->obj = $obj;
    }

    function getcomisionesAction()
    {
        $this->_disableAllLayouts();

        $id = $this->_request->getParam("id");

        $obj = Database_Model_Persona::getById($id);

        if (!$obj) {
            die("");
        }
        echo "<tr>";
        echo "<td>";
        echo "<label>Tesorería</label>";
        echo "</td>";
        echo "<td>";
        echo "<input type='text'";

        if ($this->_loggedUser->tipo != "Administrador") {
            echo " readonly='readonly' ";
        }
        echo " class='small-field onlyadmin' name='comision_global' value='$obj->comision_global' />%";
        echo "</td>";
        echo "</tr>";

        foreach ($obj->ConfigComision as $iObj) {
            echo "<tr>";
            echo "<td>";
            echo "<label>" . $iObj->Usuario->nombre . "</label>";
            echo "</td>";
            echo "<td>";
            echo "<input type='text'";

            if ($this->_loggedUser->tipo != "Administrador") {
                echo " readonly='readonly' ";
            }
            echo " class='small-field onlyadmin' name='comision[$iObj->id_usuario]' value='$iObj->monto_comision' />%";
            echo "</td>";
            echo "</tr>";
        }

    }

    function getnumeroAction()
    {
        $this->_disableAllLayouts();

        $id = $this->_request->getParam("id");

        $obj = Database_Model_Empresa::getById($id);

        if (!$obj) {
            die("");
        }

        echo $obj->folio_actual;

    }


}