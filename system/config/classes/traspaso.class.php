<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."traspaso.auto.class.php");

class Traspaso extends AutoTraspaso { 
	private $DB_TABLE = "traspaso";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM traspaso where status!='BAJA';";
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
		$sql= "SELECT * FROM traspaso WHERE id_traspaso=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result traspaso");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		
		$id_usuario		  = (isset($_request['id_usuario']))        ? $_request['id_usuario'] : $_SESSION['user_id'];
		$id_tiendaorigen  = (isset($_request['id_tiendaanterior'])) ? $_request['id_tiendaanterior']  : $_SESSION['user_info']['id_tienda'];
		$id_tiendadestino = (isset($_request['id_tienda']))         ? $_request['id_tienda']  : die('No tienda destino');
		
		$_requestTraspaso['folio']    	       = $this->getNewFolio($id_tiendadestino);
		$_requestTraspaso['id_tienda']         = $id_tiendadestino;
		$_requestTraspaso['id_tiendaanterior'] = $id_tiendaorigen;
		$_requestTraspaso['id_user']           = $id_usuario;
		$_requestTraspaso['concepto'] 	       = 'TRASPASO A ALMACEN';
		$_requestTraspaso['comentarios']       = (isset($_request['comentarios'])) ? $_request['comentarios'] : '';
		$_requestTraspaso['referencia']        = (isset($_request['referencia'])) ? $_request['referencia'] : '';
		$_requestTraspaso['status'] 	       = 'POR AUTORIZAR';
		$_requestTraspaso['fecha'] 		       = (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:m:s") : date('Y-m-d H:m:s');
		
		$data=fromArray($_requestTraspaso,'traspaso',$this->db,"add");
		$sql= "INSERT INTO traspaso (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$idtraspaso="";
		$idefirst="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;

			$idtraspaso = $id["LAST_INSERT_ID()"];

			
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

					$_requestTraspasoProducto['id_tienda'] 	       = $id_tiendadestino;
					$_requestTraspasoProducto['cantidad_anterior'] = $productotienda['existencias'];
					$_requestTraspasoProducto['id_traspaso'] 	   = $idtraspaso;
					$_requestTraspasoProducto['id_producto']	   = $valproducto;
					$_requestTraspasoProducto['nombre']            = $producto['nombre'];
					$_requestTraspasoProducto['cantidad'] 	       = $cantidades[$key2];
					$_requestTraspasoProducto['costo'] 		       = $costos[$key2];
					$_requestTraspasoProducto['mayoreo'] 	       = $mayoreos[$key2];
					$_requestTraspasoProducto['precio']            = $precios[$key2];
					$_requestTraspasoProducto['totalcosto']        = $cantidades[$key2]*$costos[$key2];
					$_requestTraspasoProducto['total']        	   = $cantidades[$key2]*$precios[$key2];
					$_requestTraspasoProducto['status'] 		   = 'POR AUTORIZAR';
					$objTraspasoProducto = new TraspasoProducto();
					$idEP = $objTraspasoProducto->addAll($_requestTraspasoProducto);
					if($idEP>0){}else{ die("Error al insertar Traspaso Producto"); }
				}
			}
			if($totalcosto>0){
				$_requestTraspasoNva['total'] 	   = $totalgral;
				$_requestTraspasoNva['costo_total'] = $totalcosto;
				if( ! $this->updateAll($idtraspaso,$_requestTraspasoNva) ) {
					die("Error al actualizar costo total Traspaso");
				}
			}
			
		}
		return $idtraspaso;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'traspaso',$this->db,"update");
		$sql= "UPDATE traspaso SET $data[0]  WHERE id_traspaso=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($idtraspaso,$_request=false)
	{
		if(! intval( $idtraspaso )) return false;

		$datatraspaso = $this->getTable($idtraspaso);
		if(!$datatraspaso) die('error traspaso');

		$objTraspasoProducto = new TraspasoProducto();
		$dataTraspasoProductos = $objTraspasoProducto->getAllArr($idtraspaso);
		foreach ($dataTraspasoProductos as $key => $row) {
			$objTraspasoProducto->deleteAll($row['id_traspaso_producto']);
		}
		$_request['usuario_deleted'] =  $_SESSION['user_id'];
		$_request['deleted_date'] 	=  date('Y-m-d H:m:s');
		$_request['status']			= 'BAJA';
		return $this->updateAll($idtraspaso,$_request);
	}
	//metodo que sirve para obtener el folio por tienda
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id_traspaso),0)+1) folio FROM traspaso WHERE id_tienda=$id order by id_traspaso desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	//reporte de traspasos
	public function getReporteTraspasos($arrayfilters)
	{
		$fechaini      = (isset($arrayfilters['fecha_inicial']))     ? $arrayfilters['fecha_inicial'] : '';
		$fechafin      = (isset($arrayfilters['fecha_final']))       ? $arrayfilters['fecha_final']   : '';
		$id_usuario    = (isset($arrayfilters['id_usuario']))        ? $arrayfilters['id_usuario']    : '';
		$id_tienda     = (isset($arrayfilters['id_tienda']))         ? $arrayfilters['id_tienda']     : '';
		$id_tiendaant  = (isset($arrayfilters['id_tiendaanterior'])) ? $arrayfilters['id_tiendaanterior']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario    = ($id_usuario)  ? " AND v.id_user='$id_usuario' " : "";
		$qrytienda     = ($id_tienda>0) ? " AND v.id_tienda='$id_tienda' "   : "";
		$id_tiendaant  = ($id_tiendaant>0) ? " AND v.id_tiendaanterior='$id_tiendaant' "   : "";
		$sql = "SELECT v.* FROM traspaso v
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
					$id_tiendaant 
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteTraspasos"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteTraspasosPendientes()
	{
		$sql = "SELECT v.* FROM traspaso v
				where  v.status='POR AUTORIZAR'
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteTraspasos"); }
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
	public function validateAll($idtraspaso){
		if(! intval( $idtraspaso )) return false;

		$datatraspaso = $this->getTable($idtraspaso);
		if(!$datatraspaso) die('error traspaso');

		$objTraspasoProducto = new TraspasoProducto();
		$traspasoproductos = $objTraspasoProducto->getAllArr($idtraspaso);
		foreach ($traspasoproductos as $key => $row) {
			$objproductos = new Producto();
			$dataproducto = $objproductos->getTable($row['id_producto']);
			if($dataproducto['manual']) continue;

			$objproductotienda = new ProductoTienda();

			$productotienda=$objproductotienda->getTablebyProducto($row['id_producto'], $datatraspaso['id_tienda']);
			if(!$productotienda) continue;

			$productotiendaAnterior=$objproductotienda->getTablebyProducto($row['id_producto'], $datatraspaso['id_tiendaanterior']);
			if(!$productotiendaAnterior) continue;

			$objproductotienda->actualizaexistencia($productotienda['id_productotienda'],$row['cantidad'],'increment');
			$objproductotienda->actualizaexistencia($productotiendaAnterior['id_productotienda'],$row['cantidad'],'decrement');

			$requestTraspasoProducto['status']	= 'ACTIVO';
			$objTraspasoProducto->updateAll($row['id_traspaso_producto'],$requestTraspasoProducto);
		}
		$_request['usuario_validacion'] =  $_SESSION['user_id'];
		$_request['fecha_validacion'] 	=  date('Y-m-d H:m:s');
		$_request['status']				='ACTIVO';
		return $this->updateAll($idtraspaso,$_request);
	}

	


}
