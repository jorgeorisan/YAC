<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR . "permiso_user.auto.class.php");

class PermisoUser extends AutoPermisoUser { 
	private $DB_TABLE = "permiso_user";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT * FROM permiso_user where id_user=$id ;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr".$sql); }
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
		$sql= "SELECT * FROM permiso_user WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result permiso_user");}
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
		$sql= "INSERT INTO permiso_user (id_permiso,id_user) VALUES(".$idperm.",".$iduser."); ";
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

		//metodo que sirve para hacer delete
	public function deleteAll($id)
	{
		if(! intval( $id )){ return false;	}
		$id  = $this->db->real_escape_string($id);
		$sql = "DELETE FROM permiso_user  WHERE id_user=".$id.";";
		$row = $this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	
		//metodo que sirve para obtener los permisos del usuario
	public function getpermisouser($id, $section, $page)
	{
		if(! intval( $id )){
			return false;
		}
		$id      = $this->db->real_escape_string($id);
		$section = $this->db->real_escape_string($section);
		$page    = $this->db->real_escape_string($page);
		$sql = "SELECT pu.id , p.section , p.page FROM permiso_user pu 
				INNER JOIN permiso p on p.id=pu.id_permiso
				WHERE pu.id_user=".$id."
				AND p.section='".$section."'
				AND p.page='".$page."';";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getpermisouser");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}
	//metodo que sirve para obtener las secciones que le correspnden al usuario
	public function getsectionsuser($id,$section)
	{
		if(! intval( $id )){
			return false;
		}
		$id      = $this->db->real_escape_string($id);
		$section = $this->db->real_escape_string($section);
		$sql = "SELECT pu.id , p.section , p.page FROM permiso_user pu 
				INNER JOIN permiso p on p.id=pu.id_permiso
				WHERE pu.id_user='".$id."'
				AND p.section='".$section."';";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getsectionsuser");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;
	}

}
