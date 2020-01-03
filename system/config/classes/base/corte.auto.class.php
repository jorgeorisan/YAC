<?php 

	class AutoCorte {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_user = 0;
		protected $id_tienda = 0;
		protected $fecha = "";
		protected $total_diferencia = 0;
		protected $status = "";
		protected $updated_at = "";
		protected $created_at = "";
		protected $total_entrada = 0;
		protected $total_salida = 0;
		protected $total_caja = 0;
		protected $total_dinero = 0;
		protected $total_cajanew = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$corte = new Corte();
			$corte->setId( $id );
			return $corte;
		}
		public static function constructWithValues( $values ){
			$corte = new Corte();
			$corte->setValues( $values );
			return $corte;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setFecha( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHA","s") ) 
 				$this->fecha = $value;
		}
		
		public function setTotalDiferencia( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALDIFERENCIA","d") ) 
 				$this->total_diferencia = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setUpdatedAt( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDAT","s") ) 
 				$this->updated_at = $value;
		}
		
		public function setCreatedAt( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDAT","s") ) 
 				$this->created_at = $value;
		}
		
		public function setTotalEntrada( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALENTRADA","d") ) 
 				$this->total_entrada = $value;
		}
		
		public function setTotalSalida( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALSALIDA","d") ) 
 				$this->total_salida = $value;
		}
		
		public function setTotalCaja( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALCAJA","d") ) 
 				$this->total_caja = $value;
		}
		
		public function setTotalDinero( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALDINERO","d") ) 
 				$this->total_dinero = $value;
		}
		
		public function setTotalCajanew( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALCAJANEW","d") ) 
 				$this->total_cajanew = $value;
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
		public function getId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id) ;
 			}else{
 				return $this->id ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getFecha($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha) ;
 			}else{
 				return $this->fecha ;
 			}
		}
		
		public function getTotalDiferencia($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_diferencia) ;
 			}else{
 				return $this->total_diferencia ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getUpdatedAt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->updated_at) ;
 			}else{
 				return $this->updated_at ;
 			}
		}
		
		public function getCreatedAt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_at) ;
 			}else{
 				return $this->created_at ;
 			}
		}
		
		public function getTotalEntrada($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_entrada) ;
 			}else{
 				return $this->total_entrada ;
 			}
		}
		
		public function getTotalSalida($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_salida) ;
 			}else{
 				return $this->total_salida ;
 			}
		}
		
		public function getTotalCaja($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_caja) ;
 			}else{
 				return $this->total_caja ;
 			}
		}
		
		public function getTotalDinero($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_dinero) ;
 			}else{
 				return $this->total_dinero ;
 			}
		}
		
		public function getTotalCajanew($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_cajanew) ;
 			}else{
 				return $this->total_cajanew ;
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
			$sql="SELECT * FROM corte WHERE id = ?";

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

			$this->setId( $res['id'] );
			$this->setIdUser( $res['id_user'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setFecha( $res['fecha'] );
			$this->setTotalDiferencia( $res['total_diferencia'] );
			$this->setStatus( $res['status'] );
			$this->setUpdatedAt( $res['updated_at'] );
			$this->setCreatedAt( $res['created_at'] );
			$this->setTotalEntrada( $res['total_entrada'] );
			$this->setTotalSalida( $res['total_salida'] );
			$this->setTotalCaja( $res['total_caja'] );
			$this->setTotalDinero( $res['total_dinero'] );
			$this->setTotalCajanew( $res['total_cajanew'] );
			return true;
		}
		// end function load

}
