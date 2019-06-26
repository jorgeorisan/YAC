<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'get_producto': 
			if( intval($_GET["id_tienda"]) && isset($_GET["codigo"]) && intval($_GET["cantidad"]) ){
				$codigo     = $_GET["codigo"];
				$id_tienda  = $_GET["id_tienda"];
				$tipoprecio = $_GET["tipoprecio"];
				$cantidad   = $_GET["cantidad"];
				$id_productotienda = '';
				$existenciatienda  = '';
				$existenciaglobal  = '';
				$existe			   = 0;
				$producto = new Producto();
				if($res = $producto->getTablebyCode($codigo)){
					$id_producto = $res['id_producto'];
					$precio  = $res['precio'];
					$mayoreo = $res['precio_descuento'];
					$costo   = $res['costo'];
					$manual  = $res['manual'];
					$nombre  = $res['nombre'];
					$arrayfilters['id_producto'] = $id_producto;
					$arrayfilters['id_tienda']   = $id_tienda;
					$productostienda   = $producto->getAllArr($arrayfilters);
					
					foreach($productostienda as $res) {
						$existenciatienda  = $res['existenciastienda'];
						$existenciaglobal  = $res['existencias'];
						$existe  		   = ( $existenciatienda >= $cantidad ) ? 1 : 0;
						$productotienda  = new ProductoTienda();
						if($res = $productotienda->getTablebyProducto($id_producto,$id_tienda)){
							$id_productotienda  = $res['id_productotienda'];
						}
					}
					$existe  = ( $manual ) ? 1 : $existe; //recargas y excedentes
					switch ($tipoprecio) {
						case 'Mayoreo':		$precioventa  = $mayoreo;	break;
						case 'Promocumple':	$precioventa  = 0;			break;
						default:			$precioventa  = $precio;	break;
					}
					if($existe)
						include(SYSTEM_DIR.'/pages/Ventas/Ventas_get_producto.php' );
					else
						echo "Cantidad insuficiente";
				}else{
					echo "Producto no encontrado";
				}
			}
			break;				
		case 'getpreciotratamiento':
			$precio = '';
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$citas  = new Tratamiento();
				if($res = $citas->getTable($id)){
					$precio = $res['precio'];
				}
			}
			echo $precio;
			
			break;
				
		case 'deleteventa':
			if( isset($_GET["idventa"])){
				$id = $_GET["idventa"];
				$venta  = new Venta();
				$request ['razon_cancelacion'] = $_GET["motivo"];
				if($venta->deleteAll($id,$request)){
					echo "true";
				}
			}
			break;
		case 'deleteproductoventa':
			if( isset($_GET["idproductoventa"])){
				$id = $_GET["idproductoventa"];
				$Pventa  = new ProductosVenta();
				$request ['razon_cancelacion'] = $_GET["motivo"];
				if($Pventa->deleteAll($id,$request)){
					echo "true";
				}
			}
			break;
		case 'showpopuppagar':
			if( isset($_GET["id"]) && intval($_GET["id"]) ){
				$id = $_GET["id"];
				$objh = new Venta();
				
				if($datah = $objh->getTable($id)){
					$totalpagado = $objh->getpagado($id);
					$total  = $datah['total']-$totalpagado;
					include(SYSTEM_DIR.'/pages/Ventas/Ventas_showpopuppagar.php' );
				}
			}
			break;
		case 'showimprimir':
			if( isset($_GET["id_venta"]) && intval($_GET["id_venta"]) ){
				$id=$_GET['id_venta'];
				$obj = new Venta();
				$data = $obj->getTable($id);
				if ( $data ) {
					 echo make_url("Ventas","print",array('id'=>$id,'page'=>'venta','close'=>'true'));
				}
			}
			break;
		
		case 'savenewpago':
			if(isPost()){
			    $obj = new Deudores();
			    echo $obj->addAll(getPost());
			   
			}
			break;
		case 'fixdb':
			$obj = new Venta();
			$obj->arreglar_Descuentos();
			$obj->arreglar_cancelaciones();
			$obj->arreglar_cancelacionesproductos();
			$obj->arreglar_precios();
			break;
		default:
			# code...
			break;
	}
	
}

?>