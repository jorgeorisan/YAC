<?php 

	class AutoTraspaso {

	// Variables
		protected $db;
		
		protected $id_traspaso = 0;
		protected $fecha_registro = "";
		protected $fecha = "";
		protected $costo_total = 0;
		protected $total = 0;
		protected $concepto = "";
		protected $folio = "";
		protected $referencia = "";
		protected $cancelado = "";
		protected $id_usuario = "";
		protected $id_tienda = 0;
		protected $comentarios = "";
		protected $status = "";
		protected $fecha_validacion = "";
		protected $usuario_validacion = "";
		protected $usuario_deleted = "";
		protected $deleted_date = "";
		protected $ticket_items = "";
		protected $id_tiendaanterior = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$traspaso = new Traspaso();
			$traspaso->setId( $id );
			return $traspaso;
		}
		public static function constructWithValues( $values ){
			$traspaso = new Traspaso();
			$traspaso->setValues( $values );
			return $traspaso;
		}


	// Setter Methods
		public function setIdTraspaso( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTRASPASO","i") ) 
 				$this->id_traspaso = $value;
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
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setComentarios( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMENTARIOS","s") ) 
 				$this->comentarios = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setFechaValidacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAVALIDACION","s") ) 
 				$this->fecha_validacion = $value;
		}
		
		public function setUsuarioValidacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOVALIDACION","s") ) 
 				$this->usuario_validacion = $value;
		}
		
		public function setUsuarioDeleted( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIODELETED","s") ) 
 				$this->usuario_deleted = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setTicketItems( $value ){ 				$this->ticket_items = $value;
		}
		
		public function setIdTiendaanterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDAANTERIOR","i") ) 
 				$this->id_tiendaanterior = $value;
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
		public function getIdTraspaso($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_traspaso) ;
 			}else{
 				return $this->id_traspaso ;
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
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
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
		
		public function getTicketItems($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ticket_items) ;
 			}else{
 				return $this->ticket_items ;
 			}
		}
		
		public function getIdTiendaanterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tiendaanterior) ;
 			}else{
 				return $this->id_tiendaanterior ;
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
			$sql="SELECT * FROM traspaso WHERE id = ?";

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

			$this->setIdTraspaso( $res['id_traspaso'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setFecha( $res['fecha'] );
			$this->setCostoTotal( $res['costo_total'] );
			$this->setTotal( $res['total'] );
			$this->setConcepto( $res['concepto'] );
			$this->setFolio( $res['folio'] );
			$this->setReferencia( $res['referencia'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setComentarios( $res['comentarios'] );
			$this->setStatus( $res['status'] );
			$this->setFechaValidacion( $res['fecha_validacion'] );
			$this->setUsuarioValidacion( $res['usuario_validacion'] );
			$this->setUsuarioDeleted( $res['usuario_deleted'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setTicketItems( $res['ticket_items'] );
			$this->setIdTiendaanterior( $res['id_tiendaanterior'] );
			return true;
		}
		// end function load

}
