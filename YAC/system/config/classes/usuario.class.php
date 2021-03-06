<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."usuario.auto.class.php");

class Usuario extends AutoUsuario { 
	private $DB_TABLE = "usuario";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($arrayfilters=false)
	{
		$tiendas = (isset($arrayfilters['id_tienda'])) ? $arrayfilters['id_tienda']    : '';
		$qrytienda = ($tiendas)  ? " and id_tienda in (" . $tiendas . ") " : "";

		$tipo = (isset($arrayfilters['tipo'])) ? $arrayfilters['tipo']    : '';
		$qrytipo = ($tipo)  ? " AND id_usuario_tipo in($tipo) " : "";
		
		$sql = "SELECT * FROM usuario 
				where status='ACTIVO' 
				$qrytienda 
				$qrytipo
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
		$sql= "SELECT * FROM usuario WHERE id=$id;";
		$res=$this->db->query($sql);
		if(!$res)
			{die("Error getting result usuario");}
		$row = $res->fetch_assoc();
		$res->close();
		return $row;

	}
		//metodo que sirve para agregar nuevo
	public function addAll($_request)
	{
		$_request["password"]=password_hash($_request["password"],PASSWORD_DEFAULT);
		$data=fromArray($_request,'usuario',$this->db,"add");
		$sql= "INSERT INTO usuario (".$data[0].") VALUES(".$data[1]."); ";
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
		if(isset($_request["password"])){
			$_request["password"]=password_hash($_request["password"],PASSWORD_DEFAULT);
		}
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'usuario',$this->db,"update");
		$sql= "UPDATE usuario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			$Usuario = new Usuario();
			$dataUsuario=$Usuario->getTable($id);
			$UsuarioTipo = new UsuarioTipo();
			$dataUsuarioTipo=$UsuarioTipo->getTable($dataUsuario["id_usuario_tipo"]);
			if(isset($dataUsuario["id_tienda"])){
				$objtienda = new Tienda();
				$datatienda = $objtienda->getTable($dataUsuario["id_tienda"]);
				if($datatienda){
					$_SESSION['user_info']['id_tienda']		 = $dataUsuario["id_tienda"];
					$_SESSION['user_info']['tienda']		 = $datatienda["nombre"];
					$_SESSION['user_info']['info_adicional'] = $datatienda["info_adicional"];
					
				}
				
			}
			$_SESSION['user_info']['id_usuario']     = $id;
			$_SESSION['user_info']['costos']         = $dataUsuario["costos"];
			$_SESSION['user_info']['nombre']         = $dataUsuario["nombre"];
			$_SESSION['user_info']['id_usuario_tipo']= $dataUsuario["id_usuario_tipo"];
			$_SESSION['user_info']['usuario_tipo']   = $dataUsuarioTipo["usuario_tipo"];

			
			return true;
		}
	}
		//metodo que sirve para hacer delete
	public function deleteAll($id,$_request=false)
	{
		$_request["status"]="deleted";
		$_request["deleted_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'usuario',$this->db,"update");	
		$sql= "UPDATE usuario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			return true;
		}
	}
	//metodo comprueba que un usuario ya existe o no
	public function userExists($username)
	{

		$username=$this->db->real_escape_string($username);
		$sql= "SELECT * FROM usuario WHERE id_usuario='".$username."' and status='ACTIVO';";
		$res=$this->db->query($sql);
		if(!$res)
			{die('Error getting result');}
		//echo $sql;
		$row = $res->fetch_assoc();
		//echo $this->db->error;
		$res->close();
		if(!$row)
			return false;
		else
			return true;

	}


}
