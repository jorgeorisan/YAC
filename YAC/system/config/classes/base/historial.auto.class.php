<?php 

	class AutoHistorial {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_persona = "";
		protected $id_tienda = 0;
		protected $id_user = 0;
		protected $id_cita = 0;
		protected $folio = "";
		protected $total_deuda = 0;
		protected $total = 0;
		protected $descuento_aplicado = 0;
		protected $detalles_descuento = "";
		protected $observaciones = "";
		protected $status = "";
		protected $recomendaciones = "";
		protected $receta = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $user_delete = 0;

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$historial = new Historial();
			$historial->setId( $id );
			return $historial;
		}
		public static function constructWithValues( $values ){
			$historial = new Historial();
			$historial->setValues( $values );
			return $historial;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdPersona( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONA","s") ) 
 				$this->id_persona = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setIdCita( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCITA","i") ) 
 				$this->id_cita = $value;
		}
		
		public function setFolio( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FOLIO","s") ) 
 				$this->folio = $value;
		}
		
		public function setTotalDeuda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTALDEUDA","d") ) 
 				$this->total_deuda = $value;
		}
		
		public function setTotal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOTAL","d") ) 
 				$this->total = $value;
		}
		
		public function setDescuentoAplicado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DESCUENTOAPLICADO","d") ) 
 				$this->descuento_aplicado = $value;
		}
		
		public function setDetallesDescuento( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DETALLESDESCUENTO","s") ) 
 				$this->detalles_descuento = $value;
		}
		
		public function setObservaciones( $value ){ 				$this->observaciones = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setRecomendaciones( $value ){ 				$this->recomendaciones = $value;
		}
		
		public function setReceta( $value ){ 				$this->receta = $value;
		}
		
		public function setCreatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CREATEDDATE","s") ) 
 				$this->created_date = $value;
		}
		
		public function setUpdatedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "UPDATEDDATE","s") ) 
 				$this->updated_date = $value;
		}
		
		public function setDeletedDate( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DELETEDDATE","s") ) 
 				$this->deleted_date = $value;
		}
		
		public function setUserDelete( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "USERDELETE","i") ) 
 				$this->user_delete = $value;
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
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getIdCita($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_cita) ;
 			}else{
 				return $this->id_cita ;
 			}
		}
		
		public function getFolio($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->folio) ;
 			}else{
 				return $this->folio ;
 			}
		}
		
		public function getTotalDeuda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total_deuda) ;
 			}else{
 				return $this->total_deuda ;
 			}
		}
		
		public function getTotal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->total) ;
 			}else{
 				return $this->total ;
 			}
		}
		
		public function getDescuentoAplicado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->descuento_aplicado) ;
 			}else{
 				return $this->descuento_aplicado ;
 			}
		}
		
		public function getDetallesDescuento($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->detalles_descuento) ;
 			}else{
 				return $this->detalles_descuento ;
 			}
		}
		
		public function getObservaciones($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->observaciones) ;
 			}else{
 				return $this->observaciones ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getRecomendaciones($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->recomendaciones) ;
 			}else{
 				return $this->recomendaciones ;
 			}
		}
		
		public function getReceta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->receta) ;
 			}else{
 				return $this->receta ;
 			}
		}
		
		public function getCreatedDate($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->created_date) ;
 			}else{
 				return $this->created_date ;
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
		
		public function getUserDelete($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->user_delete) ;
 			}else{
 				return $this->user_delete ;
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
			$sql="SELECT * FROM historial WHERE id = ?";

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
			$this->setIdPersona( $res['id_persona'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setIdUser( $res['id_user'] );
			$this->setIdCita( $res['id_cita'] );
			$this->setFolio( $res['folio'] );
			$this->setTotalDeuda( $res['total_deuda'] );
			$this->setTotal( $res['total'] );
			$this->setDescuentoAplicado( $res['descuento_aplicado'] );
			$this->setDetallesDescuento( $res['detalles_descuento'] );
			$this->setObservaciones( $res['observaciones'] );
			$this->setStatus( $res['status'] );
			$this->setRecomendaciones( $res['recomendaciones'] );
			$this->setReceta( $res['receta'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setUserDelete( $res['user_delete'] );
			return true;
		}
		// end function load

}
