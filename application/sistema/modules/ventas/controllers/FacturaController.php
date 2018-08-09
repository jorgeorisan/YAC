<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 14/05/12
 * Time: 10:54
 *
 */

class Ventas_FacturaController extends jfLib_Controller
{

    function altaAction()
    {
        $ventas = array();
        $subtotal = 0;
        $total = 0;
        $impuestos = 0;
        $items = array();
        foreach ($this->_request->getParam("venta") as $idVenta) {
            $venta = Database_Model_Venta::getById($idVenta);
            $ventas[] = $venta;

            $total += $venta->total;
            foreach ($venta->ProductosVenta as $iobj) {
                $items[] = $iobj->toArray();
            }
        }
        $subtotal = number_format($total, 2, ".", "") / 1.16;
        $impuestos = number_format($total, 2, ".", "") - $subtotal;

        $this->view->subtotal = number_format($subtotal, 2, ".", "");
        $this->view->impuestos = number_format($impuestos, 2, ".", "");
        $this->view->total = number_format($total, 2, ".", "");

        $form = new Ventas_Form_Factura();

        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $obj = new Database_Model_Factura();

            $obj->fromArray($this->_request->getPost());
            $obj->total = $this->view->total;
            $obj->subtotal = $this->view->subtotal;
            $obj->iva = $this->view->impuestos;
            $obj->items = Zend_Json::encode($items);

            $numLetra = new jfLib_Text_NumeroaLetra();
            $numLetra->setNumero($total);
            $obj->cantidad_letra = $numLetra->letra();

            foreach ($ventas as $venta) {
                $iobj = new Database_Model_FacturaHasVenta();
                $iobj->id_venta = $venta->id_venta;

                $obj->FacturaHasVenta->add($iobj);
            }

            try {
                $obj->save();
                $id = $obj->getIncremented();
                $this->_informSuccess(null, true, "ventas/factura/ver?id=" . $id);
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }

        $this->view->form = $form;
    }

    function verAction()
    {
        $this->view->obj = Database_Model_Factura::getById($this->_request->getParam("id"));
        $form = new Ventas_Form_Factura();
        $form->populate($this->view->obj->toArray());
        $this->view->form = $form;
    }

    function imprimirAction()
    {
        include APPLICATION_PATH . "/../../library/dompdf/dompdf_config.inc.php";

        $this->_disableAllLayouts();
        $idFactura = $this->_request->getParam("id");
        $obj = Database_Model_Factura::getById($idFactura);

        $html = file_get_contents("http://container.app.tigears.com/ventas/factura/renderfactura?id_factura=$idFactura");
//                echo $html;
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("Factura_" . $idFactura . ".pdf");
    }

    function renderfacturaAction()
    {
        $this->_disableLayout();
        $idFactura = $this->_request->getParam("id_factura");
        $obj = Database_Model_Factura::getById($idFactura);

        $this->view->obj = $obj;
    }
}