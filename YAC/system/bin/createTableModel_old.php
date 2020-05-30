<?php
$_SERVER['HTTP_HOST']="";
include_once("../config/config.php");
include_once("../config/classes/db.class.php");

if ( !isset($argv[1]) || !isset($argv[2]) ){
	echo "\n\n\n--------------\nusage: " . $argv[0]. " table_name model_name \n\t\te.g. "  . $argv[0]. " users User\n\n\n";
	die;
}else{
	$table_name=$argv[1];
	$model_name=$argv[2];
}

function camelCase($str){
	$ret="";
	$a=explode("_",$str);
	foreach ($a as $aa){
		$ret.=ucfirst($aa);
	}
	return lcfirst($ret);
}

/*
Type number to type name to bind type;
numerics
-------------
BIT: 16
TINYINT: 1
BOOL: 1
SMALLINT: 2
MEDIUMINT: 9
INTEGER: 3
BIGINT: 8
SERIAL: 8
FLOAT: 4
DOUBLE: 5
DECIMAL: 246
NUMERIC: 246
FIXED: 246

dates
------------
DATE: 10
DATETIME: 12
TIMESTAMP: 7
TIME: 11
YEAR: 13

strings & binary
------------
CHAR: 254
VARCHAR: 253
ENUM: 254
SET: 254
BINARY: 254
VARBINARY: 253
TINYBLOB: 252
BLOB: 252
MEDIUMBLOB: 252
TINYTEXT: 252
TEXT: 252
MEDIUMTEXT: 252
LONGTEXT: 252

// mysqli bind
The argument may be one of four types:

    i - integer
    d - double
    s - string
    b - BLOB


/// Naming conventions

Model name: First capitalized, singular (e.g. User)
Database name: all lower case, plural (e.g. users)

Database fields: all lower case, singular, if two words use _  (e.g. id, email, first_name)
Database primary key: id int(11) auto increment
Database created modified: created datetime, modified datetime  (ALL TIMES/DATES should be UTC)

Model field names:  camal case of database fields (e.g.  email, firstName)
Model setters and getters:  camal case (e.g setEmail, getFirstName)

*/
$fieldTypes= array(
		1=>array('num'=>1,'type'=>'BOOL','bind'=>'s'),
		2=>array('num'=>2,'type'=>'SMALLINT','bind'=>'i'),
		3=>array('num'=>3,'type'=>'INTEGER','bind'=>'i'),
		4=>array('num'=>4,'type'=>'FLOAT','bind'=>'d'),
		5=>array('num'=>5,'type'=>'DOUBLE','bind'=>'d'),
		7=>array('num'=>7,'type'=>'TIMESTAMP','bind'=>'s'),
		8=>array('num'=>8,'type'=>'SERIAL','bind'=>'s'),
		9=>array('num'=>9,'type'=>'MEDIUMINT','bind'=>'i'),
		10=>array('num'=>10,'type'=>'DATE','bind'=>'s'),
		11=>array('num'=>11,'type'=>'TIME','bind'=>'s'),
		12=>array('num'=>12,'type'=>'DATETIME','bind'=>'s'),
		13=>array('num'=>13,'type'=>'YEAR','bind'=>'s'),
		16=>array('num'=>16,'type'=>'BIT','bind'=>'s'),
		246=>array('num'=>246,'type'=>'DECIMAL','bind'=>'d'),
		252=>array('num'=>252,'type'=>'BLOB','bind'=>'b'),
		252=>array('num'=>252,'type'=>'TEXT','bind'=>'s'),
		253=>array('num'=>253,'type'=>'VARCHAR','bind'=>'s'),
		254=>array('num'=>254,'type'=>'CHAR','bind'=>'s')
	);



     // Set character set, to show its impact on some values (e.g., length in bytes)
    //$db->set_charset($charset);

    $query = "SELECT *  from ".$db->real_escape_string($table_name)." ORDER BY id";

    $fields=array();
    
    if ($result = $db->query($query)) {

        /* Get field information for all columns */
        $finfo = $result->fetch_fields();

        foreach ($finfo as $val) {
        	$fields[$val->name]=array(
        		'database_name'=>$val->name,
        		'model_name'=>camelCase($val->name),
        		'bind_type'=>$fieldTypes[$val->type]['bind']
        	);

/*
            printf("Name:      %s\n",   $val->name);
            printf("Table:     %s\n",   $val->table);
            printf("Max. Len:  %d\n",   $val->max_length);
            printf("Length:    %d\n",   $val->length);
            printf("charsetnr: %d\n",   $val->charsetnr);
            printf("Flags:     %d\n",   $val->flags);
            printf("Type:      %d\n\n", $val->type);
*/            
        }
        $result->free();
    }
 


