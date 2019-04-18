<?php 
/*
Auth Class  - 
verify email/password combination
updated token / token experation


*/
	class Auth {

	// Variables
		protected $db;
		protected $id = 0;

		protected $email = "";

		protected $password = ""; 

		protected $token = ""; 
		protected $token_expires = ""; 


	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$auth = new Auth();
			$auth->setId( $id );
			return $auth;
		} 

	// Setter Methods
		public function setId( $value ){
 				$this->id = $value;
		}
		public function setEmail( $value ){
 				$this->email = trim(strtolower($value));
		}
		private function setToken( $value ){
 				$this->token = $value;
		}



	// Getter Methods
		public function getId(){
			return htmlentities( $this->id  );
		}
		public function getEmail(){
			return htmlentities( $this->email  );
		}
		public function getPassword(){
			return  $this->password  ;
		}
		public function getToken(){
			return  $this->token  ;
		}

	// Special Getters

	// Private Support Functions


	// Public functions	
		public function updateToken(){
			$token=substr(sha1(uniqid().rand(1,1000).rand(1,1000)),rand(3,10),4);
 			$token.="-".substr(sha1(uniqid().rand(1,1000).rand(1,1000)),rand(3,10),4);
 			$token.="-".substr(sha1(uniqid().rand(1,1000).rand(1,1000)),rand(3,10),4);
			$update_sql = "UPDATE  `user`  SET `password` = '', `token` = '" . $token . "', `token_expires` =  DATE_ADD(UTC_TIMESTAMP(), INTERVAL 15 MINUTE)  WHERE  `email` = ? AND  `status` = 'active' AND `deleted_date` is NULL";

	 		// Insert site content
			if ( ! $stmt = $this->db->prepare( $update_sql ) ) return false;
			$stmt->mbind_param( 's', $this->email );
			$stmt->execute( $stmt );
			if ($stmt->affected_rows){
				//$this->setValid(1);
				$this->setToken($token);
			}
			// Terminate
			$stmt->close();
			return true;
		}


		public function resetPassword($e,$t,$p){
			$sql="UPDATE user SET password = ? , `token` = '' , `token_expires` = DATE_SUB(UTC_TIMESTAMP(), INTERVAL 1 YEAR)  WHERE email = ? AND token = ? AND token_expires > UTC_TIMESTAMP()  AND  `status` = 'active' AND `deleted_date` is NULL";
			$ret=false;
			if ( ! $stmt = $this->db->prepare( $sql ) ) return false;
			$p=password_hash($p, PASSWORD_DEFAULT);
			$stmt->mbind_param( 's', $p);
			$stmt->mbind_param( 's', $e);
			$stmt->mbind_param( 's', $t);
			$stmt->execute( $stmt );
			if ($stmt->affected_rows){
				$ret=true;
			}
			// Terminate
			$stmt->close();
			return $ret;
		}

		
		public function validateCredentials($e,$p){
			$id=0;
			

			$sql = "SELECT `id`,`id_usuario`,`password` FROM usuario WHERE `id_usuario` = ?  AND  `status` = 'ACTIVO' ";

			if ( ! $stmt = $this->db->prepare( $sql ) ) return false;

			$e=strtolower($e);
			$stmt->mbind_param( 's', $e );
			$stmt->execute( $stmt );	
  			$stmt->bind_result($id, $username, $password);
			/* fetch values */
			if ($stmt->fetch()) {
				if ( password_verify($p, $password) ){ 
					$id = $id;
				}
			}
			// Terminate
			$stmt->close();
			return $id;
		}


		// Logs
		public function error_log($error) {
			file_put_contents( SYSTEM_DIR . "/internal/log/debug.log",date('Y-m-d_H:i:s').$error.PHP_EOL,FILE_APPEND | LOCK_EX);
			return $error;
		}


	}

?>