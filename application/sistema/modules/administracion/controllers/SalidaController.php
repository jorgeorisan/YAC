<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_SalidaController extends jfLib_Controller
{

    function init()
    {
        parent::init();
        $this->view->datauserlogged=$this->_loggedUser;

    }
    function _onlyAdmin()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2" || $this->_loggedUser->id_usuario_tipo != "5") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }
    }
    function indexAction(){
        //
        $form = new Administracion_Form_Salida();

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
            ->from("Database_Model_Salida")
            ->where("DATE(fecha) >= '$from'")
            ->andWhere("DATE(fecha) <= '$to'");


        if ($id_usuario = $this->_request->getParam("id_usuario")) {
            $query->andWhere("id_usuario = ?", $id_usuario);
        }


        $this->view->query = $query->execute();
        $this->view->form = $form;
    }



    function altaAction(){
        
        if($this->_request->getParam("id")){
            $obj = Doctrine_Core::getTable("Database_Model_Producto")->findOneBy("id_producto", $this->_request->getParam("id"));
            $this->view->codint=$obj->codinter;
        }
        $this->view->tipousu =$this->_loggedUser->id_usuario_tipo;
        $this->view->usu =$this->_loggedUser->id_usuario;
        $this->view->idtienda =$this->_loggedUser->id_tienda;
        if ($this->_request->isPost()) {

            $obj = new Database_Model_Salida();
            $obj->fromArray($this->_request->getPost());
            $obj->costo_total = $this->_request->getPost("total-global");
            $obj->id_usuario = $this->_loggedUser->id_usuario;
            $obj->id_tienda = $this->_request->getPost("id_tiendaanterior");

                $obj->id_tiendaanterior = $this->_loggedUser->id_tienda;
            $obj->status="POR AUTORIZAR";
            $obj->concepto="SALIDA DE ALMACEN";
//recibimos los arrays
            $cantidades = $this->_request->getPost("cantidad");
            $productos = $this->_request->getPost("id_producto");
            $totales = $this->_request->getPost("total");
            $precio = $this->_request->getPost("precio");
            $preciodescuento=$this->_request->getPost("precio_descuento");
            $costo = $this->_request->getPost("costo");

            $multiplicador = $this->_request->getPost("multiplicador");//no es un array

            $error=0;
            $cantproductos=0;
            try {

               //$obj->total=$cantproductos;
                $obj->save();
                $id = $obj->getIncremented();
            } catch (Exception $e) {
                $this->_informError($e);
            }
            foreach ($productos as $key => $val) {
                $producto = Database_Model_Producto::getById($val);
                if ($producto) {
                    $iObj = new Database_Model_SalidaProducto();
                    $iObj->cantidad = $cantidades[$key];
                    $iObj->precio = $precio[$key];
                    $iObj->precio_descuento = $preciodescuento[$key];
                    $iObj->costo = $costo[$key];
                    $iObj->totalcosto = $totales[$key];
                    $iObj->nombre = $producto->nombre;
                    $iObj->id_producto = $val;
                    $iObj->id_tienda=14;
                    $iObj->multiplicador=$multiplicador;
                    $iObj->iva=1.16;
                    $iObj->id_salida=$id;
                   
                    $cantproductos=$cantproductos+$iObj->cantidad;

                    $query = Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$producto->id_producto)
                        ->andWhere("tienda_id_tienda=14")
                        ->andWhere("status='ACTIVO'")
                        ->fetchOne();
                    //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
                    if($query){
                        $id_productotienda = $query->id_productotienda;                       
                        try {
                            $objpti = Doctrine_Core::getTable("Database_Model_ProductoTienda")->findOneBy("id_productotienda",$id_productotienda);
                            $objpti->existencias+= $cantidades[$key];                           
                            $objpti->save();
                        } catch (Exception $e) {
                            echo "error en salida de producto cuando el producto si existe". $e;
                            exit();
                        }
                    }else{
                        $objpti = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                        $objpti->id_producto      = $producto->id_producto;
                        $objpti->tienda_id_tienda = 14;
                        $objpti->existencias      = $cantidades[$key];
                        try {
                            $objpti->save();
                        } catch (Exception $e) {
                            echo "error en Salida de producto cuando el producto no existe". $e;
                            exit();
                        }
                    }    
                    $iObj->save();
                    $this->_informSuccess();
                }
            }//end foreach
        }
    }
    function getproductoAction(){
        $this->_disableLayout();
       // $id = $this->_request->getParam("id_producto");
        $id = $this->_request->getParam("barcode");


        $idtienda = $this->_loggedUser->id_tienda;


        if($id!=""){
            $cantidad = $this->_request->getParam("cantidad");
            $obj = Database_Model_Producto::getByCodbar($id);

                $tipousu=$this->_loggedUser->id_usuario_tipo;
                $tienda=$this->_loggedUser->id_tienda;

            if ($obj ) {
                $obj3 = Doctrine_Query::create()
                    ->from("Database_Model_ProductoTienda")
                    ->where("id_producto=?",$obj->id_producto)
                    ->andWhere("tienda_id_tienda=?",$idtienda)
                    ->andWhere("status='ACTIVO'")
                    ;
                //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
                $existencia=0;
                foreach($obj3->execute() as $objj3){
                    $id_productotienda2=$objj3->id_productotienda;
                    $existencia=$objj3->existencias;
                }
                ?>
                <script>
                  //  alert('jaja<?php echo $id_productotienda2;  ?>');
                </script>
                <?php
                $error=0;
                if (!$obj3) {
                    echo "<script>alert('No existe relacion del producto');   </script>";
                    $error=1;
                    //$this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
                }else{
                    if ($existencia<$cantidad) {
                        echo "<script>alert('Cantidad insuficiente para Salida');   </script>";
                    }else{
                        $this->view->tipousu=$tipousu;
                        $this->view->obj = $obj;
                        $this->view->id_tienda=$tienda;
                        $this->view->cantidad = $cantidad;
                    }
                }
            }else {
                echo "<script>alert('No existe este producto');   </script>";
            }

        }else{
            echo "<script>alert('No se ha seleccionado Ningun Producto');   </script>";
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
        $obj = Doctrine_Core::getTable("Database_Model_Salida")->findOneBy("id_salida", $id);

        if (!$obj) {
            $this->_informError();
        }
        $this->view->obj = $obj;
    }


    function borrarAction()
    {
        if ($this->_loggedUser->id_usuario_tipo == "4") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_EntradaProducto::getById($this->_request->getParam("id"));
            $ejeexiste1= Doctrine_Query::create()
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=".$obj->id_producto)
                ->where("tienda_id_tienda=".$obj->id_tienda)
            ;
            //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generand
            foreach($ejeexiste1->execute() as $ex1){
                $idproductoti=$ex1->id_productotienda;

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
        }
    }
    function imprimirAction()
    {
        $this->_disableLayout();
        $id = $this->_request->getParam("id");

        $obj = Doctrine_Core::getTable("Database_Model_Salida")->findOneBy("id_salida", $id);

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

        $obj = Database_Model_Salida::getById($id);

        if (!$obj) {
            $this->_informError();
        }
        $obj->cancelado = 1;

        if($obj->status=="ACTIVO"){
            foreach ($obj->SalidaProducto as $prodVenta) {
                if ($prodVenta->Producto) {
                    $ejeexiste= Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=?",$prodVenta->id_producto)
                        ->andWhere("tienda_id_tienda=?",$obj->id_tienda);
                    //  echo $ejeexiste->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($ejeexiste->execute() as $ex){
                        $identr=$ex->id_productotienda;//si tiene id si existe esta relacion entre el producto y la tienda
                    }
                    $objpt = Database_Model_ProductoTienda::getById($identr);
                    $objpt->existencias+= $prodVenta->cantidad;
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

                $this->_informSuccess();

        } catch (Exception $e) {
            $this->_informError();
        }

    }

}