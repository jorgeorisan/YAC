<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR."base". DIRECTORY_SEPARATOR. "permiso_usertype.auto.class.php");

class PermisoUsertype extends AutoPermisoUsertype { 
	private $DB_TABLE = "permiso_usertype";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){ return false;	}
		$id  = $this->db->real_escape_string($id);
		$sql = "SELECT * FROM permiso_usertype where id_usertype=$id ;";
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
		$sql= "SELECT * FROM permiso_usertype WHERE id_usertype=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result permiso_usertype");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($idperm, $iduser)
	{
		if(! intval( $idperm ) || ! intval( $iduser )){
			return false;
		}
		$idperm=$this->db->real_escape_string($idperm);
		$iduser=$this->db->real_escape_string($iduser);
		$sql= "INSERT INTO permiso_usertype (id_permiso,id_usertype) VALUES(".$idperm.",".$iduser."); ";
		$res= $this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";
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
		$data=fromArray($_request,'permiso_usertype',$this->db,"update");
		$sql= "UPDATE permiso_usertype SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id)
	{
		if(! intval( $id )){ return false;	}
		$id  = $this->db->real_escape_string($id);
		$sql = "DELETE FROM permiso_usertype  WHERE id_usertype=".$id.";";
		$row = $this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	


}
