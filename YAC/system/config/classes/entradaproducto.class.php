<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."entrada_producto.auto.class.php");

class EntradaProducto extends AutoEntradaProducto { 
	private $DB_TABLE = "entrada_producto";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id,$deleted=false)
	{
		if(! intval( $id )) return false;
		
		$querydeleted = (!$deleted) ? " AND ep.status!='BAJA' " : '';
		$id=$this->db->real_escape_string($id);
		$sql = "SELECT ep.* , e.id_tienda,e.fecha_validacion
				FROM entrada_producto ep
				Inner join entrada e ON e.id_entrada=ep.id_entrada
				where ep.id_entrada=$id 
				$querydeleted;";
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result getAllArr "); }
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
		$sql= "SELECT * FROM entrada_producto WHERE id_entrada_producto=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result entrada_producto");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'entrada_producto',$this->db,"add");
		$sql= "INSERT INTO entrada_producto (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'entrada_producto',$this->db,"update");
		$sql= "UPDATE entrada_producto SET $data[0]  WHERE id_entrada_producto=".$id.";";
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
		$entradaproducto = $this->getTable($id);

		$objproductotienda = new ProductoTienda();
		$productotienda = $objproductotienda->getTablebyProducto($entradaproducto['id_producto'], $entradaproducto['id_tienda']);
		if ( ! $productotienda ) die('no se encontro productotienda');

		$objproductos = new Producto();
		$dataproducto = $objproductos->getTable($entradaproducto['id_producto']);
		//si no es manual y ya esta activa la entrada actualizamos las existencias
		if(!$dataproducto['manual'] && $entradaproducto['status']=='ACTIVO')
			$objproductotienda->actualizaexistencia($productotienda['id_productotienda'],$entradaproducto['cantidad'],'decrement');
		
		$_request["status"]="BAJA";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$_request["usuario_deleted"]=$_SESSION['user_id'];
		$data=fromArray($_request,'entrada_producto',$this->db,"update");	
		$sql= "UPDATE entrada_producto SET $data[0]  WHERE id_entrada_producto=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo que sirve para hacer delete y solo decrementar
	public function deleteonlydecrement($id,$_request=false)
	{
		$entradaproducto = $this->getTable($id);
		
		$objentrada = new Entrada();
		$dataentrada = $objentrada->getTable($entradaproducto['id_entrada']);
		if(!$dataentrada) die('error entrada');

		$objproductotienda = new ProductoTienda();
		$productotienda = $objproductotienda->getTablebyProducto($entradaproducto['id_producto'], $dataentrada['id_tienda']);
		if ( ! $productotienda ) die('no se encontro productotienda');

		$objproductos = new Producto();
		$dataproducto = $objproductos->getTable($entradaproducto['id_producto']);
		//si no es manual y ya esta activa la entrada actualizamos las existencias
		if(!$dataproducto['manual'] && $entradaproducto['status']=='ACTIVO'){
			//$objproductotienda->actualizaexistencia($productotienda['id_productotienda'],$entradaproducto['cantidad'],'decrement');
			//$objproductotienda->actualizaexistencia($productotiendaAnterior['id_productotienda'],$entradaproducto['cantidad'],'increment');
		}
		$_request["status"]="BAJA";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$_request["usuario_deleted"]=$_SESSION['user_id'];
		$data=fromArray($_request,'entrada_producto',$this->db,"update");	
		$sql= "UPDATE entrada_producto SET $data[0]  WHERE id_entrada_producto=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		


}
