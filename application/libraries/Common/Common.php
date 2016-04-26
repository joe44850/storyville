<?php
	//mostly static functions that are easy to call
	
	if(!class_exists("SQL")){ require_once(LIB."/DB/sql.php");}	
	
	class Common {
	
		public static function LoadFiles($dir="", $filetype="", $prefix=""){
			
			$dir = str_replace("//", "/", $dir);			
			$result = array();

			foreach (scandir($dir) as $f) {
			  if ($f !== '.' and $f !== '..') {
				if (is_dir("$dir/$f")) {
				  $result = array_merge($result, self::LoadFiles("$dir/$f", $filetype, "$prefix$f/"));
				} else {
					if(preg_match("#\.".$filetype."#", $f)){
						$result[] = $prefix.$f;
					}
				}
			  }
			}
			sort($result);
			return $result;
		}
		
		public static function Log($str="", $logfile=""){				
			if(!$logfile){ 
				$f = ROOT."/_logs/log.log";
			}	
			else{ $f = ROOT."/_logs/".$logfile.".log";}
			$handle = fopen($f, "a");			
			fwrite($handle, $str."\r");
			fclose($handle);			
		}
		
		public static function LogClear($logfile=""){
			if(!$logfile){ 
				$f = ROOT."/_logs/log.log";
			}
			$handle = fopen($f, "w");			
			fwrite($handle, "");
			fclose($handle);			
		}
		
		public static function Truncate($max=100, $string="", $append="..."){
			$new_string = $string;
			$len = strlen($string);
			if($len > $max){
				$new_string = substr($string, 0, $max);
				$new_string.=$append;
			}
			return $new_string;
		}
		
		public static function Package($dir=""){			
			$files = Common::LoadFiles($dir, "php", "");
			asort($files);
			if($files){
				foreach($files as $file){
					if($file == $_SERVER['PHP_SELF']){ continue;}
					include_once($dir."/".$file);
				}
			}
		}
	
	}	
	
	/* class-less functions...because we need them, even though they lack class */
	function Truncate($max=100, $string="", $append="..."){
		return Common::Truncate($max, $string, $append);
	}
	
	function package($dir=""){
		Common::Package($dir);
	}
	
	function pre($args){
		if(is_array($args)){
			echo "<pre>";
			print_r($args);
			echo "</pre>";
		}
		else{
			echo "<div><b>$args</b></div>";
		}
	}

	function SafePost(){
		$conn = SQL::Connect();
		foreach($_REQUEST as $key=>$val){
			$_POST[$key] = mysqli_real_escape_string($conn, $val);
		}
	}
	
	function safe($vars){
		$conn = SQL::Connect();
		foreach($vars as $key=>$val){
			$vars[$key] = mysqli_real_escape_string($conn, $val);
		}
		return $vars;
	}