<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."productos_venta.auto.class.php");

class ProductosVenta extends AutoProductosVenta { 
	private $DB_TABLE = "productos_venta";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id,$deleted=true)
	{
		if(! intval( $id )){
			return false;
		}
		$txtdeleted = ($deleted==false) ? " AND pv.cancelado=0" : '';
		$sql = "SELECT pv.cantidad,p.codinter,pv.nombre,ifnull((pv.total/pv.cantidad),0) precio_unitario,pv.total,pv.tipoprecio,pv.cancelado,pv.id_productos_venta,(p.costo*pv.cantidad) costo,(pv.total-(p.costo*pv.cantidad)) utilidad
				FROM productos_venta pv
				LEFT JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
				LEFT JOIN producto p ON p.id_producto=pt.id_producto
				where id_venta='$id'
				$txtdeleted
				;";
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
		$sql= "SELECT pv.*,
				pt.existencias,pt.fecha_actualizacion,pt.usuario_actualizacion,pt.alerta_minima,
				p.codinter,p.costo,p.precio,p.precio_descuento,p.manual,p.nombre
			  FROM productos_venta pv
			  LEFT JOIN producto_tienda pt ON pv.id_productotienda=pt.id_productotienda
			  LEFT JOIN producto p ON p.id_producto=pt.id_producto
			    WHERE pv.id_productos_venta=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result productos_venta");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'productos_venta',$this->db,"add");
		$sql= "INSERT INTO productos_venta (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'productos_venta',$this->db,"update");
		$sql= "UPDATE productos_venta SET $data[0]  WHERE id_productos_venta=".$id.";";
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
		$_request["cancelado"] = "1";
		$_request["fecha_cancelacion"]  = date("Y-m-d H:i:s");
		$_request["usuario_cancelacion"]= $_SESSION['user_id'];
		$data=fromArray($_request,'productos_venta',$this->db,"update");	
		$sql= "UPDATE productos_venta SET $data[0]  WHERE id_productos_venta=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			$objPV = $this->getTable($id);
			$ventas = new Venta();
			if($ventas->getstatus($objPV['id_venta'])){
				$sql= "UPDATE venta SET cancelado=1  WHERE id_venta=".$objPV['id_venta'].";";
				$row=$this->db->query($sql);
				if(!$row){
					return false;
				}
			}
			$objproductostienda = new ProductoTienda();
			if(!$objPV['manual'])
			$objproductostienda->actualizaexistencia($objPV['id_productotienda'],$objPV['cantidad'],'increment');
			return true;
		}
	}

}
