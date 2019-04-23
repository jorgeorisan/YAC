<?php 

	class AutoVenta {

	// Variables
		protected $db;
		
		protected $id_venta = "";
		protected $fecha = "";
		protected $usuariosventa = "";
		protected $total = 0;
		protected $tipo = "";
		protected $factura = "";
		protected $no_calculable = "";
		protected $ticket_items = "";
		protected $cancelado = "";
		protected $id_usuario = "";
		protected $id_persona = "";
		protected $id_tienda = 0;
		protected $consignacion = "";
		protected $icredito = "";
		protected $folio = 0;
		protected $comentarios = "";
		protected $credencial = "";

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
		
		public function setUsuariosventa( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOSVENTA","s") ) 
 				$this->usuariosventa = $value;
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
		
		public function setNoCalculable( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOCALCULABLE","s") ) 
 				$this->no_calculable = $value;
		}
		
		public function setTicketItems( $value ){ 				$this->ticket_items = $value;
		}
		
		public function setCancelado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANCELADO","s") ) 
 				$this->cancelado = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setIdPersona( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONA","s") ) 
 				$this->id_persona = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setConsignacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CONSIGNACION","s") ) 
 				$this->consignacion = $value;
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
		
		public function getUsuariosventa($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuariosventa) ;
 			}else{
 				return $this->usuariosventa ;
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
		
		public function getNoCalculable($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->no_calculable) ;
 			}else{
 				return $this->no_calculable ;
 			}
		}
		
		public function getTicketItems($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ticket_items) ;
 			}else{
 				return $this->ticket_items ;
 			}
		}
		
		public function getCancelado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cancelado) ;
 			}else{
 				return $this->cancelado ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
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
		
		public function getConsignacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->consignacion) ;
 			}else{
 				return $this->consignacion ;
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
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
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
			$this->setUsuariosventa( $res['usuariosventa'] );
			$this->setTotal( $res['total'] );
			$this->setTipo( $res['tipo'] );
			$this->setFactura( $res['factura'] );
			$this->setNoCalculable( $res['no_calculable'] );
			$this->setTicketItems( $res['ticket_items'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setIdPersona( $res['id_persona'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setConsignacion( $res['consignacion'] );
			$this->setIcredito( $res['icredito'] );
			$this->setFolio( $res['folio'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setCredencial( $res['credencial'] );
			return true;
		}
		// end function load

}