<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["action"]) {
		case 'get':
			switch ($_GET["object"]) {
				
				case 'showpopupcatalogo':
					if( isset($_GET["id_tienda"]) ){
						$idtienda = $_GET["id_tienda"];
						include(SYSTEM_DIR.'/pages/Productos/Productos_showpopupcatalogo.php' );
					}
					break;
				case 'buscarproducto':
					if( isset($_GET["texto"]) ){
						$texto    = $_GET["texto"];
						$idtienda = $_GET["id_tiendaselected"];
						$productos = new Producto();
						$arrayfilters['similar']   = $texto;
						$arrayfilters['id_tienda'] = $idtienda;
						$productostienda  = $productos->getAllArr($arrayfilters);
						foreach($productostienda as $res) {
							$existenciatienda  = $res['existenciastienda'];
							$existenciaglobal  = $res['existencias'];
						}
		
						
						include(SYSTEM_DIR.'/pages/Productos/Productos_buscarproducto.php' );
					}
					break;
				case 'getproductos':
						$texto    		= (isset($_GET["texto"]))        ? $_GET["texto"] : '' ; 
						$id_categoria   = (isset($_GET["id_categoria"])) ? $_GET["id_categoria"] : '' ; 
						$id_marca   	= (isset($_GET["id_marca"]))     ? $_GET["id_marca"] : '' ; 
						$texto    = (isset($_GET["texto"]))     ? $_GET["texto"] : '' ; 
						if(isset($_GET["filters"]))  {
							$filtro = $_GET["filters"];
							$texto  =  (count($filtro[0])>0) ? $filtro[0]['value'] : ''  ; 
						}
							 
						$idtienda 		 = (isset($_GET["id_tienda"])) ? $_GET["id_tienda"] : $_SESSION['user_info']['id_tienda'] ;
						$size     		 = (isset($_GET["size"]))      ? $_GET["size"] : '10' ;
						$page  	  		 = (isset($_GET["page"]))      ? $_GET["page"] : '0' ;
						$totalproductos  = (isset($_GET["totalproductos"])) ? $_GET["totalproductos"] : '0' ;
						$maxRows  = $page * $size;
						$productos = new Producto();
						$arrayfilters['similar']   		= $texto;
						$arrayfilters['id_tienda'] 		= $idtienda;
						$arrayfilters['id_categoria'] 	= $id_categoria;
						$arrayfilters['id_marca'] 		= $id_marca;
						$arrayfilters['maxRows']  		= $maxRows;
						$arrayfilters['todo']      		= '1';
						
						$arrayfilters['size']      = $size;

						$productostienda  = $productos->getAllArr($arrayfilters);
						
						
						$totalpagestabu   = $totalproductos /  $size; 
						
						if(!$page){
							echo json_encode($productostienda);
						}else{
							//productos index
							if($texto){
								$totalpagestabu = count($productostienda) /  $size; 
								echo json_encode(array("last_page"=>ceil($totalpagestabu),"data"=>$productostienda));
							}else{
								echo json_encode(array("last_page"=>ceil($totalpagestabu),"data"=>$productostienda));
							}
						}
				
					break;
				case 'updatekardex':
					// una ves al anio a principios empieza en 2020 enero 
					echo 'Comienza updatekardex'.date('Y-m-d H:i:s').'<br>';
					
					$obj = new Producto();

					$begin        = ( isset($_GET['fecha_inicial']))? $_GET['fecha_inicial'] : date('Y-01-01'); 
					$idusuario    = $_SESSION['user_id'];
					$idtienda  	  =  $_SESSION['user_info']['id_tienda'] ;
					$arrayfilters['id_producto']   = ( isset($_GET['id']) && $_GET['id'] > 0 )  ?  $_GET['id'] : '';
					$arrayfilters['fecha_inicial'] = $begin;
					$arrayfilters['id_usuario']    = $idusuario;
					$arrayfilters['id_tienda']     = $idtienda;
					$jsonarrayfilters=json_encode($arrayfilters);
					
					//$arrayfilters['id_producto'] ='';
					$arrayfilters['kardex'] ='1';
					//$arrayfilters['todo'] ='1';
				
					$queryproductos= $obj->getAllArr($arrayfilters);
					$totalkardex = '0';
					foreach( $queryproductos as $key => $valprod){
				
					
						$arrayfilters['id_producto'] =$valprod['id_producto'];
						
						$objreports = new Reports();
						$dataventas = $objreports->getReporteVentas($arrayfilters);
				
						$dataentrada           = $objreports->getReporteEntradas($arrayfilters);
						$datasalidas           = $objreports->getReporteSalidas($arrayfilters);
						$datatraspasosentrada  = $objreports->getReporteTraspasosEntrada($arrayfilters);
						$datatraspasossalida   = $objreports->getReporteTraspasosSalida($arrayfilters);
				
						$totalkardentradas  = 0;
						$totalkardsalidas   = 0;
						foreach($dataentrada as $row) {
							$status = htmlentities($row['status']);
							switch ($status) {
								case 'BAJA':           
								case 'POR AUTORIZAR':
									break;
								default:
									$totalkardentradas  += $row['cantidad'];
									break;
							} 
						} 
						foreach($datatraspasosentrada as $row) {
							$status = htmlentities($row['status']);
							switch ($status) {
								case 'BAJA':
								case 'POR AUTORIZAR':
									break;
								default:
									$totalkardentradas  += $row['cantidad'];
									break;
							} 
						} 
						// salidas								
						foreach ($dataventas as $rowventa){
							$ventas = new Venta();
							$classventa     = ($rowventa["cancelado"]) ? "class='cancelada'" : '';
							$dataventasproductos = $objreports->getReporteVentasProductos($rowventa["id_venta"],$arrayfilters['id_producto']);
							if($dataventasproductos){
								foreach($dataventasproductos as $row) {
									if (!$row['cancelado']) { 
										$totalkardsalidas += $row['cantidad'];
									}
								}
							}
						}
						foreach($datatraspasossalida as $row) {
							$status = htmlentities($row['status']);
							switch ($status) {
								case 'BAJA':
								case 'POR AUTORIZAR':
									break;
								default:
									$totalkardsalidas  += $row['cantidad'];
									break;
							} 
						} 
						foreach($datasalidas as $row) {
							$status = htmlentities($row['status']);
							switch ($status) {
								case 'BAJA':
								case 'POR AUTORIZAR':
									break;
								default:
									$totalkardsalidas  += $row['cantidad'];
									break;
							} 
						} 
						
						$existenciaactual      = $valprod['existenciastienda'];
						$fecha_actualizacion   = $valprod['fecha_actualizacion'];
						$usuario_actualizacion = $valprod['usuario_actualizacion'];
					
						$totalkardex      = $totalkardentradas-$totalkardsalidas;
						$diferenciakardex = $existenciaactual-$totalkardex;
						//echo $valprod['id_producto'].':actual='. $existenciaactual.' kardex= '.$totalkardex.' diferencia = '.$diferenciakardex.'<br>';
						//if($diferenciakardex!=0){
							
							//$obj->CheckInvIni($valprod['id_producto'],$existenciaactual,$diferenciakardex);
							$objprodtienda = new ProductoTienda();
							$objprodtienda->updateKardex($valprod['id_producto'],$idtienda,$totalkardex,$totalkardentradas,$totalkardsalidas);
					
						//}
						
					}
					
					echo 'Termina updatekardex'.date('Y-m-d H:i:s').'<br>';
					echo 'tienda='.$idtienda.' total actualizados='.$key;
					
						
			
					break;
				
				case 'showpopupHistorial':
					if( isset($_GET["id"]) && intval($_GET["id"])){
						$id = $_GET["id"];
		
						$objpt = new ProductoTienda();
						$PT = $objpt->getTablebyProducto($id,$_SESSION['user_info']['id_tienda']);
						$id_productotienda = $PT['id_productotienda'];
		
						$objh = new HistorialInventario();
						if($datah = $objh->getAllArr($id_productotienda)){
							include(SYSTEM_DIR.'/pages/Productos/Productos_showpopupHistorial.php' );
						}
					}
					break;
				case 'showpopupEditar':
					if( isset($_GET["id"]) && intval($_GET["id"])){
						$id = $_GET["id"];
								
						$obj = new Producto();
						$data = $obj->getTable($id);
						include(SYSTEM_DIR.'/pages/Productos/Productos_showpopupEditar.php' );
						
					}
					break;
				case 'showpopupImagen':
					if( isset($_GET["id"]) && intval($_GET["id"])){
						$id = $_GET["id"];
		
						$obj = new Producto();
						$data = $obj->getTable($id);
						if($data){
							include(SYSTEM_DIR.'/pages/Productos/Productos_showpopupImagen.php' );
						}
					}
					break;
			
				case 'existeproducto':
					if( isset($_GET["codigo"]) ){
						$u = new Producto();
						if($u->existeProducto($_GET['codigo'])){
							echo 1;
						}else{
							echo 0;
						}
					}else{
						echo 0;
					}
					break;
				case 'addpopup':
					include(SYSTEM_DIR.'/pages/Productos/Productos_addpopup.php' );
					break;
				
				
					default:
					# code...
					break;
			}
			break;
		case 'post':
			switch ($_GET["object"]) {
				case 'updateexisencias':
					if( isset($_POST["idproducto"]) && isset($_POST["existencia"]) ){
						$id            = $_POST["idproducto"];
						$id_tienda     = $_SESSION['user_info']['id_tienda'];
						$id_usuario    = $_SESSION['user_id'];
						$existencia    = ($_POST["existencia"])    ? $_POST["existencia"]    : 0 ;
						$existenciaant = ($_POST["existenciaant"]) ? $_POST["existenciaant"] : 0 ;
		
						$objproducto = new Producto();
						$dataproducto = $objproducto->getTable($id);
		
						$objproductotienda = new ProductoTienda();
						$PT = $objproductotienda->getTablebyProducto($id,$_SESSION['user_info']['id_tienda']);
						if ( !$PT ) return false;
						$requesProductoTienda['id_productotienda'] 	 = $PT['id_productotienda'];
						$requesProductoTienda['existencia'] 	     = $existencia;
						$requesProductoTienda['existencia_anterior'] = $existenciaant;
		
						$objHistorialIventario = new HistorialInventario();
						$idHI = $objHistorialIventario->addAll($requesProductoTienda);
						if ( $existencia != $existenciaant ){
							if ( $existencia > $existenciaant ){
								//entrada 
								$objEntrada = new Entrada();
								$requestEntrada['id_user'] = $id_usuario;
								$requestEntrada['id_tienda']  = $id_tienda;
								$requestEntrada['fecha']      = date('Y-m-d H:i:s');
								$requestEntrada['status']     = "ACTIVO";
								$requestEntrada['concepto']   = "ACTUALIZACION INVENTARIO";
								$requestEntrada['referencia'] = "ENTRADA DIRECTA";
								$_requestEntrada['icredito']  = 0;
								$ide = $objEntrada->addByOne($requestEntrada);
								//entrada de productos
								$iObjEntradaProducto = new EntradaProducto();
								$requestEntradaProducto['id_entrada']       = $ide;
								$requestEntradaProducto['id_producto']      = $PT['id_producto'];
								$requestEntradaProducto['id_tienda']        = $id_tienda;
								$requestEntradaProducto['cantidad_anterior']= $existenciaant;
								$requestEntradaProducto['cantidad']         = $existencia-$existenciaant;
								$requestEntradaProducto['precio']           = $dataproducto['precio'];
								$requestEntradaProducto['mayoreo'] 			= $dataproducto['precio_descuento'];
								$requestEntradaProducto['costo']            = $dataproducto['costo'];
								$requestEntradaProducto['totalcosto']       = $existencia * $dataproducto['costo'];
								$requestEntradaProducto['nombre']           = $dataproducto['nombre'];
								$requestEntradaProducto['act_inventario']   = 1;
								$idep = $iObjEntradaProducto->addAll($requestEntradaProducto);
							}else{
								//salida de productos
								$objeSalida = new Salida();
								$requestSalida['id_user']           = $id_usuario;
								$requestSalida['id_tienda']         = 14;
								$requestSalida['id_tiendaanterior'] = $id_tienda;
								$requestSalida['fecha']             = date('Y-m-d H:i:s');
								$requestSalida['status']            = "ACTIVO";
								$requestSalida['concepto']          = "ACTUALIZACION INVENTARIO";
								$requestSalida['referencia']        = "SALIDA DIRECTA";
								$ids = $objeSalida->addByOne($requestSalida);
								if(!$ids) die("error al guardar salida");
				
								$iObjSalidaProducto = new SalidaProducto();
								$requestSalidaProducto['id_salida']        = $ids;
								$requestSalidaProducto['id_producto']      = $id;
								$requestSalidaProducto['id_tienda']        = $id_tienda;
								$requestSalidaProducto['cantidad']         = $existenciaant - $existencia;
								$requestSalidaProducto['precio']           = $dataproducto['precio'];
								$requestSalidaProducto['precio_descuento'] = $dataproducto['precio_descuento'];
								$requestSalidaProducto['costo']            = $dataproducto['costo'];
								$requestSalidaProducto['totalcosto']       = $existencia * $dataproducto['costo'];
								$requestSalidaProducto['nombre']           = $dataproducto['nombre'];
								$requestSalidaProducto['act_inventario']   = 1;
								$idsp = $iObjSalidaProducto->addAll($requestSalidaProducto);
							}
						}
						
						$objproductotienda->actualizaexistencia($PT['id_productotienda'],$existencia,'general');
						
						$requestProductoTienda['fecha_actualizacion'] = date('Y-m-d H:i:s');
						$requestProductoTienda['usuario_actualizacion'] = $_SESSION['user_id'];
						$update = $objproductotienda->updateAll($PT['id_productotienda'],$requestProductoTienda);
						if( !$update ) die('no actualizo con exito productotienda');
						echo $idHI;
					}
					break;
				
				case 'updateimagen':
					if( isset($_POST["id_producto"]) ){
						$id = $_POST["id_producto"];
						
						$objproducto = new Producto();
						$dataProducto = $objproducto->getTable($id);
						if (isset($_FILES['imagen']["tmp_name"])){
							$carpetaimg = PRODUCTOS.'/images';
							move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaimg."/".$id."_".$dataProducto['codinter'].'.png');
							$request['imagen']=$id."_".$dataProducto['codinter'].'.png';
							$id = $objproducto->updateAll($id,$request);
							if( $id >0  ) {
								echo $id;
							}else{
								echo "Error al actualizar imagen";
							}
						}else{
							echo "Error al recibir imagen";
						}
					}else{
						echo "Error al recibir datos";
					}
					break;
				case 'savenewproducto':
					$objproducto = new Producto();
					if(!$objproducto->existeProducto($_POST['codinter'])){
						$id=$objproducto->addAll(getPost());
						if($id>0){
							//nuevas imagenes
							if (isset($_FILES['imagen']["tmp_name"])){
								$carpetaimg = PRODUCTOS.'/images';
								move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaimg."/".$id."_".$_POST['codinter'].'.png');
								$request['imagen']=$id."_".$_POST['codinter'].'.png';
								$idimagen = $objproducto->updateAll($id,$request);
								if( $idimagen >0  ) {
									echo json_encode(array("status"=>true,'response'=>$id,'code'=>$_POST['codinter']));
								}else{
									echo json_encode(array("status"=>true,'response'=>'El la imagen no se agrego correctamente','code'=>$_POST['codinter'])); "";
								}
							}else{
								echo json_encode(array("status"=>true,'response'=>$id,'code'=>$_POST['codinter']));
							}
						}else{
							echo json_encode(array("status"=>false,'response'=>'El no se agrego correctamente el producto','code'=>$_POST['codinter'])); "";
						}
					}else{
						echo json_encode(array("status"=>false,'response'=>'El codigo ya existe','code'=>$_POST['codinter'])); "";
					}
					
					break;
				
				case 'updateproducto':
					$objproducto = new Producto();				
					$id = $objproducto->updateAll($_POST['id_producto'],getPost());
					if( $id >0  ) {
						
						$data = $objproducto->getTable($id);

						echo json_encode(array("status"=>true,'response'=>json_encode($data),'code'=>$_POST['codinter']));
					}else{
						echo json_encode(array("status"=>false,'response'=>'El producto no se actualizo correctamente','code'=>$_POST['codinter'])); "";
					}
					
					
					break;
					default:
					# code...
					break;
			}
			break;
		
			default:
			# code...
			break;
	}
	
}

?>