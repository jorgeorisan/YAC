<?php 

	class AutoProductosVenta {

	// Variables
		protected $db;
		
		protected $id_productos_venta = "";
		protected $id_venta = "";
		protected $cantidad = 0;
		protected $nombre = "";
		protected $total = 0;
		protected $cancelado = "";
		protected $id_productotienda = 0;
		protected $costototal = 0;
		protected $status = "";
		protected $folio = 0;
		protected $paquete = 0;
		protected $tipoprecio = "";
		protected $fecha_registro = "";
		protected $fecha_cancelacion = "";
		protected $usuario_cancelacion = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$productosVenta = new ProductosVenta();
			$productosVenta->setId( $id );
			return $productosVenta;
		}
		public static function constructWithValues( $values ){
			$productosVenta = new ProductosVenta();
			$productosVenta->setValues( $values );
			return $productosVenta;
		}


	// Setter Methods
		public function setIdProductosVenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTOSVENTA","s") ) 
 				$this->id_productos_venta = $value;
		}
		
		public function setIdVenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDVENTA","s") ) 
 				$this->id_venta = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setCancelado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANCELADO","s") ) 
 				$this->cancelado = $value;
		}
		
		public function setIdProductotienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTOTIENDA","i") ) 
 				$this->id_productotienda = $value;
		}
		
		public function setCostototal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOTOTAL","d") ) 
 				$this->costototal = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setFolio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FOLIO","i") ) 
 				$this->folio = $value;
		}
		
		public function setPaquete( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PAQUETE","i") ) 
 				$this->paquete = $value;
		}
		
		public function setTipoprecio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIPOPRECIO","s") ) 
 				$this->tipoprecio = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setFechaCancelacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHACANCELACION","s") ) 
 				$this->fecha_cancelacion = $value;
		}
		
		public function setUsuarioCancelacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOCANCELACION","s") ) 
 				$this->usuario_cancelacion = $value;
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
		public function getIdProductosVenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_productos_venta) ;
 			}else{
 				return $this->id_productos_venta ;
 			}
		}
		
		public function getIdVenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_venta) ;
 			}else{
 				return $this->id_venta ;
 			}
		}
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getCancelado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cancelado) ;
 			}else{
 				return $this->cancelado ;
 			}
		}
		
		public function getIdProductotienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_productotienda) ;
 			}else{
 				return $this->id_productotienda ;
 			}
		}
		
		public function getCostototal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costototal) ;
 			}else{
 				return $this->costototal ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getFolio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->folio) ;
 			}else{
 				return $this->folio ;
 			}
		}
		
		public function getPaquete($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->paquete) ;
 			}else{
 				return $this->paquete ;
 			}
		}
		
		public function getTipoprecio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tipoprecio) ;
 			}else{
 				return $this->tipoprecio ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getFechaCancelacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_cancelacion) ;
 			}else{
 				return $this->fecha_cancelacion ;
 			}
		}
		
		public function getUsuarioCancelacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_cancelacion) ;
 			}else{
 				return $this->usuario_cancelacion ;
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
			$sql="SELECT * FROM productos_venta WHERE id = ?";

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

			$this->setIdProductosVenta( $res['id_productos_venta'] );
			$this->setIdVenta( $res['id_venta'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setNombre( $res['nombre'] );
			$this->setTotal( $res['total'] );
			$this->setCancelado( $res['cancelado'] );
			$this->setIdProductotienda( $res['id_productotienda'] );
			$this->setCostototal( $res['costototal'] );
			$this->setStatus( $res['status'] );
			$this->setFolio( $res['folio'] );
			$this->setPaquete( $res['paquete'] );
			$this->setTipoprecio( $res['tipoprecio'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setFechaCancelacion( $res['fecha_cancelacion'] );
			$this->setUsuarioCancelacion( $res['usuario_cancelacion'] );
			return true;
		}
		// end function load

}
