<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."venta.auto.class.php");

class Venta extends AutoVenta { 
	private $DB_TABLE = "venta";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM venta where status='active';";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
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
		$sql= "SELECT * FROM venta WHERE id_venta=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result venta");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_tienda']  = (isset($_request['id_tienda']))  ? $_request['id_tienda']  : $_SESSION['user_info']['id_tienda'];
		$_request['id_user'] 		= (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_id'];
		$_request['folio']      = $this->getNewFolio($_request['id_tienda']);
		$_request['total'] 		  = $_request['total-global'];
		$_request['descuento'] 	= (isset($_request['monto'])) ? ($_request['monto']) : 0;
		$_request['fecha'] 		  = (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:m:s") : date('Y-m-d H:m:s');
		$_request['icredito'] 	= ($_request['tipo']=="Credito" || $_request['tipo']=="Apartado") ? 1 : 0;
		$_request['id_user_registro']	= $_SESSION['user_id'];
		
		$data=fromArray($_request,'venta',$this->db,"add");
		$sql= "INSERT INTO venta (".$data[0].") VALUES(".$data[1]."); ";
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

			$objPV = new ProductosVenta();
			$objproductos = new Producto();
			$objproductostienda = new ProductoTienda();
			
			if($objproductos){
			
				//ProductosVenta
				//arrays
				$cantidades      = $_request["cantidad"];
				$productos       = $_request["id_producto"];
				$productotienda  = $_request["id_productotienda"];
				$totales         = $_request["total_producto"];
				$costos          = (isset($_request["costototal"]))? $_request["costototal"] : 0;
				$tipoprecio      = $_request["tipoprecio"];
				foreach ($productotienda as $key => $value) {
					$producto = $objproductos->gettable($productos[$key]);
					$_requestProductosVenta['id_venta']  	       = $id;
					$_requestProductosVenta['id_productotienda'] = $value;
					$_requestProductosVenta['cantidad'] 	   		 = $cantidades[$key];
					$_requestProductosVenta['nombre']        	   = $producto['nombre'];
					$_requestProductosVenta['costototal']        = $costos[$key];
					$_requestProductosVenta['total'] 	   		     = $totales[$key];
					$_requestProductosVenta['tipoprecio']  	     = $tipoprecio[$key];
					$idHD = $objPV->addAll($_requestProductosVenta);
					if($idHD>0){}else{ die("Error al insertar historial diagnostico"); }
					if(!$producto['manual'])
						$objproductostienda->actualizaexistencia($value,$cantidades[$key],'decrement');
				}
			//ABONOS
				if(($_request['tipo']=="Credito" || $_request['tipo']=="Apartado" ) && $_request['montoabono']>0){
				
					$_requesDeudores['id_venta'] 	  = $id;
					$_requesDeudores['id_tienda'] 	= $_request['id_tienda'];
					$_requesDeudores['id_usuario']  = (isset($_request['id_usuario'])) ? $_request['id_usuario'] : '';
					$_requesDeudores['montoabono']  = $_request['montoabono'];
					$_requesDeudores['fecha_abono'] = $_request['fecha']." ".date('H:i:s');
					$_requesDeudores['tipo_pago']	  = $_request['tipo'];
					$_requesDeudores['comentarios'] = 'Abono Inicial';
					
					$objdeudores = new Deudores();
					$objdeudores->addAll($_requesDeudores);
				}
			}else{
				die('el producto no existe');
			}
		}
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'venta',$this->db,"update");
		$sql= "UPDATE venta SET $data[0]  WHERE id_venta=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["cancelado"]="1";
		$_request["fecha_cancelacion"]   = date("Y-m-d H:i:s");
		$_request["usuario_cancelacion"] = $_SESSION['user_info']["id_usuario"];
		$data=fromArray($_request,'venta',$this->db,"update");	
		$sql= "UPDATE venta SET $data[0]  WHERE id_venta=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			
			$objPV = new ProductosVenta();
			$datapv = $objPV->getAllArr($id,false);
			foreach($datapv as $row) {
				$objPV->deleteAll($row['id_productos_venta']);
			}
			return true;
		}
	}
	public function getReporteVentas($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario = ($id_usuario)  ? " AND v.id_user='$id_usuario' " : "";
		$qrytienda  = ($id_tienda>0) ? " AND v.id_tienda='$id_tienda' "   : "";
		$sql = "SELECT v.*,u.id_usuario id_usuario
						FROM venta v
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result 1"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteVentasApartados()
	{
		
		$sql = "SELECT v.*,(TO_DAYS(v.fecha)- TO_DAYS(CURDATE())) AS dias, u.id_usuario id_usuario,CONCAT(p.nombre,' ',p.ap_paterno,' ',p.ap_materno) cliente ,p.telefono telefono
						FROM venta v
						LEFT JOIN usuario u ON v.id_user=u.id
						LEFT JOIN persona p ON v.id_persona=p.id_persona
							where icredito=1
							AND cancelado=0
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result  getReporteVentasApartados"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteAbonos($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario     = ($id_usuario)  ? " AND v.id_user = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND v.id_tienda  = '$id_tienda'  " : "";
		$sql = "SELECT SUM(d.montoabono) as totalventaabonos, d.id_user id_usuario 
				FROM  deudores d
				LEFT JOIN venta v ON d.id_venta=v.id_venta
				where  
					DATE(d.fecha_abono)>='".$fechaini."' and DATE(d.fecha_abono)<='".$fechafin."'
					AND d.status='ACTIVA'
					$qryusuario
					$qrytienda
				GROUP BY v.id_user
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result  getReporteAbonos"); }
		else{
			while ($row = $res->fetch_object())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteComisionesUsuarios($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario     = ($id_usuario)  ? " AND v.id_user = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND v.id_tienda  = '$id_tienda'  " : "";
		$sql = "SELECT 
							usuarios_venta.id_usuario id_usuario,usuarios_venta.comision,usuarios_venta.id_usuario_tipo,
							ifnull(usuarios_venta.totalventa,0) totalventa,
							ifnull(ventas_credito.totalventacredito,0) totalventacredito,
							ifnull(ventas_canceladas.totalventacancelada,0) totalventacancelada,
							ifnull(ventas_mayoreo.totalventamayoreo,0) totalventamayoreo,
							ifnull(ventas_abonos.totalventaabonos,0) totalventaabonos,
							ifnull(ventas_recargas.totalventarecargas,0) totalventarecargas,
							ifnull(ventas_excedente.totalventaexcedente,0) totalventaexcedente,
							ifnull(descuentos.totalventadescuento,0) totalventadescuento
						FROM (
							SELECT SUM(pv.total) as totalventa,SUM(v.descuento) totalventadescuento, v.id_user , u.comision,u.id_usuario,u.id_usuario_tipo
							FROM  productos_venta pv
							INNER JOIN venta v ON pv.id_venta=v.id_venta
								LEFT JOIN usuario u ON u.id=v.id_user 
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 AND pv.cancelado=0 
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						) AS usuarios_venta
						LEFT JOIN (
							SELECT SUM(v.descuento) totalventadescuento, v.id_user 
							FROM  venta v
								LEFT JOIN usuario u ON u.id=v.id_user 
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						)AS descuentos ON usuarios_venta.id_user=descuentos.id_user
						LEFT JOIN (
							SELECT SUM(pv.total) as totalventacancelada, pv.usuario_cancelacion id_user 
							FROM  productos_venta pv 
							INNER JOIN venta v ON pv.id_venta=v.id_venta
							where  
								DATE(pv.fecha_cancelacion)>='".$fechaini."' and DATE(pv.fecha_cancelacion)<='".$fechafin."'
								AND v.icredito=0 
								$qryusuario
								$qrytienda
							GROUP BY pv.usuario_cancelacion
						)AS ventas_canceladas ON usuarios_venta.id_user=ventas_canceladas.id_user
						LEFT JOIN (
							SELECT SUM(pv.total) as totalventamayoreo, v.id_user id_user 
							FROM  productos_venta pv
							LEFT JOIN venta v ON pv.id_venta=v.id_venta
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 
								AND pv.tipoprecio = 'Mayoreo'
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						)AS ventas_mayoreo ON usuarios_venta.id_user=ventas_mayoreo.id_user
						LEFT JOIN (
							SELECT SUM(d.montoabono) as totalventaabonos, d.id_user id_user 
							FROM  deudores d
							LEFT JOIN venta v ON d.id_venta=v.id_venta
							where  
								DATE(d.fecha_abono)>='".$fechaini."' and DATE(d.fecha_abono)<='".$fechafin."'
								AND d.status='ACTIVA'
								$qryusuario
								$qrytienda
							GROUP BY d.id_user
						)AS ventas_abonos ON usuarios_venta.id_user=ventas_abonos.id_user
						LEFT JOIN (
							SELECT (SUM(pv.total)-v.descuento) as totalventacredito, v.id_user id_user 
							FROM  productos_venta pv
							INNER JOIN venta v ON pv.id_venta=v.id_venta
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=1
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						)AS ventas_credito ON usuarios_venta.id_user=ventas_credito.id_user
						LEFT JOIN (
							SELECT SUM(pv.total) as totalventarecargas, v.id_user id_user 
							FROM  productos_venta pv
							INNER JOIN venta v ON pv.id_venta=v.id_venta
							INNER JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
							INNER JOIN producto p ON pt.id_producto=p.id_producto
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 AND p.manual=1 AND pv.nombre='RECARGA'
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						)AS ventas_recargas ON usuarios_venta.id_user=ventas_recargas.id_user
						LEFT JOIN (
							SELECT SUM(pv.total) as totalventaexcedente, v.id_user id_user 
							FROM  productos_venta pv
							INNER JOIN venta v ON pv.id_venta=v.id_venta
							INNER JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
							INNER JOIN producto p ON pt.id_producto=p.id_producto
							where  
								DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
								AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 AND p.manual=1 AND pv.nombre='EXCEDENTE'
								$qryusuario
								$qrytienda
							GROUP BY v.id_user
						)AS ventas_excedente ON usuarios_venta.id_user=ventas_excedente.id_user
						
				";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getReporteComisionesUsuarios"); }
		else{
			while ($row = $res->fetch_object()){ 
				$set[] = $row; 
			}
		}
		
		return $set;
	}
	//metodo que sirve para obtener el folio por tienda
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id_venta),0)+1) folio FROM venta WHERE id_tienda=$id order by id_venta desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	//metodo para obtener el estatus de venta
	public function getstatuscancelada($id){
	
		if(! intval( $id )) return false;
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * 
				FROM productos_venta pv
				LEFT JOIN venta v ON pv.id_venta=v.id_venta
					WHERE pv.id_venta=$id 
					AND pv.cancelado=0;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result venta");}
		$row = $res->fetch_assoc();
		$res->close();

		$cancelado = ($row) ?  false : true;
		return $cancelado;
	}
	public function getpagado($id){
		if(! intval( $id )) return false;
		$sql = "SELECT ifnull(sum(montoabono),0) as total FROM deudores where  id_venta=$id and status='ACTIVA' limit 1;";
		$res = $this->db->query($sql);
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result venta");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['total'];
	}
	public function getpagos($id){
		if(! intval( $id )) return false;
		$sql = "SELECT * FROM deudores where  id_venta=$id and status='ACTIVA'";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result  getReporteVentasApartados"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	// ventas por producto
	public function getReporteVentasProductos($id)
	{
		if(! intval( $id )) return false;
		
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT pv.*,v.id_tienda,u.id_usuario id_usuario,p.codinter,v.tipo,v.icredito,v.folio,v.comentarios,v.fecha
						FROM productos_venta pv
						LEFT JOIN venta v ON pv.id_venta=v.id_venta
						LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda
						LEFT JOIN producto p ON p.id_producto=pt.id_producto
						LEFT JOIN usuario u ON u.id=v.id_user
				where  pv.id_venta=$id
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteVentasProductos "); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}

	//CORRECCION DE BASE DE DATOS
	// arrreglar descuentos de ventas
	public function arreglar_Descuentos(){
		$sql = "SELECT SUM(d.montodesc) as totalventadescuento,d.id_venta id_venta
			FROM descuentos d 
			INNER JOIN venta v ON v.id_venta=d.id_venta  
			GROUP BY d.id_venta ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc()){ 
				 $request['descuento']=$row['totalventadescuento'];
				 $id=$row['id_venta'];
				 $this->updateAll($id,$request);
			 }
		}
		echo "exito arreglar_Descuentos";
	}
	// arrreglar VENTAS CANCELADAS
	public function arreglar_cancelaciones(){
		$sql = "SELECT id_venta,observaciones,id_usuario,fecha_registro FROM venta_cancelada ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc()){ 
				$request['cancelado']=1;
				$request['fecha_cancelacion']=$row['fecha_registro'];
				$request['razon_cancelacion']=$row['observaciones'];
				$request['usuario_cancelacion']=$row['id_usuario'];
				$id=$row['id_venta'];
				$this->updateAll($id,$request);
			 }
		}
		echo "exito arreglar_cancelaciones";
	}
	// arrreglar VENTAS PRODUCTOS CANCELADAS
	public function arreglar_cancelacionesproductos(){
		$sql = "SELECT id_productos_venta,observaciones,id_usuario,fecha_registro FROM venta_productocancelado";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc()){ 
				$request['cancelado']=1;
				$request['fecha_cancelacion']   = $row['fecha_registro'];
				$request['razon_cancelacion']   = $row['observaciones'];
				$request['usuario_cancelacion'] = $row['id_usuario'];
				$id=$row['id_productos_venta'];
				$PV= new ProductosVenta();
				$PV->updateAll($id,$request);
			 }
		}
		echo "exito arreglar_cancelacionesproductos";
	}
	// arrreglar Precios de Productos
	public function arreglar_precios(){
		$sql = "SELECT TODO.id_producto,TODO.codinter,TODO.nombre,TODO.marca,TODO.categoria,
				TODO.proveedor,TODO.paquete	,TODO.costo,TODO.precio,TODO.preciomayoreo
				,TODO.existencias, TIENDA.existencias existenciastienda,TIENDA.fecha_actualizacion,TIENDA.usuario_actualizacion
				FROM(
					SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
						PRODUCTO.proveedor,PRODUCTO.paquete	,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
						,SUM(EXISTENCIAS.existencias) existencias
						FROM(
							SELECT p.id_producto,codinter,p.nombre,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
							FROM producto p
							LEFT JOIN marca m on p.id_marca=m.id_marca
							LEFT JOIN categoria c on p.id_categoria=c.id_categoria
							LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
							WHERE p.status='ACTIVO'
						) AS PRODUCTO LEFT JOIN (
						SELECT ep.id_producto,ep.id_entrada_producto,ep.costo,ep.precio,ep.precio_descuento preciomayoreo
						FROM(
							SELECT id_producto,max(id_entrada_producto) id_entrada_producto 
							FROM xqwmrfeeug.entrada_producto
							WHERE status='ACTIVO'
							group by id_producto
						)ULTIMAENTRADA  
						JOIN entrada_producto ep ON ep.id_entrada_producto=ULTIMAENTRADA.id_entrada_producto
						)PRECIO ON PRODUCTO.id_producto=PRECIO.id_producto
						LEFT JOIN(
							SELECT id_producto, existencias, tienda_id_tienda id_tienda
							FROM producto_tienda 
							WHERE tienda_id_tienda!='14'
							group by id_producto,tienda_id_tienda
						)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
						
						group by 
						PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
						PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
						,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
				) AS TODO
				LEFT JOIN (
					SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
						PRODUCTO.proveedor,PRODUCTO.paquete	,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
						,SUM(EXISTENCIAS.existencias) existencias,EXISTENCIAS.fecha_actualizacion,EXISTENCIAS.usuario_actualizacion
						FROM(
							SELECT p.id_producto,codinter,p.nombre,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
							FROM producto p
							LEFT JOIN marca m on p.id_marca=m.id_marca
							LEFT JOIN categoria c on p.id_categoria=c.id_categoria
							LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
							WHERE p.status='ACTIVO'
						) AS PRODUCTO LEFT JOIN (
						SELECT ep.id_producto,ep.id_entrada_producto,ep.costo,ep.precio,ep.precio_descuento preciomayoreo
						FROM(
							SELECT id_producto,max(id_entrada_producto) id_entrada_producto 
							FROM xqwmrfeeug.entrada_producto
							WHERE status='ACTIVO'
							group by id_producto
						)ULTIMAENTRADA  
						JOIN entrada_producto ep ON ep.id_entrada_producto=ULTIMAENTRADA.id_entrada_producto
						)PRECIO ON PRODUCTO.id_producto=PRECIO.id_producto
						LEFT JOIN(
							SELECT id_producto, tienda_id_tienda id_tienda, existencias, fecha_actualizacion,usuario_actualizacion
							FROM producto_tienda 
							group by id_producto,tienda_id_tienda
						)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
						
						group by 
						PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
						PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
						,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
				) TIENDA ON TODO.id_producto=TIENDA.id_producto 
				
        ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ( $objasas = $res->fetch_object() ) {
				$PV= new Producto();
				$request['precio']           = ($objasas->precio) ? $objasas->precio : 0;
				$request['costo']   	     = ($objasas->costo) ? $objasas->costo :0;
				$request['precio_descuento'] = ($objasas->preciomayoreo) ?  $objasas->preciomayoreo :0;
				$PV->updateAll($objasas->id_producto,$request);
			//	echo $objasas->id_producto."->precio:".$objasas->precio." costo:".$objasas->costo." mayoreo:".$objasas->preciomayoreo."<br>";
				
			}
		   
		}
		echo "exito arreglar_precios";
	}

	
	

}
