<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 25/07/11
 * Time: 19:48
 *
 */

class Ventas_AdministrarController extends jfLib_Controller
{

    function init()
    {
        parent::init();
        $this->view->datauserlogged=$this->_loggedUser;

    }
    function indexAction()
    {
        $this->_redirect("ventas/reportes");
    }

    function altaAction()
    {
      
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario=?",$this->_loggedUser->id_usuario)
            ->execute();

        foreach($querytipo as $tipo){
            $tipousu=$tipo["id_usuario_tipo"];
            $this->view->id_tienda=$tipo["id_tienda"];;
        }
        $this->view->tipousu=$tipousu;
        $this->view->usu=$this->_loggedUser->id_usuario;

        if ($this->_request->isPost()) {
            if(!$this->_request->getPost("total-global")){
                return false;
            }


            $obj = new Database_Model_Venta();
            $obj->fromArray($this->_request->getPost());
            $obj->total = $this->_request->getPost("total-global");
            $obj->id_usuario = $this->_loggedUser->id_usuario;
            $obj->fecha =date('Y-m-d H:i:s');
            if($this->_loggedUser->id_usuario_tipo==2 || $this->_loggedUser->id_usuario_tipo==5){
                $obj->id_usuario = $this->_request->getPost("id_usuario");
                $obj->fecha = $this->_request->getPost("fecha")." ".date('H:i:s');
            }
            $obj->id_persona = $this->_request->getPost("id_persona");
            $obj->id_tienda = $this->_request->getPost("id_tienda");


            if ($this->_request->getPost("tipo")=="Credito") {
                $obj->icredito = 1;
            }

            //recibimos los arrays
            $cantidades = $this->_request->getPost("cantidad");
            $productos = $this->_request->getPost("id_producto");
            $totales = $this->_request->getPost("total");
            $costos = $this->_request->getPost("costototal");


            $descripciondesc = $this->_request->getPost("descripciondesc");
            $usuariodesc = $this->_request->getPost("usuariodesc");
            $porcentajedesc = $this->_request->getPost("porcentajedesc");
            $totaldesc = $this->_request->getPost("totaldesc");
            $montodesc = $this->_request->getPost("montodesc");
            $tipoprecio = $this->_request->getPost("tipoprecio");
            $desc = $this->_request->getPost("desc");

            $error=0;
            $queryfolio = Doctrine_Query::create()
                ->from("Database_Model_Venta")
                ->where("id_tienda=?",$obj->id_tienda)
                ->orderBy("folio desc")
                ->limit(1);
            $folio=1;
            foreach($queryfolio->execute() as $objfolio){
                $folio = $objfolio->folio+1;
            }



            try {
                $obj->folio=$folio;
                $obj->save();
                $id = $obj->getIncremented();
            } catch (Exception $e) {
                // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                echo "erro vent".$e;
                exit;
            }
            foreach ($productos as $key => $val) {

                $producto = Database_Model_Producto::getById($val);

                if ($producto) {

                    $iObj = new Database_Model_ProductosVenta();
                    $iObj->cantidad = $cantidades[$key];
                    $iObj->total = $totales[$key];
                    $iObj->costototal = $costos[$key];
                    $iObj->tipoprecio = $tipoprecio[$key];
                    $iObj->nombre = $producto->nombre;
                    $iObj->folio=$folio;
                    $iObj->id_venta=$id;

                    $cantventa=$iObj->cantidad;

                    $query = Doctrine_Query::create()
                        ->from("Database_Model_ProductoTienda")
                        ->where("id_producto=".$producto->id_producto)
                        ->andWhere("tienda_id_tienda=".$obj->id_tienda)
                        ->andWhere("status='ACTIVO'");

                    //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
                    foreach($query->execute() as $objt){
                        $id_productotienda=$objt["id_productotienda"];
                    }
                    if($id_productotienda>0){//el producto en esta tienda si existe

                        $iObj->id_productotienda = $id_productotienda;

                        $productotienda = Database_Model_ProductoTienda::getById($id_productotienda);

                        if($productotienda->Producto->manual){//recargas
                            try {
                                //$obj->ProductosVenta->add($iObj);
                                $iObj->save();
                            } catch (Exception $e) {
                                // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                echo "error linea pv 1".$e;
                                exit;
                            }
                        }else{
                            if($productotienda->existencias>=$iObj->cantidad){


                                /////////////si es paquete decrementamos los productos del paquete
                                if($producto->paquete==1){
                                    $iObj->paquete=1;
                                    $querypaquete = Doctrine_Query::create()
                                        ->from("Database_Model_Paquete")
                                        ->where("id_producto=?",$val)
                                        ->andWhere("status='ACTIVO'")
                                        ->orderBy("id_producto ") ;
                                    $id_productocompuesto="";
                                    foreach($querypaquete->execute() as $objpaquete){
                                        $id_productocompuesto = $objpaquete->id_productocompuesto;
                                        $querypaquetetienda = Doctrine_Query::create()
                                            ->from("Database_Model_ProductoTienda")
                                            ->where("id_producto=?",$id_productocompuesto)
                                            ->andWhere("tienda_id_tienda=?",$obj->id_tienda)
                                            ->andWhere("status='ACTIVO'");
                                        foreach($querypaquetetienda->execute() as $objtpq){
                                            $id_productopqtienda=$objtpq["id_productotienda"];
                                        }
                                        $productotiendapq = Database_Model_ProductoTienda::getById($id_productopqtienda);
                                        $productotiendapq->existencias-=$objpaquete->cantidad;//decrementamos las existencias
                                        try {
                                            $productotiendapq->save();
                                        } catch (Exception $e) {
                                            // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                            echo "error linea pt".$e;
                                            exit;
                                        }

                                    }
                                }else{
                                    $productotienda->existencias-=$iObj->cantidad;//decrementamos las existencias
                                }
                                ///////////////////////////////////termina si es paquete
                                try {

                                   // $producto->save();

                                    //termina peps
                                    //$obj->ProductosVenta->add($iObj);
                                    $iObj->save();
                                    $productotienda->save();
                                } catch (Exception $e) {
                                    // $this->sendErrorMail("VENTA ALTA LINEA 48  (INVENTARIO):" . $e);
                                    echo "error linea pv2".$e;
                                    exit;
                                }
                            }else{
                                $error=1;
                                $msj= "Las Existencias del producto: ".$productotienda->Producto->nombre." en esta tienda son insuficientes, solo se cuentan con: ".$productotienda->existencias;
                                echo "<script>alert('".$msj."');</script>";

                            }
                        }

                    }else{
                        $error=1;
                        $msj= "No hay Existencias del producto: ".$iObj->nombre." en esta tienda";
                        echo "<script>alert('".$msj."');</script>";
                    }
                }


            }//end foreach

            try {
                if($error==0){

                    $obj->folio=$folio;
                    $obj->save();
                    $id = $obj->getIncremented();
                    foreach ($porcentajedesc as $key => $i) {
                        $iObjdesc = new Database_Model_Descuentos();
                        $iObjdesc->descripciondesc = $descripciondesc[$key];
                        $iObjdesc->id_usuario = $usuariodesc[$key];
                        $iObjdesc->porcentajedesc = $porcentajedesc[$key];
                        $iObjdesc->totaldesc = $totaldesc[$key];
                        $iObjdesc->montodesc = $desc[$key];
                        $iObjdesc->id_venta = $id;

                        try {
                            $iObjdesc->save();
                        } catch (Exception $e) {
                            $this->_informError($e);
                        }
                    }
                    if($abono=$this->_request->getPost("abono")){
                        $obj = new Database_Model_Deudores();
                        $obj->fecha_abono=$this->_request->getPost("fecha")." ".date('H:i:s');
                        $obj->id_persona=$this->_request->getPost("id_persona");
                        $obj->comentarios="Abono Inicial";
                        $obj->id_usuario = $this->_loggedUser->id_usuario;
                        $obj->montoabono = $abono;
                        $obj->id_venta = $id;
                       
                            $saldo=$abono;
                        
                        $venta = Database_Model_Venta::getById($id);
                        if($saldo<$venta->total){//si el saldo pagado es menor a la cantidad vendida
                            try {
                                if($obj->montoabono+$saldo==$venta->total){
                                    $venta->total+=$obj->montoabono;
                                    $q = Doctrine_Query::create()
                                        ->update('Database_Model_Venta')
                                        ->set('icredito', '?', "0")
                                        ->where('id_venta = ?', $id);
                                    $q->execute();
                                }
                                $obj->save(); 
                            } catch (Exception $e) {
                                $this->_informError($e);
                            }
                        }
                    }

                    $this->_informSuccess(null, true, "ventas/administrar/ver/id/" . $id);
                }
            } catch (Exception $e) {
                $this->_informError($e);
            }

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
    function verdevolucionAction()
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
    function imprimirdpAction()
    { $this->_disableLayout();
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }
        $obj = Doctrine_Core::getTable("Database_Model_VentaProductocancelado")->findOneBy("id_venta_productocancelado", $id);

        if (!$obj) {
            $this->_informError();
        }
        $this->view->obj = $obj;
    }
    function verdevolucionproductoAction()
    {
        $id = $this->_request->getParam("id");
        if (!$id) {
            $this->_informError();
        }
        $obj = Doctrine_Core::getTable("Database_Model_VentaProductocancelado")->findOneBy("id_venta_productocancelado", $id);

        if (!$obj) {
            $this->_informError();
        }
        $this->view->obj = $obj;
    }
    function addproductoAction()
    {
        if($this->_loggedUser->id_usuario){


            $this->_disableAllLayouts();

            $id = trim($this->_request->getParam("id_producto"));
            if(!$id){
                return false;
            }
            $tipoprecio = $this->_request->getParam("tipoprecio");
            $cantidad   = $this->_request->getParam("cantidad");
            $obj = Database_Model_Producto::getByCodbar($id);         
            
            $tipousu=$this->_loggedUser->id_usuario_tipo;
            if($tipousu=="2" || $tipousu=="5" ){
                if($this->_request->getParam("id_tienda")!=""){
                    $tienda= $this->_request->getParam("id_tienda");

                }else{
                    echo "<script>alert('No se ha seleccionado Ninguna Tienda');   </script>";
                    $error=1;
                }
            }else{
                $tienda=$tipo["id_tienda"];
            }
            $existe=0;
            $idpt=0;
            $qryexisteentienda = Doctrine_Query::create()
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=?",$obj->id_producto)
                ->andwhere("tienda_id_tienda=?",$tienda)
                ->execute();
            foreach($qryexisteentienda as $existe){
                $idpt=$existe["id_productotienda"];
                $existe=1;
            }
            $objpt = Doctrine_Core::getTable("Database_Model_ProductoTienda")->findOneBy("id_productotienda", $idpt);

            if (!$objpt) {
                $objpti = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                $objpti->id_producto      = $obj->id_producto;
                $objpti->tienda_id_tienda = $tienda;
                $objpti->existencias      = $cantidad;//solo asta que se valide
                $objpti->save();//guardamos la nueva relacion
                
            }else{
                $objpt->existencias = $cantidad;
                $objpt->save();
            }
            

            $preciodesc = 0;
            $precio     = 0;
            $costo      = 0;
            $ejeprecio= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                ->andWhere("b.status='ACTIVO'")
                ->orderBy("id_entrada_producto DESC")
                ->limit(1);
            
            foreach($ejeprecio->execute() as $ex){
                $precio    = $ex["precio"];//sacamos el ultimo precio por fecha mientras no se allan vendido
                $costo     = $ex["costo"];//sacamos el ultimo precio por fecha mientras no se allan vendido
                $preciodesc= $ex["precio_descuento"];//sacamos el ultimo precio por fecha mientras no se allan vendido
            }

            $obje = new Database_Model_Entrada();
            $obje->id_usuario     = $this->_loggedUser->id_usuario;
            $obje->id_tienda      = $tienda;
            $obje->fecha          = date('Y-m-d H:i:s');
            $obje->status         = "ACTIVO";
            $obje->concepto       = "";
            $obje->referencia     = "ENTRADA DIRECTA EN VENTA";
            $obje->save();
            $id = $obje->getIncremented();

            $iObj = new Database_Model_EntradaProducto();
            $iObj->cantidad         = $cantidad;
            $iObj->precio           = $precio;
            $iObj->precio_descuento = $preciodesc;
            $iObj->costo            = $costo;
            
            $iObj->totalcosto       = $cantidad*$costo;
            $iObj->id_entrada       = $id;
            $iObj->nombre           = $obj->nombre;
            $iObj->id_producto      = $obj->id_producto;
            $iObj->id_tienda        = $tienda;
            $iObj->save();
            echo 1;
              
        }else{
            echo "<script>alert('su tiempo de sesion ha expirado favor de actualizar su pagina');   </script>";
        }

    }

    function getproductoAction()
    {
        if($this->_loggedUser->id_usuario){


            $this->_disableLayout();

            $id = trim($this->_request->getParam("id_producto"));
            if(!$id){
                return false;
            }
            $cantidad = $this->_request->getParam("cantidad");
            $obj = Database_Model_Producto::getByCodbar($id);
            $querytipo = Doctrine_Query::create()
                ->from("Database_Model_Usuario")
                ->where("id_usuario=?",$this->_loggedUser->id_usuario)
                ->execute();
            $tipousu="";
            $error=0;
            $tipoprecio=$this->_request->getParam("tipoprecio");
            foreach($querytipo as $tipo){
                $tipousu=$tipo["id_usuario_tipo"];
                if($tipousu=="2" || $tipousu=="5" ){
                    if($this->_request->getParam("id_tienda")!=""){
                        $tienda= $this->_request->getParam("id_tienda");

                    }else{
                        echo "<script>alert('No se ha seleccionado Ninguna Tienda');   </script>";
                        $error=1;
                    }
                }else{
                    $tienda=$tipo["id_tienda"];
                }
                $existe=0;
                $idpt=0;
                $qryexisteentienda = Doctrine_Query::create()
                    ->from("Database_Model_ProductoTienda")
                    ->where("id_producto=?",$obj->id_producto)
                    ->andwhere("tienda_id_tienda=?",$tienda)
                    ->andwhere("existencias>0")
                    ->andwhere("existencias>=".$cantidad)
                    ->execute();
                foreach($qryexisteentienda as $existe){
                    $idpt=$existe["id_productotienda"];
                    $existe=1;
                }
                ?>
            <?php
            }
            if($obj->manual){ //recargas y excedentes
                $existe=1;
            }


            if($existe==1){
                if ($obj && $error==0) {
                    $error2=0;
                    if($obj->paquete==1){

                        $querypaquete1 = Doctrine_Query::create()
                            ->from("Database_Model_Paquete")
                            ->where("id_producto=?",$obj->id_producto)
                            ->andWhere("status='ACTIVO'")
                            ->orderBy("id_producto ") ;
                        $contadorpaquete=0;
                        foreach($querypaquete1->execute() as $objpaquete1){
                            $contadorpaquete++;
                        }

                        $querypaquete = Doctrine_Query::create()
                            ->from("Database_Model_Paquete")
                            ->where("id_producto=?",$obj->id_producto)
                            ->andWhere("status='ACTIVO'")
                            ->orderBy("id_producto ") ;
                        $contprods=0;
                        foreach($querypaquete->execute() as $objpaquete){
                            $id_productocompuesto = $objpaquete->id_productocompuesto;
                            $querypaquetetienda = Doctrine_Query::create()
                                ->from("Database_Model_ProductoTienda")
                                ->where("id_producto=".$id_productocompuesto)
                                ->andWhere("tienda_id_tienda=".$tienda)
                                ->andWhere("existencias>=".$objpaquete->cantidad)
                                ->andWhere("status='ACTIVO'");
                            // echo $querypaquetetienda->getSqlQuery();//imprime la consulta qu ese esta generando
                            foreach($querypaquetetienda->execute() as $objtpq){
                                $contprods++;
                            }
                        }


                        if($contadorpaquete==$contprods){
                            $error2=0;
                        }else{
                            $error2=1;
                        }
                    }

                    if($error2==0){
                        $this->view->obj = $obj;
                        $this->view->id_tienda=$tienda;
                        $this->view->tipoprecio=$tipoprecio;
                        $this->view->cantidad = $cantidad;
                    }else{
                        echo "<script>alert('No cuenta con todos los productos del paquete' )</script>";
                    }

                }
            }else{
                echo "SIN EXISTENCIA";
            }
        }else{
            echo "<script>alert('su tiempo de sesion ha expirado favor de actualizar su pagina');   </script>";
        }

    }

    function descuentogerencialAction()
    {
        $this->_disableLayout();

        $this->view->monto = $monto = $this->_request->getParam("monto");
        $id_usuario = $this->_request->getParam("id_usuario");
        $password = $this->_request->getParam("password");
        $cli= $this->_request->getParam("id_persona");
        $this->view->total = $total = $this->_request->getParam("total-global");
        $obj = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario = ?", $id_usuario)
            ->andWhere("password = ?", $password)
            ->fetchOne();


        $objper = Doctrine_Core::getTable("Database_Model_Persona")->findOneBy("id_persona", $cli);

            if($obj){
                    $this->view->obj = $obj;

            }else{
                echo "<script>alert('Error en la verificacion del usuario');</script>";
            }


    }
    function consignacionAction(){
        $this->_disableAllLayouts();
        $cliente= $this->_request->getParam("id_persona");
        $objper = Doctrine_Core::getTable("Database_Model_Persona")->findOneBy("id_persona", $cliente);
        if($objper->nombre!="Publico en General"){//tiene que ser cliente para poder hacer una consignacion
            $id_usuario = $this->_request->getParam("id_usuario");
            $password = $this->_request->getParam("password");
                $obj = Doctrine_Query::create()
                    ->from("Database_Model_Usuario")
                    ->where("id_usuario = ?", $id_usuario)
                    ->andWhere("password = ?", $password)
                    ->fetchOne();

           if($obj){
               echo 1;
           }else{
               echo 0;
           }
        }else{

            echo 2;
        }
    }

    function imprimirAction()
    {


        $this->_disableLayout();

        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Doctrine_Core::getTable("Database_Model_Venta")->findOneBy("id_venta", $id);

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
    function imprimirtmAction()
    {


        $this->_disableLayout();

        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Doctrine_Core::getTable("Database_Model_Venta")->findOneBy("id_venta", $id);

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
    function imprimirtrAction()
    {
        $this->_disableLayout();

        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Doctrine_Core::getTable("Database_Model_Venta")->findOneBy("id_venta", $id);

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
    function imprimirdAction()
    {


        $this->_disableLayout();

        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Doctrine_Core::getTable("Database_Model_Venta")->findOneBy("id_venta", $id);

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

    function mostrarcatalogoAction(){
        $this->_disableLayout();
        $this->view->id_tiendaselected=$this->_request->getParam("id_tienda");
    }
    function addpopupAction(){
        $this->_disableLayout();
        $this->view->id_tiendaselected=$tienda=$this->_loggedUser->id_tienda;
        
    }
    function saveaddpopupAction(){
        $this->_disableAllLayouts();
        $this->view->id_tiendaselected=$tienda=$this->_loggedUser->id_tienda;
        if ($this->_request->isPost()) {
            $obj = new Database_Model_Persona();
            $obj->fromArray($this->_request->getPost());
            $obj->id_usuario_tipo=1;
             try {
                $obj->id_tienda=$tienda;
                $obj->save();
                echo $obj->getIncremented();
            } catch (Exception $e) {
                $this->_informError($e);
            }
                   
        }
    }
    function agregarclienteAction(){
        $this->_disableLayout();
    }
    function obtenerclienteAction(){
        $this->_disableLayout();
    }
    function altaagregarclienteAction(){
        $this->_disableAllLayouts();
        if ($this->_request->getParam("id_usuario_tipo")) {
            $obj = new Database_Model_Persona();
            $obj->fromArray($this->_request->getParams());
            $tienda=$this->_loggedUser->id_tienda;
            $tipousu=$this->_loggedUser->id_usuario_tipo;
            try {
                $obj->id_tienda=$tienda;
                $obj->save();
                echo "Exito al dar de alta";
                //  $this->_informSuccess();
            } catch (Exception $e) {
                echo "Error al dar de alta";
            }

        }

    }

    function buscarproductoAction(){
        $this->_disableLayout();
        $query = array();
        if ($q = $this->_request->getParam("q")) {
               $tienda=$this->_loggedUser->id_tienda;
                $this->view->id_tienda=$tienda;
            $query = Doctrine_Query::create()
                ->from("Database_Model_Producto p")
                ->Where("p.status='ACTIVO'")//REVISAR PORQUE SIGUE MOSTRANDO PRODUCTOS QUE ESTÁN ELIMINADOS
                ->andwhere("(p.codbarras = ?", $q)
                ->orWhere("p.nombre LIKE '%$q%'")
                ->orWhere("p.codinter LIKE '%$q%')")

                ->limit(50)
                ->orderBy("p.nombre")
                ->execute();

        }
        $this->view->id_tiendaselected=$this->_request->getParam("id_tiendaselected");

        $this->view->query = $query;
    }
    function damevendedoresAction()
    {
        $c = Doctrine_Query::create()
            ->from('Database_Model_Usuario')
            ->where("status = 'ACTIVO'")
            ->orderBy('id_usuario ASC')
            ->execute();

        if (sizeof($c) == 0) {
            $this->getHelper('json')->sendJson(array(
                'status' => 'invalid', 'response' => 'No bycicles exist with the given sku'));
        } else {
            $this->getHelper('json')->sendJson(array(
                'status' => 'ok', 'response' =>
                    $c->toArray()
            ));
        }
    }


    function cancelarAction()
    {
        $this->_disableLayout();
        $this->_disableView();
        $id = $this->_request->getParam("id");

        if (!$id) {
            $this->_informError();
        }

        $obj = Database_Model_Venta::getById($id);

        if (!$obj) {
            $this->_informError();
        }
        $obj->cancelado = 1;
        $total=0;
        if($obj->id_tienda==$this->_request->getParam("id_tienda_destino")){
            foreach ($obj->ProductosVenta as $prodVenta) {
                if (!$prodVenta->cancelado) {
                    $prodVenta->cancelado = 1;
                    if ($prodVenta->ProductoTienda) {
                        $prodVenta->ProductoTienda->existencias += $prodVenta->cantidad;
                    }
                    try {
                        $total+=$prodVenta->total;
                        $prodVenta->save();
                    } catch (Exception $e) {
                       // echo 0;
                    }
                }
            }
        }else{
            foreach ($obj->ProductosVenta as $prodVenta) {
                if (!$prodVenta->cancelado) {
                    $prodVenta->cancelado = 1;
                    if ($prodVenta->ProductoTienda) {
                        $queryptn = Doctrine_Query::create()
                            ->from("Database_Model_ProductoTienda")
                            ->where("id_producto=?",$prodVenta->ProductoTienda->id_producto)
                            //->andWhere("status='ACTIVO'")
                            ->andWhere("tienda_id_tienda=?",$this->_request->getParam("id_tienda_destino"))
                           ;
                        $id_tiendaprodnvo="";
                        foreach($queryptn->execute() as $objptn){
                            $id_tiendaprodnvo=$objptn->id_productotienda;
                        }
                        if($id_tiendaprodnvo>0){
                            $objptn->existencias += $prodVenta->cantidad;
                        }else{//si no existe la relacion tienda con producto la creamos
                            $objptiant = new Database_Model_ProductoTienda();//creamos la relacion de productotienda
                            $objptiant->id_producto=$prodVenta->ProductoTienda->id_producto;
                            $objptiant->tienda_id_tienda=$this->_request->getParam("id_tienda_destino");
                            try {
                                $objptiant->existencias += $prodVenta->cantidad;
                                $objptiant->save();
                            } catch (Exception $e) {
                                //  echo 0;
                            }
                        }

                    }
                    try {
                        $total+=$prodVenta->total;
                        $prodVenta->save();
                        $objptn->save();
                    } catch (Exception $e) {
                      //  echo 0;
                    }
                }
            }

        }


        try {
            $obj->cancelado = 1;
            $obj3 = new Database_Model_VentaCancelada();
            $obj3->id_venta=$this->_request->getParam("id");
            $obj3->observaciones=$this->_request->getParam("observaciones");
            $obj3->id_tienda_destino=$this->_request->getParam("id_tienda_destino");
            $obj3->fecha_registro=$this->_request->getParam("fechadevolucion");
            $obj3->id_usuario=$this->_loggedUser->id_usuario;
            $obj3->total=$total;

            try{
                $obj->save();
                $obj3->save();
                echo 1;
               // $this->_informSuccess(null, true, "ventas/administrar/");
            } catch (Exception $e) {
                //echo 0;
            }
        } catch (Exception $e) {
            //echo 0;
        }
    }


    function migrarAction()
    {
        $this->_disableView();

        $query = Doctrine_Query::create()
            ->from("Database_Model_ProvisionalVentas")
            ->where(
                "id_usuario IN ('anel','anita','blanca')"
            )
            ->execute();

        foreach ($query as $q) {
            $obj = new Database_Model_Venta();

            $obj->fromArray($q->toArray());

            try {
                $obj->save();
            } catch (Exception $e) {
                echo $e;
            }
        }
    }


}