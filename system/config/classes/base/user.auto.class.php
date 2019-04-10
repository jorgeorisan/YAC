<?php 

	class AutoUser {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_clinica = 0;
		protected $email = "";
		protected $nombre = "";
		protected $apellido_pat = "";
		protected $apellido_mat = "";
		protected $initials = "";
		protected $password = "";
		protected $type = "";
		protected $status = "";
		protected $comision = 0;
		protected $token = "";
		protected $token_expires = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $direccion = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$user = new User();
			$user->setId( $id );
			return $user;
		}
		public static function constructWithValues( $values ){
			$user = new User();
			$user->setValues( $values );
			return $user;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdClinica( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTALLER","i") ) 
 				$this->id_clinica = $value;
		}
		
		public function setEmail( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setApellidoPat( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "APELLIDOPAT","s") ) 
 				$this->apellido_pat = $value;
		}
		
		public function setApellidoMat( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "APELLIDOMAT","s") ) 
 				$this->apellido_mat = $value;
		}
		
		public function setInitials( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "INITIALS","s") ) 
 				$this->initials = $value;
		}
		
		public function setPassword( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PASSWORD","s") ) 
 				$this->password = $value;
		}
		
		public function setType( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TYPE","s") ) 
 				$this->type = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setComision( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMISION","i") ) 
 				$this->comision = $value;
		}
		
		public function setToken( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOKEN","s") ) 
 				$this->token = $value;
		}
		
		public function setTokenExpires( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TOKENEXPIRES","s") ) 
 				$this->token_expires = $value;
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
		
		public function setDireccion( $value ){ 				$this->direccion = $value;
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
		
		public function getIdClinica($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_clinica) ;
 			}else{
 				return $this->id_clinica ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getApellidoPat($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->apellido_pat) ;
 			}else{
 				return $this->apellido_pat ;
 			}
		}
		
		public function getApellidoMat($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->apellido_mat) ;
 			}else{
 				return $this->apellido_mat ;
 			}
		}
		
		public function getInitials($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->initials) ;
 			}else{
 				return $this->initials ;
 			}
		}
		
		public function getPassword($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->password) ;
 			}else{
 				return $this->password ;
 			}
		}
		
		public function getType($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->type) ;
 			}else{
 				return $this->type ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getComision($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comision) ;
 			}else{
 				return $this->comision ;
 			}
		}
		
		public function getToken($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token) ;
 			}else{
 				return $this->token ;
 			}
		}
		
		public function getTokenExpires($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->token_expires) ;
 			}else{
 				return $this->token_expires ;
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
		
		public function getDireccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->direccion) ;
 			}else{
 				return $this->direccion ;
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
			$sql="SELECT * FROM user WHERE id = ?";

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
			$this->setIdClinica( $res['id_clinica'] );
			$this->setEmail( $res['email'] );
			$this->setNombre( $res['nombre'] );
			$this->setApellidoPat( $res['apellido_pat'] );
			$this->setApellidoMat( $res['apellido_mat'] );
			$this->setInitials( $res['initials'] );
			$this->setPassword( $res['password'] );
			$this->setType( $res['type'] );
			$this->setStatus( $res['status'] );
			$this->setComision( $res['comision'] );
			$this->setToken( $res['token'] );
			$this->setTokenExpires( $res['token_expires'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setDireccion( $res['direccion'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO user SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_clinica` = ? ,";
			$sql .= " `email` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `apellido_pat` = ? ,";
			$sql .= " `apellido_mat` = ? ,";
			$sql .= " `initials` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `type` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comision` = ? ,";
			$sql .= " `token` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE user SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_clinica` = ? ,";
			$sql .= " `email` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `apellido_pat` = ? ,";
			$sql .= " `apellido_mat` = ? ,";
			$sql .= " `initials` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `type` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `comision` = ? ,";
			$sql .= " `token` = ? ,";
			$sql .= " `token_expires` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_clinica );
			$stmt->mbind_param( 's', $this->email );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->apellido_pat );
			$stmt->mbind_param( 's', $this->apellido_mat );
			$stmt->mbind_param( 's', $this->initials );
			$stmt->mbind_param( 's', $this->password );
			$stmt->mbind_param( 's', $this->type );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 'i', $this->comision );
			$stmt->mbind_param( 's', $this->token );
			$stmt->mbind_param( 's', $this->token_expires );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
			$stmt->mbind_param( 's', $this->direccion );
			if ($this->getId()>0){
				$stmt->mbind_param( 'i', $this->id  );
			} // end save

			$stmt->execute();
			if ($this->getId()==0){
				$this->setId( $this->db->insert_id );
			}
			return $this->getId();
		}
		

		public function updateFields($fieldstoupdate) {
			if ($this->getId()==0){ // insert new
				// only updates no save new here
			} else { // updated existing
				$sql = "UPDATE user SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_clinica",$fieldstoupdate)){
				$sql .= " `id_clinica` = ? ,";
			}
			if (in_array("email",$fieldstoupdate)){
				$sql .= " `email` = ? ,";
			}
			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("apellido_pat",$fieldstoupdate)){
				$sql .= " `apellido_pat` = ? ,";
			}
			if (in_array("apellido_mat",$fieldstoupdate)){
				$sql .= " `apellido_mat` = ? ,";
			}
			if (in_array("initials",$fieldstoupdate)){
				$sql .= " `initials` = ? ,";
			}
			if (in_array("password",$fieldstoupdate)){
				$sql .= " `password` = ? ,";
			}
			if (in_array("type",$fieldstoupdate)){
				$sql .= " `type` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("comision",$fieldstoupdate)){
				$sql .= " `comision` = ? ,";
			}
			if (in_array("token",$fieldstoupdate)){
				$sql .= " `token` = ? ,";
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$sql .= " `token_expires` = ? ,";
			}
			if (in_array("created_date",$fieldstoupdate)){
				$sql .= " `created_date` = ? ,";
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$sql .= " `updated_date` = ? ,";
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$sql .= " `deleted_date` = ? ,";
			}
			if (in_array("direccion",$fieldstoupdate)){
				$sql .= " `direccion` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_clinica",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idClinica  );
			}
			if (in_array("email",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->email  );
			}
			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("apellido_pat",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->apellidoPat  );
			}
			if (in_array("apellido_mat",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->apellidoMat  );
			}
			if (in_array("initials",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->initials  );
			}
			if (in_array("password",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->password  );
			}
			if (in_array("type",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->type  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("comision",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->comision  );
			}
			if (in_array("token",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->token  );
			}
			if (in_array("token_expires",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->tokenExpires  );
			}
			if (in_array("created_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->createdDate  );
			}
			if (in_array("updated_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->updatedDate  );
			}
			if (in_array("deleted_date",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->deletedDate  );
			}
			if (in_array("direccion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->direccion  );
			}
			if ($this->getId()>0){
				$stmt->mbind_param( 'i', $this->getId()  );
			}

			$stmt->execute();
			//if ($this->getId()==0){
			//	$this->setId( $this->db->insert_id );
			//}
			return $this->getId();
		}  // updateFields
		

		public function getAll() {
			$sql="SELECT id FROM user WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new User();
				$retval[$id[0]]->load($id[0]);
			}
			return $retval;
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

}
