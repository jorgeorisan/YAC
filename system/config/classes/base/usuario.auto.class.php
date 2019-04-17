<?php 

	class AutoUsuario {

	// Variables
		protected $db;
		
		protected $id = 0;
		protected $id_usuario = "";
		protected $password = "";
		protected $session_id = "";
		protected $status = "";
		protected $id_usuario_tipo = "";
		protected $nombre = "";
		protected $id_tienda = 0;
		protected $permisos = "";
		protected $comision = 0;
		protected $direccion = "";
		protected $costos = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$usuario = new Usuario();
			$usuario->setId( $id );
			return $usuario;
		}
		public static function constructWithValues( $values ){
			$usuario = new Usuario();
			$usuario->setValues( $values );
			return $usuario;
		}


	// Setter Methods
		public function setId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "ID","i") ) 
 				$this->id = $value;
		}
		
		public function setIdUsuario( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIO","s") ) 
 				$this->id_usuario = $value;
		}
		
		public function setPassword( $value ){ 				$this->password = $value;
		}
		
		public function setSessionId( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "SESSIONID","s") ) 
 				$this->session_id = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setIdUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIOTIPO","s") ) 
 				$this->id_usuario_tipo = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setPermisos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PERMISOS","s") ) 
 				$this->permisos = $value;
		}
		
		public function setComision( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COMISION","d") ) 
 				$this->comision = $value;
		}
		
		public function setDireccion( $value ){ 				$this->direccion = $value;
		}
		
		public function setCostos( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "COSTOS","s") ) 
 				$this->costos = $value;
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
		
		public function getIdUsuario($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario) ;
 			}else{
 				return $this->id_usuario ;
 			}
		}
		
		public function getPassword($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->password) ;
 			}else{
 				return $this->password ;
 			}
		}
		
		public function getSessionId($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->session_id) ;
 			}else{
 				return $this->session_id ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getIdUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario_tipo) ;
 			}else{
 				return $this->id_usuario_tipo ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getPermisos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->permisos) ;
 			}else{
 				return $this->permisos ;
 			}
		}
		
		public function getComision($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->comision) ;
 			}else{
 				return $this->comision ;
 			}
		}
		
		public function getDireccion($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->direccion) ;
 			}else{
 				return $this->direccion ;
 			}
		}
		
		public function getCostos($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->costos) ;
 			}else{
 				return $this->costos ;
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
			$sql="SELECT * FROM usuario WHERE id = ?";

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
			$this->setIdUsuario( $res['id_usuario'] );
			$this->setPassword( $res['password'] );
			$this->setSessionId( $res['session_id'] );
			$this->setStatus( $res['status'] );
			$this->setIdUsuarioTipo( $res['id_usuario_tipo'] );
			$this->setNombre( $res['nombre'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setPermisos( $res['permisos'] );
			$this->setComision( $res['comision'] );
			$this->setDireccion( $res['direccion'] );
			$this->setCostos( $res['costos'] );
			return true;
		}
		// end function load

		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO usuario SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 

			$sql .= " `id_usuario` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `session_id` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `id_usuario_tipo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `id_tienda` = ? ,";
			$sql .= " `permisos` = ? ,";
			$sql .= " `comision` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql .= " `costos` = ? ,";
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE usuario SET modified=UTC_TIMESTAMP(),";	

			$sql .= " `id_usuario` = ? ,";
			$sql .= " `password` = ? ,";
			$sql .= " `session_id` = ? ,";
			$sql .= " `status` = ? ,";
			$sql .= " `id_usuario_tipo` = ? ,";
			$sql .= " `nombre` = ? ,";
			$sql .= " `id_tienda` = ? ,";
			$sql .= " `permisos` = ? ,";
			$sql .= " `comision` = ? ,";
			$sql .= " `direccion` = ? ,";
			$sql .= " `costos` = ? ,";
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			$stmt->mbind_param( 's', $this->id_usuario );
			$stmt->mbind_param( 's', $this->password );
			$stmt->mbind_param( 's', $this->session_id );
			$stmt->mbind_param( 's', $this->status );
			$stmt->mbind_param( 's', $this->id_usuario_tipo );
			$stmt->mbind_param( 's', $this->nombre );
			$stmt->mbind_param( 'i', $this->id_tienda );
			$stmt->mbind_param( 's', $this->permisos );
			$stmt->mbind_param( 'd', $this->comision );
			$stmt->mbind_param( 's', $this->direccion );
			$stmt->mbind_param( 's', $this->costos );
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
				$sql = "UPDATE usuario SET modified=UTC_TIMESTAMP(),";	

			if (in_array("id_usuario",$fieldstoupdate)){
				$sql .= " `id_usuario` = ? ,";
			}
			if (in_array("password",$fieldstoupdate)){
				$sql .= " `password` = ? ,";
			}
			if (in_array("session_id",$fieldstoupdate)){
				$sql .= " `session_id` = ? ,";
			}
			if (in_array("status",$fieldstoupdate)){
				$sql .= " `status` = ? ,";
			}
			if (in_array("id_usuario_tipo",$fieldstoupdate)){
				$sql .= " `id_usuario_tipo` = ? ,";
			}
			if (in_array("nombre",$fieldstoupdate)){
				$sql .= " `nombre` = ? ,";
			}
			if (in_array("id_tienda",$fieldstoupdate)){
				$sql .= " `id_tienda` = ? ,";
			}
			if (in_array("permisos",$fieldstoupdate)){
				$sql .= " `permisos` = ? ,";
			}
			if (in_array("comision",$fieldstoupdate)){
				$sql .= " `comision` = ? ,";
			}
			if (in_array("direccion",$fieldstoupdate)){
				$sql .= " `direccion` = ? ,";
			}
			if (in_array("costos",$fieldstoupdate)){
				$sql .= " `costos` = ? ,";
			}
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}

			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( 'i', $id );

			if (in_array("id_usuario",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->idUsuario  );
			}
			if (in_array("password",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->password  );
			}
			if (in_array("session_id",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->sessionId  );
			}
			if (in_array("status",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->status  );
			}
			if (in_array("id_usuario_tipo",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->idUsuarioTipo  );
			}
			if (in_array("nombre",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->nombre  );
			}
			if (in_array("id_tienda",$fieldstoupdate)){
				$stmt->mbind_param( 'i', $this->idTienda  );
			}
			if (in_array("permisos",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->permisos  );
			}
			if (in_array("comision",$fieldstoupdate)){
				$stmt->mbind_param( 'd', $this->comision  );
			}
			if (in_array("direccion",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->direccion  );
			}
			if (in_array("costos",$fieldstoupdate)){
				$stmt->mbind_param( 's', $this->costos  );
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
			$sql="SELECT id FROM usuario WHERE 1 and status='active'";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new Usuario();
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
