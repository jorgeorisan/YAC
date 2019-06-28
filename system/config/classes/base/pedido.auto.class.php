<?php 

	class AutoPedido {

	// Variables
		protected $db;
		
		protected $id_pedido = 0;
		protected $id_tienda = 0;
		protected $id_usuario = "";
		protected $id_user = 0;
		protected $fecha_registro = "";
		protected $fecha = "";
		protected $costo_total = 0;
		protected $total = 0;
		protected $concepto = "";
		protected $folio = "";
		protected $referencia = "";
		protected $cancelado = "";
		protected $comentarios = "";
		protected $status = "";
		protected $ticket_items = "";
		protected $tipo_pago = "";
		protected $icredito = 0;
		protected $fecha_validacion = "";
		protected $usuario_validacion = 0;
		protected $usuario_deleted = 0;
		protected $deleted_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$pedido = new Pedido();
			$pedido->setId( $id );
			return $pedido;
		}
		public static function constructWithValues( $values ){
			$pedido = new Pedido();
			$pedido->setValues( $values );
			return $pedido;
		}


	// Setter Methods
		public function setIdPedido( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPEDIDO","i") ) 
 				$this->id_pedido = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setFecha( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHA","s") ) 
 				$this->fecha = $value;
		}
		
		public function setCostoTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOTOTAL","d") ) 
 				$this->costo_total = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setConcepto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CONCEPTO","s") ) 
 				$this->concepto = $value;
		}
		
		public function setFolio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FOLIO","s") ) 
 				$this->folio = $value;
		}
		
		public function setReferencia( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "REFERENCIA","s") ) 
 				$this->referencia = $value;
		}
		
		public function setCancelado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANCELADO","s") ) 
 				$this->cancelado = $value;
		}
		
		public function setComentarios( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMENTARIOS","s") ) 
 				$this->comentarios = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setTicketItems( $value ){ 				$this->ticket_items = $value;
		}
		
		public function setTipoPago( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIPOPAGO","s") ) 
 				$this->tipo_pago = $value;
		}
		
		public function setIcredito( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ICREDITO","i") ) 
 				$this->icredito = $value;
		}
		
		public function setFechaValidacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAVALIDACION","s") ) 
 				$this->fecha_validacion = $value;
		}
		
		public function setUsuarioValidacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOVALIDACION","i") ) 
 				$this->usuario_validacion = $value;
		}
		
		public function setUsuarioDeleted( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIODELETED","i") ) 
 				$this->usuario_deleted = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
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
		public function getIdPedido($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_pedido) ;
 			}else{
 				return $this->id_pedido ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getFecha($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha) ;
 			}else{
 				return $this->fecha ;
 			}
		}
		
		public function getCostoTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo_total) ;
 			}else{
 				return $this->costo_total ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getConcepto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->concepto) ;
 			}else{
 				return $this->concepto ;
 			}
		}
		
		public function getFolio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->folio) ;
 			}else{
 				return $this->folio ;
 			}
		}
		
		public function getReferencia($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->referencia) ;
 			}else{
 				return $this->referencia ;
 			}
		}
		
		public function getCancelado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cancelado) ;
 			}else{
 				return $this->cancelado ;
 			}
		}
		
		public function getComentarios($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comentarios) ;
 			}else{
 				return $this->comentarios ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getTicketItems($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ticket_items) ;
 			}else{
 				return $this->ticket_items ;
 			}
		}
		
		public function getTipoPago($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tipo_pago) ;
 			}else{
 				return $this->tipo_pago ;
 			}
		}
		
		public function getIcredito($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->icredito) ;
 			}else{
 				return $this->icredito ;
 			}
		}
		
		public function getFechaValidacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_validacion) ;
 			}else{
 				return $this->fecha_validacion ;
 			}
		}
		
		public function getUsuarioValidacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_validacion) ;
 			}else{
 				return $this->usuario_validacion ;
 			}
		}
		
		public function getUsuarioDeleted($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_deleted) ;
 			}else{
 				return $this->usuario_deleted ;
 			}
		}
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
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
			$sql="SELECT * FROM pedido WHERE id = ?";

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

			$this->setIdPedido( $res['id_pedido'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setIdUser( $res['id_user'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setFecha( $res['fecha'] );
			$this->setCostoTotal( $res['costo_total'] );
			$this->setTotal( $res['total'] );
			$this->setConcepto( $res['concepto'] );
			$this->setFolio( $res['folio'] );
			$this->setReferencia( $res['referencia'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setStatus( $res['status'] );
			$this->setTicketItems( $res['ticket_items'] );
			$this->setTipoPago( $res['tipo_pago'] );
			$this->setIcredito( $res['icredito'] );
			$this->setFechaValidacion( $res['fecha_validacion'] );
			$this->setUsuarioValidacion( $res['usuario_validacion'] );
			$this->setUsuarioDeleted( $res['usuario_deleted'] );
			$this->setDeletedDate( $res['deleted_date'] );
			return true;
		}
		// end function load

}
