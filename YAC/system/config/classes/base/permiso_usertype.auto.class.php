<?php 

	class AutoPermisoUsertype {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_permiso = 0;
		protected $id_usertype = 0;
		protected $status = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$permisoUsertype = new PermisoUsertype();
			$permisoUsertype->setId( $id );
			return $permisoUsertype;
		}
		public static function constructWithValues( $values ){
			$permisoUsertype = new PermisoUsertype();
			$permisoUsertype->setValues( $values );
			return $permisoUsertype;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdPermiso( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERMISO","i") ) 
 				$this->id_permiso = $value;
		}
		
		public function setIdUsertype( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSERTYPE","i") ) 
 				$this->id_usertype = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
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
		
		public function getIdPermiso($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_permiso) ;
 			}else{
 				return $this->id_permiso ;
 			}
		}
		
		public function getIdUsertype($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usertype) ;
 			}else{
 				return $this->id_usertype ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
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
			$sql="SELECT * FROM permiso_usertype WHERE id = ?";

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
			$this->setIdPermiso( $res['id_permiso'] );
			$this->setIdUsertype( $res['id_usertype'] );
			$this->setStatus( $res['status'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO permiso_usertype SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_permiso` = ? ,";
			$sql .= " `id_usertype` = ? ,";
			$sql .= " `status` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE permiso_usertype SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_permiso` = ? ,";
			$sql .= " `id_usertype` = ? ,";
			$sql .= " `status` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_permiso );
			$stmt->mbind_param( 'i', $this->id_usertype );
			$stmt->mbind_param( 's', $this->status );
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
				$sql = "UPDATE permiso_usertype SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_permiso",$fieldstoupdate)){
				$sql .= " `id_permiso` = ? ,";
			}
			if (in_array("id_usertype",$fieldstoupdate)){
				$sql .= " `id_usertype` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_permiso",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idPermiso  );
			}
			if (in_array("id_usertype",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUsertype  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
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
			$sql="SELECT id FROM permiso_usertype WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new PermisoUsertype();
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
