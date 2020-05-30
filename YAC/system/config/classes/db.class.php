<?php
	class db extends mysqli {
		public function prepare($query) {
			$stmt = new stmt($this,$query);

			if ( $stmt->error !== "" )
			{
				//echo time();echo( "Failed to prepare statement ~ Query: $query ~ Error: " . $stmt->error );
				return false;
			}

			return $stmt;
		}
	}

	class stmt extends mysqli_stmt {

		private $mbind_types = array();
		private $mbind_params = array();
		private $query = "";

		public function __construct($link, $query) {
			$this->mbind_reset();
			$this->query = $query;
			parent::__construct($link, $query);
		}

        /*public function get_result () {
					return parent::get_result();
				}*/
		public function mbind_reset() {
			unset($this->mbind_params);
			unset($this->mbind_types);
			$this->mbind_params = array();
			$this->mbind_types = array();
		}

		public function mbind_param($type, &$param) {
			if (!array_key_exists(0,$this->mbind_types)){$this->mbind_types=array();$this->mbind_types[0]="";}
			$this->mbind_types[0].= $type;
			$this->mbind_params[] = &$param;
			return true;
		}

		public function mbind_value($type, $param) {
			if (!array_key_exists(0,$this->mbind_types)){$this->mbind_types=array();$this->mbind_types[0]="";}
			$this->mbind_types[0].= $type;
			$this->mbind_params[] = $param;
			return true;
		}

		public function mbind_param_do() {
			$params = array_merge($this->mbind_types, $this->mbind_params);

			if ( strlen($this->mbind_types[0]) != sizeof($this->mbind_params) ) {
				debugLog( "Failed to bind parameters. ~ Query: " . $this->query . " ~ Binding: " . json_encode($params) );
				return false;
			}
			if ( substr_count($this->query, "?") != strlen($this->mbind_types[0]) ) {
				debugLog( "Not enough variables. ~ Query: " . $this->query . " ~ Binding: " . json_encode($params) );
				return false;
			}
			return call_user_func_array(array($this, 'bind_param'), $this->makeValuesReferenced($params));
		}

		private function makeValuesReferenced($arr){
			$refs = array();
			foreach($arr as $key => $value)
				$refs[$key] = &$arr[$key];
			return $refs;
		}

		public function execute() {
			if(count($this->mbind_params))
				$this->mbind_param_do();

			return parent::execute();
		}

		public function close() {
			$this->free_result();
			return parent::close();
		}
	}
?>
