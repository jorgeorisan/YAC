<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_TraspasosController extends jfLib_Controller
{
    function indexAction()
    {
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
            ->from("Database_Model_Producto p, p.Proveedor pro, p.Marca m")
            ->Where("status = 'ACTIVO'")
            ->orderBy("nombre ASC");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
            $query->andWhere("nombre LIKE '%$q%'");
            $query->orWhere("pro.nombre_corto LIKE '%$q%'");
            $query->orWhere("m.nombre LIKE '%$q%'");
            $query->orWhere("codbarras = ?", $q);
            $query->orWhere("codinter = ?", $q);
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


    function altaAction()
    {
        $idtienda=$this->_request->getParam("id_tienda");
        $error=0;
        /*if ($this->_loggedUser->id_usuario_tipo == "2") {
            if($this->_loggedUser->id_tienda == $this->_request->getParam("id_tienda")){
                $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
                $error=1;
            }else{
                $idtienda=$this->_loggedUser->id_tienda;
            }
        }*/
            ///////////////////tipo de usuario y su tienda
        if($error==0){
            $querytipo = Doctrine_Query::create()
                ->from("Database_Model_Usuario")
                ->where("id_usuario=?",$this->_loggedUser->id_usuario)
                ->execute();
            $tipousu="";
            foreach($querytipo as $tipo){
                $tipousu=$tipo["id_usuario_tipo"];
                $tienda=$tipo->id_tienda;
            }
            $this->view->tipousu=$tipousu;
            $this->view->idtienda=$idtienda;
            $this->view->existencia=$this->_request->getParam("existencia");
        }else{
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }

          //  $form = new Administracion_Form_Producto();

            if ($this->_request->isPost()) {

                $existencia= $this->_request->getPost("existencia");
                $cantidad=$this->_request->getPost("cantidad");
                if($existencia<$cantidad){//si la cantidad nueva es mayor a la que hay
                    echo "<script>alert('No puedes Traspasar esa cantidad')</script>";
                }else{
                    $obj = new Database_Model_Traspasos();
                   // $obj->fromArray($this->_request->getParams());

                      $tienda1 =$idtienda;//la tienda anterior sera la que escoja el usuario

                    $obj->idtiendaanterior=$tienda1;//tienda anterior
                    try {
                        $obj->fecha_traspaso=$this->_request->getPost("fecha_traspaso");
                        $obj->cantidad=$this->_request->getPost("cantidad");
                        $obj->id_tienda=$this->_request->getPost("id_tienda");
                        $obj->id_productotienda=$this->_request->getParam("id2");
                        $obj->id_usuario=$this->_loggedUser->id_usuario;

                        $ejeexiste= Doctrine_Query::create()
                            ->from("Database_Model_ProductoTienda")
                            ->where("id_producto=?",$this->_request->getParam("id"))
                            ->andWhere("tienda_id_tienda=?",$this->_request->getPost("id_tienda"));//es la tienda a  la que vamos a traspasar
                        $identr="0";
                        foreach($ejeexiste->execute() as $ex){
                             $identr=$ex["id_productotienda"];//si tiene id si existe esta relacion entre el producto y la tienda
                        }
                        if($identr>0){
                            try {
                                $obj2 = Database_Model_ProductoTienda::getById($identr);//
                                $exis= $obj2->existencias+$this->_request->getPost("cantidad");//sumamos lo que tenemos mas la nueva cantidad

                                $q2 = Doctrine_Query::create()
                                    ->update('Database_Model_ProductoTienda')
                                    ->set('existencias', '?', $exis)
                                    ->where('id_productotienda = ?',$identr);
                                $q2->execute();

                                $obj3 = Database_Model_ProductoTienda::getById($this->_request->getParam("id2"));//sacamos los datos para decremetar
                                $exis3= $obj3->existencias-$this->_request->getPost("cantidad");//decrementamos la cantidad en anterroit
                                $q3 = Doctrine_Query::create()
                                    ->update('Database_Model_ProductoTienda')
                                    ->set('existencias', '?', $exis3)
                                    ->where('id_productotienda = ?',$this->_request->getParam("id2"));
                                $q3->execute();
                            } catch (Exception $e) {
                                $this->_informError($e);
                            }
                        }else{//creamos la realacion
                            $obj2 = new Database_Model_ProductoTienda();
                            $obj2->fromArray($this->_request->getPost());
                            $obj2->existencias=$this->_request->getPost("cantidad");
                            $obj2->id_producto=$this->_request->getParam("id");
                            $obj2->tienda_id_tienda=$this->_request->getPost("id_tienda");
                            try{
                                $obj2->save();
                                $obj3 = Database_Model_ProductoTienda::getById($this->_request->getParam("id2"));//sacamos los datos para decremetar
                                $exis3= $obj3->existencias-$this->_request->getPost("cantidad");//decrementamos la cantidad en anterroit
                                $q3 = Doctrine_Query::create()
                                    ->update('Database_Model_ProductoTienda')
                                    ->set('existencias', '?', $exis3)
                                    ->where('id_productotienda = ?',$this->_request->getParam("id2"));

                                $q3->execute();
                            } catch (Exception $e) {
                                $this->_informError($e);
                            }
                        }
                        $obj->save();//insertamos en traspasos

                                  //----------------------------------------insertamos la entrada del producto


                        //recibimos los arrays
                        $iObj = new Database_Model_EntradaProducto();
                        $iObj->cantidad = $this->_request->getPost("cantidad");
                        $iObj->id_producto = $this->_request->getParam("id");
                        $iObj->id_entrada=1;
                        $iObj->id_tienda = $this->_request->getPost("id_tienda");
                        $iObj->status="TRASPASO";
                       // $iObj->totalcosto = $this->_request->getPost("total");
                        //$iObj->precio  = $this->_request->getPost("precio");
                        //$iObj->costo= $this->_request->getPost("costo");
                        $producto = Database_Model_Producto::getById($iObj->id_producto);
                        $iObj->nombre=$producto->nombre;
                       // $iObj->multiplicador= $this->_request->getPost("multiplicador");//no es un array
                       // $iObj->iva=1.16;
                        $error=0;

                        try {
                            if($error==0){
                                $iObj->save();
                                $id = $obj->getIncremented();
                               // $this->_informSuccess(null, true, "administracion/inventario/ver/id/" . $id);
                                $exisnva=$this->_request->getParam("existencia")-$this->_request->getPost("cantidad");
                                $this->_informSuccess(null,true,"administracion/traspasos/alta/id/".$this->_request->getParam("id")."/existencia/".$exisnva."/id_tienda/".$this->_request->getParam("id_tienda")."/id2/".$this->_request->getParam("id2"));//redireccionamosa la vista que queremos

                            }
                        } catch (Exception $e) {
                            $this->_informError($e);
                        }
                        //$this->_informSuccess();
                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
                }
            }

     //   $this->view->form = $form;
    }
    function entradaprodAction(){
        $this->view->idprod=$this->_request->getParam("id");
        $qry= Doctrine_Query::create()
            ->from("Database_Model_EntradaProducto a,a.Producto p")
            ->where("p.id_producto=".$this->_request->getParam("id"))
            ->andWhere("status='ACTIVO'")
            ->orderBy("p.nombre ASC")
            ->execute();
        $this->view->query =$qry;


        if ($this->_request->isPost()) {
            $obj = new Database_Model_EntradaProducto();

            $obj->fromArray($this->_request->getPost());
            $obj->id_usuario=$this->_loggedUser->id_usuario;
            try {
                $obj->save();
                $qrysuma= Doctrine_Query::create()
                    ->select(" SUM(p.existencias) as suma")
                    ->from("Database_Model_ProductoTienda p")
                    ->where("p.id_producto=?",$this->_request->getParam("id"))
                    ->andWhere("p.tienda_id_tienda=?",$this->_request->getPost("id_tienda"))
                ;
                //echo $qrysuma->getSqlQuery();//imprime la consulta qu ese esta generando
                $ejesuma=$qrysuma->execute();
                foreach($ejesuma as $sum){
                    $suma=$sum->suma;

                }
                $totsuma=$suma+$this->_request->getPost("cantidad");
                $ejeexiste= Doctrine_Query::create()
                    ->from("Database_Model_ProductoTienda")
                    ->where("id_producto=".$this->_request->getParam("id"))
                    ->andWhere("tienda_id_tienda=".$this->_request->getPost("id_tienda"));
              //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                $identr="0";
                foreach($ejeexiste->execute() as $ex){
                    $identr=$ex["id_productotienda"];//si tiene id si existe esta relacion entre el producto y la tienda
                }

                if($identr>0){
                    $q = Doctrine_Query::create()
                        ->update('Database_Model_ProductoTienda')
                        ->set('existencias', '?', $totsuma)
                        ->where('id_producto = ?', $this->_request->getParam("id"))
                        ->andWhere("tienda_id_tienda=?",$this->_request->getPost("id_tienda"));
                    $q->execute();
                }else{//creamos la reliacion
                    $obj2 = new Database_Model_ProductoTienda();
                    $obj2->fromArray($this->_request->getPost());
                    $obj2->existencias=$this->_request->getPost("cantidad");
                    $obj2->tienda_id_tienda=$this->_request->getPost("id_tienda");
                   try{
                         $obj2->save();
                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
                }
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }


    function verAction()
    {
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
            ->from("Database_Model_Traspasos t, t.ProductoTienda pt, pt.Producto p, p.Proveedor pro, p.Marca m")
            //->Where("t.status = 'ACTIVO'")
            ->orderBy("t.fecha_registro desc");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
            $query->andWhere("p.codinter LIKE '%$q%'");
            $query->orWhere("pro.nombre_corto LIKE '%$q%'");
            $query->orWhere("m.nombre LIKE '%$q%'");
            $query->orWhere("p.codbarras = ?", $q);

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
}