<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 20/10/11
 * Time: 10:46
 *
 */

class Ventas_ReportesController extends jfLib_Controller
{
    function init()
    {
        parent::init();


    }

    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function indexAction()
    {
        $this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());


        $query = Doctrine_Query::create()
            ->from("Database_Model_Venta")
            ->where("DATE(fecha) >= '$from'")
            ->andWhere("DATE(fecha) <= '$to'");


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }

    function porproveedorAction()
    {
        $this->_onlyAdmin();
        $form = new Ventas_Form_PorProveedor();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());

        $query = Doctrine_Query::create()
            ->select("SUM(pv.cantidad) AS total_cantidad, SUM(pv.total) AS total_total, *")
            ->from("Database_Model_ProductosVenta pv, pv.Venta v, pv.ProductoTienda p, p.Producto pr")
            ->where("DATE(v.fecha) >= '$from'")
            ->andWhere("DATE(v.fecha) <= '$to'")
            ->andWhere("pv.cancelado = ?", "0")
            ->orderBy("total_cantidad DESC")
            ->groupBy("pv.id_productotienda");

        if (!$this->_loggedUser->super_secure) {
            $query->andWhere("v.no_calculable = 0");
        }

        if ($idProveedor = $this->_request->getParam("id_proveedor")) {
           $query->andWhere("pr.id_proveedor = ?", $idProveedor);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function porproductoAction()
    {
        $this->_onlyAdmin();
        $form = new Ventas_Form_PorProducto();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());

        $query = Doctrine_Query::create()
            ->select("SUM(pv.cantidad) AS total_cantidad, SUM(pv.total) AS total_total, *")
            ->from("Database_Model_ProductosVenta pv, pv.Venta v, pv.ProductoTienda p, p.Producto pr")
            ->where("DATE(v.fecha) >= '$from'")
            ->andWhere("DATE(v.fecha) <= '$to'")
            ->andWhere("pv.cancelado = ?", "0")
            ->orderBy("total_cantidad DESC")
            ->groupBy("pv.id_productotienda");

        if (!$this->_loggedUser->super_secure) {
            $query->andWhere("v.no_calculable = 0");
        }

        if ($idProducto = $this->_request->getParam("id_producto")) {
            $query->andWhere("pr.id_producto = ?", $idProducto);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }

    function pormarcaAction()
    {
        $this->_onlyAdmin();
        $form = new Ventas_Form_PorMarca();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());

        $query = Doctrine_Query::create()
            ->select("SUM(pv.cantidad) AS total_cantidad, SUM(pv.total) AS total_total, pv.id_tienda, *")
            ->from("Database_Model_ProductosVenta pv, pv.Venta v, pv.ProductoTienda pt, pt.Producto p")
            ->where("DATE(v.fecha) >= '$from'")
            ->andWhere("DATE(v.fecha) <= '$to'")
            ->andWhere("pv.cancelado = ?", "0")
            ->orderBy("total_cantidad DESC")
            ->groupBy("pv.id_productotienda,pv.id_tienda");



        if ($idMarca = $this->_request->getParam("id_marca")) {

            $query->andWhere("p.id_marca = ?", $idMarca);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }

}