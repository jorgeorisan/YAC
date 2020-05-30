<?php 

	class AutoUsuarioTipo {

	// Variables
		protected $db;
		
		protected $id_usuario_tipo = "";
		protected $usuario_tipo = "";
		protected $status = "";
		protected $comentarios = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$usuarioTipo = new UsuarioTipo();
			$usuarioTipo->setId( $id );
			return $usuarioTipo;
		}
		public static function constructWithValues( $values ){
			$usuarioTipo = new UsuarioTipo();
			$usuarioTipo->setValues( $values );
			return $usuarioTipo;
		}


	// Setter Methods
		public function setIdUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIOTIPO","s") ) 
 				$this->id_usuario_tipo = $value;
		}
		
		public function setUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOTIPO","s") ) 
 				$this->usuario_tipo = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setComentarios( $value ){ 				$this->comentarios = $value;
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
		public function getIdUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario_tipo) ;
 			}else{
 				return $this->id_usuario_tipo ;
 			}
		}
		
		public function getUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_tipo) ;
 			}else{
 				return $this->usuario_tipo ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM usuario_tipo WHERE id = ?";

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

			$this->setIdUsuarioTipo( $res['id_usuario_tipo'] );
			$this->setUsuarioTipo( $res['usuario_tipo'] );
			$this->setStatus( $res['status'] );
			$this->setComentarios( $res['comentarios'] );
			return true;
		}
		// end function load

}
