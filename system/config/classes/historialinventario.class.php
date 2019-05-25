<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."historial_inventario.auto.class.php");

class HistorialInventario extends AutoHistorialInventario { 
	private $DB_TABLE = "historial_inventario";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id)
	{
		if(! intval( $id ))	return false;
		
		$id=$this->db->real_escape_string($id);
		$sql= "SELECT hi.id_historialinventario,p.codinter,p.nombre,hi.existencia_anterior,hi.existencia,t.nombre tienda, u.id_usuario,hi.fecha_registro
				FROM historial_inventario hi
				LEFT JOIN producto_tienda pt ON pt.id_productotienda=hi.id_productotienda
				LEFT JOIN tienda t ON pt.tienda_id_tienda=t.id_tienda
				LEFT JOIN usuario u ON u.id=hi.id_user
				LEFT JOIN producto p ON pt.id_producto=p.id_producto
					WHERE hi.id_productotienda=$id;";
		$res=$this->db->query($sql);
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
		if(! intval( $id ))	return false;

		$id=$this->db->real_escape_string($id);
		$sql= "SELECT * FROM historial_inventario WHERE id_historialinventario=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result historial_inventario");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_user']    = $_SESSION['user_id'];
		$_request['id_usuario'] = $_SESSION['user_info']['id_usuario'];
		$data=fromArray($_request,'historial_inventario',$this->db,"add");
		$sql= "INSERT INTO historial_inventario (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'historial_inventario',$this->db,"update");
		$sql= "UPDATE historial_inventario SET $data[0]  WHERE id=".$id.";";
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
		$data=fromArray($_request,'historial_inventario',$this->db,"update");	
		$sql= "UPDATE historial_inventario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

}
