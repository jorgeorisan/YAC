<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR."base". DIRECTORY_SEPARATOR. "personal.auto.class.php");

class Personal extends AutoPersonal { 
	private $DB_TABLE = "personal";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($option=false)
	{
		
		$sql = "SELECT * FROM personal where status='active' and id_clinica=".$_SESSION['user_info']['id_clinica'];
		if( $option > 0 ){
			$sql .= " and id_personalpuesto=".$option;
		}
		$sql .= ";";
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
		$sql= "SELECT * FROM personal WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result personal");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["id_user"]=$_SESSION['user_id'];
		$_request["id_clinica"]=$_SESSION['user_info']['id_clinica'];
		$data=fromArray($_request,'personal',$this->db,"add");
		$sql= "INSERT INTO personal (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'personal',$this->db,"update");
		$sql= "UPDATE personal SET $data[0]  WHERE id=".$id.";";
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
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'personal',$this->db,"update");	
		$sql= "UPDATE personal SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}	
	//metodo que sirve para obtener todos servicios realizados por persona
	public function getAllServices($fechaini,$fechafin,$idpersonal)
	{
		$fechaini='2019-02-19';
		$fechafin='2019-02-29';
		if(	validar_fecha( $fechaini )!=3 || validar_fecha( $fechafin )!=3)
			die("Error fecha invalida GRAL=".$fechaini); 

		$sql = "
			SELECT hvs.id_personal,vs.id_vehiculo,hvs.id_vehiculoservicio,hvs.status,hvs.created_date
			,hvs.fecha_inicio,hvs.fecha_estimada,hvs.fecha_fin
			,p.nombre,p.apellido_pat,p.apellido_mat,
			vs.total,s.codigo,s.nombre servicio,v.matricula,m.nombre marca,sm.nombre submarca,v.modelo,
			p.cantidad,p.forma_pago
			FROM systemmy_clinicahp.historial_vehiculoservicio hvs
			LEFT JOIN personal p ON hvs.id_personal=p.id
			LEFT JOIN vehiculo_servicio vs ON hvs.id_vehiculoservicio=vs.id
			LEFT JOIN servicio s   ON vs.id_servicio=s.id
			LEFT JOIN vehiculo v   ON vs.id_vehiculo=v.id
			LEFT JOIN marca m      ON v.id_marca=m.id
			LEFT JOIN sub_marca sm ON v.id_marca=sm.id
			WHERE  v.status='active' and
			hvs.created_date>='".$fechaini."' and hvs.created_date<='".$fechafin."' and
			hvs.id_personal=".$idpersonal." and
			hvs.status in('Realizado') and 
			v.id_clinica=".$_SESSION['user_info']['id_clinica'].";";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
	//metodo que sirve para obtener todos servicios realizados Generales
	public function getAllServicesGral($fechaini,$fechafin)
	{
		$fechaini='2019-02-19';
		$fechafin='2019-02-29';
		if(	validar_fecha( $fechaini )!=3 || validar_fecha( $fechafin )!=3)
			die("Error fecha invalida GRAL=".$fechaini); 
	
		$sql = "
			SELECT hvs.id_personal,vs.id_vehiculo,hvs.status,DATE_FORMAT(hvs.created_date, '%Y-%m-%d') fecha
			,p.nombre,p.apellido_pat,p.apellido_mat, p.forma_pago,p.cantidad,
			v.matricula,m.nombre marca,sm.nombre submarca,v.modelo,sum(vs.total) total, 
			count(hvs.id_vehiculoservicio) cantidad_servicios
			FROM systemmy_clinicahp.historial_vehiculoservicio hvs
			LEFT JOIN personal p ON hvs.id_personal=p.id
			LEFT JOIN vehiculo_servicio vs ON hvs.id_vehiculoservicio=vs.id
			LEFT JOIN servicio s   ON vs.id_servicio=s.id
			LEFT JOIN vehiculo v   ON vs.id_vehiculo=v.id
			LEFT JOIN marca m      ON v.id_marca=m.id
			LEFT JOIN sub_marca sm ON v.id_marca=sm.id
			WHERE  v.status='active' and
			hvs.created_date>='".$fechaini."' and hvs.created_date<='".$fechafin."' and
			hvs.status in('Realizado') and
			v.id_clinica=".$_SESSION['user_info']['id_clinica']."
			GROUP BY hvs.id_personal,vs.id_vehiculo,hvs.status  ,p.nombre,p.apellido_pat,p.apellido_mat, p.forma_pago,p.cantidad,v.matricula
			,m.nombre ,sm.nombre ,v.modelo ;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}


}
