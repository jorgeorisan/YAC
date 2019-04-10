<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR. "clinica.auto.class.php");

class Clinica extends AutoClinica { 
	private $DB_TABLE = "clinica";
	   	//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM ".$this->DB_TABLE." where status='active'";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die('Error getting result'); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;
	}
	   //metodo que sirve para hacer obtener datos en el editar
	public function getTable($id)
	{
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * FROM $this->DB_TABLE WHERE id='".$id."';";
		$res=$this->db->query($sql);
		if(!$res)
			{die('Error getting result');}
		   //echo $sql;
		$row = $res->fetch_assoc();
		$res->close();

		   //echo $this->db->error;

		return $row;

	}
	   //metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
	
		$data=fromArray($_request,$this->DB_TABLE,$this->db,"add");
		$sql= "INSERT INTO $this->DB_TABLE (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";   //. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res)
			{die('Error getting result');}
		else
		{
			while ($row = $res->fetch_assoc())
				$id= $row;
		}
		return $id["LAST_INSERT_ID()"];
		   //echo $this->db->error;
		   //$res->close();

	}
	   //metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request['updated_date']=date('Y-m-d H:i:s');
		$data=fromArray($_request,$this->DB_TABLE,$this->db,"update");
		
		$sql= "UPDATE $this->DB_TABLE SET $data[0]  WHERE id=".$id.";";
		
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
		$_request['status']="deleted";
		$_request['deleted_date']=date('Y-m-d H:i:s');
		$data=fromArray($_request,$this->DB_TABLE,$this->db,"update");
		
		$sql= "UPDATE $this->DB_TABLE SET $data[0]  WHERE id=".$id.";";
		
		$row=$this->db->query($sql);

		if(!$row){
			return false;
		}else{

			return true;
		}

	}

}
