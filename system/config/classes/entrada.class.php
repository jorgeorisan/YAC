<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."entrada.auto.class.php");

class Entrada extends AutoEntrada { 
	private $DB_TABLE = "entrada";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM entrada where status!='BAJA';";
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
		$sql= "SELECT * FROM entrada WHERE id_entrada=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result entrada");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
	//metodo que sirve para agregar NUEVO AL ACTUALZIAR EXISTENCIAS
	public function addByOne($_request)
	{
		$data=fromArray($_request,'entrada',$this->db,"add");
		$sql= "INSERT INTO entrada (".$data[0].") VALUES(".$data[1]."); ";
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
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		
		$_request['id_usuario'] = (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_id'];
		$tiendas = $_request["id_tiendas"];
	
		$idefirst="";
		foreach ($tiendas  as $key => $valtienda) {
			
			$id_tienda=$valtienda;
			$cantidades = $_request["cantidad".$id_tienda];
			$totalprod=0;
			foreach ($cantidades as $key2 => $valproducto) {
				if($cantidades[$key2]>0){
					$totalprod++;
				}
			}
			
			if(!$totalprod) continue;

		
			
			$_requestEntrada['folio']    		   = $this->getNewFolio($id_tienda);
			$_requestEntrada['id_tienda']    	   = $id_tienda;
			$_requestEntrada['id_user']    	   	   = $_request['id_usuario'];
			$_requestEntrada['id_proveedorcompra'] = $_request['id_proveedorcompra'];
			$_requestEntrada['concepto'] 		   = 'ENTRADA DE ALMACEN';
			$_requestEntrada['comentarios'] 	   = (isset($_request['comentarios'])) ? $_request['comentarios'] : '';
			$_requestEntrada['referencia'] 		   = (isset($_request['referencia'])) ? $_request['referencia'] : '';
			$_requestEntrada['status'] 		   	   = 'POR AUTORIZAR';
			$_requestEntrada['fecha'] 		  	   = (isset($_request['fecha'])) ? $_request['fecha']." ".date("H:i:s") : date('Y-m-d H:i:s');
			$_requestEntrada['icredito'] 		   = ($_request['tipo_pago']=="Credito") ? 1 : 0;
			$_requestEntrada['tipo_pago'] 		   = $_request['tipo_pago'];
			$data=fromArray($_requestEntrada,'entrada',$this->db,"add");
			$sql= "INSERT INTO entrada (".$data[0].") VALUES(".$data[1]."); ";
			$res=$this->db->query($sql);
			$sql= "SELECT LAST_INSERT_ID();";//. $num ;
			$res=$this->db->query($sql);
			$set=array();
			$ide="";
			if(!$res){ die("Error getting result"); }
			else{
				while ($row = $res->fetch_assoc())
					$id= $row;

				$ide = $id["LAST_INSERT_ID()"];

				if(!$ide)  die("Error al insertar Entrada");

				if($id_tienda == $_SESSION['user_info']['id_tienda']){
					$idefirst = $ide;
				}
				if(!$idefirst)
				 	$idefirst = $ide;
			
				

				$objEntradaProducto = new EntradaProducto();
				$objproductos 		= new Producto();
				$objproductotienda 	= new ProductoTienda();
				//arrays
				$productos  = $_request["id_producto"];
				
				$cantidades = $_request["cantidad".$id_tienda];
				$costos     = (isset($_request["costo"]))   ? $_request["costo"]  : [];
				$mayoreos   = (isset($_request["mayoreo"])) ? $_request["mayoreo"]: [];
				$precios    = (isset($_request["precio"]))  ? $_request["precio"] : [];
				$totalcosto = $totalgral= 0;
				foreach ($productos as $key2 => $valproducto) {
					if($cantidades[$key2]>0){
					
						$totalcosto += $cantidades[$key2]*$costos[$key2];
						$totalgral  += $cantidades[$key2]*$precios[$key2];
						$producto = $objproductos->gettable($valproducto);

						$productotienda=$objproductotienda->getTablebyProducto($valproducto, $id_tienda);
						if(!$productotienda) continue;

						$_requestEntradaProducto['id_tienda'] 	      = $id_tienda;
						$_requestEntradaProducto['cantidad_anterior'] = $productotienda['existencias'];
						$_requestEntradaProducto['id_entrada'] 	      = $ide;
						$_requestEntradaProducto['id_producto']	      = $valproducto;
						$_requestEntradaProducto['nombre']            = $producto['nombre'];
						$_requestEntradaProducto['cantidad'] 	      = $cantidades[$key2];
						$_requestEntradaProducto['costo'] 		      = $costos[$key2];
						$_requestEntradaProducto['mayoreo'] 	      = $mayoreos[$key2];
						$_requestEntradaProducto['precio']            = $precios[$key2];
						$_requestEntradaProducto['totalcosto']        = $cantidades[$key2]*$costos[$key2];
						$_requestEntradaProducto['status'] 		      = 'POR AUTORIZAR';

						$idEP = $objEntradaProducto->addAll($_requestEntradaProducto);
						if($idEP>0){}else{ die("Error al insertar Entrada Producto"); }
					}
				}
				if($totalcosto>0){
					$_requestEntradaNva['total'] 	   = $totalgral;
					$_requestEntradaNva['costo_total'] = $totalcosto;
					if( ! $this->updateAll($ide,$_requestEntradaNva) ) {
						die("Error al actualizar costo total Entrada");
					}
				}
			}
		}
		return $idefirst;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'entrada',$this->db,"update");
		$sql= "UPDATE entrada SET $data[0]  WHERE id_entrada=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($identrada,$_request=false)
	{
		$dataEntrada = $this->getTable($identrada);
		if(!$dataEntrada) die('Error entrada');

		$objEntradaProducto = new EntradaProducto();
		$dataEntradaProductos = $objEntradaProducto->getAllArr($identrada);
		foreach ($dataEntradaProductos as $key => $row) {
			//Eliminamos los productos
			$objEntradaProducto->deleteAll($row['id_entrada_producto']);
		}
		$_request['usuario_deleted'] =  $_SESSION['user_id'];
		$_request['deleted_date'] 	=  date('Y-m-d H:i:s');
		$_request['status']			= 'BAJA';
		return $this->updateAll($identrada,$_request);
		/**FALTA ACTUALIZAR LOS COSTOS A LA ULTIMA ENTRADA VALIDA */
	}
	//metodo que sirve para obtener el folio por tienda
	public function getNewFolio($idtienda)
	{
		if(! intval( $idtienda )) return false;
		
		$id=$this->db->real_escape_string($idtienda);
		$sql= "SELECT (ifnull(count(id_entrada),0)+1) folio FROM entrada WHERE id_tienda=$id AND concepto!='ACTUALIZACION INVENTARIO' order by id_entrada desc limit 1";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result getNewFolio");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row['folio'];

	}
	//reporte de entradas
	public function getReporteEntradas($arrayfilters)
	{
		$fechaini   = (isset($arrayfilters['fecha_inicial'])) ? $arrayfilters['fecha_inicial'] : '';
		$fechafin   = (isset($arrayfilters['fecha_final']))   ? $arrayfilters['fecha_final']   : '';
		$id_usuario = (isset($arrayfilters['id_usuario']))    ? $arrayfilters['id_usuario']    : '';
		$id_tienda  = (isset($arrayfilters['id_tienda']))     ? $arrayfilters['id_tienda']     : '';
		if ( validar_fecha($fechaini) != 3 || validar_fecha($fechafin) != 3){
			return false;
		}
		$qryusuario = ($id_usuario)  ? " AND v.id_user='$id_usuario' " : "";
		$qrytienda  = ($id_tienda>0) ? " AND v.id_tienda='$id_tienda' "   : "";
		$sql = "SELECT v.* FROM entrada v
				where  
					DATE(v.fecha)>='".$fechaini."' and DATE(v.fecha)<='".$fechafin."'
					$qryusuario
					$qrytienda
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteEntradas"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	//reporte de entradas por autorizar
	public function getReporteEntradasPendientes()
	{
		$sql = "SELECT v.* FROM entrada v
				where  v.status = 'POR AUTORIZAR'
			 ";
		$res = $this->db->query($sql);
		
		$set = array();
		if(!$res){ die("Error getting result getReporteEntradasPendientes"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		$res->close();
		return $set;
	}
	
	public function getpagado($id){
		if(! intval( $id )) return false;
		$sql = "SELECT ifnull(sum(montoabono),0) as total FROM deudores where  id_venta=$id and status='ACTIVA' limit 1;";
		$res = $this->db->query($sql);
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result venta");}
		$row = $res->fetch_assoc();
		$res->close();
		return 1;
	}
	public function validateAll($identrada){
		if(! intval( $identrada )) return false;

		$objEntradaProducto = new EntradaProducto();
		$entradaproductos = $objEntradaProducto->getAllArr($identrada);
		foreach ($entradaproductos as $key => $row) {
			$objproductos = new Producto();
			$dataproducto = $objproductos->getTable($row['id_producto']);
			if($dataproducto['manual']) continue;

			$objproductotienda = new ProductoTienda();
			$productotienda=$objproductotienda->getTablebyProducto($row['id_producto'], $row['id_tienda']);
			if(!$productotienda) continue;

			$requestProducto['costo']			= $row['costo'];
			$requestProducto['precio_descuento']= $row['mayoreo'];
			$requestProducto['precio']			= $row['precio'];
			$objproductotienda->actualizaexistencia($productotienda['id_productotienda'],$row['cantidad'],'increment');
			
			$objproductos->updateAll($row['id_producto'],$requestProducto); //actualizamos costos

			$requestEntradaProducto['status']	= 'ACTIVO';
			$objEntradaProducto->updateAll($row['id_entrada_producto'],$requestEntradaProducto);
		}
		$_request['usuario_validacion'] =  $_SESSION['user_id'];
		$_request['fecha_validacion'] 	=  date('Y-m-d H:i:s');
		$_request['status']				='ACTIVO';
		return $this->updateAll($identrada,$_request);
	}

}
