<?php 

	class AutoProveedor {

	// Variables
		protected $db;
		
		protected $id_proveedor = 0;
		protected $nombre_corto = "";
		protected $telefono = "";
		protected $info_adicional = "";
		protected $status = "";
		protected $id_tienda = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$proveedor = new Proveedor();
			$proveedor->setId( $id );
			return $proveedor;
		}
		public static function constructWithValues( $values ){
			$proveedor = new Proveedor();
			$proveedor->setValues( $values );
			return $proveedor;
		}


	// Setter Methods
		public function setIdProveedor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPROVEEDOR","i") ) 
 				$this->id_proveedor = $value;
		}
		
		public function setNombreCorto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRECORTO","s") ) 
 				$this->nombre_corto = $value;
		}
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setInfoAdicional( $value ){ 				$this->info_adicional = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
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
		public function getIdProveedor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_proveedor) ;
 			}else{
 				return $this->id_proveedor ;
 			}
		}
		
		public function getNombreCorto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre_corto) ;
 			}else{
 				return $this->nombre_corto ;
 			}
		}
		
		public function getTelefono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->telefono) ;
 			}else{
 				return $this->telefono ;
 			}
		}
		
		public function getInfoAdicional($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->info_adicional) ;
 			}else{
 				return $this->info_adicional ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
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
			$sql="SELECT * FROM proveedor WHERE id = ?";

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

			$this->setIdProveedor( $res['id_proveedor'] );
			$this->setNombreCorto( $res['nombre_corto'] );
			$this->setTelefono( $res['telefono'] );
			$this->setInfoAdicional( $res['info_adicional'] );
			$this->setStatus( $res['status'] );
			$this->setIdTienda( $res['id_tienda'] );
			return true;
		}
		// end function load

}
