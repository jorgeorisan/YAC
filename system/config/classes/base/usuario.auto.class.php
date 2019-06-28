<?php 

	class AutoUsuario {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_usuario = "";
		protected $password = "";
		protected $session_id = "";
		protected $status = "";
		protected $id_usuario_tipo = "";
		protected $nombre = "";
		protected $id_tienda = 0;
		protected $permisos = "";
		protected $comision = 0;
		protected $direccion = "";
		protected $costos = "";
		protected $email = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$usuario = new Usuario();
			$usuario->setId( $id );
			return $usuario;
		}
		public static function constructWithValues( $values ){
			$usuario = new Usuario();
			$usuario->setValues( $values );
			return $usuario;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setPassword( $value ){ 				$this->password = $value;
		}
		
		public function setSessionId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SESSIONID","s") ) 
 				$this->session_id = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setIdUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIOTIPO","s") ) 
 				$this->id_usuario_tipo = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setPermisos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PERMISOS","s") ) 
 				$this->permisos = $value;
		}
		
		public function setComision( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMISION","d") ) 
 				$this->comision = $value;
		}
		
		public function setDireccion( $value ){ 				$this->direccion = $value;
		}
		
		public function setCostos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOS","s") ) 
 				$this->costos = $value;
		}
		
		public function setEmail( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
		}
		
		public function setValidclass( $value ){
			if ( $this->validclassateInput('/^(true|false)$/', ( $value ) ? 'true' : 'false', "Validclass",'s') )
				$this->validclass = $value;
		}

		public function setStatusclass( $value ){
			if ( ! is_array($this->statusclass) ){
				$this->statusclass=array();
			}

			$this->statusclass[] = $value;
			$this->statusclass = array_unique($this->statusclass );
			
		}


	// Getter Methods
		public function getId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id) ;
 			}else{
 				return $this->id ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getPassword($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->password) ;
 			}else{
 				return $this->password ;
 			}
		}
		
		public function getSessionId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->session_id) ;
 			}else{
 				return $this->session_id ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getIdUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario_tipo) ;
 			}else{
 				return $this->id_usuario_tipo ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getPermisos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->permisos) ;
 			}else{
 				return $this->permisos ;
 			}
		}
		
		public function getComision($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comision) ;
 			}else{
 				return $this->comision ;
 			}
		}
		
		public function getDireccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->direccion) ;
 			}else{
 				return $this->direccion ;
 			}
		}
		
		public function getCostos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costos) ;
 			}else{
 				return $this->costos ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
 			}
		}
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}
		// Private Support Functions
		protected function validclassateInput( $pcre, $input, $field , $bind_type) {
			//if ( ! $this->validclass )
			//	return $this->validclass;

			if ( ! preg_match($pcre, $input) ){ 
				return $this->killInvalidclass( "The input provided for the field '$field' is not validclass. Value provided: ".htmlentities($input),$field);
			}else{
				unset($this->statusclass[$field]);
				if (empty($this->statusclass)){$this->validclass=true;}
			}

			return true;
		}
		protected function killInvalidclass( $msg, $field="General Error" ){
			$this->statusclass[$field] = $msg;
			$this->validclass = false;
			return false;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM usuario WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalidclass( "The ID not validclass." );

			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( 'i', $id );
			$stmt->execute();

			$res = $stmt->get_result();
			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalidclass( "Unable to retrieve information for ID. Please try again later, or contact support." );
			}

			$this->setId( $res['id'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setPassword( $res['password'] );
			$this->setSessionId( $res['session_id'] );
			$this->setStatus( $res['status'] );
			$this->setIdUsuarioTipo( $res['id_usuario_tipo'] );
			$this->setNombre( $res['nombre'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setPermisos( $res['permisos'] );
			$this->setComision( $res['comision'] );
			$this->setDireccion( $res['direccion'] );
			$this->setCostos( $res['costos'] );
			$this->setEmail( $res['email'] );
			return true;
		}
		// end function load

}
