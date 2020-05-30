<?php 

	class AutoProveedorCompra {

	// Variables
		protected $db;
		
		protected $id_proveedorcompra = 0;
		protected $nombre = "";
		protected $status = "";
		protected $telefono = "";
		protected $direccion = "";
		protected $email = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$proveedorCompra = new ProveedorCompra();
			$proveedorCompra->setId( $id );
			return $proveedorCompra;
		}
		public static function constructWithValues( $values ){
			$proveedorCompra = new ProveedorCompra();
			$proveedorCompra->setValues( $values );
			return $proveedorCompra;
		}


	// Setter Methods
		public function setIdProveedorcompra( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPROVEEDORCOMPRA","i") ) 
 				$this->id_proveedorcompra = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setDireccion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DIRECCION","s") ) 
 				$this->direccion = $value;
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
		public function getIdProveedorcompra($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_proveedorcompra) ;
 			}else{
 				return $this->id_proveedorcompra ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getTelefono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->telefono) ;
 			}else{
 				return $this->telefono ;
 			}
		}
		
		public function getDireccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->direccion) ;
 			}else{
 				return $this->direccion ;
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
			$sql="SELECT * FROM proveedor_compra WHERE id = ?";

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

			$this->setIdProveedorcompra( $res['id_proveedorcompra'] );
			$this->setNombre( $res['nombre'] );
			$this->setStatus( $res['status'] );
			$this->setTelefono( $res['telefono'] );
			$this->setDireccion( $res['direccion'] );
			$this->setEmail( $res['email'] );
			return true;
		}
		// end function load

}
