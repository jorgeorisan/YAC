<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."persona.auto.class.php");

class Persona extends AutoPersona { 
	private $DB_TABLE = "persona";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($arrayfilters=false)
	{
		/*
		1	Cliente
		2	Administrador
		3	Proveedor
		4	Empleado
		5	GERENTE GENERAL
		6	ATENCION A CLIENTES
		7	INVENTARIOS
		8	MARKETING
		9	Servicios
		10	Independiente
		11	Paciente
		*/
		$tipo = (isset($arrayfilters['tipo'])) ? $arrayfilters['tipo']    : '';
		$qrytipo = ($tipo)  ? " AND p.id_usuario_tipo in($tipo) " : "";
		
		$sql = "SELECT p.*, ut.usuario_tipo FROM persona p
				left join usuario_tipo ut ON p.id_usuario_tipo=ut.id_usuario_tipo
				where p.status='ACTIVO' 
					$qrytipo
				order by p.nombre, ut.usuario_tipo;";
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
		$sql= "SELECT * FROM persona WHERE id_persona=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result persona");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request['id_tienda']  = (isset($_request['id_tienda']))  ? $_request['id_tienda']  : $_SESSION['user_info']['id_tienda'];
		$_request['id_usuario_tipo'] = (isset($_request['id_usuario_tipo'])) ? $_request['id_usuario_tipo']    : '1';
		$data=fromArray($_request,'persona',$this->db,"add");
		$sql= "INSERT INTO persona (".$data[0].") VALUES(".$data[1]."); ";
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
		$data=fromArray($_request,'persona',$this->db,"update");
		$sql= "UPDATE persona SET $data[0]  WHERE id_persona=".$id.";";
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
		if($id>2){
			$_request["status"]="deleted";
			$_request["deleted_date"]=date("Y-m-d H:i:s");
			$data=fromArray($_request,'persona',$this->db,"update");	
			$sql= "UPDATE persona SET $data[0]  WHERE id_persona=".$id.";";
			$row=$this->db->query($sql);
			if(!$row){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
		
	}
	//metodo comprueba que una persona ya existe o no
	public function personExistings($_request=false)
	{

		$texto = $_request['nombre'].' '.$_request['ap_paterno'].' '.$_request['ap_materno'];
		$nombrecompleto = str_replace(' ',"%",$texto); 
		$queryaddtel  ='';
		if($_request['telefono']){
			$queryaddtel=" and  telefono like '%".$_request['telefono']."%'";
		}
		$sql= "SELECT * FROM persona
				WHERE CONCAT(nombre,ap_paterno,ap_materno) like ('%".$nombrecompleto."%')
				 and status='ACTIVO'
				 and id_usuario_tipo = ".$_request['id_usuario_tipo']."
				 $queryaddtel
				 limit 10;";
		
		$res = $this->db->query($sql);
		$set = array();
		if(!$res){ die("Error getting result"); }
		else{
			while ($row = $res->fetch_assoc())
				{ $set[] = $row; }
		}
		return $set;

	}

}
