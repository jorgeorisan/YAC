<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_ValidainventarioController extends jfLib_Controller
{
    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2" || $this->_loggedUser->id_usuario_tipo != "5") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function indexAction()
    {
        //$this->_onlyAdmin();
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
            ->from("Database_Model_Entrada ")
            ->where("status='POR AUTORIZAR'")
            ->orderBy("id_entrada DESC");

        if ($q = $this->_request->getParam("q")) {
            $query->andwhere("fecha_registro LIKE '%$q%'")
                ->orWhere("id_entrada LIKE '%$q%'")
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
        $obj = Database_Model_Entrada::getById($id);
        if (!$obj) {
            $this->_informError();
        }

        if($obj->status=="POR AUTORIZAR"){

            foreach ($obj->EntradaProducto as $prodVenta) {
                if ($prodVenta->Producto) {
                    $ejeexiste= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$prodVenta->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->id_tienda);
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    $identr=0;
                    foreach($ejeexiste->execute() as $ex){
                         $identr=$ex->id_productotienda;//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    $error=1;
                    if($identr>0){
                        $identr=$identr;
                        $error=0;
                    }else{
                        $objptiant = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                        $objptiant->id_producto=$prodVenta->id_producto;
                        $objptiant->tienda_id_tienda=$obj->id_tienda;

                        try {
                            $error=0;
                            $objptiant->save();//guardamos la nueva relacion
                            $identr=$objptiant->getIncremented();
                        } catch (Exception $e) {
                            // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                            echo "error al crear la relacion";
                            $error=1;
                            exit;
                        }
                    }

                    if($error==0){
                        $objpte = Database_Model_ProductoTienda::getById($identr);

                        $objpte->existencias=$objpte->existencias+$prodVenta->cantidad;
                        try {
                            $objpte->save();
                        } catch (Exception $e) {
                            echo $e;
                            exit;
                            $this->_informError($e, null, true, "administracion/validainventario");
                        }
                    }else{
                        echo "Ha ocurrido un problema, consulte al administrador, no hay incremento";
                        exit;
                    }

                }
                try {
                    $obj->status = "ACTIVO";
                } catch (Exception $e) {
                    $this->_informError($e, null, true, "administracion/validainventario");
                }
            }
            try {
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
            $obj = Database_Model_EntradaProducto::getById($this->_request->getParam("id"));

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