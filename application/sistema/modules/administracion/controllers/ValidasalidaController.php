<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_ValidasalidaController extends jfLib_Controller
{
    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2" || $this->_loggedUser->id_usuario_tipo != "5") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }

    function indexAction()
    {
        $this->_onlyAdmin();
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
            ->from("Database_Model_Salida ")
            ->where("status='POR AUTORIZAR'")
            ->orderBy("id_salida DESC");

        if ($q = $this->_request->getParam("q")) {
            $query->andwhere("fecha_registro LIKE '%$q%'")
                ->orWhere("id_salida LIKE '%$q%'")
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
        $obj = Database_Model_Salida::getById($id);
        if (!$obj) {
            $this->_informError();
        }

        if($obj->status=="POR AUTORIZAR"){
            $obj->status = "ACTIVO";
            try {
                $obj->save();
                $querysalidapro= Doctrine_Query::create()
                ->from("Database_Model_SalidaProducto")
                ->where("id_salida=?",$id)
                ->execute();
                if(count($querysalidapro)>0){
                    foreach ($querysalidapro as $prodVenta) {
                        $ejeexiste= Doctrine_Query::create()
                            ->from("Database_Model_ProductoTienda")
                            ->where("id_producto=?",$prodVenta->id_producto)
                            ->andWhere("tienda_id_tienda=?",$prodVenta->Salida->id_tiendaanterior)
                            ->fetchOne();
                        if($ejeexiste){
                            $objpt = Database_Model_ProductoTienda::getById($ejeexiste->id_productotienda);
                            $objpt->existencias-= $prodVenta->cantidad;
                            try {
                                $objpt->save();
                            } catch (Exception $e) {
                               // $this->_informError($e, null, true, "administracion/salida");
                                echo "error ".$e;
                                exit;
                            }
                        }else{
                            echo "no se encontro idproductotienda produto=".$prodVenta->id_producto."  tienda=".$prodVenta->Salida->id_tiendaanterior;
                            exit;
                        }
                       
                    }
                    $this->_informSuccess("",true,"administracion/salida/");//redireccionamosa la vista
                }else{
                    echo "no hay productos";
                    exit;
                }
            } catch (Exception $e) {
                $this->_informError();
            }
        }else{
            echo "no etro a validar";
            exit;
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
            $obj = Database_Model_SalidaProducto::getById($this->_request->getParam("id"));

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