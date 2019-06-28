<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."deudores.auto.class.php");

class Deudores extends AutoDeudores { 
	private $DB_TABLE = "deudores";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM deudores where status='active';";
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
		$sql= "SELECT * FROM deudores WHERE id_deudores=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result deudores");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_user'] 	 =  $_SESSION['user_id'];
		$_request['fecha_abono'] = (isset($_request['fecha_abono'])) ? $_request['fecha_abono'] : date('Y-m-d H:m:i');
		$data=fromArray($_request,'deudores',$this->db,"add");
		$sql= "INSERT INTO deudores (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
				
			$objVenta = new Venta();
			$dataVenta = $objVenta->getTable($_request['id_venta']);
			if($dataVenta){
				if($dataVenta['icredito']==1){
					$totalpagado   = $objVenta->getpagado($_request['id_venta']);
					$totalporpagar = $dataVenta['total']-$totalpagado;
					if($totalporpagar<=0){
						$_requestVenta['icredito'] 	=  0;
						$idvta=$objVenta->updateAll($_request['id_venta'],$_requestVenta);
					}
				}
			}
		}
		return $id["LAST_INSERT_ID()"];
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'deudores',$this->db,"update");
		$sql= "UPDATE deudores SET $data[0]  WHERE id=".$id.";";
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
		$_request["status"]="BAJA";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'deudores',$this->db,"update");	
		$sql= "UPDATE deudores SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}


}
