<?php 

	class AutoProducto {

	// Variables
		protected $db;
		
		protected $id_producto = "";
		protected $id_proveedor = 0;
		protected $id_marca = 0;
		protected $id_categoria = 0;
		protected $nombre = "";
		protected $precio = 0;
		protected $costo = 0;
		protected $precio_descuento = 0;
		protected $descuento_activado = "";
		protected $status = "";
		protected $codbarras = "";
		protected $multiplicador = 0;
		protected $fecha_registro = "";
		protected $codinter = "";
		protected $condiciones = "";
		protected $exento_iva = 0;
		protected $ieps = 0;
		protected $paquete = "";
		protected $alerta_minima = 0;
		protected $exento_ieps = "";
		protected $precio_costo = 0;
		protected $imagen = "";
		protected $manual = 0;
		protected $precio_editable = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$producto = new Producto();
			$producto->setId( $id );
			return $producto;
		}
		public static function constructWithValues( $values ){
			$producto = new Producto();
			$producto->setValues( $values );
			return $producto;
		}


	// Setter Methods
		public function setIdProducto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPRODUCTO","s") ) 
 				$this->id_producto = $value;
		}
		
		public function setIdProveedor( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPROVEEDOR","i") ) 
 				$this->id_proveedor = $value;
		}
		
		public function setIdMarca( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDMARCA","i") ) 
 				$this->id_marca = $value;
		}
		
		public function setIdCategoria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCATEGORIA","i") ) 
 				$this->id_categoria = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setPrecio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIO","d") ) 
 				$this->precio = $value;
		}
		
		public function setCosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTO","d") ) 
 				$this->costo = $value;
		}
		
		public function setPrecioDescuento( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIODESCUENTO","d") ) 
 				$this->precio_descuento = $value;
		}
		
		public function setDescuentoActivado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCUENTOACTIVADO","s") ) 
 				$this->descuento_activado = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCodbarras( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODBARRAS","s") ) 
 				$this->codbarras = $value;
		}
		
		public function setMultiplicador( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MULTIPLICADOR","d") ) 
 				$this->multiplicador = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setCodinter( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODINTER","s") ) 
 				$this->codinter = $value;
		}
		
		public function setCondiciones( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CONDICIONES","s") ) 
 				$this->condiciones = $value;
		}
		
		public function setExentoIva( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXENTOIVA","i") ) 
 				$this->exento_iva = $value;
		}
		
		public function setIeps( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IEPS","d") ) 
 				$this->ieps = $value;
		}
		
		public function setPaquete( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PAQUETE","s") ) 
 				$this->paquete = $value;
		}
		
		public function setAlertaMinima( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ALERTAMINIMA","d") ) 
 				$this->alerta_minima = $value;
		}
		
		public function setExentoIeps( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EXENTOIEPS","s") ) 
 				$this->exento_ieps = $value;
		}
		
		public function setPrecioCosto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIOCOSTO","d") ) 
 				$this->precio_costo = $value;
		}
		
		public function setImagen( $value ){ 				$this->imagen = $value;
		}
		
		public function setManual( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "MANUAL","i") ) 
 				$this->manual = $value;
		}
		
		public function setPrecioEditable( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PRECIOEDITABLE","d") ) 
 				$this->precio_editable = $value;
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
		public function getIdProducto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_producto) ;
 			}else{
 				return $this->id_producto ;
 			}
		}
		
		public function getIdProveedor($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_proveedor) ;
 			}else{
 				return $this->id_proveedor ;
 			}
		}
		
		public function getIdMarca($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_marca) ;
 			}else{
 				return $this->id_marca ;
 			}
		}
		
		public function getIdCategoria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_categoria) ;
 			}else{
 				return $this->id_categoria ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getPrecio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio) ;
 			}else{
 				return $this->precio ;
 			}
		}
		
		public function getCosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costo) ;
 			}else{
 				return $this->costo ;
 			}
		}
		
		public function getPrecioDescuento($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio_descuento) ;
 			}else{
 				return $this->precio_descuento ;
 			}
		}
		
		public function getDescuentoActivado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descuento_activado) ;
 			}else{
 				return $this->descuento_activado ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getCodbarras($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->codbarras) ;
 			}else{
 				return $this->codbarras ;
 			}
		}
		
		public function getMultiplicador($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->multiplicador) ;
 			}else{
 				return $this->multiplicador ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getCodinter($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->codinter) ;
 			}else{
 				return $this->codinter ;
 			}
		}
		
		public function getCondiciones($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->condiciones) ;
 			}else{
 				return $this->condiciones ;
 			}
		}
		
		public function getExentoIva($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->exento_iva) ;
 			}else{
 				return $this->exento_iva ;
 			}
		}
		
		public function getIeps($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ieps) ;
 			}else{
 				return $this->ieps ;
 			}
		}
		
		public function getPaquete($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->paquete) ;
 			}else{
 				return $this->paquete ;
 			}
		}
		
		public function getAlertaMinima($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->alerta_minima) ;
 			}else{
 				return $this->alerta_minima ;
 			}
		}
		
		public function getExentoIeps($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->exento_ieps) ;
 			}else{
 				return $this->exento_ieps ;
 			}
		}
		
		public function getPrecioCosto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio_costo) ;
 			}else{
 				return $this->precio_costo ;
 			}
		}
		
		public function getImagen($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->imagen) ;
 			}else{
 				return $this->imagen ;
 			}
		}
		
		public function getManual($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->manual) ;
 			}else{
 				return $this->manual ;
 			}
		}
		
		public function getPrecioEditable($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->precio_editable) ;
 			}else{
 				return $this->precio_editable ;
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
			$sql="SELECT * FROM producto WHERE id = ?";

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

			$this->setIdProducto( $res['id_producto'] );
			$this->setIdProveedor( $res['id_proveedor'] );
			$this->setIdMarca( $res['id_marca'] );
			$this->setIdCategoria( $res['id_categoria'] );
			$this->setNombre( $res['nombre'] );
			$this->setPrecio( $res['precio'] );
			$this->setCosto( $res['costo'] );
			$this->setPrecioDescuento( $res['precio_descuento'] );
			$this->setDescuentoActivado( $res['descuento_activado'] );
			$this->setStatus( $res['status'] );
			$this->setCodbarras( $res['codbarras'] );
			$this->setMultiplicador( $res['multiplicador'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setCodinter( $res['codinter'] );
			$this->setCondiciones( $res['condiciones'] );
			$this->setExentoIva( $res['exento_iva'] );
			$this->setIeps( $res['ieps'] );
			$this->setPaquete( $res['paquete'] );
			$this->setAlertaMinima( $res['alerta_minima'] );
			$this->setExentoIeps( $res['exento_ieps'] );
			$this->setPrecioCosto( $res['precio_costo'] );
			$this->setImagen( $res['imagen'] );
			$this->setManual( $res['manual'] );
			$this->setPrecioEditable( $res['precio_editable'] );
			return true;
		}
		// end function load

}
