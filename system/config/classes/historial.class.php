<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."historial.auto.class.php");

class Historial extends AutoHistorial { 
	private $DB_TABLE = "historial";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($arrayfilters=false)
	{
			$fechaini    = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
			$fechafin    = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
			$id_user     = (isset($arrayfilters['id_user']))   	   ? $arrayfilters['id_user']       : '';
			$id_persona  = (isset($arrayfilters['id_persona']))    ? $arrayfilters['id_persona']    : '';
			$id_tienda   = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
			$status      = (isset($arrayfilters['status']))   	   ? $arrayfilters['status']        : '';
			if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
				return false;
			}
			$qrypersonal = ($id_user)   ? " AND h.id_user='$id_user' " : "";
			$qrypersona  = ($id_persona>0) ? " AND h.id_persona='$id_persona' " : "";
			$qrystatus   = ($status) 		? " AND h.status='$status' " 		   : "";
			$qrytienda   = ($id_tienda) 	? " AND h.id_tienda='$id_tienda' " 	   : "";
		
		$sql = "SELECT h.id,h.folio,h.total,h.total_deuda,h.created_date,
					concat(p.nombre,p.apellido_pat,p.apellido_mat) persona,
					concat(pl.nombre) medico,
					c.nombre tienda,h.status 
				FROM historial h
				LEFT JOIN persona p  ON h.id_persona = p.id
				LEFT JOIN usuario pl ON h.id_user = pl.id
				LEFT JOIN tienda  c  ON h.id_tienda  = c.id
				LEFT JOIN cita    ct  ON h.id_cita     = ct.id
					where h.status!='deleted'
					$qrypersonal
					$qrypersona
					$qrystatus
					$qrytienda;";
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
		$sql= "SELECT * FROM historial WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_tienda'] = $_SESSION['user_info']['id_tienda'];
		$_request['id_user']    = $_SESSION['user_id'];
		$_request['folio']      = $this->getNewFolio($_request['id_tienda']);
		$_request['id_persona'] = $_request['id_persona'];
		$data=fromArray($_request,'historial',$this->db,"add");
		$sql= "INSERT INTO historial (".$data[0].") VALUES(".$data[1]."); ";
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
		$id = $id["LAST_INSERT_ID()"];
		if(!$id)  die('no se guardo historial');
		
		
		//TRATAMIENTO
		$id_tratamiento		  = (isset($_request["id_tratamiento"])) 	   ? $_request["id_tratamiento"]       : '';
		$cantidad     		  = (isset($_request["cantidad"])) 			   ? $_request["cantidad"]             : '';
		$detalles_tratamiento = (isset($_request["detalles_tratamiento"])) ? $_request["detalles_tratamiento"] : '';
		$precio_tratamiento   = (isset($_request["precio_tratamiento"]))   ? $_request["precio_tratamiento"]   : '';
		$total_tratamiento    = (isset($_request["total_tratamiento"]))    ? $_request["total_tratamiento"]    : '';
		$fecha_recomendada    = (isset($_request["fecha_recomendada"]))    ? $_request["fecha_recomendada"]    : '';
		$fecha_realizado      = (isset($_request["fecha_realizado"]))      ? $_request["fecha_realizado"]      : '';
		$status_tratamiento   = (isset($_request["status_tratamiento"]))   ? $_request["status_tratamiento"]   : '';
		if($id_tratamiento){
			foreach ($id_tratamiento as $key => $value) {
				if(!$value) continue;
				$_requesttrat['id_historial']   = $id;
				$_requesttrat['id_tratamiento'] = (intval($value))          ? $value          : die('error en tratamiento');
				$_requesttrat['cantidad']    	= (intval($cantidad[$key])) ? $cantidad[$key] : 1;
				$_requesttrat['detalles'] 	 	= $detalles_tratamiento[$key];
				$_requesttrat['precio']		 	= $precio_tratamiento[$key];
				$_requesttrat['total'] 	 	 	= $total_tratamiento[$key];
				$_requesttrat['status'] 	 	= $status_tratamiento[$key];
				$_requesttrat['seguimiento'] 	= false;
				$_requesttrat['fecha_realizado']= ($status_tratamiento[$key] !='active') ? $_requesttrat['fecha_realizado'] : NULL;
				if($fecha_recomendada[$key])
					$_requesttrat['fecha_recomendada'] 	= validar_fecha($fecha_recomendada[$key]) ? $fecha_recomendada[$key] : '';
				if($fecha_realizado[$key])
					$_requesttrat['fecha_realizado'] 	= validar_fecha($fecha_realizado[$key]) ? $fecha_realizado[$key] : '';
	
				$HT = new HistorialTratamiento();
				$idHT = $HT->addAll($_requesttrat);
				if($idHT>0){}else{ die("Error al insertar HistorialTratamiento"); }
				//add next date
				$proxima_cita = (isset($_requesttrat['fecha_recomendada'])) ? $_requesttrat["fecha_recomendada"] : '';
				if($proxima_cita){
					$objtratamiento  = new Tratamiento();
					$datatratamiento = $objtratamiento->getTable($_requesttrat['id_tratamiento']);
					$fechafinal = strtotime ( '+1 hour' , strtotime ( $proxima_cita ) ) ;
					$fechafinal = date('Y-m-d H:i',$fechafinal);
					$_requestcita2['fecha_inicial'] = $proxima_cita;
					$_requestcita2['motivo'] 	    = $datatratamiento['nombre'];
					$_requestcita2['id_personal']   = $_request['id_personal'];
					$_requestcita2['fecha_final']   = $fechafinal;
					$_requestcita2['id_persona']   = $_request['id_persona'];
					$_requestcita2['id_historialtratamiento']   = $idHT;
					$citas = new Cita();
					$idcita = $citas->addAll($_requestcita2);
					( $idcita > 0 ) ? '' : die("Error al crear cita proxima");
				}
			}
		}
		
