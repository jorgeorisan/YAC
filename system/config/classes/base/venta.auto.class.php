<?php 

	class AutoVenta {

	// Variables
		protected $db;
		
		protected $id_venta = "";
		protected $fecha = "";
		protected $total = 0;
		protected $tipo = "";
		protected $factura = "";
		protected $cancelado = "";
		protected $id_persona = "";
		protected $id_tienda = 0;
		protected $id_user = 0;
		protected $icredito = "";
		protected $folio = 0;
		protected $comentarios = "";
		protected $credencial = "";
		protected $fecha_cancelacion = "";
		protected $razon_cancelacion = "";
		protected $usuario_cancelacion = "";
		protected $descuento = 0;
		protected $fecha_registro = "";
		protected $id_user_registro = 0;
		protected $sorteo = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$venta = new Venta();
			$venta->setId( $id );
			return $venta;
		}
		public static function constructWithValues( $values ){
			$venta = new Venta();
			$venta->setValues( $values );
			return $venta;
		}


	// Setter Methods
		public function setIdVenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVENTA","s") ) 
 				$this->id_venta = $value;
		}
		
		public function setFecha( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHA","s") ) 
 				$this->fecha = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIPO","s") ) 
 				$this->tipo = $value;
		}
		
		public function setFactura( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FACTURA","s") ) 
 				$this->factura = $value;
		}
		
		public function setCancelado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANCELADO","s") ) 
 				$this->cancelado = $value;
		}
		
		public function setIdPersona( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONA","s") ) 
 				$this->id_persona = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIcredito( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ICREDITO","s") ) 
 				$this->icredito = $value;
		}
		
		public function setFolio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FOLIO","i") ) 
 				$this->folio = $value;
		}
		
		public function setComentarios( $value ){ 				$this->comentarios = $value;
		}
		
		public function setCredencial( $value ){ 				$this->credencial = $value;
		}
		
		public function setFechaCancelacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHACANCELACION","s") ) 
 				$this->fecha_cancelacion = $value;
		}
		
		public function setRazonCancelacion( $value ){ 				$this->razon_cancelacion = $value;
		}
		
		public function setUsuarioCancelacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOCANCELACION","s") ) 
 				$this->usuario_cancelacion = $value;
		}
		
		public function setDescuento( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCUENTO","d") ) 
 				$this->descuento = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setIdUserRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSERREGISTRO","i") ) 
 				$this->id_user_registro = $value;
		}
		
		public function setSorteo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SORTEO","s") ) 
 				$this->sorteo = $value;
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
		public function getIdVenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_venta) ;
 			}else{
 				return $this->id_venta ;
 			}
		}
		
		public function getFecha($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha) ;
 			}else{
 				return $this->fecha ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tipo) ;
 			}else{
 				return $this->tipo ;
 			}
		}
		
		public function getFactura($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->factura) ;
 			}else{
 				return $this->factura ;
 			}
		}
		
		public function getCancelado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cancelado) ;
 			}else{
 				return $this->cancelado ;
 			}
		}
		
		public function getIdPersona($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_persona) ;
 			}else{
 				return $this->id_persona ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getIcredito($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->icredito) ;
 			}else{
 				return $this->icredito ;
 			}
		}
		
		public function getFolio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->folio) ;
 			}else{
 				return $this->folio ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getCredencial($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->credencial) ;
 			}else{
 				return $this->credencial ;
 			}
		}
		
		public function getFechaCancelacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_cancelacion) ;
 			}else{
 				return $this->fecha_cancelacion ;
 			}
		}
		
		public function getRazonCancelacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->razon_cancelacion) ;
 			}else{
 				return $this->razon_cancelacion ;
 			}
		}
		
		public function getUsuarioCancelacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_cancelacion) ;
 			}else{
 				return $this->usuario_cancelacion ;
 			}
		}
		
		public function getDescuento($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descuento) ;
 			}else{
 				return $this->descuento ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getIdUserRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user_registro) ;
 			}else{
 				return $this->id_user_registro ;
 			}
		}
		
		public function getSorteo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->sorteo) ;
 			}else{
 				return $this->sorteo ;
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
			$sql="SELECT * FROM venta WHERE id = ?";

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

			$this->setIdVenta( $res['id_venta'] );
			$this->setFecha( $res['fecha'] );
			$this->setTotal( $res['total'] );
			$this->setTipo( $res['tipo'] );
			$this->setFactura( $res['factura'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setIdPersona( $res['id_persona'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setIdUser( $res['id_user'] );
			$this->setIcredito( $res['icredito'] );
			$this->setFolio( $res['folio'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setCredencial( $res['credencial'] );
			$this->setFechaCancelacion( $res['fecha_cancelacion'] );
			$this->setRazonCancelacion( $res['razon_cancelacion'] );
			$this->setUsuarioCancelacion( $res['usuario_cancelacion'] );
			$this->setDescuento( $res['descuento'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setIdUserRegistro( $res['id_user_registro'] );
			$this->setSorteo( $res['sorteo'] );
			return true;
		}
		// end function load

}
