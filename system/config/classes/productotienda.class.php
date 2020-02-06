<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."producto_tienda.auto.class.php");

class ProductoTienda extends AutoProductoTienda { 
	private $DB_TABLE = "producto_tienda";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM producto_tienda where status='active';";
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
		$sql= "SELECT * FROM producto_tienda WHERE id_productotienda=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto_tienda");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'producto_tienda',$this->db,"add");
		$sql= "INSERT INTO producto_tienda (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'producto_tienda',$this->db,"update");
		$sql= "UPDATE producto_tienda SET $data[0]  WHERE id_productotienda=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para hacer update  del inventario inicial
	public function updateInventarioInicial($id,$id_tienda)
	{
		$_request["inv_ini"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'producto_tienda',$this->db,"update");
		$sql= "UPDATE producto_tienda SET $data[0]  WHERE id_producto=".$id." and tienda_id_tienda =".$id_tienda.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para hacer update al kardex de cada tienda
	public function updateKardex($id,$id_tienda,$kardex)
	{
		$_request["kardex"]=$kardex;
		$data=fromArray($_request,'producto_tienda',$this->db,"update");
		$sql= "UPDATE producto_tienda SET $data[0]  WHERE id_producto=".$id." and tienda_id_tienda =".$id_tienda.";";
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
		$data=fromArray($_request,'producto_tienda',$this->db,"update");	
		$sql= "UPDATE producto_tienda SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para hacer obtener datos en el editar
	public function getTablebyProducto($id_producto,$id_tienda)
	{
		if(! intval( $id_producto )) return false;
		if(! intval( $id_tienda ))   return false;
	
		$sql= "SELECT pt.*,p.nombre,p.precio,p.costo,p.precio_descuento 
				FROM producto_tienda pt 
				LEFT JOIN producto p ON pt.id_producto=pt.id_producto
					WHERE pt.id_producto=$id_producto 
					AND pt.tienda_id_tienda=$id_tienda 
				limit 1;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto tienda");}
		$row = $res->fetch_assoc();
		$res->close();
		if(!$row){
			//si no existe la relacion la creamos
			$_request['id_producto'] = $id_producto;
			$_request['tienda_id_tienda']   = $id_tienda;
			$res=$this->addAll($_request);
			if($res){
				$this->getTablebyProducto($id_producto,$id_tienda);
			}
		}
		return $row;

	}
	public function actualizaexistencia($id,$cantidad,$tipo){
		if(! intval( $id )) return false;
		if($tipo=='increment'){
			$sql= "UPDATE producto_tienda SET existencias=existencias+".$cantidad."  WHERE id_productotienda=".$id.";";
			$row=$this->db->query($sql);
			return (!$row) ?  false : true;
		}
		if($tipo=='decrement'){
			$sql= "UPDATE producto_tienda SET existencias=existencias-".$cantidad."  WHERE id_productotienda=".$id.";";
			$row=$this->db->query($sql);
			return (!$row) ?  false : true;
		}
		if($tipo=='general'){
			$sql= "UPDATE producto_tienda SET existencias=".$cantidad."  WHERE id_productotienda=".$id.";";
			$row=$this->db->query($sql);
			return (!$row) ?  false : true;
		}
		
			
	}

}