		//PAGOS DE CONSULTA
		if($_request["monto"]>0){
			$_requestHP['id_historial']       = $id;
			$_requestHP['deuda']   			  = $_request["total_deuda"];
			$_requestHP['monto']   			  = $_request["monto"];
			$_requestHP['descuento_aplicado'] = $_request["descuento_aplicado"];
			$_requestHP['tipo_pago'] 	 	  = $_request["tipo_pago"];
			$_requestHP['observaciones']  	  = $_request["observaciones"];
			$_requestHP['fecha_pago']  	      = $_request["fecha_pago"];
			$idHP = $this->savenewpago($_requestHP);
		}
		$this->updateStatusHistorial($id);
		if($_request['id_cita']>0){
			$_requestcita['status'] = 'Completada';
			$citas = new Cita();
			$idcita = $citas->updateAll($_request['id_cita'],$_requestcita);
		}
		
		$_requestpersona['id_historial'] = $id;
		$personas = new Persona();
		$datapersonas = $personas->getTable($_request['id_persona']);
		if(!$datapersonas['id_historial']) // si no tiene historial el persona se agrega uno
			$idpersona = $personas->updateAll($_request['id_persona'],$_requestpersona); 

		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'historial',$this->db,"update");
		$sql= "UPDATE historial SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			
			
			//DIAGNOSTICO
			$objpr = new HistorialDiagnostico();
			$resp  = $objpr->deleteAllbyHistorial($id);
			if(!$resp) die("Error deleting HistorialDiagnostico");  

			//DIAGNOSTICO
			$diagnosticos    = (isset($_request["referencias"]))          ? $_request["referencias"]          : '';
			$detalles        = (isset($_request["detalles_diagnostico"])) ? $_request["detalles_diagnostico"] : '';
			$referenciasjson = (isset($_request["referencias_json"]))     ? $_request["referencias_json"]     : '';
			$dientes         = (isset($_request["diente"]))               ? $_request["diente"]               : '';
			if($diagnosticos){
				foreach ($diagnosticos as $key => $value) {
					if(!$value) continue;
					$_requestD['id_historial']  = $id;
					$_requestD['referencias']   = $value;
					$_requestD['diente']        = $dientes[$key];
					$_requestD['detalles'] 	    = $detalles[$key];
					$_requestD['referencias_json'] = $referenciasjson[$key];
					$HD = new HistorialDiagnostico();
					$idHD = $HD->addAll($_requestD);
					if($idHD>0){}else{ die("Error al insertar historial diagnostico"); }
				}
			}
			//TRATAMIENTO
			$objpr = new HistorialTratamiento();
			$resp  = $objpr->deleteAllbyHistorial($id);
			if(!$resp) die("Error deleting HistorialTratamiento");  
			
			$id_tratamiento		  = (isset($_request["id_tratamiento"])) 	   ? $_request["id_tratamiento"]       : '';
			$cantidad     		  = (isset($_request["cantidad"])) 			   ? $_request["cantidad"]             : '';
			$detalles_tratamiento = (isset($_request["detalles_tratamiento"])) ? $_request["detalles_tratamiento"] : '';
			$precio_tratamiento   = (isset($_request["precio_tratamiento"]))   ? $_request["precio_tratamiento"]   : '';
			$total_tratamiento    = (isset($_request["total_tratamiento"]))    ? $_request["total_tratamiento"]    : '';
			$fecha_recomendada    = (isset($_request["fecha_recomendada"]))    ? $_request["fecha_recomendada"]    : '';
			$fecha_realizado      = (isset($_request["fecha_realizado"]))      ? $_request["fecha_realizado"]      : '';
			$status_tratamiento   = (isset($_request["status_tratamiento"]))   ? $_request["status_tratamiento"]   : '';
			if($id_tratamiento){
				foreach ($id_tratamiento as $key => $value) {
					if(!$value) continue;
					$_requesttrat['id_historial']   = $id;
					$_requesttrat['id_tratamiento'] = (intval($value))          ? $value          : die('error en tratamiento');
					$_requesttrat['cantidad']    	= (intval($cantidad[$key])) ? $cantidad[$key] : 1;
					$_requesttrat['detalles'] 	 	= $detalles_tratamiento[$key];
					$_requesttrat['precio']		 	= $precio_tratamiento[$key];
					$_requesttrat['total'] 	 	 	= $total_tratamiento[$key];
					$_requesttrat['status'] 	 	= $status_tratamiento[$key];
					$_requesttrat['seguimiento'] 	= $seguimiento[$key];
					$_requesttrat['fecha_realizado']= ($status_tratamiento[$key] !='active') ? $_requesttrat['fecha_realizado'] : NULL;
					if($fecha_recomendada[$key])
						$_requesttrat['fecha_recomendada'] 	= validar_fecha($fecha_recomendada[$key]) ? $fecha_recomendada[$key] : '';
					if($fecha_realizado[$key])
						$_requesttrat['fecha_realizado'] 	= validar_fecha($fecha_realizado[$key]) ? $fecha_realizado[$key] : '';

					$HT = new HistorialTratamiento();
					$idHT = $HT->addAll($_requesttrat);
					if($idHT>0){}else{ die("Error al insertar HistorialTratamiento"); }
				}
			}
			//PAGOS DE CONSULTA
			if($_request["monto"]>0){
				$_requestHP['id_historial']       = $id;
				$_requestHP['deuda']   			  = $_request["total_deuda"];
				$_requestHP['monto']   			  = $_request["monto"];
				$_requestHP['descuento_aplicado'] = $_request["descuento_aplicado"];
				$_requestHP['tipo_pago'] 	 	  = $_request["tipo_pago"];
				$_requestHP['observaciones']  	  = $_request["observaciones"];
				$_requestHP['fecha_pago']  	      = $_request["fecha_pago"];
				$idHP = $this->savenewpago($_requestHP);
			}
			$this->updateStatusHistorial($id);
			
			$_requestcita['status'] = 'Completada';
			$citas = new Cita();
			$idcita = $citas->updateAll($_request['id_cita'],$_requestcita);
			return $id;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$_request['user_delete'] = $_SESSION['user_id'];
		$data=fromArray($_request,'historial',$this->db,"update");	
		$sql= "UPDATE historial SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para hacer obtener datos en el editar
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id),0)+1) folio FROM historial WHERE id_tienda=$id order by id desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	public function getStatusCompleted($id)
	{
		if(! intval( $id )) return false;
		
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT count(*) total 
				FROM historial_tratamiento ht
				LEFT JOIN tratamiento t ON t.id=ht.id_tratamiento
				 WHERE ht.status='active' 
				 	AND ht.id_historial=$id 
					AND t.producto=0 
				 order by ht.id desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return  ($row['total']>0) ? 'En Proceso' : 'Completada';

	}
	public function savenewpago($_request){
		$id = $_request['id_historial'];
		if(! intval( $id )) return false;

		$deuda = $_request['deuda'];
		$monto = (isset($_request["monto"]) && ($_request["monto"])>0) ? $_request["monto"] : 0;
		$status = $this->getStatusCompleted($id);
		$sql= "UPDATE historial SET total_deuda=total_deuda-".$monto.",updated_date='".date("Y-m-d H:i:s")."' WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			//PAGOS DE CONSULTA
			$_requestHP['id_historial']       = $id;
			$_requestHP['monto']   			  = (isset($_request["monto"])) ? $_request["monto"] : 0;
			$_requestHP['nombre']         	  = "Pago";
			$_requestHP['tipo_pago'] 	 	  = $_request["tipo_pago"];
			$_requestHP['descuento_aplicado'] = (isset($_request["descuento_aplicado"])) ? $_request["descuento_aplicado"] : 0;
			$_requestHP['observaciones']  	  = $_request["observaciones"];
			$_requestHP['fecha_pago']  	      = $_request["fecha_pago"]." ".date("H:i:s");
			$HP = new HistorialPagos();
			$idHP = $HP->addAll($_requestHP);
			if($idHP>0){}else{ die("Error al insertar HistorialPagos"); }
			return $id;
		}
	}
	public function updateStatusHistorial($id){
		if(! intval( $id )) return false;
		$status = $this->getStatusCompleted($id);
		$sql= "UPDATE historial SET updated_date='".date("Y-m-d H:i:s")."',status='".$status."'  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	public function getTableFilter($filter=false)
	{
		$addquery =(count($filter)>0) ? $filter[0]."=".$filter[1] : die('no filtros');
		
		$sql= "SELECT * FROM historial WHERE ".$addquery;
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial filtros");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
}
