<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."permiso_usuariotipo.auto.class.php");


class PermisoUsuariotipo extends AutoPermisoUsuariotipo { 
	private $DB_TABLE = "permiso_usuariotipo";

	
	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id )){
			return false;
		}
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT * FROM permiso_usuariotipo where id_usuario_tipo=$id ;";
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
		$sql= "SELECT * FROM permiso_usuariotipo WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result permiso_usuariotipo");}
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
		$sql= "INSERT INTO permiso_usuariotipo (id_permiso,id_usuario_tipo) VALUES(".$idperm.",".$iduser."); ";
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
		$sql = "DELETE FROM permiso_usuariotipo  WHERE id_usuario_tipo=".$id.";";
		$row = $this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

	


}
