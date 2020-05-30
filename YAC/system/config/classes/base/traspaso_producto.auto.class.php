<?php 

	class AutoTraspasoProducto {

	// Variables
		protected $db;
		
		protected $id_traspaso_producto = 0;
		protected $id_producto = "";
		protected $id_traspaso = 0;
		protected $id_tienda = 0;
		protected $nombre = "";
		protected $cantidad = 0;
		protected $costo = 0;
		protected $mayoreo = 0;
		protected $precio = 0;
		protected $totalcosto = 0;
		protected $total = 0;
		protected $cantidad_anterior = 0;
		protected $status = "";
		protected $fecha_registro = "";
		protected $deleted_date = "";
		protected $usuario_deleted = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$traspasoProducto = new TraspasoProducto();
			$traspasoProducto->setId( $id );
			return $traspasoProducto;
		}
		public static function constructWithValues( $values ){
			$traspasoProducto = new TraspasoProducto();
			$traspasoProducto->setValues( $values );
			return $traspasoProducto;
		}


	// Setter Methods
		public function setIdTraspasoProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTRASPASOPRODUCTO","i") ) 
 				$this->id_traspaso_producto = $value;
		}
		
		public function setIdProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTO","s") ) 
 				$this->id_producto = $value;
		}
		
		public function setIdTraspaso( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTRASPASO","i") ) 
 				$this->id_traspaso = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setCosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTO","d") ) 
 				$this->costo = $value;
		}
		
		public function setMayoreo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MAYOREO","d") ) 
 				$this->mayoreo = $value;
		}
		
		public function setPrecio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIO","d") ) 
 				$this->precio = $value;
		}
		
		public function setTotalcosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALCOSTO","d") ) 
 				$this->totalcosto = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setCantidadAnterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDADANTERIOR","i") ) 
 				$this->cantidad_anterior = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setUsuarioDeleted( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIODELETED","s") ) 
 				$this->usuario_deleted = $value;
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
		public function getIdTraspasoProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_traspaso_producto) ;
 			}else{
 				return $this->id_traspaso_producto ;
 			}
		}
		
		public function getIdProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_producto) ;
 			}else{
 				return $this->id_producto ;
 			}
		}
		
		public function getIdTraspaso($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_traspaso) ;
 			}else{
 				return $this->id_traspaso ;
 			}
		}
		
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
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getCosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo) ;
 			}else{
 				return $this->costo ;
 			}
		}
		
		public function getMayoreo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->mayoreo) ;
 			}else{
 				return $this->mayoreo ;
 			}
		}
		
		public function getPrecio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio) ;
 			}else{
 				return $this->precio ;
 			}
		}
		
		public function getTotalcosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->totalcosto) ;
 			}else{
 				return $this->totalcosto ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getCantidadAnterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad_anterior) ;
 			}else{
 				return $this->cantidad_anterior ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
 			}
		}
		
		public function getUsuarioDeleted($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_deleted) ;
 			}else{
 				return $this->usuario_deleted ;
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
			$sql="SELECT * FROM traspaso_producto WHERE id = ?";

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

			$this->setIdTraspasoProducto( $res['id_traspaso_producto'] );
			$this->setIdProducto( $res['id_producto'] );
			$this->setIdTraspaso( $res['id_traspaso'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setNombre( $res['nombre'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setCosto( $res['costo'] );
			$this->setMayoreo( $res['mayoreo'] );
			$this->setPrecio( $res['precio'] );
			$this->setTotalcosto( $res['totalcosto'] );
			$this->setTotal( $res['total'] );
			$this->setCantidadAnterior( $res['cantidad_anterior'] );
			$this->setStatus( $res['status'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setUsuarioDeleted( $res['usuario_deleted'] );
			return true;
		}
		// end function load

}
