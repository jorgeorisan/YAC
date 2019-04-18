<?php 

	class AutoPersona {

	// Variables
		protected $db;
		
		protected $id_persona = "";
		protected $nombre = "";
		protected $rfc = "";
		protected $calle = "";
		protected $num_exterior = "";
		protected $num_interior = "";
		protected $colonia = "";
		protected $ciudad = "";
		protected $estado = "";
		protected $codigo_postal = "";
		protected $pais = "";
		protected $email = "";
		protected $fecha_registro = "";
		protected $id_usuario_tipo = "";
		protected $ap_paterno = "";
		protected $ap_materno = "";
		protected $st_idcliente = "";
		protected $fecha_nacimiento = "";
		protected $status = "";
		protected $id_tienda = 0;
		protected $razon_social = "";
		protected $lada = "";
		protected $telefono = "";
		protected $observaciones = "";
		protected $banco = "";
		protected $num_cuenta = "";
		protected $dir_cuenta = "";
		protected $tiempo_credito = "";
		protected $celular = "";
		protected $alergias = "";

		protected $validclass = true;
		protected $statusclass = array();


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$persona = new Persona();
			$persona->setId( $id );
			return $persona;
		}
		public static function constructWithValues( $values ){
			$persona = new Persona();
			$persona->setValues( $values );
			return $persona;
		}


	// Setter Methods
		public function setIdPersona( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDPERSONA","s") ) 
 				$this->id_persona = $value;
		}
		
		public function setNombre( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NOMBRE","s") ) 
 				$this->nombre = $value;
		}
		
		public function setRfc( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RFC","s") ) 
 				$this->rfc = $value;
		}
		
		public function setCalle( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CALLE","s") ) 
 				$this->calle = $value;
		}
		
		public function setNumExterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMEXTERIOR","s") ) 
 				$this->num_exterior = $value;
		}
		
		public function setNumInterior( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMINTERIOR","s") ) 
 				$this->num_interior = $value;
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
		
		public function setCodigoPostal( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CODIGOPOSTAL","s") ) 
 				$this->codigo_postal = $value;
		}
		
		public function setPais( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "PAIS","s") ) 
 				$this->pais = $value;
		}
		
		public function setEmail( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "EMAIL","s") ) 
 				$this->email = $value;
		}
		
		public function setFechaRegistro( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "FECHAREGISTRO","s") ) 
 				$this->fecha_registro = $value;
		}
		
		public function setIdUsuarioTipo( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDUSUARIOTIPO","s") ) 
 				$this->id_usuario_tipo = $value;
		}
		
		public function setApPaterno( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "APPATERNO","s") ) 
 				$this->ap_paterno = $value;
		}
		
		public function setApMaterno( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "APMATERNO","s") ) 
 				$this->ap_materno = $value;
		}
		
		public function setStIdcliente( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STIDCLIENTE","s") ) 
 				$this->st_idcliente = $value;
		}
		
		public function setFechaNacimiento( $value ){ 				$this->fecha_nacimiento = $value;
		}
		
		public function setStatus( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "STATUS","s") ) 
 				$this->status = $value;
		}
		
		public function setIdTienda( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "IDTIENDA","i") ) 
 				$this->id_tienda = $value;
		}
		
		public function setRazonSocial( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "RAZONSOCIAL","s") ) 
 				$this->razon_social = $value;
		}
		
		public function setLada( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "LADA","s") ) 
 				$this->lada = $value;
		}
		
		public function setTelefono( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TELEFONO","s") ) 
 				$this->telefono = $value;
		}
		
		public function setObservaciones( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "OBSERVACIONES","s") ) 
 				$this->observaciones = $value;
		}
		
		public function setBanco( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "BANCO","s") ) 
 				$this->banco = $value;
		}
		
		public function setNumCuenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "NUMCUENTA","s") ) 
 				$this->num_cuenta = $value;
		}
		
		public function setDirCuenta( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "DIRCUENTA","s") ) 
 				$this->dir_cuenta = $value;
		}
		
		public function setTiempoCredito( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "TIEMPOCREDITO","s") ) 
 				$this->tiempo_credito = $value;
		}
		
		public function setCelular( $value ){			
			if ( $this->validclassateInput("/^.*$/", $value, "CELULAR","s") ) 
 				$this->celular = $value;
		}
		
		public function setAlergias( $value ){ 				$this->alergias = $value;
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
		public function getIdPersona($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_persona) ;
 			}else{
 				return $this->id_persona ;
 			}
		}
		
		public function getNombre($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->nombre) ;
 			}else{
 				return $this->nombre ;
 			}
		}
		
		public function getRfc($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->rfc) ;
 			}else{
 				return $this->rfc ;
 			}
		}
		
		public function getCalle($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->calle) ;
 			}else{
 				return $this->calle ;
 			}
		}
		
		public function getNumExterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_exterior) ;
 			}else{
 				return $this->num_exterior ;
 			}
		}
		
		public function getNumInterior($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_interior) ;
 			}else{
 				return $this->num_interior ;
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
		
		public function getCodigoPostal($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->codigo_postal) ;
 			}else{
 				return $this->codigo_postal ;
 			}
		}
		
		public function getPais($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->pais) ;
 			}else{
 				return $this->pais ;
 			}
		}
		
		public function getEmail($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->email) ;
 			}else{
 				return $this->email ;
 			}
		}
		
		public function getFechaRegistro($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_registro) ;
 			}else{
 				return $this->fecha_registro ;
 			}
		}
		
		public function getIdUsuarioTipo($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_usuario_tipo) ;
 			}else{
 				return $this->id_usuario_tipo ;
 			}
		}
		
		public function getApPaterno($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ap_paterno) ;
 			}else{
 				return $this->ap_paterno ;
 			}
		}
		
		public function getApMaterno($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->ap_materno) ;
 			}else{
 				return $this->ap_materno ;
 			}
		}
		
		public function getStIdcliente($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->st_idcliente) ;
 			}else{
 				return $this->st_idcliente ;
 			}
		}
		
		public function getFechaNacimiento($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->fecha_nacimiento) ;
 			}else{
 				return $this->fecha_nacimiento ;
 			}
		}
		
		public function getStatus($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->status) ;
 			}else{
 				return $this->status ;
 			}
		}
		
		public function getIdTienda($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->id_tienda) ;
 			}else{
 				return $this->id_tienda ;
 			}
		}
		
		public function getRazonSocial($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->razon_social) ;
 			}else{
 				return $this->razon_social ;
 			}
		}
		
		public function getLada($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->lada) ;
 			}else{
 				return $this->lada ;
 			}
		}
		
		public function getTelefono($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->telefono) ;
 			}else{
 				return $this->telefono ;
 			}
		}
		
		public function getObservaciones($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->observaciones) ;
 			}else{
 				return $this->observaciones ;
 			}
		}
		
		public function getBanco($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->banco) ;
 			}else{
 				return $this->banco ;
 			}
		}
		
		public function getNumCuenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->num_cuenta) ;
 			}else{
 				return $this->num_cuenta ;
 			}
		}
		
		public function getDirCuenta($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->dir_cuenta) ;
 			}else{
 				return $this->dir_cuenta ;
 			}
		}
		
		public function getTiempoCredito($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->tiempo_credito) ;
 			}else{
 				return $this->tiempo_credito ;
 			}
		}
		
		public function getCelular($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->celular) ;
 			}else{
 				return $this->celular ;
 			}
		}
		
		public function getAlergias($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->alergias) ;
 			}else{
 				return $this->alergias ;
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
			$sql="SELECT * FROM persona WHERE id = ?";

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

			$this->setIdPersona( $res['id_persona'] );
			$this->setNombre( $res['nombre'] );
			$this->setRfc( $res['rfc'] );
			$this->setCalle( $res['calle'] );
			$this->setNumExterior( $res['num_exterior'] );
			$this->setNumInterior( $res['num_interior'] );
			$this->setColonia( $res['colonia'] );
			$this->setCiudad( $res['ciudad'] );
			$this->setEstado( $res['estado'] );
			$this->setCodigoPostal( $res['codigo_postal'] );
			$this->setPais( $res['pais'] );
			$this->setEmail( $res['email'] );
			$this->setFechaRegistro( $res['fecha_registro'] );
			$this->setIdUsuarioTipo( $res['id_usuario_tipo'] );
			$this->setApPaterno( $res['ap_paterno'] );
			$this->setApMaterno( $res['ap_materno'] );
			$this->setStIdcliente( $res['st_idcliente'] );
			$this->setFechaNacimiento( $res['fecha_nacimiento'] );
			$this->setStatus( $res['status'] );
			$this->setIdTienda( $res['id_tienda'] );
			$this->setRazonSocial( $res['razon_social'] );
			$this->setLada( $res['lada'] );
			$this->setTelefono( $res['telefono'] );
			$this->setObservaciones( $res['observaciones'] );
			$this->setBanco( $res['banco'] );
			$this->setNumCuenta( $res['num_cuenta'] );
			$this->setDirCuenta( $res['dir_cuenta'] );
			$this->setTiempoCredito( $res['tiempo_credito'] );
			$this->setCelular( $res['celular'] );
			$this->setAlergias( $res['alergias'] );
			return true;
		}
		// end function load

}
