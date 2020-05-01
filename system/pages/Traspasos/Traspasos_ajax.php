<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'get_producto': 
			if( intval($_GET["id_tiendaanteriorsearch"]) && isset($_GET["codigo"]) && intval($_GET["cantidad"]) ){
				$codigo     = $_GET["codigo"];
				$id_tienda  = $_GET["id_tiendaanteriorsearch"];
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
					
					if(!$existe) 
						echo "<script>alert('Cantidad insuficiente:".$existenciatienda."');</script>";
					else
						include(SYSTEM_DIR.'/pages/Traspasos/Traspasos_get_producto.php' );
					
				}else{
					echo "Producto no encontrado";
				}
			}
			
		break;
				
		case 'validar':
			if(isPost()){
				if( intval($_POST["id_traspaso"]) ){
					$idtraspaso=$_POST["id_traspaso"];
					$obj = new Traspaso();
					echo $obj->validateAll($idtraspaso) ;
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