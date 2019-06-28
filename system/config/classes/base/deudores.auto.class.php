<?php 

	class AutoDeudores {

	// Variables
		protected $db;
		
		protected $id_deudores = 0;
		protected $id_venta = "";
		protected $fecha_abono = "";
		protected $fecha_registro = "";
		protected $status = "";
		protected $montoabono = 0;
		protected $id_usuario = "";
		protected $comentarios = "";
		protected $tipo_pago = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$deudores = new Deudores();
			$deudores->setId( $id );
			return $deudores;
		}
		public static function constructWithValues( $values ){
			$deudores = new Deudores();
			$deudores->setValues( $values );
			return $deudores;
		}


	// Setter Methods
		public function setIdDeudores( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDDEUDORES","i") ) 
 				$this->id_deudores = $value;
		}
		
		public function setIdVenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVENTA","s") ) 
 				$this->id_venta = $value;
		}
		
		public function setFechaAbono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAABONO","s") ) 
 				$this->fecha_abono = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setMontoabono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MONTOABONO","d") ) 
 				$this->montoabono = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setComentarios( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMENTARIOS","s") ) 
 				$this->comentarios = $value;
		}
		
		public function setTipoPago( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIPOPAGO","s") ) 
 				$this->tipo_pago = $value;
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
		public function getIdDeudores($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_deudores) ;
 			}else{
 				return $this->id_deudores ;
 			}
		}
		
		public function getIdVenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_venta) ;
 			}else{
 				return $this->id_venta ;
 			}
		}
		
		public function getFechaAbono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_abono) ;
 			}else{
 				return $this->fecha_abono ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getMontoabono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->montoabono) ;
 			}else{
 				return $this->montoabono ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getTipoPago($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tipo_pago) ;
 			}else{
 				return $this->tipo_pago ;
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
			$sql="SELECT * FROM deudores WHERE id = ?";

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

			$this->setIdDeudores( $res['id_deudores'] );
			$this->setIdVenta( $res['id_venta'] );
			$this->setFechaAbono( $res['fecha_abono'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setStatus( $res['status'] );
			$this->setMontoabono( $res['montoabono'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setTipoPago( $res['tipo_pago'] );
			return true;
		}
		// end function load

}
