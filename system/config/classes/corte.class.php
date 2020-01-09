<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."corte.auto.class.php");

class Corte extends AutoCorte { 
	private $DB_TABLE = "corte";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr()
	{
		$sql = "SELECT * FROM corte where status='active';";
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
		$sql= "SELECT * FROM corte WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result corte");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_tienda']  = (isset($_request['id_tienda']))  ? $_request['id_tienda']  : $_SESSION['user_info']['id_tienda'];
		$_request['id_user'] 	= (isset($_request['id_usuario'])) ? $_request['id_usuario'] : $_SESSION['user_id'];
		$data=fromArray($_request,'corte',$this->db,"add");
		$sql= "INSERT INTO corte (".$data[0].") VALUES(".$data[1]."); ";
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
				
				$objPV = new CorteConceptos();

				$text_entrada    = (isset($_request["text_entrada"]))   ? $_request["text_entrada"]:'';
				$row_entrada     = (isset($_request["row_entrada"])) 	? $_request["row_entrada"] : '';
				$text_salida     = (isset($_request["text_salida"])) 	? $_request["text_salida"] : '';
				$row_salida      = (isset($_request["row_salida"])) 	? $_request["row_salida"]  : '';
				$row_dinero      = (isset($_request["row_dinero"])) 	? $_request["row_dinero"]  : '';
				$text_dinero     = (isset($_request["text_dinero"])) 	? $_request["text_dinero"] : '';
				foreach ($text_entrada as $key => $value) {
					if(!$text_entrada[$key]) continue;

					$cantidad  = (intval($row_entrada[$key]))? $row_entrada[$key] : 0;
					$_requestConceptosCorte['corte_id'] = $id;
					$_requestConceptosCorte['concepto'] = $text_entrada[$key];
					$_requestConceptosCorte['cantidad'] = $cantidad;
					$_requestConceptosCorte['tipo']     = 'entrada';
					$idaux = $objPV->addAll($_requestConceptosCorte);
					if($idaux>0){}else{ die("Error al insertar conceptos corte entrada"); }
				}
				foreach ($text_salida as $key => $value) {
					if(!$text_salida[$key]) continue;
					
					$cantidad  = (intval($row_salida[$key]))? $row_salida[$key] : 0;
					$_requestConceptosCorte['corte_id'] = $id;
					$_requestConceptosCorte['concepto'] = $text_salida[$key];
					$_requestConceptosCorte['cantidad'] = $cantidad;
					$_requestConceptosCorte['tipo']     = 'salida';
					$idaux = $objPV->addAll($_requestConceptosCorte);
					if($idaux>0){}else{ die("Error al insertar conceptos corte salida"); }
				}
				foreach ($text_dinero as $key => $value) {
					if(!$text_dinero[$key]) continue;
					
					$cantidad  = (intval($row_dinero[$key]))? $row_dinero[$key] : 0;
					$_requestConceptosCorte['corte_id'] = $id;
					$_requestConceptosCorte['concepto'] = $text_dinero[$key];
					$_requestConceptosCorte['cantidad'] = $cantidad;
					$_requestConceptosCorte['tipo']     = 'dinero';
					$idaux = $objPV->addAll($_requestConceptosCorte);
					if($idaux>0){}else{ die("Error al insertar conceptos corte dinero"); }
				}
		}
		return $id;
	}
		//metodo que sirve para hacer update
	public function updateAll($id,$_request)
	{
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'corte',$this->db,"update");
		$sql= "UPDATE corte SET $data[0]  WHERE id=".$id.";";
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
		
		$data=fromArray($_request,'corte',$this->db,"update");	
		$sql= "UPDATE corte SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}

	


}
