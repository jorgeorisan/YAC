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
		}
		return $id["LAST_INSERT_ID()"];
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
		$sql = "SELECT * FROM venta v
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
						ifnull(ventas_descuento.totalventadescuento,0) totalventadescuento
					FROM (
						SELECT SUM(pv.total) as totalventa, v.id_usuario id_usuario, u.comision
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
						SELECT SUM(vpc.total) as totalventacancelada, vpc.id_usuario id_usuario 
						FROM  venta_productocancelado vpc
						INNER JOIN productos_venta pv ON vpc.id_productos_venta=pv.id_productos_venta
						INNER JOIN venta v ON pv.id_venta=v.id_venta
						where  
							DATE(vpc.fecha_registro)>='".$fechaini."' and DATE(vpc.fecha_registro)<='".$fechafin."'
							AND v.icredito=0 
							$qryusuario
							$qrytienda
						GROUP BY vpc.id_usuario
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
					LEFT JOIN (
						SELECT SUM(d.montodesc) as totalventadescuento, d.id_usuario id_usuario 
						FROM  descuentos d
						INNER JOIN venta v ON v.id_venta=d.id_venta
						where  
							DATE(d.fecha_registro)>='".$fechaini."' and DATE(d.fecha_registro)<='".$fechafin."'
							AND v.cancelado=0   AND d.status='ACTIVO'
							$qryusuariodesc
							$qrytiendadesc
						GROUP BY d.id_usuario
					)AS ventas_descuento ON usuarios_venta.id_usuario=ventas_descuento.id_usuario
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

}
