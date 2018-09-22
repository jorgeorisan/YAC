<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jfhernandez
 * Date: 23/11/11
 * Time: 21:30
 *
 */

class Administracion_ProductosController extends jfLib_Controller
{
    protected $TITLE = "Reporte de Inventario por Tienda";
    protected $TITLE2 = "Reporte de Consumibles";
    private $DB_MODEL_ID = "id_embarcacion";

    function init(){
        parent::init();
        $this->view->TITLE = $this->TITLE;
        $this->view->TITLE2 = $this->TITLE2;
        $this->view->DB_MODEL_ID = $this->DB_MODEL_ID;

    }

    function indexAction()
    {
        ///////////////////tipo de usuario y su tienda

        $tipousu=$this->_loggedUser->id_usuario_tipo;
        $tienda=$this->_loggedUser->id_tienda;

        $this->view->tipousu = $tipousu;
        $this->view->usu = $this->_loggedUser->id_usuario;
        $this->view->tienda = $tienda;
        ////////////////////////////////////////

        // Defining initial variables

        $query = Doctrine_Query::create()
            ->from("Database_Model_Producto p, p.Proveedor pro, p.Marca m")
            ->Where("p.status = 'ACTIVO'")
            ->orderBy("codinter ASC");
        if ($id_marca = $this->_request->getParam("id_marca")) {//para la busqueda
            $query->andWhere("p.id_marca =?",$id_marca);
            $this->view->id_marca=$id_marca;
        }
        if ($id_categoria = $this->_request->getParam("id_categoria")) {//para la busqueda
            $query->andWhere("p.id_categoria =?",$id_categoria);
            $this->view->id_categoria=$id_categoria;
        }
        if ($id_proveedor = $this->_request->getParam("id_proveedor")) {//para la busqueda
            $query->andWhere("p.id_proveedor =?",$id_proveedor);
            $this->view->id_proveedor=$id_proveedor;

        }

            $this->view->vertodo=$this->_request->getParam("vertodo");




        $this->view->query = $query->execute();

    }
    function imprimirtodoAction()
    {
        $this->_disableLayout();
        ///////////////////tipo de usuario y su tienda
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario=?",$this->_loggedUser->id_usuario)
            ->execute();
        $tipousu="";
        foreach($querytipo as $tipo){
            $tipousu=$tipo->id_usuario_tipo;
            $tienda=$tipo->id_tienda;
        }
        $this->view->tipousu = $tipousu;
        $this->view->usu = $this->_loggedUser->id_usuario;
        $this->view->tienda = $tienda;
        ////////////////////////////////////////

        $query = Doctrine_Query::create()
            ->from("Database_Model_Producto p, p.Proveedor pro, p.Marca m")
            ->Where("p.status = 'ACTIVO'")
            ->orderBy("codinter ASC");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
            $query->andWhere("nombre LIKE '%$q%'");
            // $query->orWhere("pro.nombre_corto LIKE '%$q%'");
            // $query->orWhere("m.nombre LIKE '%$q%'");
            //$query->orWhere("codbarras = ?", $q);
            $query->orWhere("codinter LIKE '%$q%'");
        }
        if ($id_marca = $this->_request->getParam("id_marca")) {//para la busqueda
            $query->andWhere("p.id_marca =?",$id_marca);
            $this->view->id_marca=$id_marca;
        }
        if ($id_categoria = $this->_request->getParam("id_categoria")) {//para la busqueda
            $query->andWhere("p.id_categoria =?",$id_categoria);
            $this->view->id_categoria=$id_categoria;
        }
        if ($id_proveedor = $this->_request->getParam("id_proveedor")) {//para la busqueda
            $query->andWhere("p.id_proveedor =?",$id_proveedor);
            $this->view->id_proveedor=$id_proveedor;

        }



