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
		$_request['id_user'] 	= (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_id'];
		$_request['folio']      = $this->getNewFolio($_request['id_tienda']);
		$_request['total'] 		= $_request['total-global'];
		$_request['descuento'] 	= (isset($_request['monto'])) ? ($_request['monto']) : 0;
		$_request['fecha'] 		= (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:i:s") : date('Y-m-d H:i:s');

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
					$_requestProductosVenta['id_venta']  	     = $id;
					$_requestProductosVenta['id_productotienda'] = $value;
					$_requestProductosVenta['cantidad'] 	   	 = $cantidades[$key];
					$_requestProductosVenta['nombre']        	 = $producto['nombre'];
					$_requestProductosVenta['costototal']        = $costos[$key];
					$_requestProductosVenta['total'] 	   		 = $totales[$key];
					$_requestProductosVenta['tipoprecio']  	     = $tipoprecio[$key];
					$idHD = $objPV->addAll($_requestProductosVenta);
					if($idHD>0){}else{ die("Error al insertar productos venta"); }
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
	
	public function getcancelaciones($id)
	{
	
		$sql = "SELECT ifnull(sum(pv.total),0) totalcancelado
						FROM productos_venta pv
							LEFT JOIN venta v ON v.id_venta=pv.id_venta
						where  pv.id_venta=$id 
							AND 	pv.cancelado=1
							AND 	v.cancelado=0";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result venta");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['totalcancelado'];
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
	

	

	
	

}
