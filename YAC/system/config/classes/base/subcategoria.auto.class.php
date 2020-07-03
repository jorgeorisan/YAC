<?php 

	class AutoSubcategoria {

	// Variables
		protected $db;
		
		protected $id_subcategoria = 0;
		protected $nombre_subcategoria = "";
		protected $id_categoria = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$subcategoria = new Subcategoria();
			$subcategoria->setId( $id );
			return $subcategoria;
		}
		public static function constructWithValues( $values ){
			$subcategoria = new Subcategoria();
			$subcategoria->setValues( $values );
			return $subcategoria;
		}


	// Setter Methods
		public function setIdSubcategoria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDSUBCATEGORIA","i") ) 
 				$this->id_subcategoria = $value;
		}
		
		public function setNombreSubcategoria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRESUBCATEGORIA","s") ) 
 				$this->nombre_subcategoria = $value;
		}
		
		public function setIdCategoria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCATEGORIA","i") ) 
 				$this->id_categoria = $value;
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
		public function getIdSubcategoria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_subcategoria) ;
 			}else{
 				return $this->id_subcategoria ;
 			}
		}
		
		public function getNombreSubcategoria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre_subcategoria) ;
 			}else{
 				return $this->nombre_subcategoria ;
 			}
		}
		
		public function getIdCategoria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_categoria) ;
 			}else{
 				return $this->id_categoria ;
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
			$sql="SELECT * FROM subcategoria WHERE id = ?";

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

			$this->setIdSubcategoria( $res['id_subcategoria'] );
			$this->setNombreSubcategoria( $res['nombre_subcategoria'] );
			$this->setIdCategoria( $res['id_categoria'] );
			return true;
		}
		// end function load

}
