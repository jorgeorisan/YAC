<?php 

	class AutoHistorialInventario {

	// Variables
		protected $db;
		
		protected $id_historialinventario = 0;
		protected $id_productotienda = 0;
		protected $existencia_anterior = 0;
		protected $existencia = 0;
		protected $fecha_registro = "";
		protected $id_usuario = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$historialInventario = new HistorialInventario();
			$historialInventario->setId( $id );
			return $historialInventario;
		}
		public static function constructWithValues( $values ){
			$historialInventario = new HistorialInventario();
			$historialInventario->setValues( $values );
			return $historialInventario;
		}


	// Setter Methods
		public function setIdHistorialinventario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDHISTORIALINVENTARIO","i") ) 
 				$this->id_historialinventario = $value;
		}
		
		public function setIdProductotienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTOTIENDA","i") ) 
 				$this->id_productotienda = $value;
		}
		
		public function setExistenciaAnterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXISTENCIAANTERIOR","d") ) 
 				$this->existencia_anterior = $value;
		}
		
		public function setExistencia( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXISTENCIA","d") ) 
 				$this->existencia = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
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
		public function getIdHistorialinventario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_historialinventario) ;
 			}else{
 				return $this->id_historialinventario ;
 			}
		}
		
		public function getIdProductotienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_productotienda) ;
 			}else{
 				return $this->id_productotienda ;
 			}
		}
		
		public function getExistenciaAnterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->existencia_anterior) ;
 			}else{
 				return $this->existencia_anterior ;
 			}
		}
		
		public function getExistencia($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->existencia) ;
 			}else{
 				return $this->existencia ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
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
			$sql="SELECT * FROM historial_inventario WHERE id = ?";

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

			$this->setIdHistorialinventario( $res['id_historialinventario'] );
			$this->setIdProductotienda( $res['id_productotienda'] );
			$this->setExistenciaAnterior( $res['existencia_anterior'] );
			$this->setExistencia( $res['existencia'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setIdUsuario( $res['id_usuario'] );
			return true;
		}
		// end function load

}
