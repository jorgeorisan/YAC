<?php 

	class AutoPersonal {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_user = 0;
		protected $id_clinica = 0;
		protected $id_personalpuesto = 0;
		protected $nombre = "";
		protected $apellido_pat = "";
		protected $apellido_mat = "";
		protected $telefono = "";
		protected $calle = "";
		protected $num_int = "";
		protected $num_ext = "";
		protected $email = "";
		protected $cp = "";
		protected $colonia = "";
		protected $ciudad = "";
		protected $estado = "";
		protected $status = "";
		protected $created_date = "";
		protected $updated_date = "";
		protected $deleted_date = "";
		protected $forma_pago = "";
		protected $cantidad = 0;
		protected $cedula = "";
		protected $rfc = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$personal = new Personal();
			$personal->setId( $id );
			return $personal;
		}
		public static function constructWithValues( $values ){
			$personal = new Personal();
			$personal->setValues( $values );
			return $personal;
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
		
		public function setIdClinica( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDCLINICA","i") ) 
 				$this->id_clinica = $value;
		}
		
		public function setIdPersonalpuesto( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONALPUESTO","i") ) 
 				$this->id_personalpuesto = $value;
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
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setCalle( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CALLE","s") ) 
 				$this->calle = $value;
		}
		
		public function setNumInt( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMINT","s") ) 
 				$this->num_int = $value;
		}
		
		public function setNumExt( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMEXT","s") ) 
 				$this->num_ext = $value;
		}
		
		public function setEmail( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
		}
		
		public function setCp( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CP","s") ) 
 				$this->cp = $value;
		}
		
		public function setColonia( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COLONIA","s") ) 
 				$this->colonia = $value;
		}
		
		public function setCiudad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CIUDAD","s") ) 
 				$this->ciudad = $value;
		}
		
		public function setEstado( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ESTADO","s") ) 
 				$this->estado = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
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
		
		public function setFormaPago( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FORMAPAGO","s") ) 
 				$this->forma_pago = $value;
		}
		
		public function setCantidad( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CANTIDAD","d") ) 
 				$this->cantidad = $value;
		}
		
		public function setCedula( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CEDULA","s") ) 
 				$this->cedula = $value;
		}
		
		public function setRfc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RFC","s") ) 
 				$this->rfc = $value;
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
		
		public function getIdClinica($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_clinica) ;
 			}else{
 				return $this->id_clinica ;
 			}
		}
		
		public function getIdPersonalpuesto($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_personalpuesto) ;
 			}else{
 				return $this->id_personalpuesto ;
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
		
		public function getTelefono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->telefono) ;
 			}else{
 				return $this->telefono ;
 			}
		}
		
		public function getCalle($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->calle) ;
 			}else{
 				return $this->calle ;
 			}
		}
		
		public function getNumInt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_int) ;
 			}else{
 				return $this->num_int ;
 			}
		}
		
		public function getNumExt($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_ext) ;
 			}else{
 				return $this->num_ext ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
 			}
		}
		
		public function getCp($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cp) ;
 			}else{
 				return $this->cp ;
 			}
		}
		
		public function getColonia($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->colonia) ;
 			}else{
 				return $this->colonia ;
 			}
		}
		
		public function getCiudad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ciudad) ;
 			}else{
 				return $this->ciudad ;
 			}
		}
		
		public function getEstado($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->estado) ;
 			}else{
 				return $this->estado ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
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
		
		public function getFormaPago($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->forma_pago) ;
 			}else{
 				return $this->forma_pago ;
 			}
		}
		
		public function getCantidad($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cantidad) ;
 			}else{
 				return $this->cantidad ;
 			}
		}
		
		public function getCedula($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->cedula) ;
 			}else{
 				return $this->cedula ;
 			}
		}
		
		public function getRfc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->rfc) ;
 			}else{
 				return $this->rfc ;
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
			$sql="SELECT * FROM personal WHERE id = ?";

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
			$this->setIdClinica( $res['id_clinica'] );
			$this->setIdPersonalpuesto( $res['id_personalpuesto'] );
			$this->setNombre( $res['nombre'] );
			$this->setApellidoPat( $res['apellido_pat'] );
			$this->setApellidoMat( $res['apellido_mat'] );
			$this->setTelefono( $res['telefono'] );
			$this->setCalle( $res['calle'] );
			$this->setNumInt( $res['num_int'] );
			$this->setNumExt( $res['num_ext'] );
			$this->setEmail( $res['email'] );
			$this->setCp( $res['cp'] );
			$this->setColonia( $res['colonia'] );
			$this->setCiudad( $res['ciudad'] );
			$this->setEstado( $res['estado'] );
			$this->setStatus( $res['status'] );
			$this->setCreatedDate( $res['created_date'] );
			$this->setUpdatedDate( $res['updated_date'] );
			$this->setDeletedDate( $res['deleted_date'] );
			$this->setFormaPago( $res['forma_pago'] );
			$this->setCantidad( $res['cantidad'] );
			$this->setCedula( $res['cedula'] );
			$this->setRfc( $res['rfc'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO personal SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_user` = ? ,";
			$sql .= " `id_clinica` = ? ,";
			$sql .= " `id_personalpuesto` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `apellido_pat` = ? ,";
			$sql .= " `apellido_mat` = ? ,";
			$sql .= " `telefono` = ? ,";
			$sql .= " `calle` = ? ,";
			$sql .= " `num_int` = ? ,";
			$sql .= " `num_ext` = ? ,";
			$sql .= " `email` = ? ,";
			$sql .= " `cp` = ? ,";
			$sql .= " `colonia` = ? ,";
			$sql .= " `ciudad` = ? ,";
			$sql .= " `estado` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `forma_pago` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `cedula` = ? ,";
			$sql .= " `rfc` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE personal SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_user` = ? ,";
			$sql .= " `id_clinica` = ? ,";
			$sql .= " `id_personalpuesto` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `apellido_pat` = ? ,";
			$sql .= " `apellido_mat` = ? ,";
			$sql .= " `telefono` = ? ,";
			$sql .= " `calle` = ? ,";
			$sql .= " `num_int` = ? ,";
			$sql .= " `num_ext` = ? ,";
			$sql .= " `email` = ? ,";
			$sql .= " `cp` = ? ,";
			$sql .= " `colonia` = ? ,";
			$sql .= " `ciudad` = ? ,";
			$sql .= " `estado` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `created_date` = ? ,";
			$sql .= " `updated_date` = ? ,";
			$sql .= " `deleted_date` = ? ,";
			$sql .= " `forma_pago` = ? ,";
			$sql .= " `cantidad` = ? ,";
			$sql .= " `cedula` = ? ,";
			$sql .= " `rfc` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 'i', $this->id_user );
			$stmt->mbind_param( 'i', $this->id_clinica );
			$stmt->mbind_param( 'i', $this->id_personalpuesto );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 's', $this->apellido_pat );
			$stmt->mbind_param( 's', $this->apellido_mat );
			$stmt->mbind_param( 's', $this->telefono );
			$stmt->mbind_param( 's', $this->calle );
			$stmt->mbind_param( 's', $this->num_int );
			$stmt->mbind_param( 's', $this->num_ext );
			$stmt->mbind_param( 's', $this->email );
			$stmt->mbind_param( 's', $this->cp );
			$stmt->mbind_param( 's', $this->colonia );
			$stmt->mbind_param( 's', $this->ciudad );
			$stmt->mbind_param( 's', $this->estado );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->created_date );
			$stmt->mbind_param( 's', $this->updated_date );
			$stmt->mbind_param( 's', $this->deleted_date );
			$stmt->mbind_param( 's', $this->forma_pago );
			$stmt->mbind_param( 'd', $this->cantidad );
			$stmt->mbind_param( 's', $this->cedula );
			$stmt->mbind_param( 's', $this->rfc );
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
				$sql = "UPDATE personal SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_user",$fieldstoupdate)){
				$sql .= " `id_user` = ? ,";
			}
			if (in_array("id_clinica",$fieldstoupdate)){
				$sql .= " `id_clinica` = ? ,";
			}
			if (in_array("id_personalpuesto",$fieldstoupdate)){
				$sql .= " `id_personalpuesto` = ? ,";
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
			if (in_array("telefono",$fieldstoupdate)){
				$sql .= " `telefono` = ? ,";
			}
			if (in_array("calle",$fieldstoupdate)){
				$sql .= " `calle` = ? ,";
			}
			if (in_array("num_int",$fieldstoupdate)){
				$sql .= " `num_int` = ? ,";
			}
			if (in_array("num_ext",$fieldstoupdate)){
				$sql .= " `num_ext` = ? ,";
			}
			if (in_array("email",$fieldstoupdate)){
				$sql .= " `email` = ? ,";
			}
			if (in_array("cp",$fieldstoupdate)){
				$sql .= " `cp` = ? ,";
			}
			if (in_array("colonia",$fieldstoupdate)){
				$sql .= " `colonia` = ? ,";
			}
			if (in_array("ciudad",$fieldstoupdate)){
				$sql .= " `ciudad` = ? ,";
			}
			if (in_array("estado",$fieldstoupdate)){
				$sql .= " `estado` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
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
			if (in_array("forma_pago",$fieldstoupdate)){
				$sql .= " `forma_pago` = ? ,";
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$sql .= " `cantidad` = ? ,";
			}
			if (in_array("cedula",$fieldstoupdate)){
				$sql .= " `cedula` = ? ,";
			}
			if (in_array("rfc",$fieldstoupdate)){
				$sql .= " `rfc` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_user",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idUser  );
			}
			if (in_array("id_clinica",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idClinica  );
			}
			if (in_array("id_personalpuesto",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idPersonalpuesto  );
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
			if (in_array("telefono",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->telefono  );
			}
			if (in_array("calle",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->calle  );
			}
			if (in_array("num_int",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->numInt  );
			}
			if (in_array("num_ext",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->numExt  );
			}
			if (in_array("email",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->email  );
			}
			if (in_array("cp",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cp  );
			}
			if (in_array("colonia",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->colonia  );
			}
			if (in_array("ciudad",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->ciudad  );
			}
			if (in_array("estado",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->estado  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
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
			if (in_array("forma_pago",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->formaPago  );
			}
			if (in_array("cantidad",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->cantidad  );
			}
			if (in_array("cedula",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->cedula  );
			}
			if (in_array("rfc",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->rfc  );
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
			$sql="SELECT id FROM personal WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Personal();
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
