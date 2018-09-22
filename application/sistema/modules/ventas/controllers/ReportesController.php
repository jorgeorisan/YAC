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
    //$this->_onlyAdmin();
    $form = new Ventas_Form_Reporte();

    $from = date("Y-m-d");
    $to   = date("Y-m-d");

    if ($this->_request->getParam("from")) $from = $this->_request->getParam("from");

    if ($this->_request->getParam("to"))   $to = $this->_request->getParam("to");

    $this->view->to   = $to;
    $this->view->from = $from;
    $form->from->setValue($from);
    $form->to->setValue($to);

    $form->populate($this->_request->getParams());
  
    $query = Doctrine_Query::create()
        ->from("Database_Model_Venta")
        ->where("DATE(fecha) >= '$from'")
       // ->andWhere("folio>1")
        ->andWhere("DATE(fecha) <= '$to'");
    $querycomi = Doctrine_Query::create()
        ->select("SUM(v.total) as total, v.id_usuario id_usuario")
        ->from("Database_Model_Venta v")
        ->where("DATE(v.fecha) >= '$from'")
        //->andWhere("folio>1")
        ->andWhere("DATE(v.fecha) <= '$to'")
        ->groupBy("v.id_usuario");
    //echo $querycomi->getSqlQuery();
    if ($this->_request->getParam("credito")) {
        $form->credito->setValue(1);
        $this->view->credito=1;
        $query->andWhere("tipo='Credito'");
        $querycomi->andWhere("tipo='Credito'");
    }
    if($this->_loggedUser->id_usuario_tipo!=2){
        $this->view->id_tienda=$this->_loggedUser->id_tienda;
        $query->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
        $querycomi->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
    }


    if ($id_usuario = $this->_request->getParam("id_usuario")) {
        $query->andWhere("id_usuario = ?", $id_usuario);
        $querycomi->andWhere("id_usuario = ?", $id_usuario);
        $this->view->id_usuario=$id_usuario;
    }
    if ($id_tienda = $this->_request->getParam("id_tienda")) {
        $this->view->id_tienda = $id_tienda;
        $query->andWhere("id_tienda = ?", $id_tienda);
        $querycomi->andWhere("id_tienda = ?", $id_tienda);
    }

    $this->view->usu=$this->_loggedUser->id_usuario;
    $this->view->query = $query->execute();
    $this->view->querycomisiones = $querycomi->execute();
    $this->view->form = $form;

}
    function creditosAction()
    {
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");

        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");

        }
        $this->view->to=$to;
        $this->view->from=$from;
        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
     
        $query = Doctrine_Query::create()
            ->from("Database_Model_Venta")
            ->where("DATE(fecha) >= '$from'")
            ->andWhere("DATE(fecha) <= '$to'");
        $querycomi = Doctrine_Query::create()
            ->select("SUM(v.total) as total, v.id_usuario id_usuario")
            ->from("Database_Model_Venta v")
            ->where("DATE(v.fecha) >= '$from'")
            ->andWhere("DATE(v.fecha) <= '$to'")
            ->groupBy("v.id_usuario");
        //echo $querycomi->getSqlQuery();
        if ($this->_request->getParam("credito")) {
            $form->credito->setValue(1);
            $this->view->credito=1;
            $query->andWhere("tipo='Credito'");
            $querycomi->andWhere("tipo='Credito'");
        }
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
            $querycomi->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
        }


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
            $querycomi->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $querycomi->andWhere("id_tienda = ?", $id_tienda);
        }


        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->querycomisiones = $querycomi->execute();
        $this->view->form = $form;

    }
    function abonosAction()
    {
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");

        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");

        }
        $this->view->to=$to;
        $this->view->from=$from;
        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
     
        $query = Doctrine_Query::create()
            ->from("Database_Model_Deudores")
            ->where("DATE(fecha_abono) >= '$from'")
            ->andWhere("DATE(fecha_abono) <= '$to'");
       
        //echo $querycomi->getSqlQuery();
        if ($this->_request->getParam("credito")) {
            $form->credito->setValue(1);
            $this->view->credito=1;
            $query->andWhere("tipo='Credito'");
            $querycomi->andWhere("tipo='Credito'");
        }
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
            $querycomi->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);
        }


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
            $querycomi->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $querycomi->andWhere("id_tienda = ?", $id_tienda);
        }


        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function detallesAction()
    {
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }
        $this->view->to=$to;
        $this->view->from=$from;
        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
       
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query = Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);

        }else{
            $query = Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'");
        }
        $queryabono = Doctrine_Query::create()
            ->select("sum(v.montoabono) as total")
            ->from("Database_Model_Deudores v")
            ->where("DATE(v.fecha_abono) >= '$from'")
            ->andWhere("DATE(v.fecha_abono) <= '$to'");

        //echo $queryabono->getSqlQuery();



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
            $queryabono->andWhere("v.id_usuario=?",$id_usuario);
            $this->view->id_usuario=$id_usuario;
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }

        $this->view->queryabono=$queryabono->fetchOne();
        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function detallescontaAction()
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
      
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query = Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda);

        }else{
            $query = Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'");
        }


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }


        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function getMonthDays($Month, $Year)
    {
        //Si la extensión que mencioné está instalada, usamos esa.
        if( is_callable("cal_days_in_month"))
        {
            return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
        }
        else
        {
            //Lo hacemos a mi manera.
            return date("d",mktime(0,0,0,$Month+1,0,$Year));
        }
    }

    function comisionesAction()
    {
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");
        if($this->_request->getParam("quincena")) {
            if ($this->_request->getParam("quincena") == '1') {
                $from = $this->_request->getParam("anio") . '-' . $this->_request->getParam("mes") . "-01";
                 $to = $this->_request->getParam("anio") . '-' . $this->_request->getParam("mes") . "-15";
            } else {
                  $from = $this->_request->getParam("anio") . '-' . $this->_request->getParam("mes") . "-15";
                //Obtenemos la cantidad de días que tiene septiembre del 2008
                 $dias = $this->getMonthDays($this->_request->getParam("mes"), $this->_request->getParam("anio"));
                 $to = $this->_request->getParam("anio") . '-' . $this->_request->getParam("mes") . "-".$dias;
            }
            $this->view->anio = $this->_request->getParam("anio") ;
            $this->view->mes = $this->_request->getParam("mes") ;
            $this->view->quincena = $this->_request->getParam("quincena") ;
        }



        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
        if ($this->_request->isPost()) {

            $obj = new Database_Model_Comisiones();
            $obj->fromArray($this->_request->getPost());
            $obj->id_usuario = $this->_loggedUser->id_usuario;

            //recibimos los arrays
            $idsusuario = $this->_request->getPost("idsusuario");
            $totalvtas = $this->_request->getPost("totalvtas");
            $totalasis = $this->_request->getPost("totalasis");


            $id_tienda = $this->_request->getPost("id_tienda");
            $montocomi = $this->_request->getPost("montocomi");
            $porcen = $this->_request->getPost("porcen");
            $totalcomi = $this->_request->getPost("totalcomi");

            foreach ($idsusuario as $key => $val) {

                $iObj = new Database_Model_ComisionesVendedor();
                $iObj->idsusuario = $idsusuario[$key];
                $iObj->totalvtas = $totalvtas[$key];
                $iObj->totalasis = $totalasis[$key];

                $iObj->id_tienda = $id_tienda[$key];
                $iObj->montocomi = $montocomi[$key];
                $iObj->porcen = $porcen[$key];
                $iObj->totalcomi = $totalcomi[$key];
                try {

                    $descgastos = $this->_request->getPost("descgastos");
                    $conceptodescgastos = $this->_request->getPost("conceptodescgastos");
                    $mtdes=0;
                    foreach ($descgastos[$key] as $key2 => $val2) {
                        if($descgastos[$key][$key2]>0){
                            echo $descgastos[$key][$key2];
                            echo $conceptodescgastos[$key][$key2];
                            $mtdes+=$descgastos[$key][$key2];

                            $iObj2 = new Database_Model_DescgastosComision();
                            $iObj2->monto = $descgastos[$key][$key2];
                            $iObj2->concepto = $conceptodescgastos[$key][$key2];

                            try {
                                $iObj->DescgastosComision->add($iObj2);
                            } catch (Exception $e) {
                                echo "error al guardar concepto gastos";
                                exit;
                            }
                        }
                    }

                    $iObj->descgastos = $mtdes;
                    $obj->ComisionesVendedor->add($iObj);
                } catch (Exception $e) {
                    echo "error al guardar comisiones de vendedor";
                    exit;
                }
            }//end foreach

            try {
                $obj->save();
                $this->_informSuccess("Comisiones guardadas con Exito!!", true, "ventas/reportes/comisiones/");
            } catch (Exception $e) {
                $this->_informError($e);
            }

        }
       
        if ($id_usuario = $this->_request->getParam("id_usuario")) {
        }

        if($this->_loggedUser->id_usuario_tipo!=2){
            $query = Doctrine_Query::create()
                ->select("uv.id_venta")
                ->from("Database_Model_UsuariosVenta uv,uv.Venta  v")
                //->where("v.cancelado=0")
                ->andwhere("DATE(v.fecha) >= '$from'")
                ->andWhere("DATE(v.fecha) <= '$to'")
                ->andWhere("v.id_tienda=?",$this->_loggedUser->id_tienda)
                ->groupBy('uv.id_venta');
            $query->andWhere("id_usuario = ?", $id_usuario);

            $query2 = Doctrine_Query::create()
                ->select("uv.id_usuario,sum(uv.monto) total")
                ->from("Database_Model_UsuariosVenta uv,uv.Venta  v")
                ->where("v.cancelado=0")
                ->andwhere("DATE(v.fecha) >= '$from'")
                ->andWhere("DATE(v.fecha) <= '$to'")
                ->andWhere("v.id_tienda=?",$this->_loggedUser->id_tienda)
                ->groupBy('uv.id_usuario');
        }else{
            $query = Doctrine_Query::create()
                ->select("uv.id_venta")
                ->from("Database_Model_UsuariosVenta uv,uv.Venta  v")
                //->where("v.cancelado=0")
                ->andwhere("DATE(v.fecha) >= '$from'")
                ->andWhere("DATE(v.fecha) <= '$to'")
                ->groupBy('uv.id_venta');

            $query2 = Doctrine_Query::create()
                ->select("uv.id_usuario,sum(uv.monto) total")
                ->from("Database_Model_UsuariosVenta uv,uv.Venta  v")
                ->where("v.cancelado=0")
                ->andwhere("DATE(v.fecha) >= '$from'")
                ->andWhere("DATE(v.fecha) <= '$to'")
                ->groupBy('uv.id_usuario')
               ;
        }


        $id_usuario = $this->_request->getParam("id_usuario");

        if ($id_usuario !='#'&& $id_usuario !='') {
            $query->andWhere("uv.id_usuario = ?", $id_usuario);
            $query2->andWhere("uv.id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("v.id_tienda = ?", $id_tienda);
            $query2->andWhere("v.id_tienda = ?", $id_tienda);
        }
        //echo $query2->getSqlQuery();//imprime la consulta qu ese esta generando
        $this->view->vendedor=$id_usuario;
        $this->view->query = $query->execute();
        $this->view->from = $from;
        $this->view->to = $to;
        $this->view->queryvendmontos = $query2->execute();

    }
    function comisionesreporteAction()
    {
        //$this->_onlyAdmin();
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
                ->from("Database_Model_ComisionesVendedor cv,cv.Comisiones c")
                ->where("DATE(c.fecha_registro) >= '$from'")
                ->andWhere("DATE(c.fecha_registro) <= '$to'")
              ;
        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("idsusuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }
        //echo $query2->getSqlQuery();//imprime la consulta qu ese esta generando
        $this->view->usu=$id_usuario;
        $this->view->query = $query->execute();
        $this->view->from = $from;
        $this->view->to = $to;
        $this->view->form = $form;

    }
    function devolucionesAction()
    {
        //$this->_onlyAdmin();
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
     
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaCancelada a, a.Venta v" )
                ->where("DATE(fecha_registro) >= '$from'")
                ->andWhere("DATE(fecha_registro) <= '$to'")
                ->andWhere("v.cancelado=1")
                ->andWhere("v.id_tienda=?",$this->_loggedUser->id_tienda);
        }else{
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaCancelada a, a.Venta v")
                ->where("DATE(a.fecha_registro) >= '$from'")
                ->andWhere("v.cancelado=1")
                ->andWhere("DATE(a.fecha_registro) <= '$to'");
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("v.id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("v.id_tienda = ?", $id_tienda);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("v.id_tienda = ?", $id_tienda);
            $query->andWhere("v.id_usuario = ?", $id_usuario);
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function devolucionesproductoAction()
    {
        //$this->_onlyAdmin();
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
        
        if($this->_loggedUser->id_usuario_tipo!=2){
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado a,a.ProductosVenta b,a.Usuario u")
                ->where("DATE(a.fecha_registro) >= '$from'")
                ->andWhere("DATE(a.fecha_registro) <= '$to'")
                //->andWhere("a.cancelado=1")
                ->andWhere("u.id_tienda=?",$this->_loggedUser->id_tienda);
        }else{
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado a,a.ProductosVenta b,a.Usuario u")
                ->where("DATE(a.fecha_registro) >= '$from'")
              //  ->andWhere("a.cancelado=1")
                ->andWhere("DATE(a.fecha_registro) <= '$to'");
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("u.id_tienda = ?", $id_tienda);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("u.id_tienda = ?", $id_tienda);
            $query->andWhere("id_usuario = ?", $id_usuario);
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function alertaminimainventarioAction()
    {
        //$this->_onlyAdmin();
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
       
        ////////////////////////////////////////
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

        if($this->_loggedUser->id_usuario_tipo){
            $query = Doctrine_Query::create()
                ->select("pt.id_producto , pt.tienda_id_tienda ,pt.existencias ,p.alerta_minima ")
                ->from("Database_Model_ProductoTienda pt, pt.Producto p")
                ->Where("tienda_id_tienda=12")
                ->andWhere("pt.existencias < p.alerta_minima")
                ->groupBy("pt.id_producto, pt.tienda_id_tienda, p.alerta_minima, pt.alerta_minima")
               // ->having("pt.existencias < p.alerta_minima")
                ->orderBy("p.codinter");
        }else{
            $query = Doctrine_Query::create()
                ->select("pt.id_producto , pt.tienda_id_tienda ,pt.existencias ,p.alerta_minima as alerta_minima2 ")
                //->select("pt.id_producto id_producto, pt.tienda_id_tienda id_tienda,pt.existencias existencias,p.alerta_minima alerta_minima")
                ->from("Database_Model_ProductoTienda pt, pt.Producto p,pt.Tienda t")
                ->where("pt.existencias < p.alerta_minima")
                ->groupBy("pt.id_producto, pt.tienda_id_tienda, p.alerta_minima")
             //   ->having("pt.existencias < p.alerta_minima")
                ->orderBy("p.codinter");
        }
       // echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
        if ($q = $this->_request->getParam("q")) {//para la busqueda
            $query->andWhere("t.nombre LIKE '%$q%'");
            $query->orWhere("p.nombre LIKE '%$q%'");
            $query->orWhere("p.codbarras = ?", $q);
            $query->orWhere("p.codinter = ?", $q);
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

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $pager->execute();
        $this->view->paginator = $pagerLayout;
        $this->view->form = $form;

        $this->view->counter = ($resultsPerPage * ($currentPage - 1)) + 1;



    }
    function corteventaAction(){
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Reporte();

        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }
        if ( $this->_request->getParam("id_tienda")=="") {
          // echo "<script>alert('Selecciona una tienda');</script>";
        }

        $form->from->setValue($from);
        $form->to->setValue($to);

        $form->populate($this->_request->getParams());
        

            $query = Doctrine_Query::create()
                ->select("vc.tipo as tipo  ,  sum(vc.total) total,vc.id_tienda as id_tienda  ,vc.nombre  nombre, vc.abono  abono,vc.id_usuario  id_usuario, vc.fecha  fecha")
                ->from("Database_Model_Ventascorte vc")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->groupBy("vc.tipo, vc.id_tienda, vc.abono, vc.id_usuario");

                //->groupBy("'tipo,id_tienda,nombre,abono,id_usuario,fecha' ");
               // ->orderBy('nombre');

         //echo $query->getSqlQuery();//imprime la consulta qu ese esta generando

        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
        }

        $querydesc="";
        ///////////////////////////////////////DETALLE///////////////////////////////////////////////////

            $query2 = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->orderBy('id_venta');
            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                //->orderBy('')
               ;
            $querydev = Doctrine_Query::create()
                ->from("Database_Model_VentaCancelada d,d.Venta vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")

            ;
            $querydevp = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado d,d.ProductosVenta pv,pv.Venta v")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")

            ;



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query2->andWhere("id_usuario = ?", $id_usuario);
        }


        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query2->andWhere("id_tienda = ?", $id_tienda);
            $querydesc->andWhere("vc.id_tienda=?",$id_tienda);
            $querydev->andWhere("vc.id_tienda=?",$id_tienda);
            $querydevp->andWhere("v.id_tienda=?",$id_tienda);
            $this->view->tienda=$id_tienda;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////
        //echo $query->getSqlQuery();

        if($querydesc->execute()){
            $this->view->querydesc =$querydesc->execute();
        }
        if($querydev->execute()){
            $this->view->querydev =$querydev->execute();
        }
        if($querydevp->execute()){
            $this->view->querydevp =$querydevp->execute();
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->tipousu=$this->_loggedUser->id_usuario_tipo;
        $this->view->query = $query->execute();
        $this->view->query2 = $query2->execute();
        $this->view->form = $form;
        $this->view->from = $from;
        $this->view->to = $to;
    }

    function detallecorteventaAction(){
        //$this->_onlyAdmin();
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
       
        if($this->_loggedUser->id_usuario_tipo!=2&&$this->_loggedUser->id_usuario!="mariely"){
            $query = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda)
            ->orderBy('id_venta');

            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                ->andWhere("vc.id_tienda=?",$this->_loggedUser->id_tienda)
                //->orderBy('')
              ;
        }else{
            $query = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
            ->orderBy('id_venta');
            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                //->orderBy('')
                ;
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $querydesc->andWhere("vc.id_tienda=?",$id_tienda);
            $query->andWhere("id_tienda = ?", $id_tienda);

        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        $this->view->querydesc =$querydesc->execute();
        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();
        $this->view->form = $form;
    }

    function imprimircorteventaAction(){
        //$this->_onlyAdmin();
        $this->_disableLayout();
        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }
        $this->view->from=$from;
        $this->view->to=$to;

       
        if($this->_loggedUser->id_usuario_tipo!=2&&$this->_loggedUser->id_usuario!="mariely"){
            $query = Doctrine_Query::create()
                ->select("tipo  tipo,  sum(total) total,id_tienda  id_tienda,nombre  nombre, abono  abono,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_Ventascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda)
                ->groupBy("tipo, id_tienda, abono");
            //->orderBy('nombre');
        }else{
            $query = Doctrine_Query::create()
                ->select("vc.tipo as tipo  ,  sum(vc.total) total,vc.id_tienda as id_tienda  ,vc.nombre  nombre, vc.abono  abono,vc.id_usuario  id_usuario, vc.fecha  fecha")
                ->from("Database_Model_Ventascorte vc")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->groupBy("vc.tipo, vc.id_tienda, vc.abono");

            //->groupBy("'tipo,id_tienda,nombre,abono,id_usuario,fecha' ");
            // ->orderBy('nombre');
        }
        // echo $query->getSqlQuery();//imprime la consulta qu ese esta generando

        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $this->view->tienda=$id_tienda;
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        ///////////////////////////////////////DETALLE///////////////////////////////////////////////////
        if($this->_loggedUser->id_usuario_tipo!=2&&$this->_loggedUser->id_usuario!="mariely"){
            $query2 = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda)
                ->orderBy('id_venta');

            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                ->andWhere("vc.id_tienda=?",$this->_loggedUser->id_tienda)
                //->orderBy('')
            ;
            $querydev = Doctrine_Query::create()
                ->from("Database_Model_VentaCancelada d,d.Venta vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                //->andWhere("status='ACTIVO'")
                ->andWhere("vc.id_tienda=?",$this->_loggedUser->id_tienda)
                //->orderBy('')
            ;
            $querydevp = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado d,d.ProductosVenta pv,pv.Venta v")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                //->andWhere("status='ACTIVO'")
                ->andWhere("v.id_tienda=?",$this->_loggedUser->id_tienda)
                //->orderBy('')
            ;
        }else{
            $query2 = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->orderBy('id_venta');
            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                //->orderBy('')
            ;
            $querydev = Doctrine_Query::create()
                ->from("Database_Model_VentaCancelada d,d.Venta vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")

            ;
            $querydevp = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado d,d.ProductosVenta pv,pv.Venta v")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")

            ;
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query2->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query2->andWhere("id_tienda = ?", $id_tienda);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query2->andWhere("id_tienda = ?", $id_tienda);
            $query2->andWhere("id_usuario = ?", $id_usuario);
        }
        ////////////////////////////////////////////////////////////////////////////////////////////
        //echo $query->getSqlQuery();
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $querydesc->andWhere("vc.id_tienda=?",$id_tienda);
            $querydev->andWhere("vc.id_tienda=?",$id_tienda);
            $querydevp->andWhere("v.id_tienda=?",$id_tienda);

        }
        if($querydesc->execute()){
            $this->view->querydesc =$querydesc->execute();
        }
        if($querydev->execute()){
            $this->view->querydev =$querydev->execute();
        }
        if($querydevp->execute()){
            $this->view->querydevp =$querydevp->execute();
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->tipousu=$this->_loggedUser->id_usuario_tipo;
        $this->view->query = $query->execute();
        $this->view->query2 = $query2->execute();
        
        $this->view->from = $from;
        $this->view->to = $to;

    }
    function imprimirdetallecorteventaAction(){
        //$this->_onlyAdmin();
        $this->_disableLayout();
        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }
        $this->view->from=$from;
        $this->view->to=$to;

        if($this->_loggedUser->id_usuario_tipo!=2&&$this->_loggedUser->id_usuario!="mariely"){
            $query = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->andWhere("id_tienda=?",$this->_loggedUser->id_tienda)
                ->orderBy('id_venta');
            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                ->andWhere("vc.id_tienda=?",$this->_loggedUser->id_tienda)
                //->orderBy('')
                ;
        }else{
            $query = Doctrine_Query::create()
                ->select("id_venta  id_venta,cantidad cantidad,codinter codinter,nombre nombre,exento_iva exento_iva,exento_ieps exento_ieps,total total,tipo tipo,id_tienda  id_tienda,id_usuario  id_usuario, fecha  fecha")
                ->from("Database_Model_DetalleVentascorte")
                ->where("DATE(fecha) >= '$from'")
                ->andWhere("DATE(fecha) <= '$to'")
                ->orderBy('id_venta');
            $querydesc = Doctrine_Query::create()
                ->from("Database_Model_Descuentos d,d.Ventascorte vc")
                ->where("DATE(d.fecha_registro) >= '$from'")
                ->andWhere("DATE(d.fecha_registro) <= '$to'")
                ->andWhere("status='ACTIVO'")
                //->orderBy('')
                ;
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $querydesc->andWhere("vc.id_tienda=?",$id_tienda);
            $query->andWhere("id_tienda = ?", $id_tienda);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_tienda = ?", $id_tienda);
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        $this->view->querydesc =$querydesc->execute();
        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();


    }
    function imprimirdevolucionproductoAction()
    {

        $this->_disableLayout();
        //$this->_onlyAdmin();


        $from = date("Y-m-d");
        $to = date("Y-m-d");

        if ($this->_request->getParam("from")) {
            $from = $this->_request->getParam("from");
        }
        if ($this->_request->getParam("to")) {
            $to = $this->_request->getParam("to");
        }


        if($this->_loggedUser->id_usuario_tipo!=2&&$this->_loggedUser->id_usuario!="mariely"){
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado a,a.ProductosVenta b,a.Usuario u")
                ->where("DATE(fecha_registro) >= '$from'")
                ->andWhere("DATE(fecha_registro) <= '$to'")
                //->andWhere("a.cancelado=1")
                ->andWhere("u.id_tienda=?",$this->_loggedUser->id_tienda);
        }else{
            $query = Doctrine_Query::create()
                ->from("Database_Model_VentaProductocancelado a,a.ProductosVenta b,a.Usuario u")
                ->where("DATE(fecha_registro) >= '$from'")
                //  ->andWhere("a.cancelado=1")
                ->andWhere("DATE(fecha_registro) <= '$to'");
        }



        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")) {
            $query->andWhere("u.id_tienda = ?", $id_tienda);
        }
        if ($id_tienda = $this->_request->getParam("id_tienda")&& $id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("u.id_tienda = ?", $id_tienda);
            $query->andWhere("id_usuario = ?", $id_usuario);
        }

        $this->view->usu=$this->_loggedUser->id_usuario;
        $this->view->query = $query->execute();

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
            ->andWhere("v.cancelado = ?", "0")

            ->orderBy("total_cantidad DESC")
            ->groupBy("pv.id_productotienda");
        $queryexce = Doctrine_Query::create()
            ->select("SUM(pv.cantidad) AS total_cantidad, SUM(pv.total) AS total_total, *")
            ->from("Database_Model_ProductosVenta pv, pv.Venta v, pv.ProductoTienda p, p.Producto pr")
            ->where("DATE(v.fecha) >= '$from'")
            ->andWhere("DATE(v.fecha) <= '$to'")
            ->andWhere("pv.cancelado = ?", "0")
            ->andWhere("v.cancelado = ?", "0")
            ->andWhere("pr.manual=1")
            ->andWhere("v.id_usuario!='Elena'")
            ->andWhere("v.id_usuario!='Fanny Casas'")
            ->andWhere("v.id_usuario!='jorge'")
            ->andWhere("pr.nombre='EXCEDENTE'")

            ->orderBy("total_cantidad DESC")
            ->groupBy("pv.id_productotienda");

	    $querydesc = Doctrine_Query::create()
			->select("SUM(a.montodesc) AS total_descuentos")
            ->from("Database_Model_Descuentos a, a.Venta v")
            ->where("DATE(fecha_registro) >= '$from'")
			->andWhere("v.cancelado = ?", "0")
            ->andWhere("DATE(fecha_registro) <= '$to'")
			;

        if (!$this->_loggedUser->super_secure) {
            $query->andWhere("v.no_calculable = 0");
        }

        if ($idProveedor = $this->_request->getParam("id_proveedor")) {
           $query->andWhere("pr.id_proveedor = ?", $idProveedor);
           $queryexce->andWhere("pr.id_proveedor = ?", $idProveedor);
            $this->view->idproveedor=$idProveedor;
        }else{
            $query->andWhere("pr.manual=0");//recargas y exedentes1328
        }

        if ($iduser = $this->_request->getParam("id_usuario")) {
            $query->andWhere("v.id_usuario = ?", $iduser);
            $queryexce->andWhere("v.id_usuario = ?", $iduser);
            $querydesc->andWhere("a.id_usuario = ?", $iduser);
        }
        if ($codintercadena=$this->_request->getParam("autocomplete")) {
            $codiner = explode('::', $codintercadena);
            $query->andWhere("pr.id_proveedor = ?", $codiner[0]);
            $queryexce->andWhere("pr.id_proveedor = ?", $codiner[0]);
        }

        if ($idProveedor!=9) {//si es tecnopay no se generan descuentos
            $this->view->querydesc = $querydesc->execute();
        }
        $querydias = Doctrine_Query::create()
            ->select("DATEDIFF('".$to."','".$from."') dias")
            ->from("Database_Model_Descuentos ")
            ->fetchOne()
        ;



        $this->view->query = $query->execute();
        $this->view->queryexce = $queryexce->execute();
        $this->view->form = $form;

        $this->view->dias=$querydias->dias;
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
        if ($codintercadena=$this->_request->getParam("autocomplete")) {
            $codiner = explode('::', $codintercadena);

            $query->andWhere("pr.codinter = ?", $codiner[0]);
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
    function descuentosAction()
    {
        //$this->_onlyAdmin();
        $form = new Ventas_Form_Descuento();

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
            ->from("Database_Model_Descuentos a, a.Venta v")
            ->where("DATE(fecha_registro) >= '$from'")
            ->andWhere("DATE(fecha_registro) <= '$to'");


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("a.id_usuario = ?", $id_usuario);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function porclienteAction()
    {
        
        $form = new Ventas_Form_Cliente();

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
            ->from("Database_Model_Venta ")
            ->where("id_venta>0")
            ->andWhere("DATE(fecha) <= '$to'");


        if ($from =$this->_request->getParam("from")) {
            $query->andWhere("DATE(fecha) >= '$from'");
        }
        if ($to =$this->_request->getParam("to")) {
            $query->andWhere("DATE(fecha) <= '$to'");
        }

        if ($id = $this->_request->getParam("id_persona")) {
            $query->andWhere("id_persona = ?", $id);
        }

       if ($codintercadena=$this->_request->getParam("autocomplete")) {
            $codiner = explode('::', $codintercadena);
            $query->andWhere("id_persona = ?", $codiner[0]);
        }

        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function validacionentradasAction()
    {
        $this->_onlyAdmin();
        $form = new Administracion_Form_Entrada();

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
            ->from("Database_Model_Entrada")
            ->where("DATE(fecha) >= '$from'")
            ->andWhere("status='ACTIVO'")
            ->andWhere("DATE(fecha) <= '$to'");


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
    function validaciontraspasoAction()
    {
        $this->_onlyAdmin();
        $form = new Administracion_Form_Entrada();

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
            ->from("Database_Model_Traspaso")
            ->where("DATE(fecha) >= '$from'")
            ->andWhere("status='ACTIVO'")
            ->andWhere("DATE(fecha) <= '$to'");


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }
}