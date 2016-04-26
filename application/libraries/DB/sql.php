<?php

class SQL {
	
	public function __construct(){
		$this->conn = SQL::connect();
		$this->dolog = (class_exists("Logger")) ? true : false;
	}

	public static $last_id;

    public static function connect() {
	
        //$CI = & get_instance();
        //$CI->load->database();
        //echo $CI->db->hostname;
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS) or die(mysqli_error);
        mysqli_select_db($conn, DBNAME);
        return $conn;
    }

    public static function disconnect($conn) {
        mysqli_close($conn);
    }

    public static function Query($sql, $return_one = false) {
		$obj = new static();
		
		if(preg_match("#insert#si", $sql)){ return $obj->_DoInsert($sql);}
		else if(preg_match("#delete from#si", $sql)){ return $obj->_DoDelete($sql);}
		else{ return $obj->_DoSelect($sql, $return_one);}
    }
	
	public static function Post($vars="", $table=""){
		//$vars = safe($vars);
		if(!$vars){ return; }
		$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.columns WHERE TABLE_NAME = '$table' ";
		$rows = SQL::Query($sql);
		$keys = array();
		$values = array();
		$columns = array();
		foreach($rows as $arr){ foreach($arr as $key=>$val){ $columns[] = $val;}}
		foreach($vars as $key=>$val){			
			if(in_array($key, $columns)){ 
				$keys[] = $key;
				$values[] = $val;
			}
		}
		$sql = "INSERT INTO `$table` (".implode(",", $keys).") VALUES ('".implode("','", $values)."')";
		$conn = self::connect();
		mysqli_query($conn, $sql);
		return mysqli_insert_id($conn);
	}
	
	private function _Post($vars, $table){
		
	}
	
	private function _DoInsert($sql){		
		//$sql = mysqli_real_escape_string($this->conn, $sql);
		mysqli_query($this->conn, $sql);
		if(mysqli_error($this->conn) && $this->dolog){
			Logger::Write("SQL ERROR on this query $sql \n".mysqli_error($this->conn));
		}
		return mysqli_insert_id($this->conn);
	}
	
	private function _DoSelect($sql, $return_one=false){
		$res = mysqli_query($this->conn, $sql);
		if(mysqli_error($this->conn) && $this->dolog){ 
			Logger::Write("SQL ERROR on this query $sql \n".mysqli_error($this->conn));
			return;
		}
		if(is_bool($res)){ return null;}
        while ($rows[] = mysqli_fetch_array($res)) {};
        array_pop($rows);
        self::disconnect($this->conn);
        if ($return_one) {
            return @$rows[0];
        }
        return $rows;
	}
	
	private function _DoDelete($sql){
		$res = mysqli_query($this->conn, $sql);
		if(mysqli_error($this->conn) && $this->dolog){ 
			Logger::Write("SQL ERROR on this query $sql \n".mysqli_error($this->conn));
			return;
		}
	}

}
