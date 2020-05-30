<?php 

	class AutoPermisoUsuariotipo {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_permiso = 0;
		protected $id_usuario_tipo = "";
		protected $created_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$permisoUsuariotipo = new PermisoUsuariotipo();
			$permisoUsuariotipo->setId( $id );
			return $permisoUsuariotipo;
		}
		public static function constructWithValues( $values ){
			$permisoUsuariotipo = new PermisoUsuariotipo();
			$permisoUsuariotipo->setValues( $values );
			return $permisoUsuariotipo;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdPermiso( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERMISO","i") ) 
 				$this->id_permiso = $value;
		}
		
		public function setIdUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIOTIPO","s") ) 
 				$this->id_usuario_tipo = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
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
		
		public function getIdPermiso($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_permiso) ;
 			}else{
 				return $this->id_permiso ;
 			}
		}
		
		public function getIdUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario_tipo) ;
 			}else{
 				return $this->id_usuario_tipo ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
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
			$sql="SELECT * FROM permiso_usuariotipo WHERE id = ?";

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
			$this->setIdPermiso( $res['id_permiso'] );
			$this->setIdUsuarioTipo( $res['id_usuario_tipo'] );
			$this->setCreatedDate( $res['created_date'] );
			return true;
		}
		// end function load

}
