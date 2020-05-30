<?php 

	class AutoTienda {

	// Variables
		protected $db;
		
		protected $id_tienda = 0;
		protected $nombre = "";
		protected $telefono = "";
		protected $info_adicional = "";
		protected $status = "";
		protected $ubicacion = "";
		protected $permiso_adicional = 0;
		protected $rfc = "";
		protected $abreviacion = "";
		protected $color = "";
		protected $logo = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$tienda = new Tienda();
			$tienda->setId( $id );
			return $tienda;
		}
		public static function constructWithValues( $values ){
			$tienda = new Tienda();
			$tienda->setValues( $values );
			return $tienda;
		}


	// Setter Methods
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setInfoAdicional( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "INFOADICIONAL","s") ) 
 				$this->info_adicional = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setUbicacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UBICACION","s") ) 
 				$this->ubicacion = $value;
		}
		
		public function setPermisoAdicional( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PERMISOADICIONAL","i") ) 
 				$this->permiso_adicional = $value;
		}
		
		public function setRfc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RFC","s") ) 
 				$this->rfc = $value;
		}
		
		public function setAbreviacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ABREVIACION","s") ) 
 				$this->abreviacion = $value;
		}
		
		public function setColor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COLOR","s") ) 
 				$this->color = $value;
		}
		
		public function setLogo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LOGO","s") ) 
 				$this->logo = $value;
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
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
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
		
		public function getUbicacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ubicacion) ;
 			}else{
 				return $this->ubicacion ;
 			}
		}
		
		public function getPermisoAdicional($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->permiso_adicional) ;
 			}else{
 				return $this->permiso_adicional ;
 			}
		}
		
		public function getRfc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->rfc) ;
 			}else{
 				return $this->rfc ;
 			}
		}
		
		public function getAbreviacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->abreviacion) ;
 			}else{
 				return $this->abreviacion ;
 			}
		}
		
		public function getColor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->color) ;
 			}else{
 				return $this->color ;
 			}
		}
		
		public function getLogo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->logo) ;
 			}else{
 				return $this->logo ;
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
			$sql="SELECT * FROM tienda WHERE id = ?";

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

			$this->setIdTienda( $res['id_tienda'] );
			$this->setNombre( $res['nombre'] );
			$this->setTelefono( $res['telefono'] );
			$this->setInfoAdicional( $res['info_adicional'] );
			$this->setStatus( $res['status'] );
			$this->setUbicacion( $res['ubicacion'] );
			$this->setPermisoAdicional( $res['permiso_adicional'] );
			$this->setRfc( $res['rfc'] );
			$this->setAbreviacion( $res['abreviacion'] );
			$this->setColor( $res['color'] );
			$this->setLogo( $res['logo'] );
			return true;
		}
		// end function load

}
