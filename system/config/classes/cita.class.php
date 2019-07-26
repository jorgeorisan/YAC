<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."cita.auto.class.php");

class Cita extends AutoCita { 
	private $DB_TABLE = "cita";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($arrayfilters=false)
	{
		$fecha        = (isset($arrayfilters['fecha_inicial'])) ? " AND DATE(fecha_inicial)>='".$arrayfilters['fecha_inicial']."' and DATE(fecha_final)<='".$arrayfilters['fecha_inicial']." 23:59:00'" : '';
		$id_persona   = (isset($arrayfilters['id_persona']) && $arrayfilters['id_persona']>0) ? " AND id_persona='".$arrayfilters['id_persona']."'" : '';
		$status		  = (isset($arrayfilters['status']) ) ? " AND status='".$arrayfilters['status']."'" : '';
		$sql = "SELECT * FROM cita
				 where status!='deleted'
				 $fecha
				 $id_persona
				 $status ;";
		
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
		$sql= "SELECT c.*, CONCAT(p.nombre,' ',p.ap_paterno) persona
				FROM cita c
				LEFT JOIN persona p ON c.id_persona=p.id_persona
				WHERE c.id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result cita");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//
	public function getTableFilter($filter=false)
	{
		$addquery =(count($filter)>0) ? $filter[0]."=".$filter[1] : die('no filtros');
		
		$sql= "SELECT * FROM cita WHERE ".$addquery;
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result cita");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		
		$_request["id_tienda"] = $_SESSION['user_info']['id_tienda'];
		$_request["id_usuarioalta"] = $_SESSION['user_id'];
		$data=fromArray($_request,'cita',$this->db,"add");
		$sql= "INSERT INTO cita (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'cita',$this->db,"update");
		$sql= "UPDATE cita SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return $id;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'cita',$this->db,"update");	
		$sql= "UPDATE cita SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve sabir si ya existe una cita en fecha y hora
	public function getExisteCita($fechaini,$fechafin,$idpersonal)
	{
		$fechaini 	= validar_fecha($fechaini) ? $fechaini : '';
		$fechafin 	= validar_fecha($fechafin) ? $fechafin : '';
		if(! intval( $idpersonal ))	return false;
		$idpersonal=$this->db->real_escape_string($idpersonal);

		$sql= "SELECT *
				FROM cita 
				WHERE id_user=$idpersonal
				AND fecha_inicial>='".$fechaini."'
				AND fecha_final<='".$fechafin."'
				;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result cita");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}

}
