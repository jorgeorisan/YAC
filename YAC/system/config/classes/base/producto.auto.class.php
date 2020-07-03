<?php 

	class Autoproducto {

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
		protected $status = "";
		protected $codbarras = "";
		protected $fecha_registro = "";
		protected $codinter = "";
		protected $paquete = "";
		protected $alerta_minima = 0;
		protected $precio_costo = 0;
		protected $imagen = "";
		protected $manual = 0;
		protected $precio_editable = 0;
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $status_categoria = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$producto = new producto();
			$producto->setId( $id );
			return $producto;
		}
		public static function constructWithValues( $values ){
			$producto = new producto();
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
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setCodbarras( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODBARRAS","s") ) 
 				$this->codbarras = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setCodinter( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODINTER","s") ) 
 				$this->codinter = $value;
		}
		
		public function setPaquete( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PAQUETE","s") ) 
 				$this->paquete = $value;
		}
		
		public function setAlertaMinima( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ALERTAMINIMA","d") ) 
 				$this->alerta_minima = $value;
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
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setStatusCategoria( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUSCATEGORIA","s") ) 
 				$this->status_categoria = $value;
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
		
		public function getUpdatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_date) ;
 			}else{
 				return $this->updated_date ;
 			}
		}
		
		public function getDeletedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->deleted_date) ;
 			}else{
 				return $this->deleted_date ;
 			}
		}
		
		public function getStatusCategoria($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status_categoria) ;
 			}else{
 				return $this->status_categoria ;
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
			$sql="SELECT * FROM Producto WHERE id = ?";

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
			$this->setStatus( $res['status'] );
			$this->setCodbarras( $res['codbarras'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setCodinter( $res['codinter'] );
			$this->setPaquete( $res['paquete'] );
			$this->setAlertaMinima( $res['alerta_minima'] );
			$this->setPrecioCosto( $res['precio_costo'] );
			$this->setImagen( $res['imagen'] );
			$this->setManual( $res['manual'] );
			$this->setPrecioEditable( $res['precio_editable'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setStatusCategoria( $res['status_categoria'] );
			return true;
		}
		// end function load

}
