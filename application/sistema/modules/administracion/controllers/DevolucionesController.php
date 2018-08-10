<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 20/10/11
 * Time: 10:46
 *
 */

class Administracion_DevolucionesController extends jfLib_Controller
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

       /* ?>
        <script>
            alert('<?Php echo $this->_loggedUser->id_usuario_tipo;  ?>');
        </script>
<?php
*/

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
            ->from("Database_Model_Venta")
            ->where("cancelado=0")
            ->orderBy("id_venta  DESC");
        if ($this->_loggedUser->id_usuario_tipo == "2" || $this->_loggedUser->id_usuario == "mariely") {

        }else{
           // $query->where("id_tienda=?",$this->_loggedUser->id_tienda);
        }

        if ($q = $this->_request->getParam("q")) {
            $query->andwhere("folio LIKE '%$q%'");
            $query->orwhere("id_usuario LIKE '%$q%'");
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
    function mostrarcancelarventaAction(){
        $this->_disableLayout();
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }else{
            $this->view->tipousu=$this->_loggedUser->id_usuario_tipo;
            $this->view->usu=$this->_loggedUser->id_usuario;
            $this->view->id_tiendausu=$this->_loggedUser->id_tienda;
            $this->view->tiendausu=$this->_loggedUser->Tienda->nombre;
            $obj = Database_Model_Venta::getById($id);
            $this->view->obj = $obj;
        }

    }
    function mostrarcancelarventapAction(){
        $this->_disableLayout();
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }else{
            $this->view->tipousu=$this->_loggedUser->id_usuario_tipo;
            $this->view->usu=$this->_loggedUser->id_usuario;
            $this->view->id_tiendausu=$this->_loggedUser->id_tienda;
            $this->view->tiendausu=$this->_loggedUser->Tienda->nombre;
            $obj = Database_Model_ProductosVenta::getById($id);
            $this->view->obj = $obj;
        }

    }

    function verAction()
    {
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }
        $obj = Doctrine_Core::getTable("Database_Model_Venta")->findOneBy("id_venta", $id);

        if (!$obj) {
            $this->_informError();
        }
        $this->view->obj = $obj;
    }

    function cancelarproductoAction()
    {
        $this->_disableLayout();
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_ProductosVenta::getById($id);

        if (!$obj) {
            $this->_informError();
        }

        if ($obj->cancelado==0) {

            if($obj->Venta->id_tienda==$this->_request->getParam("id_tienda_destino")){
                $objpt = Database_Model_ProductoTienda::getById($obj->id_productotienda);
                $objpt->existencias+= $obj->cantidad;
                $objpt->save();

            }else{
                $queryptn = Doctrine_Query::create()
                    ->from("Database_Model_ProductoTienda")
                    ->where("id_producto=?",$obj->ProductoTienda->id_producto)
                    //->andWhere("status='ACTIVO'")
                    ->andWhere("tienda_id_tienda=?",$this->_request->getParam("id_tienda_destino"))
                ;
                $id_tiendaprodnvo="";
                foreach($queryptn->execute() as $objptn){
                    $id_tiendaprodnvo=$objptn->id_productotienda;
                }
                if($id_tiendaprodnvo>0){
                    $objptn->existencias += $obj->cantidad;
                    try {
                        $objptn->save();
                    } catch (Exception $e) {
                        //$this->_informError($e, null, true, "administracion/devoluciones");
                    }
                }else{//si no existe la relacion tienda con producto la creamos
                    $objptiant = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                    $objptiant->id_producto=$obj->ProductoTienda->id_producto;
                    $objptiant->tienda_id_tienda=$this->_request->getParam("id_tienda_destino");
                    try {
                        $objptiant->existencias += $obj->cantidad;
                        $objptiant->save();
                    } catch (Exception $e) {
                        //  echo 0;
                    }
                }
            }
            $obj->cancelado = 1;
            $obj3 = new Database_Model_VentaProductocancelado();
            $obj3->id_productos_venta=$this->_request->getParam("id");
            $obj3->id_usuario=$this->_loggedUser->id_usuario;
            $obj3->observaciones=$this->_request->getParam("observaciones");
            $obj3->id_tienda_destino=$this->_request->getParam("id_tienda_destino");
            $obj3->total=$obj->total;
            $obj->status = "DEVOLUCION";
            try{
                $obj3->save();
                $obj->save();
              
                echo 1;
                //  $this->_informSuccess(null, true, "administracion/devoluciones/ver/id/".$obj->id_venta);

            } catch (Exception $e) {
                //$this->_informError($e);
            }
        }
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



}