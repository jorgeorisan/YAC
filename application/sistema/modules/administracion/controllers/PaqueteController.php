<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_PaqueteController extends jfLib_Controller
{

    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2" || $this->_loggedUser->id_usuario_tipo != "5") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }
    function indexAction(){
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
            ->from("Database_Model_Paquete p, p.Producto pr")
            ->where("status='ACTIVO'")
            ->orderBy("p.id_paquete  DESC");


        if ($q = $this->_request->getParam("q")) {
            $query->where("p.nombre LIKE '%$q%'");
        }
        if ($q = $this->_request->getParam("q")) {
            $query->where("pr.codinter LIKE '%$q%'");
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
       // $this->_onlyAdmin();

        $this->view->tipousu =$this->_loggedUser->id_usuario_tipo;
        $this->view->usu =$this->_loggedUser->id_usuario;
        $this->view->idtienda =$this->_loggedUser->id_tienda;
        $productox = Database_Model_Producto::getById($this->_request->getParam("id"));

        $objexistepaquete = Doctrine_Core::getTable("Database_Model_Paquete")->findOneBy("id_producto", $this->_request->getParam("id"));
        if ($objexistepaquete) {
           echo"<script>alert('Ya se han insertado productos a este paquete anteriormente, si continua se agregaran mas!!.');</script>";
        }
        if ($productox) {
            $this->view->productox=$productox;
        }else{
            $this->_informError(null, "No existe el producto", TRUE, "/");

        }
        if ($this->_request->isPost()) {
            $cantidades = $this->_request->getPost("cantidad");
            $productos = $this->_request->getPost("id_producto");
            $error=0;
            $cantproductos=0;
            foreach ($productos as $key => $val) {
                $producto = Database_Model_Producto::getById($val);
                if ($producto) {
                    $iObj = new Database_Model_Paquete();
                    $iObj->id_producto=$this->_request->getParam("id");//el id del productopaquete ya creado
                    $iObj->cantidad = $cantidades[$key];
                    $iObj->nombre = $producto->nombre;
                    $iObj->id_usuario = $this->_loggedUser->id_usuario;
                    $iObj->comentarios = $this->_request->getPost("comentarios");
                    $iObj->id_productocompuesto = $val; //de los productos que se compone el paquete
                    try {
                        $productox->paquete=1;
                        $productox->save();
                        $iObj->save();
                        $error=0;
                    } catch (Exception $e) {
                       // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                        echo "error en paquete de producto cuando el producto si existe";
                        exit();
                        $this->_informError($e);
                    }
                }
            }//end foreach
            if($error==0) {
                $this->_informSuccess();
            }
        }

    }
    function getproductoAction(){
        $this->_disableLayout();
       // $id = $this->_request->getParam("id_producto");
        $id = $this->_request->getParam("barcode");



        if($id!=""){
            $cantidad = $this->_request->getParam("cantidad");
            $obj = Database_Model_Producto::getByCodbar($id);

                $tipousu=$this->_loggedUser->id_usuario_tipo;

            if ($obj ) {
                $this->view->tipousu=$tipousu;
                $this->view->obj = $obj;
                $this->view->cantidad = $cantidad;
            }else {
                echo "<script>alert('No existe este producto');   </script>";
            }

        }else{
            echo "<script>alert('No se ha seleccionado Ningun Producto');   </script>";
        }

    }


    function cancelarAction()
    {
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_Paquete::getById($id);

        if (!$obj) {
            $this->_informError();
        }


        if($obj->status=="ACTIVO") {
            try {
                $obj->status = "BAJA";
                $obj->save();

                $this->_informSuccess();

            } catch (Exception $e) {
                $this->_informError();
            }
        }

    }

}