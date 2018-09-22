<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_InventariosController extends jfLib_Controller
{

    function indexAction(){
        if ($this->_loggedUser->id_usuario_tipo) {
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
                ->andWhere("DATE(fecha) <= '$to'");


            if ($id_usuario = $this->_request->getParam("id_usuario")) {
                $query->andWhere("id_usuario = ?", $id_usuario);
            }


            $this->view->query = $query->execute();
            $this->view->form = $form;
        }else{
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function index2Action()
    {
        $form = new jfLib_Form_Search();
        $form->populate($this->_request->getParams());

        // Defining initial variables
        if ($this->_request->getParam('p')) {
            $currentPage = $this->_request->getParam('p');
        } else {
            $currentPage = 1;
        }

        $resultsPerPage = 25;
        $url = $this->view->baseUrl($this->_request->getModuleName() . "/" . $this->_request->getControllerName());

        $query = Doctrine_Query::create()
            ->from("Database_Model_EntradaProducto a,a.Producto p")
            ->where("status='ACTIVO'")
            ->orderBy("id_entrada_producto DESC");

        if ($q = $this->_request->getParam("q")) {
            $query->andwhere("fechare_gistro LIKE '%$q%'")
                ->orWhere("comentarios LIKE '%$q%'")
                ->orWhere("p.codbarras = ?", $q)
            ->orWhere("p.codinter = ?", $q);
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

    function altaAction(){
        if($this->_request->getParam("id")){
            $obj = Doctrine_Core::getTable("Database_Model_Producto")->findOneBy("id_producto", $this->_request->getParam("id"));
            $this->view->codint=$obj->codinter;
        }

        if ($this->_request->isPost()) {

            $obj = new Database_Model_Entrada();
            $obj->fromArray($this->_request->getPost());
            $obj->costo_total = $this->_request->getPost("total-global");
            $obj->id_usuario = $this->_loggedUser->id_usuario;
             $obj->id_tienda = $this->_request->getPost("id_tienda");
            $obj->status="POR AUTORIZAR";
            $obj->concepto="ENTRADA DE ALMACEN";
//recibimos los arrays
            $cantidades = $this->_request->getPost("cantidad");
            $productos = $this->_request->getPost("id_producto");
            $totales = $this->_request->getPost("total");
            $precio = $this->_request->getPost("precio");
            $preciodescuento=$this->_request->getPost("precio_descuento");
            $preciocosto=$this->_request->getPost("precio_costo");
            $costo = $this->_request->getPost("costo");

            $multiplicador = $this->_request->getPost("multiplicador");//no es un array

            $error=0;
            $cantproductos=0;
            $obj->total=$cantproductos;
            $obj->save();
            $id = $obj->getIncremented();
            foreach ($productos as $key => $val) {
                $producto = Database_Model_Producto::getById($val);
                if ($producto) {
                    $iObj = new Database_Model_EntradaProducto();
                    $iObj->cantidad         = $cantidades[$key];
                    $iObj->precio           = $precio[$key];
                    $iObj->precio_descuento = $preciodescuento[$key];
                    $iObj->precio_costo     = $preciocosto[$key];
                    $iObj->costo            = $costo[$key];
                    $iObj->totalcosto       = $totales[$key];
                    $iObj->id_entrada       = $id;
                    $iObj->nombre           = $producto->nombre;
                    $iObj->id_producto      = $val;
                     $iObj->id_tienda       = $obj->id_tienda;
                    $iObj->multiplicador    = $multiplicador;
                    $iObj->iva              = 1.16;
                    $cantproductos          = $cantproductos+$iObj->cantidad;

                    $query = Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=".$producto->id_producto)
                        ->andWhere("tienda_id_tienda=".$obj->id_tienda)
                        ->andWhere("status='ACTIVO'");
                    //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
                    $cantanterior=0;
                    foreach($query->execute() as $objt){
                        $id_productotienda = $objt->id_productotienda;
                        $cantanterior      = $objt->existencias;
                    }
                    $iObj->cantidad_anterior=$cantanterior;
                    if($id_productotienda>0){//el producto en esta tienda si existe
                        try {

                            //$obj->EntradaProducto->add($iObj);
                            $iObj->save();
                        } catch (Exception $e) {
                            $error=1;
                            echo "no se metio en entrada producto";
                            exit();
                        }
                    }else{
                        $objpti = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                        $objpti->id_producto=$producto->id_producto;
                        $objpti->tienda_id_tienda=$obj->id_tienda;
                        $objpti->existencias=0;//solo asta que se valide
                        
                        try {
                            $objpti->save();//guardamos la nueva relacion
                            //$obj->EntradaProducto->add($iObj);
                            $iObj->save();
                        } catch (Exception $e) {
                            $error=1;
                            echo "no se genero la relacion";
                            exit();
                        }

                    }
                }else{
                    echo "no existe el producto";
                    $error=1;
                    exit();
                }
            }//end foreach
            try {
                if($error==0){

                    //ENVIA MAIL de entrada
                    $mail = new Zend_Mail("UTF-8");
                    $mail->setSubject("¡Nueva Entrada de Producto! Tienda Trepsi");
                    $message = "<html><style>";
                    $message .= "table {border-collapse: collapse; border-spacing: 0px;} body, html { margin:0;      padding:0; width:100%; height:100%; font-family:Verdana, Geneva,sans-serif; font-size:12px;}";
                    $message .="</style>";
                    $message .="<body>";
                    $message .= 'Se ha solicitado una nueva entrada de producto con el Codigo de Entrada: <strong>'.$id."</strong>";

                    $mail->addTo("aaron@trepsi.com.mx");
                    // $mail->addTo("jorge.orihuela@tigears.com");
                    $mail->addCc("guillermo@trepsi.com.mx");//compia

                    $mail->setBodyHtml($message);
                    $mail->setFrom("noreply@789.mx", "Notificaciones 789.MX");
                    try {
                         //$mail->send();
                        $this->_informSuccess(null, true, "administracion/inventarios/ver/id/" . $id);
                    } catch (Exception $e) {
                        // $this->_informError($e);
                        echo $e;

                    }

                }
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }



    }
    function getproductoAction(){
        $this->_disableLayout();
        $tipousu=$this->_loggedUser->id_usuario_tipo;
        $usu=$this->_loggedUser->id_usuario;
        if($tipousu){
            $id = $this->_request->getParam("id_prod");

            if($id!=""&&$id!=" "){
                $cantidad = $this->_request->getParam("cantidad");
                $obj = Database_Model_Producto::getByCodbar($id);
                    $tienda= $this->_loggedUser->id_tienda;

                if ($obj) {
                    $this->view->tipousu=$tipousu;
                    $this->view->usu=$this->_loggedUser->id_usuario;
                    $this->view->obj = $obj;
                    $this->view->id_tienda=$tienda;
                    $this->view->cantidad = $cantidad;
                }else{
                    echo "<script>alert('No Existe este Producto');   </script>";
                }
            }else{
                echo "<script>alert('No se ha seleccionado Ningun Producto');   </script>";
            }
        }else{
            echo "<script>alert('No tienes permisos para dar nuevas entradas');   </script>";
        }

    }

    function editarAction()
    {
        $obj = Doctrine_Core::getTable("Database_Model_EntradaProducto")->findOneBy("id_categoria", $this->_request->getParam("id"));
        if (!$obj) {
            $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
        }
        $form = new Administracion_Form_Inventario();
        $form->populate($obj->toArray());
        if ($this->_request->isPost() && $form->isValid($this->_request->getParams())) {
            $transaction = new jfLib_Doctrine_UnitOfWork();
            $obj->fromArray($this->_request->getParams());
            $transaction->registerModelForCreateOrUpdate($obj);
            try {
                $transaction->commitAll();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
        $this->view->form = $form;
    }

    function verAction()
    {
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }
        $obj = Doctrine_Core::getTable("Database_Model_Entrada")->findOneBy("id_entrada", $id);

        if (!$obj) {
            $this->_informError();
        }
        $this->view->obj = $obj;
    }


    function borrarAction()
    {

        if ($this->_loggedUser->id_usuario_tipo) {

            $obj = Database_Model_EntradaProducto::getById($this->_request->getParam("id"));
            $ejeexiste1= Doctrine_Query::create()
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=".$obj->id_producto)
                ->where("tienda_id_tienda=".$obj->id_tienda)
            ;
            //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generand
            foreach($ejeexiste1->execute() as $ex1){
                $idproductoti=$ex1["id_productotienda"];

            }
            $producto = Database_Model_ProductoTienda::getById($idproductoti);
              $producto->existencias -= $obj->cantidad;
            try {

                $producto->save();
                $obj->status="BAJA";
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError();
            }

        }else{
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }
    function imprimirAction()
    {
        $this->_disableLayout();
        $id = $this->_request->getParam("id");

        $obj = Doctrine_Core::getTable("Database_Model_Entrada")->findOneBy("id_entrada", $id);

        if (!$obj) {
            $this->_informError();
        }
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Tienda")
            ->where("id_tienda=?",$obj->id_tienda)
            ->execute();
        $tienda="";
        foreach($querytipo as $tipo){
            $tienda=$tipo->nombre;
        }
        $this->view->tienda=$tienda;
        $this->view->obj = $obj;
    }
    function cancelarAction()
    {
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_Entrada::getById($id);

        if (!$obj) {
            $this->_informError();
        }
        $obj->cancelado = 1;

        if($obj->status=="ACTIVO"){
            foreach ($obj->EntradaProducto as $prodVenta) {
                if ($prodVenta->Producto) {
                    $ejeexiste= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$prodVenta->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->id_tienda);
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($ejeexiste->execute() as $ex){
                        $identr=$ex["id_productotienda"];//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    $objpt = Database_Model_ProductoTienda::getById($identr);
                    if ($prodVenta->status=="ACTIVO") {
                         $objpt->existencias-= $prodVenta->cantidad;
                    }
                }
                try {
                    $objpt->save();
                } catch (Exception $e) {
                    $this->_informError($e, null, true, "ventas/administrar");
                }
            }
        }
        try {
            $obj->status = "BAJA";
            $obj->save();
            $obj3 = new Database_Model_Validaentrada();
            $obj3->id_entrada=$this->_request->getParam("id");
            $obj3->id_usuario=$this->_loggedUser->id_usuario;
            // $obj3->cantidad=$cantidad;
            try{
                $obj3->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        } catch (Exception $e) {
            $this->_informError();
        }

    }
    function cancelarproductoAction()
    {
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_EntradaProducto::getById($id);

        if (!$obj) {
            $this->_informError();
        }
        $obj->cancelado = 1;

        if($obj->Entrada->status=="ACTIVO"){
            if ($obj->status=="ACTIVO") {
                if ($obj->Producto) {
                    $ejeexiste= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$obj->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->Entrada->id_tienda);
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($ejeexiste->execute() as $ex){
                        $identr=$ex["id_productotienda"];//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    $objpt = Database_Model_ProductoTienda::getById($identr);
                    $objpt->existencias-= $obj->cantidad;
                }
                try {
                    $objpt->save();
                } catch (Exception $e) {
                    $this->_informError($e, null, true, "ventas/administrar");
                }
            }
        }
        try {
            $obj->status = "BAJA";
            $obj->save();
            $obj3 = new Database_Model_EntradaProductocancelado();
            $obj3->id_entrada_producto=$this->_request->getParam("id");
            $obj3->id_usuario=$this->_loggedUser->id_usuario;
            // $obj3->cantidad=$cantidad;
            try{
                $obj3->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        } catch (Exception $e) {
            $this->_informError();
        }

    }

}