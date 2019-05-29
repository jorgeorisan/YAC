<?php 

	class AutoPedidoProducto {

	// Variables
		protected $db;
		
		protected $id_pedido_producto = 0;
		protected $id_producto = "";
		protected $nombre = "";
		protected $cantidad = 0;
		protected $status = "";
		protected $costo = 0;
		protected $mayoreo = 0;
		protected $precio = 0;
		protected $id_pedido = 0;
		protected $totalcosto = 0;
		protected $id_tienda = 0;
		protected $cancelado = "";
		protected $cantidad_anterior = 0;
		protected $precio_costo = 0;
		protected $fecha_registro = "";
		protected $act_inventario = 0;
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
			$pedidoProducto = new PedidoProducto();
			$pedidoProducto->setId( $id );
			return $pedidoProducto;
		}
		public static function constructWithValues( $values ){
			$pedidoProducto = new PedidoProducto();
			$pedidoProducto->setValues( $values );
			return $pedidoProducto;
		}


	// Setter Methods
		public function setIdPedidoProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPEDIDOPRODUCTO","i") ) 
 				$this->id_pedido_producto = $value;
		}
		
		public function setIdProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTO","s") ) 
 				$this->id_producto = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
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
		
		public function setIdPedido( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPEDIDO","i") ) 
 				$this->id_pedido = $value;
		}
		
		public function setTotalcosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALCOSTO","d") ) 
 				$this->totalcosto = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setCancelado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANCELADO","s") ) 
 				$this->cancelado = $value;
		}
		
		public function setCantidadAnterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDADANTERIOR","d") ) 
 				$this->cantidad_anterior = $value;
		}
		
		public function setPrecioCosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIOCOSTO","d") ) 
 				$this->precio_costo = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setActInventario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ACTINVENTARIO","i") ) 
 				$this->act_inventario = $value;
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
		public function getIdPedidoProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_pedido_producto) ;
 			}else{
 				return $this->id_pedido_producto ;
 			}
		}
		
		public function getIdProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_producto) ;
 			}else{
 				return $this->id_producto ;
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
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
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
		
		public function getIdPedido($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_pedido) ;
 			}else{
 				return $this->id_pedido ;
 			}
		}
		
		public function getTotalcosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->totalcosto) ;
 			}else{
 				return $this->totalcosto ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getCancelado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cancelado) ;
 			}else{
 				return $this->cancelado ;
 			}
		}
		
		public function getCantidadAnterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad_anterior) ;
 			}else{
 				return $this->cantidad_anterior ;
 			}
		}
		
		public function getPrecioCosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio_costo) ;
 			}else{
 				return $this->precio_costo ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getActInventario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->act_inventario) ;
 			}else{
 				return $this->act_inventario ;
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
			$sql="SELECT * FROM pedido_producto WHERE id = ?";

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

			$this->setIdPedidoProducto( $res['id_pedido_producto'] );
			$this->setIdProducto( $res['id_producto'] );
			$this->setNombre( $res['nombre'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setStatus( $res['status'] );
			$this->setCosto( $res['costo'] );
			$this->setMayoreo( $res['mayoreo'] );
			$this->setPrecio( $res['precio'] );
			$this->setIdPedido( $res['id_pedido'] );
			$this->setTotalcosto( $res['totalcosto'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setCantidadAnterior( $res['cantidad_anterior'] );
			$this->setPrecioCosto( $res['precio_costo'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setActInventario( $res['act_inventario'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setUsuarioDeleted( $res['usuario_deleted'] );
			return true;
		}
		// end function load

}
