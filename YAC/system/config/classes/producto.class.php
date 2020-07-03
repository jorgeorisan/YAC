<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."producto.auto.class.php");

class Producto extends AutoProducto { 
	private $DB_TABLE = "producto";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr( $arrayfilters=false)
	{
		
		$tienda = (isset($_SESSION['user_info']['id_tienda'])) ? $_SESSION['user_info']['id_tienda'] : '';
		$queryprod = $querylimit= '';
		$TODO  = " HAVING TIENDA.existencias>0 ";
		$querymarca = $querycategoria = $querysubcategoria = $queryinvini= $querykardex= '';
		if(count($arrayfilters)>0){
			if(isset($arrayfilters['id_tienda']) && $arrayfilters['id_tienda']>0)
				$tienda = $arrayfilters['id_tienda'] ;
			if(isset($arrayfilters['todo']) && $arrayfilters['todo']==1)
				$TODO = '' ;
			if(isset($arrayfilters['id_producto']) && $arrayfilters['id_producto']>0){
				if(isset($arrayfilters['todo']) && $arrayfilters['todo']==true){
					$TODO  = "";
				}else{
					$producto  = $arrayfilters['id_producto'];
					$queryprod = " AND p.id_producto = $producto" ;
				}
			}
			if(isset($arrayfilters['similar']) && $arrayfilters['similar']!=''){
				$similar   = $arrayfilters['similar'];
				$queryprod = "AND (p.codinter like '%". $similar ."%' OR  p.nombre like '%". $similar ."%'  OR  m.nombre like '%". $similar ."%')" ;
			}
			if(isset($arrayfilters['id_categoria']) && $arrayfilters['id_categoria']>0)
				$querycategoria = "AND p.id_categoria =".$arrayfilters['id_categoria'];
			
			if(isset($arrayfilters['id_subcategoria']) && $arrayfilters['id_subcategoria']>0)
				$querysubcategoria = "AND p.id_subcategoria =".$arrayfilters['id_subcategoria'];

			if(isset($arrayfilters['id_marca']) && $arrayfilters['id_marca']>0)
				$querymarca = "AND p.id_marca =".$arrayfilters['id_marca'];
			
			if(isset($arrayfilters['maxRows']) && $arrayfilters['maxRows'] >0 ){
				$maxRows   = $arrayfilters['maxRows'];
				$minRows =  $maxRows-$arrayfilters['size'];
				$long    = $arrayfilters['size'];
				$TODO .=" LIMIT  $minRows,$long  " ;
			}
			if(isset($arrayfilters['inventario_inicial']) && $arrayfilters['inventario_inicial'] >0 ){
				$queryinvini = " AND inv_ini is null" ;
			}
			if(isset($arrayfilters['kardex']) && $arrayfilters['kardex'] >0 ){
				$querykardex = " AND kardex!=existencias" ;
			}

		}
		$prov = $tienda;
		$querytienda='';
		if($tienda == 15) 
			$prov=13;

		if(!$tienda)
			$querytienda= ($_SESSION['user_info']['id_tienda']==16) ? " AND (p.id_proveedor=14)" : " AND (p.id_proveedor!=14)";


	
        $sql = "
			SELECT TODO.id_producto,TODO.codinter,TODO.manual,TODO.nombre,TODO.marca,TODO.categoria,TODO.subcategoria,TODO.imagen,
			TODO.proveedor,TODO.paquete	,TODO.costo,TODO.precio,TODO.preciomayoreo
			,TODO.existencias, TIENDA.existencias existenciastienda,TIENDA.fecha_actualizacion,TIENDA.usuario_actualizacion,TIENDA.inv_ini,ifnull(TIENDA.kardex,0) kardex
			FROM(
				SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.manual,PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,PRODUCTO.subcategoria,
					PRODUCTO.proveedor,PRODUCTO.paquete	,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento preciomayoreo
					,SUM(EXISTENCIAS.existencias) existencias
					FROM(
						SELECT p.id_producto,p.codinter,p.manual, p.imagen,p.nombre,p.costo,p.precio_descuento,p.precio,m.nombre marca,c.categoria,s.nombre_subcategoria subcategoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
						FROM producto p
						LEFT JOIN marca m on p.id_marca=m.id_marca
						LEFT JOIN categoria c on p.id_categoria=c.id_categoria
						LEFT JOIN subcategoria s on p.id_subcategoria=s.id_subcategoria
						LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
						WHERE p.status='ACTIVO'
						$queryprod
						$querycategoria
						$querysubcategoria
						$querymarca
						$querytienda
						AND pr.id_tienda='$prov'
					) AS PRODUCTO LEFT JOIN (
						SELECT id_producto, existencias, tienda_id_tienda id_tienda
						FROM producto_tienda 
						WHERE tienda_id_tienda!='14'
						group by id_producto,tienda_id_tienda
					)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
					
					group by 
					PRODUCTO.id_producto,PRODUCTO.codinter, PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,
					PRODUCTO.categoria,PRODUCTO.subcategoria,PRODUCTO.proveedor,PRODUCTO.paquete
					,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento
					order by PRODUCTO.nombre
					
			) AS TODO
			LEFT JOIN (
				SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,PRODUCTO.subcategoria,
					PRODUCTO.proveedor,PRODUCTO.paquete	,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento preciomayoreo
					,SUM(EXISTENCIAS.existencias) existencias,EXISTENCIAS.fecha_actualizacion,EXISTENCIAS.usuario_actualizacion,EXISTENCIAS.inv_ini,EXISTENCIAS.kardex
					FROM(
						SELECT p.id_producto,codinter,p.costo,p.precio_descuento,p.precio,p.nombre,m.nombre marca,c.categoria,s.nombre_subcategoria subcategoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
						FROM producto p
						LEFT JOIN marca m on p.id_marca=m.id_marca
						LEFT JOIN categoria c on p.id_categoria=c.id_categoria
						LEFT JOIN subcategoria s on p.id_subcategoria=s.id_subcategoria
						LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
						WHERE p.status='ACTIVO'
					) AS PRODUCTO LEFT JOIN(
						SELECT id_producto, tienda_id_tienda id_tienda, existencias, fecha_actualizacion,u. id_usuario usuario_actualizacion, inv_ini, kardex
						FROM producto_tienda pt
						LEFT JOIN usuario u ON  u.id=pt.usuario_actualizacion
						WHERE tienda_id_tienda='$tienda'
						$queryinvini
						$querykardex
						group by id_producto,tienda_id_tienda
					)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
					
					group by 
					PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
					PRODUCTO.categoria,PRODUCTO.subcategoria,PRODUCTO.proveedor,PRODUCTO.paquete
					,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento
			) TIENDA ON TODO.id_producto=TIENDA.id_producto
			
			$TODO
			";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr Producto"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
	//metodo que sirve para obtener todos  los productos con status_categoria
	public function getAllArrStatusCategoria( $arrayfilters=false)
	{
		
		$tienda = '13';
		$querystatus_categoria = '';
		
		
		if(count($arrayfilters)>0){
			if(isset($arrayfilters['status_categoria']) ){
				$status_categoria = $arrayfilters['status_categoria'] ;
				switch ($status_categoria) {
					case 'Nuevo':
					case 'Proximamente':
					case 'Oferta':
						break;
					default:
						$status_categoria = 'Normal';
						break;
				}
				
				$querystatus_categoria= " AND (p.status_categoria='$status_categoria')";

			}
		}
	
        $sql = "
			SELECT TODO.id_producto,TODO.codinter,TODO.manual,TODO.nombre,TODO.marca,TODO.categoria,TODO.imagen,
			TODO.proveedor,TODO.paquete	,TODO.costo,TODO.precio,TODO.preciomayoreo
			,TODO.existencias, TIENDA.existencias existenciastienda,TIENDA.fecha_actualizacion,TIENDA.usuario_actualizacion,TIENDA.inv_ini,ifnull(TIENDA.kardex,0) kardex
			FROM(
				SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.manual,PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
					PRODUCTO.proveedor,PRODUCTO.paquete	,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento preciomayoreo
					,SUM(EXISTENCIAS.existencias) existencias
					FROM(
						SELECT p.id_producto,p.codinter,p.manual, p.imagen,p.nombre,p.costo,p.precio_descuento,p.precio,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
						FROM producto p
						LEFT JOIN marca m on p.id_marca=m.id_marca
						LEFT JOIN categoria c on p.id_categoria=c.id_categoria
						LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
						WHERE p.status='ACTIVO'
						$querystatus_categoria
						AND pr.id_tienda='$tienda'
					) AS PRODUCTO LEFT JOIN (
						SELECT id_producto, existencias, tienda_id_tienda id_tienda
						FROM producto_tienda 
						WHERE tienda_id_tienda!='14'
						group by id_producto,tienda_id_tienda
					)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
					
					group by 
					PRODUCTO.id_producto,PRODUCTO.codinter, PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,
					PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
					,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento
					order by PRODUCTO.nombre
					
			) AS TODO
			LEFT JOIN (
				SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
					PRODUCTO.proveedor,PRODUCTO.paquete	,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento preciomayoreo
					,SUM(EXISTENCIAS.existencias) existencias,EXISTENCIAS.fecha_actualizacion,EXISTENCIAS.usuario_actualizacion,EXISTENCIAS.inv_ini,EXISTENCIAS.kardex
					FROM(
						SELECT p.id_producto,codinter,p.costo,p.precio_descuento,p.precio,p.nombre,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
						FROM producto p
						LEFT JOIN marca m on p.id_marca=m.id_marca
						LEFT JOIN categoria c on p.id_categoria=c.id_categoria
						LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
						WHERE p.status='ACTIVO'
					) AS PRODUCTO LEFT JOIN(
						SELECT id_producto, tienda_id_tienda id_tienda, existencias, fecha_actualizacion,u. id_usuario usuario_actualizacion, inv_ini, kardex
						FROM producto_tienda pt
						LEFT JOIN usuario u ON  u.id=pt.usuario_actualizacion
						WHERE tienda_id_tienda='$tienda'
						group by id_producto,tienda_id_tienda
					)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
					group by 
					PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
					PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
					,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento
			) TIENDA ON TODO.id_producto=TIENDA.id_producto
			HAVING TIENDA.existencias>0 
			";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArrStatusCategoria Producto"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
	public function getAllArrServicios($arrayfilters=false)
	{
		$tienda = '';
		if(count($arrayfilters)>0){
			if(isset($arrayfilters['id_tienda']))
				$tienda = " AND pr.id_tienda=".$arrayfilters['id_tienda'] ;
		}
			
        $sql = "SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.manual,PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
						PRODUCTO.proveedor,PRODUCTO.paquete	,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento preciomayoreo
						FROM(
							SELECT p.id_producto,p.codinter,p.manual, p.imagen,p.nombre,p.costo,p.precio_descuento,p.precio,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
							FROM producto p
							LEFT JOIN marca m on p.id_marca=m.id_marca
							LEFT JOIN categoria c on p.id_categoria=c.id_categoria
							LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
							WHERE p.status='ACTIVO'
							AND pr.info_adicional='Servicios'
							$tienda
						) AS PRODUCTO 
						group by 
						PRODUCTO.id_producto,PRODUCTO.codinter, PRODUCTO.imagen,PRODUCTO.nombre,PRODUCTO.marca,
						PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
						,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento	
						ORDER BY PRODUCTO.nombre
		";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr Producto"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
		//metodo que sirve para hacer obtener datos en el editar
	public function getTable($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT p.*, c.categoria,m.nombre marca
				 FROM producto p
				Left join categoria c ON c.id_categoria=p.id_categoria
				Left join marca m ON m.id_marca=p.id_marca
				WHERE p.id_producto=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//
	public function CheckInvIni($id,$existenciaactual,$diferenciakardex){
		
		$id_tienda     = $_SESSION['user_info']['id_tienda'];
		$id_usuario    = $_SESSION['user_id'];

		$dataproducto = $this->getTable($id);

		$existencia    = $existenciaactual ;

		//entrada 
		$objEntrada = new Entrada();
		$requestEntrada['id_user']    = $id_usuario;
		$requestEntrada['id_tienda']  = $id_tienda;
		$requestEntrada['fecha']      = date('Y-m-d H:i:s');
		$requestEntrada['status']     = "ACTIVO";
		$requestEntrada['concepto']   = "INVENTARIO INICIAL 2020";
		$requestEntrada['referencia'] = "ENTRADA DIRECTA";
		$_requestEntrada['icredito']  = 0;
		$ide = $objEntrada->addByOne($requestEntrada);
		//entrada de productos
		$iObjEntradaProducto = new EntradaProducto();
		$requestEntradaProducto['id_entrada']       = $ide;
		$requestEntradaProducto['id_producto']      = $id;
		$requestEntradaProducto['id_tienda']        = $id_tienda;
		$requestEntradaProducto['cantidad_anterior']= $existencia;
		$requestEntradaProducto['cantidad']         = $diferenciakardex;
		$requestEntradaProducto['precio']           = $dataproducto['precio'];
		$requestEntradaProducto['mayoreo'] 			= $dataproducto['precio_descuento'];
		$requestEntradaProducto['costo']            = $dataproducto['costo'];
		$requestEntradaProducto['totalcosto']       = $existencia * $dataproducto['costo'];
		$requestEntradaProducto['nombre']           = $dataproducto['nombre'];
		$requestEntradaProducto['act_inventario']   = 1;
		$idep = $iObjEntradaProducto->addAll($requestEntradaProducto);
		
		$objprodtienda = new ProductoTienda();
		$objprodtienda->updateInventarioInicial($id,$id_tienda);
			
		
	}
	
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'producto',$this->db,"add");
		$sql= "INSERT INTO producto (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
				
			$id = $id["LAST_INSERT_ID()"];
			
			$tienda = new Tienda();
			$datatienda = $tienda->getAllArr();
			$objpti = new ProductoTienda();
			foreach($datatienda as $ex){					
				$_requestpt['id_producto'] 			 = $id;
				$_requestpt['tienda_id_tienda']      = $ex['id_tienda'];
				$_requestpt['existencias']           = 0;
				$_requestpt['fecha_actualizacion']   = date('Y-m-d H:i:s');
				$_requestpt['usuario_actualizacion'] = $_SESSION['user_id'];
				try {
					$objpti->addAll($_requestpt);
				} catch (Exception $e) {
					echo "no se genero la relacion".$e;
					exit();
				}
			}
		}
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'producto',$this->db,"update");
		$sql= "UPDATE producto SET $data[0]  WHERE id_producto=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return $id;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="BAJA";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'producto',$this->db,"update");	
		$sql= "UPDATE producto SET $data[0]  WHERE id_producto=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer obtener datos en el editar
	public function getTablebyCode($code)
	{
		
		$code = $this->db->real_escape_string($code);
		$sql  = "SELECT * FROM producto WHERE codinter='$code' and status='ACTIVO'";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para hacer obtener datos en el editar
	public function getProductosParecidos($code)
	{
		
		$code = $this->db->real_escape_string($code);
		$sql  = "SELECT *
			FROM producto 
			WHERE  codinter like '%". $code ."%' 
				AND  nombre like '%". $code ."%' 
				AND status='ACTIVO'
			ORDER BY nombre
			LIMIT 50";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;

	}

	//metodo comprueba que un producto existe o no
	public function existeProducto($code)
	{

		$code=$this->db->real_escape_string($code);
		$sql= "SELECT * FROM producto WHERE codinter='".$code."' and status='ACTIVO';";
		$res=$this->db->query($sql);
		if(!$res)
			{die('Error getting result');}
		//echo $sql;
		$row = $res->fetch_assoc();
		//echo $this->db->error;
		$res->close();
		if(!$row)
			return false;
		else
			return true;

	}
}
