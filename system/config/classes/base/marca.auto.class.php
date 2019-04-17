<?php 

	class AutoMarca {

	// Variables
		protected $db;
		
		protected $id_marca = 0;
		protected $nombre = "";
		protected $descuento = 0;
		protected $descuento_activado = 0;
		protected $status = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$marca = new Marca();
			$marca->setId( $id );
			return $marca;
		}
		public static function constructWithValues( $values ){
			$marca = new Marca();
			$marca->setValues( $values );
			return $marca;
		}


	// Setter Methods
		public function setIdMarca( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDMARCA","i") ) 
 				$this->id_marca = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setDescuento( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCUENTO","d") ) 
 				$this->descuento = $value;
		}
		
		public function setDescuentoActivado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCUENTOACTIVADO","i") ) 
 				$this->descuento_activado = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
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
		public function getIdMarca($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_marca) ;
 			}else{
 				return $this->id_marca ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getDescuento($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descuento) ;
 			}else{
 				return $this->descuento ;
 			}
		}
		
		public function getDescuentoActivado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descuento_activado) ;
 			}else{
 				return $this->descuento_activado ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
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
			$sql="SELECT * FROM marca WHERE id = ?";

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

			$this->setIdMarca( $res['id_marca'] );
			$this->setNombre( $res['nombre'] );
			$this->setDescuento( $res['descuento'] );
			$this->setDescuentoActivado( $res['descuento_activado'] );
			$this->setStatus( $res['status'] );
			return true;
		}
		// end function load

}
