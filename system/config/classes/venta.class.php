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
		$_request['id_usuario'] = (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_info']['id_usuario'];
		$_request['folio']      = $this->getNewFolio($_request['id_tienda']);
		$_request['total'] 		= $_request['total-global'];
		$_request['descuento'] 	= (isset($_request['monto'])) ? ($_request['monto']) : 0;
		$_request['fecha'] 		= (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:m:s") : date('Y-m-d H:m:s');
		$_request['icredito'] 	= ($_request['tipo']=="Credito") ? 1 : 0;
		
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
			$objdescuentos = new Descuentos();
			$objproductostienda = new ProductoTienda();
			//ProductosVenta
				//arrays
				$cantidades      = $_request["cantidad"];
				$productos       = $_request["id_producto"];
				$productotienda  = $_request["id_productotienda"];
				$totales         = $_request["total_producto"];
				$costos          = $_request["costototal"];
				$tipoprecio      = $_request["tipoprecio"];
				foreach ($productotienda as $key => $value) {
					$producto = $objproductos->gettable($productos[$key]);
					$_requestD['id_venta']  	    = $id;
					$_requestD['id_productotienda'] = $value;
					$_requestD['cantidad'] 	   		= $cantidades[$key];
					$_requestD['nombre']        	= $producto['nombre'];
					$_requestD['costototal']        = $costos[$key];
					$_requestD['total'] 	   		= $totales[$key];
					$_requestD['tipo_precio']  	    = $tipoprecio[$key];
					$idHD = $objPV->addAll($_requestD);
					if($idHD>0){}else{ die("Error al insertar historial diagnostico"); }
					if(!$producto['manual'])
						$objproductostienda->actualizaexistencia($value,$cantidades[$key],'decrement');
				}
			//ABONOS
				if($_request['tipo']=="Credito" && $_request['montoabono']>0){
				
					$_requesA['id_venta'] 	 = $id;
					$_requesA['id_tienda'] 	 = $_request['id_tienda'];
					$_requesA['id_usuario']  = $_request['id_usuario'];
					$_requesA['montoabono']  = $_request['montoabono'];
					$_requesA['fecha_abono'] = $_request['fecha'];
					$_requesA['tipo_pago']	 = $_request['fecha'];
					$_requesA['comentarios'] = 'Abono Inicial';
					
					$this->savenewpago($_requesA);
				}
			//Descuentos
				if($_request['descuento']>0){
				
					$_requesD['id_venta'] 	 = $id;
					$_requesD['id_usuario']  = $_request['id_usuario'];
					$_requesD['totaldesc']   = $_request['montoabono'];
					$_requesD['descripciondesc'] = "Desc :".$_request['id_usuario']."$ ".$_request['montoabono'];
					
					$objdescuentos->addAll($_requesD);
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
		$qryusuario = ($id_usuario)  ? " AND v.id_usuario='$id_usuario' " : "";
		$qrytienda  = ($id_tienda>0) ? " AND v.id_tienda='$id_tienda' "   : "";
		$sql = "SELECT v.* FROM venta v
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
	public function getReporteComisionesUsuarios($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario     = ($id_usuario)  ? " AND v.id_usuario = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND v.id_tienda  = '$id_tienda'  " : "";
		$qryusuariodesc = ($id_usuario)  ? " AND d.id_usuario = '$id_usuario' " : "";
		$qrytiendadesc  = ($id_tienda>0) ? " AND v.id_tienda  = '$id_tienda'  " : "";
		$sql = "SELECT 
						usuarios_venta.id_usuario,usuarios_venta.comision,
						ifnull(usuarios_venta.totalventa,0) totalventa,
						ifnull(ventas_credito.totalventacredito,0) totalventacredito,
						ifnull(ventas_canceladas.totalventacancelada,0) totalventacancelada,
						ifnull(ventas_mayoreo.totalventamayoreo,0) totalventamayoreo,
						ifnull(ventas_abonos.totalventaabonos,0) totalventaabonos,
						ifnull(ventas_recargas.totalventarecargas,0) totalventarecargas,
						ifnull(ventas_excedente.totalventaexcedente,0) totalventaexcedente,
						ifnull(usuarios_venta.totalventadescuento,0) totalventadescuento
					FROM (
						SELECT SUM(pv.total) as totalventa,SUM(v.descuento) totalventadescuento, v.id_usuario id_usuario, u.comision
						FROM  productos_venta pv
						INNER JOIN venta v ON pv.id_venta=v.id_venta
    					LEFT JOIN usuario u ON u.id_usuario=v.id_usuario 
						where  
							DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							AND v.cancelado=0 AND pv.cancelado=0 
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					) AS usuarios_venta
					LEFT JOIN (
						SELECT SUM(pv.total) as totalventacancelada, pv.usuario_cancelacion id_usuario 
						FROM  productos_venta pv 
						INNER JOIN venta v ON pv.id_venta=v.id_venta
						where  
							DATE(pv.fecha_cancelacion)>='".$fechaini."' and DATE(pv.fecha_cancelacion)<='".$fechafin."'
							AND v.icredito=0 
							$qryusuario
							$qrytienda
						GROUP BY pv.usuario_cancelacion
					)AS ventas_canceladas ON usuarios_venta.id_usuario=ventas_canceladas.id_usuario
					LEFT JOIN (
						SELECT SUM(pv.total) as totalventamayoreo, v.id_usuario id_usuario 
						FROM  productos_venta pv
						LEFT JOIN venta v ON pv.id_venta=v.id_venta
						where  
							DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 
							AND pv.tipoprecio = 'Mayoreo'
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					)AS ventas_mayoreo ON usuarios_venta.id_usuario=ventas_mayoreo.id_usuario
					LEFT JOIN (
						SELECT SUM(v.montoabono) as totalventaabonos, v.id_usuario id_usuario 
						FROM  deudores v
						where  
							DATE(v.fecha_abono)>='".$fechaini."' and DATE(v.fecha_abono)<='".$fechafin."'
							AND v.status='ACTIVA'
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					)AS ventas_abonos ON usuarios_venta.id_usuario=ventas_abonos.id_usuario
					LEFT JOIN (
						SELECT SUM(pv.total) as totalventacredito, v.id_usuario id_usuario 
						FROM  productos_venta pv
						INNER JOIN venta v ON pv.id_venta=v.id_venta
						where  
							DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=1
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					)AS ventas_credito ON usuarios_venta.id_usuario=ventas_credito.id_usuario
					LEFT JOIN (
						SELECT SUM(pv.total) as totalventarecargas, v.id_usuario id_usuario 
						FROM  productos_venta pv
						INNER JOIN venta v ON pv.id_venta=v.id_venta
						INNER JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
						INNER JOIN producto p ON pt.id_producto=p.id_producto
						where  
							DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 AND p.manual=1 AND pv.nombre='RECARGA'
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					)AS ventas_recargas ON usuarios_venta.id_usuario=ventas_recargas.id_usuario
					LEFT JOIN (
						SELECT SUM(pv.total) as totalventaexcedente, v.id_usuario id_usuario 
						FROM  productos_venta pv
						INNER JOIN venta v ON pv.id_venta=v.id_venta
						INNER JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
						INNER JOIN producto p ON pt.id_producto=p.id_producto
						where  
							DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							AND v.cancelado=0 AND pv.cancelado=0 AND v.icredito=0 AND p.manual=1 AND pv.nombre='EXCEDENTE'
							$qryusuario
							$qrytienda
						GROUP BY v.id_usuario
					)AS ventas_excedente ON usuarios_venta.id_usuario=ventas_excedente.id_usuario
					
			 ";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result 1"); }
		else{
			while ($row = $res->fetch_object()){ 
				$set[] = $row; 
			}
		}
		
		return $set;
	}
	//metodo que sirve para hacer obtener datos en el editar
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
	public function getstatus($id){
	
		if(! intval( $id )) return false;
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * 
				FROM productos_venta pv
				LEFT JOIN venta v ON pv.id_venta=v.id_venta
					WHERE pv.id_venta=$id AND pv.cancelado=0 AND v.cancelado=0;";
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
	
	

}
