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
						if($res = $productotienda->getTablebyProducto($id_producto,$id_tienda))
							$id_productotienda  = $res['id_productotienda'];
						
					}
					$existe  = ( $manual ) ? 1 : $existe; //recargas y excedentes
					
					include(SYSTEM_DIR.'/pages/Entradas/Entradas_get_producto.php' );
					
				}else{
					echo "Producto no encontrado";
				}
			}
			
		break;
		case 'deleteonlydecrement': 
				$response = [];
				if( intval($_GET["id"]) && isset($_GET["id"]) ){
					$id     = $_GET["id"];
					$producto = new EntradaProducto();
					if($res = $producto->deleteonlydecrement($id)){
						$response = array('error'=>false,'response'=>'Exito al eliminar');
					}else{
						$response = array('error'=>true,'response'=>'Error al eliminar');
					}
				}else{
					$response = array('error'=>true,'response'=>'Error en el ID');
				}
				echo json_encode($response);
			break;
		case 'updateexisencias':
			if( isset($_POST["id"]) && isset($_POST["existencia"]) ){
				$id            = $_POST["id"];
				$existencia    = ($_POST["existencia"])    ? $_POST["existencia"]    : 0 ;

				$objproducto = new EntradaProducto();

				$request['cantidad'] = $existencia;
				$update = $objproducto->updateAll($id,$request);
				if( !$update ) die('no actualizo con exito EntradaProducto');
				echo $id;
			}
			break;
		
		
		case 'validar':
			if(isPost()){
				if( intval($_POST["id_entrada"]) ){
					$identrada=$_POST["id_entrada"];
					$obj = new Entrada();
					echo $obj->validateAll($identrada) ;
				}else{
					echo "Error al recibir datos";
				}
			}
			break;
		default:
			# code...
			break;
	}
	
}

?>