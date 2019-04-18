<?php 

	class AutoDescuentos {

	// Variables
		protected $db;
		
		protected $id_descuentos = 0;
		protected $id_usuario = "";
		protected $porcentajedesc = "";
		protected $montodesc = 0;
		protected $totaldesc = 0;
		protected $id_venta = "";
		protected $fecha_registro = "";
		protected $descripciondesc = "";
		protected $status = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$descuentos = new Descuentos();
			$descuentos->setId( $id );
			return $descuentos;
		}
		public static function constructWithValues( $values ){
			$descuentos = new Descuentos();
			$descuentos->setValues( $values );
			return $descuentos;
		}


	// Setter Methods
		public function setIdDescuentos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDDESCUENTOS","i") ) 
 				$this->id_descuentos = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setPorcentajedesc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PORCENTAJEDESC","s") ) 
 				$this->porcentajedesc = $value;
		}
		
		public function setMontodesc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MONTODESC","d") ) 
 				$this->montodesc = $value;
		}
		
		public function setTotaldesc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALDESC","d") ) 
 				$this->totaldesc = $value;
		}
		
		public function setIdVenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVENTA","s") ) 
 				$this->id_venta = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setDescripciondesc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCRIPCIONDESC","s") ) 
 				$this->descripciondesc = $value;
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
		public function getIdDescuentos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_descuentos) ;
 			}else{
 				return $this->id_descuentos ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getPorcentajedesc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->porcentajedesc) ;
 			}else{
 				return $this->porcentajedesc ;
 			}
		}
		
		public function getMontodesc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->montodesc) ;
 			}else{
 				return $this->montodesc ;
 			}
		}
		
		public function getTotaldesc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->totaldesc) ;
 			}else{
 				return $this->totaldesc ;
 			}
		}
		
		public function getIdVenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_venta) ;
 			}else{
 				return $this->id_venta ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getDescripciondesc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descripciondesc) ;
 			}else{
 				return $this->descripciondesc ;
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
			$sql="SELECT * FROM descuentos WHERE id = ?";

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

			$this->setIdDescuentos( $res['id_descuentos'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setPorcentajedesc( $res['porcentajedesc'] );
			$this->setMontodesc( $res['montodesc'] );
			$this->setTotaldesc( $res['totaldesc'] );
			$this->setIdVenta( $res['id_venta'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setDescripciondesc( $res['descripciondesc'] );
			$this->setStatus( $res['status'] );
			return true;
		}
		// end function load

}