$output ='<?php 

	class ' . $model_name . ' {

	// Variables
		protected $db;
		';


echo $output."\n";
foreach ($fields as $k=>$v){
	echo "\t\tprotected $".$v['database_name'];
	if ($v['bind_type']=="i" ||$v['bind_type']=="d" ){
		echo " = 0;\n";
	}else {
		echo " = \"\";\n";
	}
}
echo '
		protected $valid = true;
		protected $status = array();
';

echo "\n\n";


echo '	// Constructor Methods
		public   function __construct(){
			global $db;
			$this->db = $db;
		}
		public static function construct( $id ){
			$'. lcfirst($model_name) .' = new '. $model_name .'();
			$'. lcfirst($model_name) .'->setId( $id );
			return $'. lcfirst($model_name) .';
		}
		public static function constructWithValues( $values ){
			$'. lcfirst($model_name) .' = new '. $model_name .'();
			$'. lcfirst($model_name) .'->setValues( $values );
			return $'. lcfirst($model_name) .';
		}
';

echo "\n\n" .'	// Setter Methods' . "";
foreach ($fields as $k=>$v){
		echo '
		public function set' . ucfirst($v['model_name']) . '( $value ){
			if ( $this->validateInput("/^.*$/", $value, "' . strtoupper($v['model_name']) . '","'.$v['bind_type'].'") ) 
 				$this->' . $v['database_name'] . ' = $value;
		}
		'."";
}
echo '
		public function setValid( $value ){
			if ( $this->validateInput(\'/^(true|false)$/\', ( $value ) ? \'true\' : \'false\', "Valid",\'s\') )
				$this->valid = $value;
		}

		public function setStatus( $value ){
			if ( ! is_array($this->status) ){
				$this->status=array();
			}

			$this->status[] = $value;
			$this->status = array_unique($this->status );
			
		}
';		

echo "\n\n" .'	// Getter Methods' . "";
foreach ($fields as $k=>$v){
		echo '
		public function get' . ucfirst($v['model_name']) . '($sanitize=true){ 
 			if($sanitize){
 				return htmlspecialchars($this->' . $v['database_name'] . ') ;
 			}else{
 				return $this->' . $v['database_name'] . ' ;
 			}
		}
		'."";
}
echo '
		public function getValid(){
			return $this->valid;
		}
		public function getStatus(){
			return  $this->status ;
		}
';		

echo '
	// Public Support Functions
		public function load($id) {
			$sql="SELECT * FROM ' . $table_name . ' WHERE id = ?";

			if ( $id == 0 )
				return $this->killInvalid( "The ID not valid." );

			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->mbind_param( \'i\', $id );
			$stmt->execute();

			$res = $stmt->get_result();
			$res = ( is_null($res) || ! $res )? [] : $res->fetch_array(MYSQLI_ASSOC) ;
			$stmt->close();
			if ( sizeof( $res ) == 0 ) {
				return $this->killInvalid( "Unable to retrieve information for ID. Please try again later, or contact support." );
			}
';
foreach ($fields as $k=>$v){
		echo '
			$this->set' . ucfirst($v['model_name']) . '( $res[\'' . $v['database_name'] . '\'] );';
}
echo '
			return true;
		}
		// end function load
';

echo '
		public function save() {
			if ($this->getId()==0){ // insert new
				$sql = "INSERT INTO ' . $table_name . ' SET modified=UTC_TIMESTAMP(),created=UTC_TIMESTAMP(),"; 
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		echo '
			$sql .= " `'.$v['database_name'].'` = ? ,";';
		}
}
echo '
			$sql = trim($sql,",");

			} else { // updated existing
				$sql = "UPDATE ' . $table_name . ' SET modified=UTC_TIMESTAMP(),";	
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		echo '
			$sql .= " `' . $v['database_name'] . '` = ? ,";';
		}
}
echo '
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}
';

echo '
			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( \'i\', $id );
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		echo '
			$stmt->mbind_param( \'' . $v['bind_type'] . '\', $this->' . $v['database_name'] . ' );';
		}
}
echo '
			if ($this->getId()>0){
				$stmt->mbind_param( \'i\', $this->id  );
			} // end save
';


echo '
			$stmt->execute();
			if ($this->getId()==0){
				$this->setId( $this->db->insert_id );
			}
			return $this->getId();
		}
		
';

/// updateFields
echo '
		public function updateFields($fieldstoupdate) {
			if ($this->getId()==0){ // insert new
				// only updates no save new here
			} else { // updated existing
				$sql = "UPDATE ' . $table_name . ' SET modified=UTC_TIMESTAMP(),";	
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created'  ){
		echo '
			if (in_array("' . $k . '",$fieldstoupdate)){
				$sql .= " `' . $v['database_name'] . '` = ? ,";
			}';
		}
}
echo '
			$sql = trim($sql,",");
			$sql .= " WHERE id = ?";
			}
';

echo '
			
			// Save data 
			$stmt = $this->db->prepare( $sql );
			//$stmt->mbind_param( \'i\', $id );
';
foreach ($fields as $k=>$v){
		if ( $k != 'id' && $k != 'modified' && $k != 'created' ){
		echo '
			if (in_array("' . $k . '",$fieldstoupdate)){
				$stmt->mbind_param( \'' . $v['bind_type'] . '\', $this->' . $v['model_name'] .  '  );
			}';
		}
}
echo '
			if ($this->getId()>0){
				$stmt->mbind_param( \'i\', $this->getId()  );
			}
';
echo '
			$stmt->execute();
			//if ($this->getId()==0){
			//	$this->setId( $this->db->insert_id );
			//}
			return $this->getId();
		}  // updateFields
		
';






echo '
		public function getAll() {
			$sql="SELECT id FROM ' . $table_name . ' WHERE 1";
			// Get data 
			$stmt = $this->db->prepare( $sql );
			$stmt->execute();

			$res = $stmt->get_result();
			$retval=array();
			while($id = mysqli_fetch_row($res)){
				$retval[$id[0]] = new ' . $model_name . '();
				$retval[$id[0]]->load($id[0]);
			}
			return $retval;
		}

';

echo '

	// Private Support Functions
		protected function validateInput( $pcre, $input, $field , $bind_type) {
			//if ( ! $this->valid )
			//	return $this->valid;

			if ( ! preg_match($pcre, $input) ){ 
				return $this->killInvalid( "The input provided for the field \'$field\' is not valid. Value provided: ".htmlentities($input),$field);
			}else{
				unset($this->status[$field]);
				if (empty($this->status)){$this->valid=true;}
			}

			return true;
		}
		protected function killInvalid( $msg, $field="General Error" ){
			$this->status[$field] = $msg;
			$this->valid = false;
			return false;
		}
';

echo '
}
';

/*
$output  = <<<EOF
<?php 

	class {!MODEL_NAME!} {

	// Variables
		protected $db;
		protected $id = 0;

		protected $email = "";
		protected $first_name = "";
		protected $last_name = "";

		protected $initials = "";
		protected $password = ""; 
		protected $type = ""; 

		protected $token = ""; 
		protected $token_expires = ""; 

		protected $deleted = 0;
		protected $enabled = 0; 

		protected $created = "";
		protected $modified = "";

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
			if ( $this->validateInput('/^[0-9]{1,10}$/', $value, "ID") ) 
 				$this->id = $value;
		}
		public function setEmail( $value ){
			if ( $this->validateInput('/^[a-z0-9]+@illumant\.com$/', $value, "Email") ) 
 				$this->email = $value;
		}


EOF;
*/