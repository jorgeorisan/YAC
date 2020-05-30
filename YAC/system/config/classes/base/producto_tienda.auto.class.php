<?php 

	class AutoProductoTienda {

	// Variables
		protected $db;
		
		protected $id_productotienda = 0;
		protected $existencias = 0;
		protected $status = "";
		protected $tienda_id_tienda = 0;
		protected $id_producto = "";
		protected $alerta_minima = 0;
		protected $fecha_actualizacion = "";
		protected $usuario_actualizacion = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$productoTienda = new ProductoTienda();
			$productoTienda->setId( $id );
			return $productoTienda;
		}
		public static function constructWithValues( $values ){
			$productoTienda = new ProductoTienda();
			$productoTienda->setValues( $values );
			return $productoTienda;
		}


	// Setter Methods
		public function setIdProductotienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTOTIENDA","i") ) 
 				$this->id_productotienda = $value;
		}
		
		public function setExistencias( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXISTENCIAS","d") ) 
 				$this->existencias = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setTiendaIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIENDAIDTIENDA","i") ) 
 				$this->tienda_id_tienda = $value;
		}
		
		public function setIdProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTO","s") ) 
 				$this->id_producto = $value;
		}
		
		public function setAlertaMinima( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ALERTAMINIMA","d") ) 
 				$this->alerta_minima = $value;
		}
		
		public function setFechaActualizacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAACTUALIZACION","s") ) 
 				$this->fecha_actualizacion = $value;
		}
		
		public function setUsuarioActualizacion( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USUARIOACTUALIZACION","s") ) 
 				$this->usuario_actualizacion = $value;
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
		public function getIdProductotienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_productotienda) ;
 			}else{
 				return $this->id_productotienda ;
 			}
		}
		
		public function getExistencias($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->existencias) ;
 			}else{
 				return $this->existencias ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getTiendaIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tienda_id_tienda) ;
 			}else{
 				return $this->tienda_id_tienda ;
 			}
		}
		
		public function getIdProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_producto) ;
 			}else{
 				return $this->id_producto ;
 			}
		}
		
		public function getAlertaMinima($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->alerta_minima) ;
 			}else{
 				return $this->alerta_minima ;
 			}
		}
		
		public function getFechaActualizacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_actualizacion) ;
 			}else{
 				return $this->fecha_actualizacion ;
 			}
		}
		
		public function getUsuarioActualizacion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->usuario_actualizacion) ;
 			}else{
 				return $this->usuario_actualizacion ;
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
			$sql="SELECT * FROM producto_tienda WHERE id = ?";

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

			$this->setIdProductotienda( $res['id_productotienda'] );
			$this->setExistencias( $res['existencias'] );
			$this->setStatus( $res['status'] );
			$this->setTiendaIdTienda( $res['tienda_id_tienda'] );
			$this->setIdProducto( $res['id_producto'] );
			$this->setAlertaMinima( $res['alerta_minima'] );
			$this->setFechaActualizacion( $res['fecha_actualizacion'] );
			$this->setUsuarioActualizacion( $res['usuario_actualizacion'] );
			return true;
		}
		// end function load

}
