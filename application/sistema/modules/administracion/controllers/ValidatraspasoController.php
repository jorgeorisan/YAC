<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_ValidatraspasoController extends jfLib_Controller
{
    function init()
    {
        parent::init();
        $this->view->datauserlogged=$this->_loggedUser;

    }
   
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

        $resultsPerPage = 25;
        $url = $this->view->baseUrl($this->_request->getModuleName() . "/" . $this->_request->getControllerName());

        $query = Doctrine_Query::create()
            ->from("Database_Model_Traspaso ")
            ->where("status='POR AUTORIZAR'")
            ->orderBy("id_traspaso DESC");

        if ($q = $this->_request->getParam("q")) {
            $query->andwhere("fecha_registro LIKE '%$q%'")
                ->orWhere("id_traspaso LIKE '%$q%'")
                ->orWhere("referencia  LIKE '%$q%'");

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
        $this->_disableView();
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }
        $obj = Database_Model_Traspaso::getById($id);
        if (!$obj) {
            $this->_informError();
        }

        if($obj->status=="POR AUTORIZAR"){
            $obj->status = "ACTIVO";
            $productosquery= Doctrine_Query::create()
            ->from("Database_Model_TraspasoProducto")
            ->where("id_traspaso=?",$obj->id_traspaso)
            ->andWhere("status='ACTIVO'");

            foreach ($productosquery->execute() as $prodVenta) {
                if ($prodVenta->Producto) {
                    $ejeexiste= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$prodVenta->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->id_tienda)
                        ->andWhere("status='ACTIVO'");
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($ejeexiste->execute() as $ex){
                         $identr=$ex->id_productotienda;//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    $objpt = Database_Model_ProductoTienda::getById($identr);
                     $objpt->existencias+= $prodVenta->cantidad;
                    /////////////si es paquete decrementamos los productos del paquete
                    if($objpt->Producto->paquete==1){
                       // $obj->paquete=1;
                        $querypaquete = Doctrine_Query::create()
                            ->from("Database_Model_Paquete")
                            ->where("id_producto=?",$objpt->id_producto)
                            ->andWhere("status='ACTIVO'")
                            ->orderBy("id_producto ") ;
                        $id_productocompuesto="";
                        foreach($querypaquete->execute() as $objpaquete){
                           echo  $id_productocompuesto = $objpaquete->id_productocompuesto;
                            $querypaquetetienda = Doctrine_Query::create()
                                ->from("Database_Model_ProductoTienda")
                                ->where("id_producto=".$id_productocompuesto)
                                ->andWhere("tienda_id_tienda=".$obj->id_tienda)
                                ->andWhere("status='ACTIVO'");
                            foreach($querypaquetetienda->execute() as $objtpq){
                               echo  $id_productopqtienda=$objtpq->id_productotienda;
                            }
                            if($id_productopqtienda){
                                $id_productopqtienda=$id_productopqtienda;
                            }else {
                                $objptiantpq = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                                $objptiantpq->id_producto = $id_productocompuesto;
                                $objptiantpq->tienda_id_tienda = $obj->id_tienda;
                                try {
                                    $objptiantpq->save();//guardamos la nueva relacion
                                    $id_productopqtienda = $objptiantpq->getIncremented();
                                } catch (Exception $e) {
                                    // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                    echo "error al crear la relacion";
                                    exit;
                                }
                            }
                            $productotiendapq = Database_Model_ProductoTienda::getById($id_productopqtienda);
                            $productotiendapq->existencias+=$objpaquete->cantidad;//decrementamos las existencias

                            try {
                                $productotiendapq->save();
                            } catch (Exception $e) {
                                // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                echo "error linea 117";
                                exit;
                            }
                        }
                    }
                    ///////////////////////////////////termina si es paquete
                }
                try {
                    $objpt->save();
                    $ejeexiste2= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$prodVenta->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->id_tiendaanterior);
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($ejeexiste2->execute() as $ex2){
                        $identr2=$ex2->id_productotienda;//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    if($identr2){
                        $identr2=$identr2;
                    }else{
                        $objptiant = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                        $objptiant->id_producto=$prodVenta->id_producto;
                        $objptiant->tienda_id_tienda=$obj->id_tiendaanterior;
                        try {
                            $objptiant->save();//guardamos la nueva relacion
                            $identr2=$objptiant->getIncremented();
                        } catch (Exception $e) {
                           // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                            echo "error al crear la relacion";
                            exit;
                        }
                    }
                    $objpt2 = Database_Model_ProductoTienda::getById($identr2);
                    $objpt2->existencias-= $prodVenta->cantidad;
                    /////////////si es paquete decrementamos los productos del paquete de la otra tienda
                    if($objpt->Producto->paquete==1){
                        // $obj->paquete=1;
                        $querypaquete = Doctrine_Query::create()
                            ->from("Database_Model_Paquete")
                            ->where("id_producto=?",$objpt2->id_producto)
                            ->andWhere("status='ACTIVO'")
                            ->orderBy("id_producto ") ;
                        $id_productocompuesto="";
                        foreach($querypaquete->execute() as $objpaquete2){
                            $id_productocompuesto = $objpaquete2->id_productocompuesto;
                            $querypaquetetienda2 = Doctrine_Query::create()
                                ->from("Database_Model_ProductoTienda")
                                ->where("id_producto=".$id_productocompuesto)
                                ->andWhere("tienda_id_tienda=".$obj->id_tiendaanterior)
                                ->andWhere("status='ACTIVO'");
                            foreach($querypaquetetienda2->execute() as $objtpq2){
                                $id_productopqtienda2=$objtpq2->id_productotienda;
                            }
                            $productotiendapq2 = Database_Model_ProductoTienda::getById($id_productopqtienda2);
                            $productotiendapq2->existencias-=$objpaquete2->cantidad;//decrementamos las existencias
                            try {
                                $productotiendapq2->save();
                            } catch (Exception $e) {
                                // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                echo "error linea 117";
                                exit;
                            }
                        }
                    }
                    ///////////////////////////////////termina si es paquete
                    try {
                        $objpt2->save();
                    } catch (Exception $e) {
                        $this->_informError($e, null, true, "administracion/validatraspaso");
                    }
                } catch (Exception $e) {
                    $this->_informError($e, null, true, "administracion/validatraspaso");
                }
            }
            try {
                $obj->save();
                $obj3 = new Database_Model_Validatraspaso();
                $obj3->id_traspaso=$this->_request->getParam("id");
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

        $this->view->obj = Database_Model_EntradaProducto::getById($this->_request->getParam("id"));
    }

    function borrarAction()
    {
        if ($this->_loggedUser->id_usuario_tipo == "4") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_TraspasoProducto::getById($this->_request->getParam("id"));

            try {

                $obj->status="BAJA";
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError();
            }
        }
    }

}