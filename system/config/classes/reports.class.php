<?php 
/*
Auth Class  - funciones del modulo de reportes
*/
class Reports extends Usuario {

// Variables
	protected $db;
	protected $id = 0;

	protected $email = "";

	protected $password = ""; 

	protected $token = ""; 
	protected $token_expires = ""; 


	public function getReporteVentas($arrayfilters)
	{
		$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario  = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto = (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		$size	     = (isset($arrayfilters['size']))          ? $arrayfilters['size']          : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario  = ($id_usuario)    ? " AND v.id_user    = '$id_usuario' " : "";
		$qrytienda   = ($id_tienda>0)   ? " AND v.id_tienda  = '$id_tienda' "   : "";
		$id_producto = ($id_producto>0) ? " AND v.id_producto= '$id_usuario' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT v.*,u.id_usuario id_usuario
						FROM venta v
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
					order by v.id_venta DESC
					$qrysize
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
	// ventas por producto
	public function getReporteVentasProductos($id,$id_producto=false)
	{
		if(! intval( $id )) return false;

		$queryprod = ($id_producto>0) ? " AND pt.id_producto=".$id_producto : '';

		
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT pv.*,v.id_tienda,u.id_usuario id_usuario,p.codinter,v.tipo,v.icredito,v.folio,v.comentarios,v.fecha
						FROM productos_venta pv
						LEFT JOIN venta v ON pv.id_venta=v.id_venta
						LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda
						LEFT JOIN producto p ON p.id_producto=pt.id_producto
						LEFT JOIN usuario u ON u.id=v.id_user
				where  pv.id_venta=$id
				$queryprod
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
	// ventas por producto
	public function getReportesActInv($arrayfilters=false)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto= (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario = ($id_usuario)  ? " AND hi.id_user      = '$id_usuario' " : "";
		$qrytienda  = ($id_tienda>0) ? " AND pt.tienda_id_tienda    = '$id_tienda'  " : "";
		$queryprod  = ($id_producto>0) ? " AND pt.id_producto= ".$id_producto  : '';
		
		
		$sql = "SELECT hi.id_historialinventario,hi.id_productotienda,hi.existencia_anterior,hi.existencia,hi.id_usuario,hi.fecha_registro,
					pt.id_producto,pr.id_tienda,p.nombre,p.codinter,pr.nombre_corto,m.nombre marca,t.nombre tienda
				FROM  historial_inventario hi
				LEFT JOIN producto_tienda pt ON hi.id_productotienda=pt.id_productotienda
				LEFT JOIN producto p ON pt.id_producto=p.id_producto
				LEFT JOIN marca m ON p.id_marca=m.id_marca
				LEFT JOIN proveedor pr ON pr.id_proveedor=p.id_proveedor
				LEFT JOIN tienda t ON t.id_tienda=pt.tienda_id_tienda
				where  
					DATE(hi.fecha_registro)>='".$fechaini."' and DATE(hi.fecha_registro)<='".$fechafin."'
					$qryusuario
					$qrytienda
					$queryprod
				GROUP BY hi.fecha_registro
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReportesActInv"); }
		else{
			while ($row = $res->fetch_object())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}

	// reporte de ventas por hora
	public function getReporteVentaHora($arrayfilters=false)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto= (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario = ($id_usuario)  ? " AND v.id_user      = '$id_usuario' " : "";
		$qrytienda  = ($id_tienda>0) ? " AND v.id_tienda    = '$id_tienda'  " : "";
		$queryprod  = ($id_producto>0) ? " AND pt.id_producto= ".$id_producto  : '';
		
		
		$sql = "SELECT view_fecha.hora
					,ifnull(view_venta.total_global,0) total_global
					,ifnull(view_recargas.total_recargas,0) total_recargas
					,ifnull(view_mayoreo.total_mayoreo,0) total_mayoreo
				FROM(
					SELECT SUM(pv.total) total_global,
					HOUR(v.fecha) hora
					FROM productos_venta pv 
					LEFT JOIN venta v ON pv.id_venta=v.id_venta 
					LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda 
					LEFT JOIN producto p ON p.id_producto=pt.id_producto 
					LEFT JOIN usuario u ON u.id=v.id_user 
					WHERE DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
						$qryusuario
						$qrytienda
						$queryprod
						and pv.cancelado=0
					GROUP BY HOUR(v.fecha)
				) view_fecha 
				LEFT JOIN (
				SELECT SUM(pv.total) total_global,
					HOUR(v.fecha) hora
					FROM productos_venta pv 
					LEFT JOIN venta v ON pv.id_venta=v.id_venta 
					LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda 
					LEFT JOIN producto p ON p.id_producto=pt.id_producto 
					LEFT JOIN usuario u ON u.id=v.id_user 
					WHERE DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
						$qryusuario
						$qrytienda
						$queryprod
						and pv.cancelado=0
						and pt.id_producto!=1328
						and pv.tipoprecio='Normal'
					GROUP BY HOUR(v.fecha)
					)view_venta ON view_fecha.hora=view_venta.hora
					LEFT JOIN (
					SELECT SUM(pv.total) total_mayoreo,
						HOUR(v.fecha) hora
						FROM productos_venta pv 
						LEFT JOIN venta v ON pv.id_venta=v.id_venta 
						LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda 
						LEFT JOIN producto p ON p.id_producto=pt.id_producto 
						LEFT JOIN usuario u ON u.id=v.id_user 
						WHERE DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
							$qryusuario
							$qrytienda
							$queryprod
							and pv.cancelado=0
							and pt.id_producto!=1328
							and pv.tipoprecio='Mayoreo'
						GROUP BY HOUR(v.fecha)
					)view_mayoreo ON view_fecha.hora=view_mayoreo.hora
				LEFT JOIN(
					SELECT SUM(pv.total) total_recargas,
					HOUR(v.fecha) hora 
					FROM productos_venta pv 
					LEFT JOIN venta v ON pv.id_venta=v.id_venta 
					LEFT JOIN producto_tienda pt ON pt.id_productotienda=pv.id_productotienda 
					LEFT JOIN producto p ON p.id_producto=pt.id_producto 
					LEFT JOIN usuario u ON u.id=v.id_user 
					WHERE DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
						$qryusuario
						$qrytienda
						$queryprod
						and pv.cancelado=0
						and pt.id_producto=1328
					GROUP BY HOUR(v.fecha)
				) view_recargas ON view_fecha.hora = view_recargas.hora

				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReportesActInv"); }
		else{
			while ($row = $res->fetch_object())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	

}

?>