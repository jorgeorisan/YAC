<?php 

	class AutoCita {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_clinica = 0;
		protected $id_personal = 0;
		protected $id_paciente = 0;
		protected $id_user = 0;
		protected $motivo = "";
		protected $status = "";
		protected $fecha_inicial = "";
		protected $fecha_final = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$cita = new Cita();
			$cita->setId( $id );
			return $cita;
		}
		public static function constructWithValues( $values ){
			$cita = new Cita();
			$cita->setValues( $values );
			return $cita;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdClinica( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCLINICA","i") ) 
 				$this->id_clinica = $value;
		}
		
		public function setIdPersonal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONAL","i") ) 
 				$this->id_personal = $value;
		}
		
		public function setIdPaciente( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPACIENTE","i") ) 
 				$this->id_paciente = $value;
		}
		
		public function setIdUser( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSER","i") ) 
 				$this->id_user = $value;
		}
		
		public function setMotivo( $value ){ 				$this->motivo = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setFechaInicial( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAINICIAL","s") ) 
 				$this->fecha_inicial = $value;
		}
		
		public function setFechaFinal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAFINAL","s") ) 
 				$this->fecha_final = $value;
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
		
		public function getIdPersonal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_personal) ;
 			}else{
 				return $this->id_personal ;
 			}
		}
		
		public function getIdPaciente($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_paciente) ;
 			}else{
 				return $this->id_paciente ;
 			}
		}
		
		public function getIdUser($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_user) ;
 			}else{
 				return $this->id_user ;
 			}
		}
		
		public function getMotivo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->motivo) ;
 			}else{
 				return $this->motivo ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getFechaInicial($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_inicial) ;
 			}else{
 				return $this->fecha_inicial ;
 			}
		}
		
		public function getFechaFinal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_final) ;
 			}else{
 				return $this->fecha_final ;
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
		
		public function getValidclass(){
			return $this->validclass;
		}
		public function getStatusclass(){
			return  $this->statusclass ;
		}

	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM cita WHERE id = ?";

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
			$this->setIdPersonal( $res['id_personal'] );
			$this->setIdPaciente( $res['id_paciente'] );
			$this->setIdUser( $res['id_user'] );
			$this->setMotivo( $res['motivo'] );
			$this->setStatus( $res['status'] );
			$this->setFechaInicial( $res['fecha_inicial'] );
			$this->setFechaFinal( $res['fecha_final'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO cita SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_clinica` = ? ,";
			$sql .= " `id_personal` = ? ,";
			$sql .= " `id_paciente` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `motivo` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `fecha_inicial` = ? ,";
			$sql .= " `fecha_final` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE cita SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_clinica` = ? ,";
			$sql .= " `id_personal` = ? ,";
			$sql .= " `id_paciente` = ? ,";
			$sql .= " `id_user` = ? ,";
			$sql .= " `motivo` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `fecha_inicial` = ? ,";
			$sql .= " `fecha_final` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_clinica );
			$stmt->mbind_param( 'i', $this->id_personal );
			$stmt->mbind_param( 'i', $this->id_paciente );
			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 's', $this->motivo );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->fecha_inicial );
			$stmt->mbind_param( 's', $this->fecha_final );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
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
				$sql = "UPDATE cita SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_clinica",$fieldstoupdate)){
				$sql .= " `id_clinica` = ? ,";
			}
			if (in_array("id_personal",$fieldstoupdate)){
				$sql .= " `id_personal` = ? ,";
			}
			if (in_array("id_paciente",$fieldstoupdate)){
				$sql .= " `id_paciente` = ? ,";
			}
			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("motivo",$fieldstoupdate)){
				$sql .= " `motivo` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("fecha_inicial",$fieldstoupdate)){
				$sql .= " `fecha_inicial` = ? ,";
			}
			if (in_array("fecha_final",$fieldstoupdate)){
				$sql .= " `fecha_final` = ? ,";
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
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_clinica",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idClinica  );
			}
			if (in_array("id_personal",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idPersonal  );
			}
			if (in_array("id_paciente",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idPaciente  );
			}
			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("motivo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->motivo  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("fecha_inicial",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaInicial  );
			}
			if (in_array("fecha_final",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->fechaFinal  );
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
			$sql="SELECT id FROM cita WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Cita();
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
