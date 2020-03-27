<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."pedido.auto.class.php");

class Pedido extends AutoPedido { 
	private $DB_TABLE = "pedido";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM pedido where status!='BAJA';";
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
		$sql= "SELECT * FROM pedido WHERE id_pedido=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result pedido");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar NUEVO AL ACTUALZIAR EXISTENCIAS
	public function addByOne($_request)
	{
		$data=fromArray($_request,'pedido',$this->db,"add");
		$sql= "INSERT INTO pedido (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		
		$_request['id_usuario'] = (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_id'];
		$id_tienda              = (isset($_request['id_tienda']))  ? $_request['id_tienda']  : $_SESSION['user_info']['id_tienda'];
			
		$_requestPedido['folio']    		   = $this->getNewFolio($id_tienda);
		$_requestPedido['id_tienda']    	   = $id_tienda;
		$_requestPedido['id_user']    	   	   = $_request['id_usuario'];
		$_requestPedido['concepto'] 		   = 'PEDIDO';
		$_requestPedido['comentarios'] 	       = (isset($_request['comentarios'])) ? $_request['comentarios'] : '';
		$_requestPedido['referencia'] 		   = (isset($_request['referencia'])) ? $_request['referencia'] : '';
		$_requestPedido['status'] 		   	   = 'SOLICITADO';
		$_requestPedido['fecha'] 		  	   = (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:i:s") : date('Y-m-d H:i:s');
		$data=fromArray($_requestPedido,'pedido',$this->db,"add");
		$sql= "INSERT INTO pedido (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$ide="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;

			$ide = $id["LAST_INSERT_ID()"];

			if(!$ide)  die("Error al insertar Pedido");
			
			

			$objPedidoProducto = new PedidoProducto();
			$objproductos 		= new Producto();
			$objproductotienda 	= new ProductoTienda();
			//arrays
			$productos  = $_request["id_producto"];
			$cantidades = $_request["cantidad"];
			$costos     = (isset($_request["costo"]))   ? $_request["costo"]  : [];
			$mayoreos   = (isset($_request["mayoreo"])) ? $_request["mayoreo"]: [];
			$precios    = (isset($_request["precio"]))  ? $_request["precio"] : [];
			$detalles   = (isset($_request["detalles"]))? $_request["detalles"] : [];
			$totalcosto = $totalgral= 0;
			foreach ($productos as $key2 => $valproducto) {
				if($cantidades[$key2]>0){
				
					$totalcosto += $cantidades[$key2]*$costos[$key2];
					$totalgral  += $cantidades[$key2]*$precios[$key2];
					$producto = $objproductos->gettable($valproducto);

					$productotienda=$objproductotienda->getTablebyProducto($valproducto, $id_tienda);
					if(!$productotienda) continue;

					$_requestPedidoProducto['id_tienda'] 	      = $id_tienda;
					$_requestPedidoProducto['cantidad_anterior']  = $productotienda['existencias'];
					$_requestPedidoProducto['id_pedido'] 	      = $ide;
					$_requestPedidoProducto['id_producto']	      = $valproducto;
					$_requestPedidoProducto['nombre']             = $producto['nombre'];
					$_requestPedidoProducto['cantidad'] 	      = $cantidades[$key2];
					$_requestPedidoProducto['detalles'] 	      = $detalles[$key2];
					$_requestPedidoProducto['costo'] 		      = $costos[$key2];
					$_requestPedidoProducto['mayoreo'] 	          = $mayoreos[$key2];
					$_requestPedidoProducto['precio']             = $precios[$key2];
					$_requestPedidoProducto['totalcosto']         = $cantidades[$key2]*$costos[$key2];
					$_requestPedidoProducto['status'] 		      = 'SOLICITADO';

					$idEP = $objPedidoProducto->addAll($_requestPedidoProducto);
					if($idEP>0){}else{ die("Error al insertar Pedido Producto"); }
				}
			}
			if($totalcosto>0){
				$_requestPedidoNva['total'] 	   = $totalgral;
				$_requestPedidoNva['costo_total'] = $totalcosto;
				if( ! $this->updateAll($ide,$_requestPedidoNva) ) {
					die("Error al actualizar costo total Pedido");
				}
			}
		}
		
		return $ide;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'pedido',$this->db,"update");
		$sql= "UPDATE pedido SET $data[0]  WHERE id_pedido=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($idpedido,$_request=false)
	{
		$dataPedido = $this->getTable($idpedido);
		if(!$dataPedido) die('Error pedido');

		$objPedidoProducto = new PedidoProducto();
		$dataPedidoProductos = $objPedidoProducto->getAllArr($idpedido);
		foreach ($dataPedidoProductos as $key => $row) {
			//Eliminamos los productos
			$objPedidoProducto->deleteAll($row['id_pedido_producto']);
		}
		$_request['usuario_deleted'] =  $_SESSION['user_id'];
		$_request['deleted_date'] 	=  date('Y-m-d H:i:s');
		$_request['status']			= 'BAJA';
		return $this->updateAll($idpedido,$_request);
		/**FALTA ACTUALIZAR LOS COSTOS A LA ULTIMA ENTRADA VALIDA */
	}
	//metodo que sirve para obtener el folio por tienda
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id_pedido),0)+1) folio FROM pedido WHERE id_tienda=$id  order by id_pedido desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	//reporte de pedidos
	public function getReportePedidos($arrayfilters)
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
		$sql = "SELECT v.* FROM pedido v
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReportePedidos"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	//reporte de pedidos por autorizar
	public function getReportePedidosPendientes()
	{
		$sql = "SELECT v.* FROM pedido v
				where  v.status = 'SOLICITADO'
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReportePedidosPendientes"); }
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
	public function validateAll($idpedido){
		if(! intval( $idpedido )) return false;

		$objPedidoProducto = new PedidoProducto();
		$pedidoproductos = $objPedidoProducto->getAllArr($idpedido);
		foreach ($pedidoproductos as $key => $row) {
			$objproductos = new Producto();
			$dataproducto = $objproductos->getTable($row['id_producto']);
			if($dataproducto['manual']) continue;

			$objproductotienda = new ProductoTienda();
			$productotienda=$objproductotienda->getTablebyProducto($row['id_producto'], $row['id_tienda']);
			if(!$productotienda) continue;

			$requestProducto['costo']			= $row['costo'];
			$requestProducto['precio_descuento']= $row['mayoreo'];
			$requestProducto['precio']			= $row['precio'];
			
			$requestPedidoProducto['status']	= 'ACTIVO';
			$objPedidoProducto->updateAll($row['id_pedido_producto'],$requestPedidoProducto);
		}
		$_request['usuario_validacion'] =  $_SESSION['user_id'];
		$_request['fecha_validacion'] 	=  date('Y-m-d H:i:s');
		$_request['status']				='ACTIVO';
		return $this->updateAll($idpedido,$_request);
	}

}
