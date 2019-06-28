<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."salida.auto.class.php");

class Salida extends AutoSalida { 
	private $DB_TABLE = "salida";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM salida where status !='BAJA';";
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
		$sql= "SELECT * FROM salida WHERE id_salida=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result salida");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar NUEVO AL ACTUALZIAR EXISTENCIAS
	public function addByOne($_request)
	{
		$data=fromArray($_request,'salida',$this->db,"add");
		$sql= "INSERT INTO salida (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result salida"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		
		$id_usuario		  = (isset($_request['id_usuario']))        ? $_request['id_usuario'] : $_SESSION['user_id'];
		$id_tiendaorigen  = (isset($_request['id_tiendaanterior'])) ? $_request['id_tiendaanterior']  : $_SESSION['user_info']['id_tienda'];
		$id_tiendadestino = (isset($_request['id_tienda']))         ? $_request['id_tienda']  : die('No tienda destino');
		
		$_requestSalida['folio']    	     = $this->getNewFolio($id_tiendadestino);
		$_requestSalida['id_tienda']         = $id_tiendadestino;
		$_requestSalida['id_tiendaanterior'] = $id_tiendaorigen;
		$_requestSalida['id_user']           = $id_usuario;
		$_requestSalida['concepto'] 	     = 'SALIDA DE ALMACEN';
		$_requestSalida['comentarios']       = (isset($_request['comentarios'])) ? $_request['comentarios'] : '';
		$_requestSalida['referencia']        = (isset($_request['referencia'])) ? $_request['referencia'] : '';
		$_requestSalida['status'] 	         = 'POR AUTORIZAR';
		$_requestSalida['fecha'] 		     = (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:m:s") : date('Y-m-d H:m:s');
		
		$data=fromArray($_requestSalida,'salida',$this->db,"add");
		$sql= "INSERT INTO salida (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$idsalida="";
		$idefirst="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;

			$idsalida = $id["LAST_INSERT_ID()"];

			$objSalidaProducto = new SalidaProducto();
			$objproductos 		= new Producto();
			$objproductotienda 	= new ProductoTienda();
			//arrays
			$productos  = $_request["id_producto"];
			$cantidades = $_request["cantidad"];
			$costos     = (isset($_request["costo"]))   ? $_request["costo"]  : [];
			$mayoreos   = (isset($_request["mayoreo"])) ? $_request["mayoreo"]: [];
			$precios    = (isset($_request["precio"]))  ? $_request["precio"] : [];
			$totalcosto = $totalgral= 0;
			foreach ($productos as $key2 => $valproducto) {
				if($cantidades[$key2]>0){
				
					$totalcosto += $cantidades[$key2]*$costos[$key2];
					$totalgral  += $cantidades[$key2]*$precios[$key2];
					$producto = $objproductos->gettable($valproducto);

					$productotienda=$objproductotienda->getTablebyProducto($valproducto, $id_tiendadestino);
					if(!$productotienda) continue;

					$_requestSalidaProducto['id_tienda'] 	       = $id_tiendadestino;
					$_requestSalidaProducto['cantidad_anterior'] = $productotienda['existencias'];
					$_requestSalidaProducto['id_salida'] 	   = $idsalida;
					$_requestSalidaProducto['id_producto']	   = $valproducto;
					$_requestSalidaProducto['nombre']            = $producto['nombre'];
					$_requestSalidaProducto['cantidad'] 	       = $cantidades[$key2];
					$_requestSalidaProducto['costo'] 		       = $costos[$key2];
					$_requestSalidaProducto['mayoreo'] 	       = $mayoreos[$key2];
					$_requestSalidaProducto['precio']            = $precios[$key2];
					$_requestSalidaProducto['totalcosto']        = $cantidades[$key2]*$costos[$key2];
					$_requestSalidaProducto['total']        	   = $cantidades[$key2]*$precios[$key2];
					$_requestSalidaProducto['status'] 		   = 'POR AUTORIZAR';

					$idEP = $objSalidaProducto->addAll($_requestSalidaProducto);
					if($idEP>0){}else{ die("Error al insertar Salida Producto"); }
				}
			}
			if($totalcosto>0){
				$_requestSalidaNva['total'] 	   = $totalgral;
				$_requestSalidaNva['costo_total'] = $totalcosto;
				if( ! $this->updateAll($idsalida,$_requestSalidaNva) ) {
					die("Error al actualizar costo total Salida");
				}
			}
			
		}
		return $idsalida;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'salida',$this->db,"update");
		$sql= "UPDATE salida SET $data[0]  WHERE id_salida=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($idsalida,$_request=false)
	{
		if(! intval( $idsalida )) return false;

		$datasalida = $this->getTable($idsalida);
		if(!$datasalida) die('error salida');

		$objSalidaProducto = new SalidaProducto();
		$dataSalidaProductos = $objSalidaProducto->getAllArr($idsalida);
		foreach ($dataSalidaProductos as $key => $row) {
			//Eliminamos los productos
			$objSalidaProducto->deleteAll($row['id_salida_producto']);
		}
		$_request['usuario_deleted'] =  $_SESSION['user_id'];
		$_request['deleted_date'] 	=  date('Y-m-d H:m:s');
		$_request['status']			= 'BAJA';
		return $this->updateAll($idsalida,$_request);
	}
	//metodo que sirve para obtener el folio por tienda
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id_salida),0)+1) folio FROM salida WHERE id_tienda=$id order by id_salida desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	//reporte de salidas
	public function getReporteSalidas($arrayfilters)
	{
		$fechaini      = (isset($arrayfilters['fecha_inicial']))     ? $arrayfilters['fecha_inicial'] : '';
		$fechafin      = (isset($arrayfilters['fecha_final']))       ? $arrayfilters['fecha_final']   : '';
		$id_usuario    = (isset($arrayfilters['id_usuario']))        ? $arrayfilters['id_usuario']    : '';
		$id_tienda     = (isset($arrayfilters['id_tienda']))         ? $arrayfilters['id_tienda']     : '';
		$id_tiendaant  = (isset($arrayfilters['id_tiendaanterior'])) ? $arrayfilters['id_tiendaanterior']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario    = ($id_usuario)  ? " AND v.id_usuario='$id_usuario' " : "";
		$qrytienda     = ($id_tienda>0) ? " AND v.id_tienda='$id_tienda' "   : "";
		$id_tiendaant  = ($id_tiendaant>0) ? " AND v.id_tiendaanterior='$id_tiendaant' "   : "";
		$sql = "SELECT v.* FROM salida v
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
					$id_tiendaant 
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteSalidas"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
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
		return 1;
	}
	public function validateAll($idsalida){
		if(! intval( $idsalida )) return false;

		$datasalida = $this->getTable($idsalida);
		if(!$datasalida) die('error salida');

		$objSalidaProducto = new SalidaProducto();
		$salidaproductos = $objSalidaProducto->getAllArr($idsalida);
		foreach ($salidaproductos as $key => $row) {
			$objproductos = new Producto();
			$dataproducto = $objproductos->getTable($row['id_producto']);
			if($dataproducto['manual']) continue;

			$objproductotienda = new ProductoTienda();

			$productotienda=$objproductotienda->getTablebyProducto($row['id_producto'], $datasalida['id_tienda']);
			if(!$productotienda) continue;

			$productotiendaAnterior=$objproductotienda->getTablebyProducto($row['id_producto'], $datasalida['id_tiendaanterior']);
			if(!$productotiendaAnterior) continue;

			$objproductotienda->actualizaexistencia($productotienda['id_productotienda'],$row['cantidad'],'increment');
			$objproductotienda->actualizaexistencia($productotiendaAnterior['id_productotienda'],$row['cantidad'],'decrement');

			$requestSalidaProducto['status']	= 'ACTIVO';
			$objSalidaProducto->updateAll($row['id_salida_producto'],$requestSalidaProducto);
		}
		$_request['usuario_validacion'] =  $_SESSION['user_id'];
		$_request['fecha_validacion'] 	=  date('Y-m-d H:m:s');
		$_request['status']				='ACTIVO';
		return $this->updateAll($idsalida,$_request);
	}

	


}
