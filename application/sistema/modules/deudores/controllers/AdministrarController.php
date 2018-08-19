<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:48
 *
 */

class Deudores_AdministrarController extends jfLib_Controller
{

    function indexAction()
    {
       // $this->_redirect("ventas/reportes");
        ///////////////////tipo de usuario y su tienda
       
        $tipousu=$this->_loggedUser->id_usuario_tipo;
        $tienda=$this->_loggedUser->id_tienda;
        
        $this->view->tipousu = $tipousu;
        $this->view->tienda = $tienda;
        ////////////////////////////////////////
    
        $query = Doctrine_Query::create()
            ->from("Database_Model_Venta v, v.Persona c")
            ->Where("icredito = '1'")
            ->andWhere("cancelado=0")
            ->orderBy("id_venta desc");


        $this->view->query = $query->execute();
        $this->view->form = $form;

    }

    function altaAction()
    {
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario=?",$this->_loggedUser->id_usuario)
            ->execute();

        foreach($querytipo as $tipo){
             $tipousu=$tipo["id_usuario_tipo"];

        }
        $this->view->tipousu=$tipousu;

        $query = Doctrine_Query::create()
            ->from("Database_Model_Venta v")
            ->Where("tipo = 'Credito'")
            ->andWhere("id_venta=?",$this->_request->getParam("id"))
            ->orderBy("id_venta ASC")
            ->fetchOne();
        $cli = Doctrine_Query::create()
            ->from("Database_Model_Persona")
            ->where("id_persona=?",$query->id_persona)
            ->execute();

        foreach($cli as $c){
            $cliente=$c["nombre"];

        }
        $this->view->cliente=$cliente;
        $this->view->data=$query;

        if ($this->_request->isPost()) {

            $obj = new Database_Model_Deudores();
            $obj->fromArray($this->_request->getPost());
             $obj->id_usuario = $this->_loggedUser->id_usuario;

                if($this->_request->getParam("id_usuario")!=""){
                    $obj->id_usuario =$this->_request->getParam("id_usuario");

                }

            $obj->montoabono = $this->_request->getPost("montoabono");

                $querysaldo = Doctrine_Query::create()
                    ->select("SUM(montoabono) AS saldo")
                    ->from("Database_Model_Deudores")
                    ->where("id_venta =?",$this->_request->getPost("id_venta"))
                    ->andWhere("status = ?", "ACTIVA")
                    ->execute();
                foreach($querysaldo as $s){
                    $saldo=$s["saldo"];
                }
                $venta = Database_Model_Venta::getById($this->_request->getPost("id_venta"));
                if($saldo<$venta->total){//si el saldo pagado es menor a la cantidad vendida
                    try {

                    // $id = $obj->getIncremented();

                    if($obj->montoabono+$saldo==$venta->total){

                        $venta->total+=$obj->montoabono;//aumentamos las ventas de entradas para saber si ya se
                        $q = Doctrine_Query::create()
                            ->update('Database_Model_Venta')
                            ->set('icredito', '?', "0")
                            ->where('id_venta = ?', $this->_request->getPost("id_venta"));
                        $q->execute();
                    }
                        $obj->save();
                         $id = $obj->getIncremented();
                            $this->_informSuccess(null, true, "deudores/administrar/imprimir/id/" . $id);
                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
                }
        }

    }

    function verAction()
    {
        // $this->_redirect("ventas/reportes");
        ///////////////////tipo de usuario y su tienda
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario=?",$this->_loggedUser->id_usuario)
            ->execute();
        $tipousu="";
        foreach($querytipo as $tipo){
            $tipousu=$tipo["id_usuario_tipo"];
            $tienda=$tipo->id_tienda;
        }
        $this->view->tipousu = $tipousu;
        $this->view->tienda = $tienda;
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

        $query = Doctrine_Query::create()
            ->from("Database_Model_Deudores")
            ->Where("id_venta =?", $this->_request->getParam("id"))
            ->orderBy("fecha_abono desc");


        if ($q = $this->_request->getParam("q")) {//para la busqueda
            $query->andWhere("id_venta LIKE '%$q%'");

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

        $this->view->counter = ($resultsPerPage * ($currentPage - 1)) + 1;
    }

    function cancelarAction()
    {
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_Deudores::getById($id);


        if (!$obj) {
            $this->_informError();
        }
        $obj->status = "CANCELADO";

        try {
            $obj->save();
            $q = Doctrine_Query::create()
                ->update('Database_Model_Venta')
                ->set('icredito', '?', "1")
                ->where('id_venta = ?', $obj->id_venta);
            $q->execute();
            $this->_informSuccess();
        } catch (Exception $e) {
            $this->_informError($e, null, true, "deudores/administrar");
        }
    }
  

    function imprimirAction()
    {


        $this->_disableLayout();

        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Doctrine_Core::getTable("Database_Model_Deudores")->findOneBy("id_deudores", $id);

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

}