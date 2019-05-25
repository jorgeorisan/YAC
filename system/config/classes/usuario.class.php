<?php

require_once(SYSTEM_DIR . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR ."base". DIRECTORY_SEPARATOR ."usuario.auto.class.php");

class Usuario extends AutoUsuario { 
	private $DB_TABLE = "usuario";

	
		//metodo que sirve para obtener todos los datos de la tabla
	public function getAllArr($id_usuario_tipo=false)
	{
		$add = ($id_usuario_tipo) ? " and id_tienda in (" . $id_usuario_tipo . ") " : '';
		
		$sql = "SELECT * FROM usuario where status='ACTIVO' $add ;";
		
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
		if($_request["password"]){
			$_request["password"]=password_hash($_request["password"],PASSWORD_DEFAULT);
		}
		$_request["updated_date"]=date("Y-m-d H:i:s");
		$data=fromArray($_request,'usuario',$this->db,"update");
		$sql= "UPDATE usuario SET $data[0]  WHERE id=".$id.";";
		$row=$this->db->query($sql);
		if(!$row){
			return false;
		}else{
			$UsuarioTipo = new UsuarioTipo();
			$dataUsuarioTipo=$UsuarioTipo->getTable($_request["id_usuario_tipo"]);
			if(isset($_request["id_tienda"])){
				$objtienda = new Tienda();
				$datatienda = $objtienda->getTable($_request["id_tienda"]);
				if($datatienda){
					$_SESSION['user_info']['id_tienda']=$_request["id_tienda"];
					$_SESSION['user_info']['tienda']=$datatienda["nombre"];
					$_SESSION['user_info']['info_adicional']=$datatienda["info_adicional"];
					// mostrar productos en sesion
					$_SESSION['CADENA']='';
					$obj = new Producto();
					$queryproductos = $obj->getAllArr();
					
					$prod="";
				
					foreach($queryproductos as $producto){   
						$prod=$prod.",'".$producto['codinter']."::".str_replace("'", "", $producto['nombre'])." $". $producto['precio']."|". $producto['existenciastienda']."'";
					}
					$cadena = substr($prod,1);
					$_SESSION['CADENA']=$cadena;
				}
				
			}
			$_SESSION['user_info']['id_usuario']     = $_request["id_usuario"];
			$_SESSION['user_info']['costos']         = $_request["costos"];
			$_SESSION['user_info']['nombre']         = $dataUsuarioTipo["nombre"];
			$_SESSION['user_info']['id_usuario_tipo']= $_request["id_usuario_tipo"];
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