        $this->view->query = $query->execute();
    }
    function imprimirtiendaAction()
    {
        $this->_disableLayout();
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
        $this->view->usu = $this->_loggedUser->id_usuario;
        $this->view->tienda = $tienda;
        ////////////////////////////////////////

        $query = Doctrine_Query::create()
            ->from("Database_Model_ProductoTienda t,t.Producto p")
            ->Where("p.status = 'ACTIVO'")
            ->andWhere("t.tienda_id_tienda=".$this->_request->getParam('id_tienda'))
            ->andWhere("t.existencias>0")
            ->orderBy("p.codinter ASC");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
            // $query->orWhere("p.nombre LIKE '%$q%'");
            $query->andWhere("p.status = 'ACTIVO'");
            $query->andWhere("p.codinter LIKE '%$q%'");
        }


        $this->view->query = $query->execute();
    }
    function productotiendaAction(){
        ///////////////////tipo de usuario y su tienda
        $querytipo = Doctrine_Query::create()
            ->from("Database_Model_Usuario")
            ->where("id_usuario=?",$this->_loggedUser->id_usuario)
            ->execute();
        $tipousu="";
        foreach($querytipo as $tipo){
            $tipousu=$tipo["id_usuario_tipo"];
            $tienda=$this->_request->getParam('id_tienda');
        }
        $this->view->tipousu = $tipousu;
        $this->view->usu = $this->_loggedUser->id_usuario;
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
        $url = $this->view->baseUrl($this->_request->getModuleName() . "/" . $this->_request->getControllerName(). "/productotienda/id_tienda/".$this->_request->getParam('id_tienda') );

        $query = Doctrine_Query::create()
            ->from("Database_Model_ProductoTienda t,t.Producto p")
            ->Where("p.status = 'ACTIVO'")
            ->andWhere("t.tienda_id_tienda=".$this->_request->getParam('id_tienda'))
            ->andWhere("t.existencias>0")
            ->orderBy("p.codinter ASC");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
           // $query->orWhere("p.nombre LIKE '%$q%'");
            $query->andWhere("p.status = 'ACTIVO'");
            $query->andWhere("p.codinter LIKE '%$q%'");
        }
       // echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
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
    function borrarentradaprodAction()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_EntradaProducto::getById($this->_request->getParam("id"));
            $producto = Database_Model_Producto::getById($obj->id_producto);
            $producto->existencias -= $obj->cantidad;
            try {

                $q2 = Doctrine_Query::create()
                    ->update('Database_Model_Producto')
                    ->set('existencias', '?', $producto->existencias)
                    ->where('id_producto = ?', $producto->id_producto);
                $q2->execute();

                $q = Doctrine_Query::create()
                    ->update('Database_Model_EntradaProducto')
                    ->set('status', '?', "BAJA")
                    ->where('id_entrada_producto = ?', $this->_request->getParam("id"));
                $q->execute();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError();
            }
        }
    }


    function altaAction()
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

            $form = new Administracion_Form_Producto();

            if ($this->_request->isPost() && $form->isValid($this->_request->getParams())) {
                $obj = new Database_Model_Producto();
                $obj->fromArray($this->_request->getParams());
               // var_dump($_FILES['imagen']);
                $qrycodbar= Doctrine_Query::create()
                    ->select("p.codbarras")
                    ->from("Database_Model_Producto p")
                  //  ->where("p.codbarras=".$this->_request->getPost("codbarras"))
                    ->where("p.codinter=?",$this->_request->getPost("codinter"))
                ;
                //echo $qrysuma->getSqlQuery();//imprime la consulta qu ese esta generando
                $ejecodbar=$qrycodbar->execute();
                $codbar="";
                foreach($ejecodbar as $codbar){
                    $codbar=$ejecodbar->codinter;
                }
                if($codbar==""){
                    try {


                        $obj->save();


                        $id = $obj->getIncremented();
                        if($this->_request->getPost("paquete")){
                            $this->_informSuccess(null,true,"/administracion/paquete/alta/id/".$id);
                        }else{
                            $this->_informSuccess(null,true,"/administracion/productos/alta/");
                        }


                    } catch (Exception $e) {
                        $this->_informError($e);
                    }
                }else{
                    echo "<script>alert('Este Codigo Interno ya existe');</script>";
                }
            }

            $this->view->form = $form;

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
            $obj->status="POR AUTORIZAR";
            try {
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

    function editarAction()
    {
        if($this->_loggedUser->id_usuario_tipo)//adminstrador
        {
            $obj = Doctrine_Core::getTable("Database_Model_Producto")->findOneBy("id_producto", $this->_request->getParam("id"));
            if (!$obj) {
                $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
            }
            $form = new Administracion_Form_Producto();
            $form->populate($obj->toArray());
            $this->view->data = $obj->toArray();
            if ($this->_request->isPost() ) {
                $obj->fromArray($this->_request->getParams());
                try {
                    $obj->save();
                    if($this->_request->getParam("id_entrada_producto")>0){
                        $obj2 = Doctrine_Core::getTable("Database_Model_EntradaProducto")->findOneBy("id_entrada_producto",$this->_request->getParam("id_entrada_producto"));
                        try {
                            $obj2->precio=$this->_request->getParam("precio");
                            $obj2->costo=$this->_request->getParam("costo");
                            $obj2->precio_descuento=$this->_request->getParam("precio_descuento");
                            try {
                                $obj2->save();
                                $this->_informSuccess(null,true,"/administracion/productos/editar/id/".$this->_request->getParam("id"));
                            } catch (Exception $e) {
                                $this->_informError($e);
                            }
                        } catch (Exception $e) {
                            // $this->_informError($e);
                            echo $e;

                        }



                    }
                    else{
                        $this->_informSuccess();
                    }
                } catch (Exception $e) {
                    $this->_informError($e);
                }

            }
            $this->view->form = $form;
        }else
        {
            $this->_informError(null,"No cuenta con los permisos para acceder a esta sección. Favor de comunicarse con su administrador.");
            $this->_disableView();
        }
    }
    function detallesproductoAction(){
        $this->_disableLayout();
        $this->view->id = $this->_request->getParam("id");
        $this->view->tipousu = $this->_loggedUser->id_usuario_tipo;//mando el tipo de usuario
    }
    function actualizarAction(){
        $this->_disableLayout();

        if($this->_loggedUser->id_usuario_tipo)//adminstrador
        {
            $obj = Doctrine_Core::getTable("Database_Model_ProductoTienda")->findOneBy("id_productotienda", $this->_request->getParam("id"));
            if (!$obj) {
                $this->_informError(null, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
            }

            $this->view->data = $obj->toArray();
            if ($this->_request->isPost() ) {
                $obj = Doctrine_Core::getTable("Database_Model_ProductoTienda")->findOneBy("id_productotienda", $this->_request->getPost("id"));

                $obj->fromArray($this->_request->getParams());
                try {
                    $obj->save();
                    $this->_informSuccess("",true,'/administracion/productos/kardex/id/'.$obj->id_producto.'?id2='.$obj->id_producto.'&id_sucursal2=13');

                } catch (Exception $e) {
                    $this->_informError($e);
                }

            }
        }else
        {
            $this->_informError(null,"No cuenta con los permisos para acceder a esta sección. Favor de comunicarse con su administrador.");
            $this->_disableView();
        }
    }
    function detallespaqueteAction(){
        $this->_disableLayout();
        $this->view->id = $this->_request->getParam("id");
        $this->view->tipousu = $this->_loggedUser->id_usuario_tipo;//mando el tipo de usuario
    }
    function validainventarioAction(){
        $this->_disableLayout();
        $this->view->id_usuario = $this->_loggedUser->id_usuario;
        if ($this->_request->isPost()) {


            $obj = new Database_Model_ValidaInventario();

            $obj->fromArray($this->_request->getParams());
            $obj->id_usuario= $this->_loggedUser->id_usuario;
            try {
                $obj->save();
                $this->_informSuccess();
            } catch (Exception $e) {
                $this->_informError($e, null, true, $this->_request->getModuleName() . "/" . $this->_request->getControllerName());
            }
        }

    }
    function kardexAction(){
        $query = Doctrine_Query::create()
            //->select("t.id_producto id_producto")
            ->from("Database_Model_ProductoTienda t")
            ->where("id_productotienda = ?", $this->_request->getParam("id"));
            //  ->orderBy("t.nombre ASC")

        if($id=$this->_request->getParam("id2")){
            $query->andwhere("t.tienda_id_tienda=?",$id);
        }else{
            $query->andwhere("t.tienda_id_tienda=?",$this->_loggedUser->id_tienda);
        }
        $this->view->query=$query->fetchOne();;
    }

    function verAction()
    {
        $this->view->obj = Database_Model_Empresa::getById($this->_request->getParam("id"));
    }

    function vercuentaAction()
    {
        $this->view->obj = Database_Model_Cuenta::getById($this->_request->getParam("id"));
    }

    function borrarAction()
    {
        if ($this->_loggedUser->id_usuario_tipo != "2") {
            $this->_informError(null, "Usted no tiene permisos para ingresar.", TRUE, "/");
        }else{
            $obj = Database_Model_Producto::getById($this->_request->getParam("id"));
            try {

                $q = Doctrine_Query::create()
                    ->update('Database_Model_Producto')
                    ->set('status', '?', "BAJA")
                    ->where('id_producto = ?', $this->_request->getParam("id"));
                $q->execute();

              $this->_informSuccess(null, true, "productos/alta/");
            } catch (Exception $e) {
                $this->_informError($e);
            }
        }
    }

    function getproductoAction()
    {
        $this->_setAjaxJSONReponse();
       // hace el disableView disableLayout y poner de header que el contenido es un json

        $obj = Database_Model_Producto::getByCodbar($this->_request->getParam("id"));
        $ejec= $obj->toArray();
        $query = Doctrine_Query::create()
            ->from("Database_Model_Producto")
            ->Where("status = 'ACTIVO'")
            ->andWhere("id_producto !=".$ejec["id_producto"])
            ->orderBy("nombre ASC")
            ->execute();
            echo  "<select id='id_producto' name='id_producto' style='width:460px'>
                    <option value='".$ejec["id_producto"]."'>".$ejec["nombre"]."</option>";
        foreach($query as $obj){
            echo "<option value='".$obj->id_producto."'> ".$obj->nombre."</option>";

        }
        echo "</select>";
    }

    function excelproductotiendaAction(){
        $this->_disableAllLayouts();
         $tienda=$this->_request->getParam('id_tienda');

        $query = Doctrine_Query::create()
            ->from("Database_Model_ProductoTienda t,t.Producto p")
            ->Where("p.status = 'ACTIVO'")
            ->andWhere("t.tienda_id_tienda=".$tienda)
            ->andWhere("t.existencias>0")
            ->orderBy("p.codinter ASC");

        if ($q = $this->_request->getParam("q")) {//para la busqueda
            // $query->orWhere("p.nombre LIKE '%$q%'");
            $query->andWhere("p.status = 'ACTIVO'");
            $query->andWhere("p.codinter LIKE '%$q%'");
        }


        $objPHPExcel = new jfLib_MSDoc_Excel();
        $str_NombreReporte = $this->TITLE;
        // Agrega una imagen
        $objDrawing = new PHPExcel_Worksheet_Drawing();
       $objDrawing->setName('logo cremas');
        $objDrawing->setDescription('PHPExcel logo');
         $objDrawing->setPath('./images/logo.jpg');
        //echo $objDrawing->setPath('http://phpstack-1171-4157-7368.cloudwaysapps.com/puntoventacremas/public/sistema/images/logo.png');
        $objDrawing->setHeight(60);
        $objDrawing->setCoordinates('A2');
        $objDrawing->setOffsetX(30);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //  $objPHPExcel->setActiveSheetIndex(0);
        $counter = 5;
        $total=0;
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, $this->acentos($str_NombreReporte));

        $styleGeneral = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Calibri',
                'color' => array('rgb' => '000000')
            ));

        $styleCabecera = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF')
            ));
        $desde="A".$counter.":";
        $hasta="J".$counter;
        $objPHPExcel->getActiveSheet()->getStyle(
            $desde.
            $objPHPExcel->getActiveSheet()->getHighestColumn() .
            $objPHPExcel->getActiveSheet()->getHighestRow()
        )->applyFromArray($styleGeneral);

        $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->applyFromArray($styleCabecera);

        $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->getFill()->applyFromArray(
            array(
                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => '092F87'),
                'endcolor'   => array('rgb' => '092F87')
            )
        );


        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$counter, 'CONTADOR');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, 'CODIGO INTER');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$counter, 'NOMBRE');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$counter, 'MARCA');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$counter, 'CATEGORIA');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$counter, 'PROVEEDOR');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$counter, 'COSTO');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$counter, 'PRECIO');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$counter, 'EXISTENCIAS');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$counter, 'TIENDA');

        foreach ($query->execute() as $obj) {
            $counter++;

            ////////////////////existencias

            $query = Doctrine_Query::create()
                ->select("ifnull(sum(existencias),0) totexistencias")
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=?",$obj->Producto->id_producto)
                ->andWhere("tienda_id_tienda=?",$this->_request->getParam('id_tienda'))
                ->execute();//verificamos si es adminisrador

            foreach($query as $objt){
                $totexistencias=$objt->totexistencias;
            }

            ////////////////////////////////precio
            $ejeprecio= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                //->andWhere("cantvendida<cantidad")
                ->andWhere("b.status='ACTIVO'")
                ->orderBy("id_entrada_producto DESC")
                ->limit(1);


            $existentes=$totexistencias;
            $precio2=null;
            foreach($ejeprecio->execute() as $ex){
                $existentes=$ex->cantidad-$ex->cantvendida;
                $precio2=$ex->precio;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($precio2){
                $precio=$precio2;
            }else{
                $precio=$obj->Producto->precio;
            }


            $ejecosto= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                ->andWhere("b.status='ACTIVO'")
                //  ->andWhere("a.cantvendida<a.cantidad")
                ->orderBy("id_entrada_producto desc")
                ->limit(1);
            $costoBase0=$obj->Producto->costo;
            // echo $ejecosto->getSqlQuery();//imprime la consulta qu ese esta generando
            $costoBase=0;
            $costoBase1=null;
            foreach($ejecosto->execute() as $excosto){

                $costoBase1=$excosto->costo;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($costoBase1){
                $costoBase=$costoBase1;
            }else{
                $costoBase=$costoBase0;
            }


            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $counter, $counter);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $counter, $obj->Producto->codinter);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $counter, $this->acentos($obj->Producto->nombre));
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $counter, $obj->Producto->Marca->nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $counter, $obj->Producto->Categoria->categoria);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $counter, $obj->Producto->Proveedor->nombre_corto);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $counter, $costoBase);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $counter, $precio);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $counter, $totexistencias);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $counter, $obj->Tienda->nombre);
        }


        $xlsName = $this->TITLE.date("Y-m-d_H-i-s") . ".xlsx";
        $fileName =  $xlsName;
       // echo $fileName = "http://phpstack-1171-4157-7368.cloudwaysapps.com/puntoventacremas/public/sistema/documentos/" . $xlsName;

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

      //  $objWriter->save($fileName);
     //  $objWriter->save("././sistema/documentos/".$fileName);
       $objWriter->save("./documentos/".$fileName);

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=$fileName");
        header("Content-type: application/vnd.ms-excel;charset=latin");
        header("Content-type: text/html; charset=utf-8");
        header("Content-Transfer-Encoding: binary ");

        $objWriter->save("php://output");

    }
    function excelAction(){
        $this->_disableAllLayouts();


        $query = Doctrine_Query::create()
            ->from("Database_Model_ProductoTienda t,t.Producto p")
            ->Where("p.status = 'ACTIVO'")
            ->orderBy("t.tienda_id_tienda ASC");
        if (!$this->_request->getParam("vertodo")) {//para la busqueda
            $query->andWhere("t.existencias>0");
        }

        if ($id_marca = $this->_request->getParam("id_marca")) {//para la busqueda
            $query->andWhere("p.id_marca =?",$id_marca);

        }
        if ($id_categoria = $this->_request->getParam("id_categoria")) {//para la busqueda
            $query->andWhere("p.id_categoria =?",$id_categoria);

        }
        if ($id_proveedor = $this->_request->getParam("id_proveedor")) {//para la busqueda
            $query->andWhere("p.id_proveedor =?",$id_proveedor);


        }



        $objPHPExcel = new jfLib_MSDoc_Excel();
        $str_NombreReporte = $this->TITLE;
        // Agrega una imagen
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('logo cremas');
        $objDrawing->setDescription('PHPExcel logo');
        $objDrawing->setPath('./images/logo.jpg');
        //echo $objDrawing->setPath('http://phpstack-1171-4157-7368.cloudwaysapps.com/puntoventacremas/public/sistema/images/logo.png');
        $objDrawing->setHeight(60);
        $objDrawing->setCoordinates('A2');
        $objDrawing->setOffsetX(30);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        //  $objPHPExcel->setActiveSheetIndex(0);
        $counter = 5;
        $total=0;
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, $this->acentos($str_NombreReporte));

        $styleGeneral = array(
            'font'  => array(
                'size'  => 12,
                'name'  => 'Calibri',
                'color' => array('rgb' => '000000')
            ));

        $styleCabecera = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF')
            ));
        $desde="A".$counter.":";
        $hasta="J".$counter;
        $objPHPExcel->getActiveSheet()->getStyle(
            $desde.
            $objPHPExcel->getActiveSheet()->getHighestColumn() .
            $objPHPExcel->getActiveSheet()->getHighestRow()
        )->applyFromArray($styleGeneral);

        $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->applyFromArray($styleCabecera);

        $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->getFill()->applyFromArray(
            array(
                'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array('rgb' => '092F87'),
                'endcolor'   => array('rgb' => '092F87')
            )
        );


        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$counter, 'CONTADOR');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, 'CODIGO INTER');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$counter, 'NOMBRE');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$counter, 'MARCA');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$counter, 'CATEGORIA');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$counter, 'PROVEEDOR');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$counter, 'COSTO');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$counter, 'PRECIO');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$counter, 'EXISTENCIAS');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$counter, 'TIENDA');

        foreach ($query->execute() as $obj) {
            $counter++;

            ////////////////////existencias

            $query = Doctrine_Query::create()
                ->select("ifnull(sum(existencias),0) totexistencias,tienda_id_tienda")
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=?",$obj->id_producto)
            ->andWhere("tienda_id_tienda=?",$obj->Tienda->id_tienda);
            //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
            // ->execute();//verificamos si es adminisrador
            foreach($query->execute() as $objt){
                $totexistencias=$objt->totexistencias;
            }

            ////////////////////////////////precio
            $ejeprecio= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                //->andWhere("cantvendida<cantidad")
                ->andWhere("b.status='ACTIVO'")
                ->orderBy("id_entrada_producto DESC")
                ->limit(1);


            $existentes=$totexistencias;
            $precio2=null;
            foreach($ejeprecio->execute() as $ex){
                $existentes=$ex->cantidad-$ex->cantvendida;
                $precio2=$ex->precio;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($precio2){
                $precio=$precio2;
            }else{
                $precio=$obj->Producto->precio;
            }


            $ejecosto= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                ->andWhere("b.status='ACTIVO'")
                //  ->andWhere("a.cantvendida<a.cantidad")
                ->orderBy("id_entrada_producto desc")
                ->limit(1);
            $costoBase0=$obj->Producto->costo;
            // echo $ejecosto->getSqlQuery();//imprime la consulta qu ese esta generando
            $costoBase=0;
            $costoBase1=null;
            foreach($ejecosto->execute() as $excosto){

                $costoBase1=$excosto->costo;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($costoBase1){
                $costoBase=$costoBase1;
            }else{
                $costoBase=$costoBase0;
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $counter, $counter);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $counter, $obj->Producto->codinter);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $counter, $obj->Producto->nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $counter, $obj->Producto->Marca->nombre);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $counter, $obj->Producto->Categoria->categoria);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $counter, $obj->Producto->Proveedor->nombre_corto);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $counter, $costoBase);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $counter, $precio);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $counter, $totexistencias);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $counter, $obj->Tienda->nombre);
        }


        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $xlsName = "Reporte de Productos ".date("Y-m-d_H-i-s") . ".xls";
        $fileName = "./documentos/" . $xlsName;

        

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");;
        header("Content-Disposition: attachment;filename=$xlsName");
        header("Content-type: application/vnd.ms-excel;charset=latin");
        header("Content-type: text/html; charset=utf-8");
        header("Content-Transfer-Encoding: binary ");
        $objWriter->save("php://output");

    }
    function excelproductoAction(){
        
        $this->_disableAllLayouts();
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=inventario.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $query = Doctrine_Query::create()
            ->from("Database_Model_ProductoTienda t,t.Producto p")
            ->Where("p.status = 'ACTIVO'")
            ->orderBy("t.tienda_id_tienda ASC");
        if (!$this->_request->getParam("vertodo")) {//para la busqueda
            $query->andWhere("t.existencias>0");
        }

        if ($id_marca = $this->_request->getParam("id_marca")) {//para la busqueda
            $query->andWhere("p.id_marca =?",$id_marca);

        }
        if ($id_categoria = $this->_request->getParam("id_categoria")) {//para la busqueda
            $query->andWhere("p.id_categoria =?",$id_categoria);

        }
        if ($id_proveedor = $this->_request->getParam("id_proveedor")) {//para la busqueda
            $query->andWhere("p.id_proveedor =?",$id_proveedor);


        }
        echo "IDPRODUCTO,CODIGO INTER,NOMBRE,MARCA,CATEGORIA,PROVEEDOR,COSTO,PRECIO,EXISTENCIAS,TIENDA,IDPRODUCTOTIENDA";
        echo "\n";
        $counter=0;
        foreach($query->execute() as $obj){
            $counter++;

            ////////////////////existencias

            $query = Doctrine_Query::create()
                ->select("ifnull(sum(existencias),0) totexistencias,tienda_id_tienda")
                ->from("Database_Model_ProductoTienda")
                ->where("id_producto=?",$obj->id_producto)
                ->andWhere("tienda_id_tienda!=14")
                ->andWhere("tienda_id_tienda=?",$obj->Tienda->id_tienda);
            //  echo $query->getSqlQuery();//imprime la consulta qu ese esta generando
            // ->execute();//verificamos si es adminisrador
             $id_productotienda=$obj->id_productotienda;
            foreach($query->execute() as $objt){
                $totexistencias=$objt->totexistencias;
                
            }

            ////////////////////////////////precio
            $ejeprecio= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                //->andWhere("cantvendida<cantidad")
                ->andWhere("b.status='ACTIVO'")
                ->orderBy("id_entrada_producto DESC")
                ->limit(1);


            $existentes=$totexistencias;
            $precio2=null;
            foreach($ejeprecio->execute() as $ex){
                $existentes=$ex->cantidad-$ex->cantvendida;
                $precio2=$ex->precio;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($precio2){
                $precio=$precio2;
            }else{
                $precio=$obj->Producto->precio;
            }


            $ejecosto= Doctrine_Query::create()
                ->from("Database_Model_EntradaProducto a, a.Entrada b")
                ->where("a.id_producto=?",$obj->id_producto)
                ->andWhere("b.status='ACTIVO'")
                //  ->andWhere("a.cantvendida<a.cantidad")
                ->orderBy("id_entrada_producto desc")
                ->limit(1);
            $costoBase0=$obj->Producto->costo;
            // echo $ejecosto->getSqlQuery();//imprime la consulta qu ese esta generando
            $costoBase=0;
            $costoBase1=null;
            foreach($ejecosto->execute() as $excosto){

                $costoBase1=$excosto->costo;//sacamos el ultimo precio por fecha mientras no se allan vendido
            }
            if($costoBase1){
                $costoBase=$costoBase1;
            }else{
                $costoBase=$costoBase0;
            }
            echo $obj->id_producto.",";
            echo $obj->Producto->codinter.",";
            echo str_replace(","," ",$obj->Producto->nombre).",";
            echo str_replace(","," ",$obj->Producto->Marca->nombre).",";
            echo str_replace(","," ",$obj->Producto->Categoria->categoria).",";
            echo str_replace(","," ",$obj->Producto->Proveedor->nombre_corto).",";
            echo $costoBase.",";
            echo $precio.",";
            echo $totexistencias.",";
            echo $obj->Tienda->nombre.",";
            echo $id_productotienda."";
            
            echo "\n";
        }
    }
    function excelproductocostoAction(){
        $this->_disableAllLayouts();

          $dia=date('d');
        if($dia==1){
            $query = Doctrine_Query::create()
                ->select("existencias as existencias,id_tienda as id_tienda,precio as precio,costo as costo,precio_mayoreo as precio_mayoreo")
                ->from("Database_Model_Inventariocostomensual ")
                ->orderBy("id_tienda ASC");


            $objPHPExcel = new jfLib_MSDoc_Excel();
            $str_NombreReporte = $this->TITLE;
            // Agrega una imagen
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('logo cremas');
            $objDrawing->setDescription('PHPExcel logo');
            $objDrawing->setPath('./images/logo.jpg');
            //echo $objDrawing->setPath('http://phpstack-1171-4157-7368.cloudwaysapps.com/puntoventacremas/public/sistema/images/logo.png');
            $objDrawing->setHeight(60);
            $objDrawing->setCoordinates('A2');
            $objDrawing->setOffsetX(30);
            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
            //  $objPHPExcel->setActiveSheetIndex(0);
            $counter = 5;
            $total=0;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, $this->acentos($str_NombreReporte));

            $styleGeneral = array(
                'font'  => array(
                    'size'  => 12,
                    'name'  => 'Calibri',
                    'color' => array('rgb' => '000000')
                ));

            $styleCabecera = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => 'FFFFFF')
                ));
            $desde="A".$counter.":";
            $hasta="F".$counter;
            $objPHPExcel->getActiveSheet()->getStyle(
                $desde.
                $objPHPExcel->getActiveSheet()->getHighestColumn() .
                $objPHPExcel->getActiveSheet()->getHighestRow()
            )->applyFromArray($styleGeneral);

            $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->applyFromArray($styleCabecera);

            $objPHPExcel->getActiveSheet()->getStyle($desde.$hasta)->getFill()->applyFromArray(
                array(
                    'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => array('rgb' => '092F87'),
                    'endcolor'   => array('rgb' => '092F87')
                )
            );


            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$counter, 'CONTADOR');
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$counter, 'TIENDA');
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$counter, 'EXISTENCIAS');
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$counter, 'COSTO');
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$counter, 'PRECIO');
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$counter, 'PRECIO DESCUENTO');


            $cont=0;
            foreach ($query->execute() as $obj1) {
                $counter++;
                $cont++;
                $objt = Doctrine_Core::getTable("Database_Model_Tienda")->findOneBy("id_tienda", $obj1->id_tienda);

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $counter, $cont);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $counter, $objt->nombre);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $counter, $obj1->existencias);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $counter, $obj1->costo);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $counter, $obj1->precio);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $counter, $obj1->precio_mayoreo);
            }


            $xlsName = "Reporte de Concentrado de  Inventario  ".date("Y-m-d_H-i-s") . ".xls";
            $fileName =  $xlsName;
            // echo $fileName = "http://phpstack-1171-4157-7368.cloudwaysapps.com/puntoventacremas/public/sistema/documentos/" . $xlsName;

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

            //  $objWriter->save($fileName);
            //  $objWriter->save("././sistema/documentos/".$fileName);
            $objWriter->save("./documentos/".$fileName);

            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");;
            header("Content-Disposition: attachment;filename=$fileName");
            header("Content-type: application/vnd.ms-excel;charset=latin");
            header("Content-type: text/html; charset=utf-8");
            header("Content-Transfer-Encoding: binary ");

            $objWriter->save("php://output");

            ///////////////////////////////enviar el excel por mail

            $data = ob_get_contents();



            $mail = new Zend_Mail("utf-8");
            $mail->setBodyText('Este es el inventario hasta el dia de hoy '.date("Y-m-d_H-i-s"))
                ->setFrom('noreply@cremas.com', 'cremas')
                ->addTo('aaron@cremas.com.mx')
                ->addCc('guillermo@cremas.com.mx')
                ->addBcc('jorge.orihuela@tigears.com');
            $at = new Zend_Mime_Part($data);
            $at->type        = 'application/vnd.ms-excel';
            $at->disposition = Zend_Mime::DISPOSITION_INLINE;
            $at->encoding    = Zend_Mime::ENCODING_BASE64;
            $at->filename    = 'Inventario_costo_'.date("Y-m-d_h:i:sa").'.xls';
            $mail2 = clone $mail;
            $mail3 = clone $mail;
            $mail->setSubject('Inventario Costo '.date("Y-m-d_h:i:sa").' Excel');
            $mail->addAttachment($at);
           // $mail->send();
            /*
///////////////////////////////////para enviar un pdf
            $data = ob_get_contents();

            $at = new Zend_Mime_Part($data);
            $at->type = 'application/pdf';
            $at->disposition = Zend_Mime::DISPOSITION_INLINE;
            $at->encoding    = Zend_Mime::ENCODING_BASE64;
            $at->filename    = 'Corte_De_Caja'.date("Y-m-d_h:i:sa").'.pdf';
            $mail2->setSubject('Corte de caja '.date("Y-m-d_h:i:sa").' PDF');
            $mail2->addAttachment($at);
            //$mail2->send();
            ob_clean();
            $objWriter = PHPExcel_IOFactory::createWriter     ($objPHPExcel, 'HTML');
            $objWriter->save('php://output');

            //////////////////////////////para mandar un html con el contenido
            $data = ob_get_contents();
            $mail3->setSubject('Corte de caja '.date("Y-m-d_h:i:sa").' HTML');
            $mail3-> setBodyHTML('Aqui esta el corte de caja de hoy '.$message."<br/><br/>".
                str_replace('cellpadding="0"','cellpadding="10"',str_replace('border="0"','border="1"',$data)));
            $mail3->send();
            ob_clean();
*/

        }else{
            $mail = new Zend_Mail("utf-8");
            $mail->setBodyText('Se ejecuto la tarea programada '.date("Y-m-d_H-i-s"))
                ->setFrom('noreply@cremas.com', 'cremas')
                ->addTo('jorge.orihuela@tigears.com')
               ;
            $mail->setSubject('Tarea programada Inventario Costo '.date("Y-m-d_h:i:sa").' Excel');
           // $mail->send();
        }
    }
    public function acentos($cadena)
    {
        $cadena = str_replace("&nbsp;"," ",$cadena);
        $cadena = str_replace("&iexcl;","¡",$cadena);
        $cadena = str_replace("&cent;","¢",$cadena);
        $cadena = str_replace("&pound;","£",$cadena);
        $cadena = str_replace("&curren;","¤",$cadena);
        $cadena = str_replace("&yen;","¥",$cadena);
        $cadena = str_replace("&brvbar;","¦",$cadena);
        $cadena = str_replace("&sect;","§",$cadena);
        $cadena = str_replace("&uml;","¨",$cadena);
        $cadena = str_replace("&copy;","©",$cadena);
        $cadena = str_replace("&ordf;","ª",$cadena);
        $cadena = str_replace("&laquo;","«",$cadena);
        $cadena = str_replace("&not;","¬",$cadena);
        $cadena = str_replace("&shy;","",$cadena);
        $cadena = str_replace("&reg;","®",$cadena);
        $cadena = str_replace("&macr;","¯",$cadena);
        $cadena = str_replace("&deg;","°",$cadena);
        $cadena = str_replace("&plusmn;","±",$cadena);
        $cadena = str_replace("&sup2;","²",$cadena);
        $cadena = str_replace("&sup3;","³",$cadena);
        $cadena = str_replace("&acute;","´",$cadena);
        $cadena = str_replace("&micro;","µ",$cadena);
        $cadena = str_replace("&para;","¶",$cadena);
        $cadena = str_replace("&middot;","·",$cadena);
        $cadena = str_replace("&cedil;","¸",$cadena);
        $cadena = str_replace("&sup1;","¹",$cadena);
        $cadena = str_replace("&ordm;","º",$cadena);
        $cadena = str_replace("&raquo;","»",$cadena);
        $cadena = str_replace("&frac14;","¼",$cadena);
        $cadena = str_replace("&frac12;","½",$cadena);
        $cadena = str_replace("&frac34;","¾",$cadena);
        $cadena = str_replace("&iquest;","¿",$cadena);
        $cadena = str_replace("&Agrave;","À",$cadena);
        $cadena = str_replace("&Aacute;","Á",$cadena);
        $cadena = str_replace("&Acirc;","Â",$cadena);
        $cadena = str_replace("&Atilde;","Ã",$cadena);
        $cadena = str_replace("&Auml;","Ä",$cadena);
        $cadena = str_replace("&Aring;","Å",$cadena);
        $cadena = str_replace("&AElig;","Æ",$cadena);
        $cadena = str_replace("&Ccedil;","Ç",$cadena);
        $cadena = str_replace("&Egrave;","È",$cadena);
        $cadena = str_replace("&Eacute;","É",$cadena);
        $cadena = str_replace("&Ecirc;","Ê",$cadena);
        $cadena = str_replace("&Euml;","Ë",$cadena);
        $cadena = str_replace("&Igrave;","Ì",$cadena);
        $cadena = str_replace("&Iacute;","Í",$cadena);
        $cadena = str_replace("&Icirc;","Î",$cadena);
        $cadena = str_replace("&Iuml;","Ï",$cadena);
        $cadena = str_replace("&ETH;","Ð",$cadena);
        $cadena = str_replace("&Ntilde;","Ñ",$cadena);
        $cadena = str_replace("&Ograve;","Ò",$cadena);
        $cadena = str_replace("&Oacute;","Ó",$cadena);
        $cadena = str_replace("&Ocirc;","Ô",$cadena);
        $cadena = str_replace("&Otilde;","Õ",$cadena);
        $cadena = str_replace("&Ouml;","Ö",$cadena);
        $cadena = str_replace("&times;","×",$cadena);
        $cadena = str_replace("&Oslash;","Ø",$cadena);
        $cadena = str_replace("&Ugrave;","Ù",$cadena);
        $cadena = str_replace("&Uacute;","Ú",$cadena);
        $cadena = str_replace("&Ucirc;","Û",$cadena);
        $cadena = str_replace("&Uuml;","Ü",$cadena);
        $cadena = str_replace("&Yacute;","Ý",$cadena);
        $cadena = str_replace("&THORN;","Þ",$cadena);
        $cadena = str_replace("&szlig;","ß",$cadena);
        $cadena = str_replace("&agrave;","à",$cadena);
        $cadena = str_replace("&aacute;","á",$cadena);
        $cadena = str_replace("&acirc;","â",$cadena);
        $cadena = str_replace("&atilde;","ã",$cadena);
        $cadena = str_replace("&auml;","ä",$cadena);
        $cadena = str_replace("&aring;","å",$cadena);
        $cadena = str_replace("&aelig;","æ",$cadena);
        $cadena = str_replace("&ccedil;","ç",$cadena);
        $cadena = str_replace("&egrave;","è",$cadena);
        $cadena = str_replace("&eacute;","é",$cadena);
        $cadena = str_replace("&ecirc;","ê",$cadena);
        $cadena = str_replace("&euml;","ë",$cadena);
        $cadena = str_replace("&igrave;","ì",$cadena);
        $cadena = str_replace("&iacute;","í",$cadena);
        $cadena = str_replace("&icirc;","î",$cadena);
        $cadena = str_replace("&iuml;","ï",$cadena);
        $cadena = str_replace("&eth;","ð",$cadena);
        $cadena = str_replace("&ntilde;","ñ",$cadena);
        $cadena = str_replace("&ograve;","ò",$cadena);
        $cadena = str_replace("&oacute;","ó",$cadena);
        $cadena = str_replace("&ocirc;","ô",$cadena);
        $cadena = str_replace("&otilde;","õ",$cadena);
        $cadena = str_replace("&ouml;","ö",$cadena);
        $cadena = str_replace("&divide;","÷",$cadena);
        $cadena = str_replace("&oslash;","ø",$cadena);
        $cadena = str_replace("&ugrave;","ù",$cadena);
        $cadena = str_replace("&uacute;","ú",$cadena);
        $cadena = str_replace("&ucirc;","û",$cadena);
        $cadena = str_replace("&uuml;","ü",$cadena);
        $cadena = str_replace("&yacute;","ý",$cadena);
        $cadena = str_replace("&thorn;","þ",$cadena);
        $cadena = str_replace("&yuml;","ÿ",$cadena);
        return $cadena;
    }

    public function colunmasExcel()
    {
        $arreglo  = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ","CA","CB","CC","CD","CE","CF","CG","CH","CI","CJ","CK","CL","CM","CN","CO","CP","CQ","CR","CS","CT","CU","CV","CW","CX","CY","CZ");
        return $arreglo;
    }


}