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
		
		$qryusuario  = ($id_usuario)    ? " AND v.id_user    = '$id_usuario' " : "";
		$qrytienda   = ($id_tienda>0)   ? " AND v.id_tienda  = '$id_tienda' "   : "";
		$id_producto = ($id_producto>0) ? " AND v.id_producto= '$id_usuario' " : "";
		$qryfechaini = ($fechaini>0)    ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin = ($fechafin>0)    ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT v.*,u.id_usuario id_usuario
						FROM venta v
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					v.id_venta>0
					$qryfechaini
					$qryfechafin 
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
	public function getReporteTraspasosEntrada($arrayfilters)
	{
		$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario  = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto = (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		$size	     = (isset($arrayfilters['size']))          ? $arrayfilters['size']          : '';
		
		$qryusuario  = ($id_usuario)    ? " AND v.id_user     = '$id_usuario' "   : "";
		$qrytienda   = ($id_tienda>0)   ? " AND v.id_tienda   = '$id_tienda' "    : "";
		$qryproducto = ($id_producto>0) ? " AND ep.id_producto = '$id_producto' "   : "";
		$qryfechaini = ($fechaini>0)    ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin = ($fechafin>0)    ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT ep.*,u.id_usuario id_usuario, v.fecha_validacion fecha_validacion, tio.nombre origen
						FROM traspaso_producto ep 
						LEFT JOIN traspaso v ON ep.id_traspaso=v.id_traspaso
						LEFT JOIN tienda tio ON tio.id_tienda=v.id_tienda
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					v.id_traspaso>0
					$qryfechaini
					$qryfechafin 
					$qryusuario
					$qryproducto
					$qrytienda
					order by v.id_traspaso DESC
					$qrysize
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteTraspasosEntrada"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteTraspasosSalida($arrayfilters)
	{
		$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario  = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto = (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		$size	     = (isset($arrayfilters['size']))          ? $arrayfilters['size']          : '';
		
		$qryusuario  = ($id_usuario)    ? " AND v.id_user     = '$id_usuario' "   : "";
		$qrytienda   = ($id_tienda>0)   ? " AND v.id_tiendaanterior   = '$id_tienda' "    : "";
		$qryproducto = ($id_producto>0) ? " AND ep.id_producto = '$id_producto' "   : "";
		$qryfechaini = ($fechaini>0)    ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin = ($fechafin>0)    ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT ep.*,u.id_usuario id_usuario, v.fecha_validacion fecha_validacion, tio.nombre destino
						FROM traspaso_producto ep 
						LEFT JOIN traspaso v ON ep.id_traspaso=v.id_traspaso
						LEFT JOIN tienda tio ON tio.id_tienda=v.id_tienda
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					v.id_traspaso>0
					$qryfechaini
					$qryfechafin 
					$qryusuario
					$qryproducto
					$qrytienda
					order by v.id_traspaso DESC
					$qrysize
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteTraspasosSalida"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteEntradas($arrayfilters)
	{
		$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario  = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto = (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		$size	     = (isset($arrayfilters['size']))          ? $arrayfilters['size']          : '';
		
		$qryusuario  = ($id_usuario)    ? " AND v.id_user     = '$id_usuario' "   : "";
		$qrytienda   = ($id_tienda>0)   ? " AND v.id_tienda   = '$id_tienda' "    : "";
		$qryproducto = ($id_producto>0) ? " AND ep.id_producto = '$id_producto' "   : "";
		$qryfechaini = ($fechaini>0)    ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin = ($fechafin>0)    ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT ep.*,u.id_usuario id_usuario, v.fecha_validacion fecha_validacion, v.concepto concepto
						FROM entrada_producto ep 
						LEFT JOIN entrada v ON ep.id_entrada=v.id_entrada
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					v.id_entrada>0
					$qryfechaini
					$qryfechafin 
					$qryusuario
					$qrytienda
					$qryproducto
					order by v.id_entrada DESC
					$qrysize
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteEntradas"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getReporteSalidas($arrayfilters)
	{
		$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario  = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_producto = (isset($arrayfilters['id_producto']))   ? $arrayfilters['id_producto']   : '';
		$size	     = (isset($arrayfilters['size']))          ? $arrayfilters['size']          : '';
		
		$qryusuario  = ($id_usuario)    ? " AND v.id_user     = '$id_usuario' "   : "";
		$qrytienda   = ($id_tienda>0)   ? " AND ep.id_tienda   = '$id_tienda' "    : "";
		$qryproducto = ($id_producto>0) ? " AND ep.id_producto = '$id_producto' "   : "";
		$qryfechaini = ($fechaini>0)    ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin = ($fechafin>0)    ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
		$qrysize 	 = ($size>0)		? " LIMIT $size " : "";
		$sql = "SELECT ep.*,u.id_usuario id_usuario, v.fecha_validacion fecha_validacion
						FROM salida_producto ep 
						LEFT JOIN salida v ON ep.id_salida=v.id_salida
						LEFT JOIN usuario u ON u.id=v.id_user
				where  
					v.id_salida>0
					$qryfechaini
					$qryfechafin 
					$qryusuario
					$qrytienda
					$qryproducto
					order by v.id_salida DESC
					$qrysize
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteEntradas"); }
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
							usuarios_venta.id_user ,usuarios_venta.id_usuario id_usuario,usuarios_venta.comision,usuarios_venta.id_usuario_tipo,
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
	public function getReportePagos($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		$id_venta   = (isset($arrayfilters['id_venta']))      ? $arrayfilters['id_venta']     : '';
		$id_persona = (isset($arrayfilters['id_persona']))    ? $arrayfilters['id_persona']     : '';
		
		$qryusuario     = ($id_usuario)  ? " AND d.id_user = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND v.id_tienda  = '$id_tienda'  " : "";
		$qryfechaini    = ($fechaini>0)  ? " AND DATE(d.fecha_abono)>='".$fechaini."' " : "";
		$qryfechafin    = ($fechafin>0)  ? " AND DATE(d.fecha_abono)<='".$fechafin."' " : "";
		$qryventa       = ($id_venta>0)  ? " AND d.id_venta='".$id_venta."' " : "";
		$qrypersona    = ($id_persona>0) ? " AND v.id_persona='".$id_persona."' " : "";
		$sql = "SELECT d.*, v.id_persona,v.id_tienda,v.descuento,v.total,v.cancelado,v.folio,v.icredito,v.tipo 
				FROM  deudores d
				LEFT JOIN venta v ON d.id_venta=v.id_venta
				where  d.id_deudores>0
					$qryfechaini
					$qryfechafin 
					$qryusuario
					$qrytienda
					$qryventa
					$qrypersona
				";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result  getReportePagos"); }
		else{
			while ($row = $res->fetch_object())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	public function getCajaAnterior($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  =  $_SESSION['user_info']['id_tienda'];
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario     = ($id_usuario)  ? " AND d.id_user = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND d.id_tienda  = '$id_tienda'  " : "";
	 	$sql = "SELECT ifnull(d.total_cajanew,0) as total, d.id_user id_usuario , d.id_tienda
			FROM  corte d
			where  
				DATE(d.fecha)>='".$fechaini."' and DATE(d.fecha)<='".$fechafin."'
				AND d.status='active'
				$qrytienda
				order by id desc
			limit 1
			";
		$res=$this->db->query($sql);
		
		if(!$res)
			{die("Error getting result getCajaAnterior");}
		$row = $res->fetch_assoc();
		if(!($row)){

			$sql = "SELECT ifnull(d.total_cajanew,0) as total, d.id_user id_usuario , d.id_tienda
				FROM  corte d
				where  
					DATE(d.fecha)<='".$fechafin."'
					AND d.status='active'
					$qrytienda
					order by id desc	
				limit 1
				";
			$res=$this->db->query($sql);
			
			if(!$res)
				{die("Error getting result getCajaAnterior");}
			$row = $res->fetch_assoc();
		}
		$res->close();
		return $row['total'];
	}
	// para sacar todos los cortes de venta
	public function getReporteCortes($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']    : ''; 
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario     = ($id_usuario)  ? " AND d.id_user = '$id_usuario' " : "";
		$qrytienda      = ($id_tienda>0) ? " AND d.id_tienda  = '$id_tienda'  " : "";
	 	$sql = "SELECT d.*, u.id_usuario,t.nombre tienda
			FROM  corte d 
				LEFT JOIN usuario u on d.id_user=u.id  
				LEFT JOIN tienda t on t.id_tienda=u.id_tienda
			where  
				DATE(d.fecha)>='".$fechaini."' and DATE(d.fecha)<='".$fechafin."'
				AND d.status='active'
				$qrytienda
				$qryusuario
				order by id desc
			
			";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteCortes "); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	// para sacar todos los cortes de venta
	public function getReporteCortesConceptos($id,$tipo)
	{
		
		$tipo   = (isset($tipo)) ? $tipo : '';
		$qrytipo     = ($tipo)  ? " AND cc.tipo = '$tipo' " : "";
	 	$sql = "SELECT *
			FROM  corte_conceptos cc
				LEFT JOIN corte c on cc.corte_id=c.id
			where  
				cc.corte_id = $id
				$qrytipo
				order by cc.id asc
			";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteCortesConceptos "); }
		else{
			while ($row = $res->fetch_assoc())
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
		$sql = "SELECT pv.*,v.id_tienda,u.id_usuario id_usuario,p.codinter,v.tipo,v.icredito,v.folio,v.comentarios,v.fecha,v.fecha_cancelacion,v.usuario_cancelacion,v.razon_cancelacion,v.comentarios
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
		
		
		$qryfechaini    = ($fechaini>0)  ? " AND DATE(v.fecha)>='".$fechaini."' " : "";
		$qryfechafin    = ($fechafin>0)  ? " AND DATE(v.fecha)<='".$fechafin."' " : "";
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
					WHERE v.id_venta>0
						$qryfechaini
						$qryfechafin
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
	
	//reporte para realizar el comparativo de inventario de las tiendas
	public function getReporteComparativoInventario($arrayfilters=false){
		$id_categoria = (isset($arrayfilters['id_categoria']))? $arrayfilters['id_categoria']  : '';
		$id_marca     = (isset($arrayfilters['id_marca']))    ? $arrayfilters['id_marca']      : '';
		$todo         = (isset($arrayfilters['todo']))        ? $arrayfilters['todo']          : '';
		$id_tienda    = (isset($arrayfilters['id_tienda']))   ? $arrayfilters['id_tienda']     : '';
		
		$querycategoria = ($id_categoria)  ? " AND p.id_categoria =".$id_categoria : "";
		$querymarca     = ($id_marca)  ? " AND p.id_categoria =".$id_marca : "";
		$querytodo      = " HAVING TIENDA.existencias>0 ";
		$queryprod = $querylimit= '';
		
		$prov = $id_tienda;
		$querytienda='';
		if($id_tienda == 15) 
			$prov=13;

		if(!$id_tienda)
			$querytienda= ($_SESSION['user_info']['id_tienda']==16) ? " AND (p.id_proveedor=14)" : " AND (p.id_proveedor!=14)";

	
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
						$queryprod
						$querycategoria
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
						WHERE tienda_id_tienda='$id_tienda'
						group by id_producto,tienda_id_tienda
					)EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
					
					group by 
					PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
					PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
					,PRODUCTO.costo,PRODUCTO.precio,PRODUCTO.precio_descuento
			) TIENDA ON TODO.id_producto=TIENDA.id_producto
			
			$querytodo
			";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getReporteComparativoInventario"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}

}

?>