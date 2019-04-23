<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."producto.auto.class.php");

class Producto extends AutoProducto { 
	private $DB_TABLE = "producto";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id_producto=false,$tienda=false)
	{
		if(!$tienda)
			$tienda = $_SESSION['user_info']['id_tienda'];

		$queryprod =($id_producto) ? " AND p.id_producto = $id_producto" : '';
			
		
        $sql = "
        SELECT TODO.id_producto,TODO.codinter,TODO.nombre,TODO.marca,TODO.categoria,
        TODO.proveedor,TODO.paquete	,TODO.costo,TODO.precio,TODO.preciomayoreo
        ,TODO.existencias, TIENDA.existencias existenciastienda,TIENDA.fecha_actualizacion,TIENDA.usuario_actualizacion
        FROM(
             SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
                PRODUCTO.proveedor,PRODUCTO.paquete	,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
                ,SUM(EXISTENCIAS.existencias) existencias
                FROM(
                    SELECT p.id_producto,codinter,p.nombre,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
                    FROM producto p
                    LEFT JOIN marca m on p.id_marca=m.id_marca
                    LEFT JOIN categoria c on p.id_categoria=c.id_categoria
                    LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
					WHERE p.status='ACTIVO'
					$queryprod
                ) AS PRODUCTO LEFT JOIN (
                SELECT ep.id_producto,ep.id_entrada_producto,ep.costo,ep.precio,ep.precio_descuento preciomayoreo
                FROM(
                    SELECT id_producto,max(id_entrada_producto) id_entrada_producto 
                    FROM xqwmrfeeug.entrada_producto
                    WHERE status='ACTIVO'
                    group by id_producto
                )ULTIMAENTRADA  
                JOIN entrada_producto ep ON ep.id_entrada_producto=ULTIMAENTRADA.id_entrada_producto
                )PRECIO ON PRODUCTO.id_producto=PRECIO.id_producto
                LEFT JOIN(
                    SELECT id_producto, existencias, tienda_id_tienda id_tienda
                    FROM producto_tienda 
                    WHERE tienda_id_tienda!='14'
                    group by id_producto,tienda_id_tienda
                )EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
                
                group by 
                PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
                PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
                ,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
        ) AS TODO
        LEFT JOIN (
            SELECT PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,PRODUCTO.categoria,
                PRODUCTO.proveedor,PRODUCTO.paquete	,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
                ,SUM(EXISTENCIAS.existencias) existencias,EXISTENCIAS.fecha_actualizacion,EXISTENCIAS.usuario_actualizacion
                FROM(
                    SELECT p.id_producto,codinter,p.nombre,m.nombre marca,c.categoria,pr.nombre_corto proveedor,if(paquete=1,'SI','NO') paquete
                    FROM producto p
                    LEFT JOIN marca m on p.id_marca=m.id_marca
                    LEFT JOIN categoria c on p.id_categoria=c.id_categoria
                    LEFT JOIN proveedor pr on p.id_proveedor=pr.id_proveedor
                    WHERE p.status='ACTIVO'
                ) AS PRODUCTO LEFT JOIN (
                SELECT ep.id_producto,ep.id_entrada_producto,ep.costo,ep.precio,ep.precio_descuento preciomayoreo
                FROM(
                    SELECT id_producto,max(id_entrada_producto) id_entrada_producto 
                    FROM xqwmrfeeug.entrada_producto
                    WHERE status='ACTIVO'
                    group by id_producto
                )ULTIMAENTRADA  
                JOIN entrada_producto ep ON ep.id_entrada_producto=ULTIMAENTRADA.id_entrada_producto
                )PRECIO ON PRODUCTO.id_producto=PRECIO.id_producto
                LEFT JOIN(
                    SELECT id_producto, tienda_id_tienda id_tienda, existencias, fecha_actualizacion,usuario_actualizacion
                    FROM producto_tienda 
					WHERE tienda_id_tienda='$tienda'
                    group by id_producto,tienda_id_tienda
                )EXISTENCIAS ON PRODUCTO.id_producto=EXISTENCIAS.id_producto
                
                group by 
                PRODUCTO.id_producto,PRODUCTO.codinter,PRODUCTO.nombre,PRODUCTO.marca,
                PRODUCTO.categoria,PRODUCTO.proveedor,PRODUCTO.paquete
                ,PRECIO.costo,PRECIO.precio,PRECIO.preciomayoreo
        ) TIENDA ON TODO.id_producto=TIENDA.id_producto";
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
		$sql= "SELECT * FROM producto WHERE id_producto=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$data=fromArray($_request,'producto',$this->db,"add");
		$sql= "INSERT INTO producto (".$data[0].") VALUES(".$data[1]."); ";
		$res=$this->db->query($sql);
		$sql= "SELECT LAST_INSERT_ID();";//. $num ;
		$res=$this->db->query($sql);
		$set=array();
		$id="";
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				$id= $row;
				
			$id = $id["LAST_INSERT_ID()"];
			
			$tienda = new Tienda();
			$datatienda = $tienda->getAllArr();
			$objpti = new ProductoTienda();
			foreach($datatienda as $ex){					
				$_requestpt['id_producto'] 			 = $id;
				$_requestpt['tienda_id_tienda']      = $ex['id_tienda'];
				$_requestpt['existencias']           = 0;
				$_requestpt['fecha_actualizacion']   = date('Y-m-d H:i:s');
				$_requestpt['usuario_actualizacion'] = $_SESSION['user_id'];
				try {
					$objpti->addAll($_requestpt);
				} catch (Exception $e) {
					echo "no se genero la relacion".$e;
					exit();
				}
			}
		}
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'producto',$this->db,"update");
		$sql= "UPDATE producto SET $data[0]  WHERE id_producto=".$id.";";
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
		$_request["status"]="BAJA";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'producto',$this->db,"update");	
		$sql= "UPDATE producto SET $data[0]  WHERE id_producto=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer obtener datos en el editar
	public function getTablebyCode($code)
	{
		
		$code = $this->db->real_escape_string($code);
		$sql  = "SELECT * FROM producto WHERE codinter='$code' and status='ACTIVO'";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result producto");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}


}
