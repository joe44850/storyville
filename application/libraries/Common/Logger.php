<?php

	class Logger {
		
		public static function Write($msg, $logfile=""){
			$Logger = new static();
			$Logger->_Write($msg, $logfile);
		}
		
		private function _Write($msg, $logfile){
			$msg = $this->_FormatMsg($msg);			
			$path = ROOT."/application/logs";			
			if(!$logfile){ $logfile = "error_log.txt";}
			$file = $path."/".$logfile;
			$handle = fopen($file, "a");					
			fwrite($handle, $msg);			
			fclose($handle);
		}
		
		private function _FormatMsg($msg){
			$now = date("F j, Y h:i a");
			$msg = "\r $now\r";
			if(is_array($msg)){
				$msg.="\r This is an array";
				$msg.=$this->_FormatArray($msg);
			}
			else{ $msg.=$msg;}
			$msg.="\r";
			return $msg;
		}
	
		private function _FormatArray(array $msg=null, $text=""){
			foreach($msg as $key=>$val){
				if(is_array($val)){
					$text.="\r";
					$this->_FormatArray($val, $text);
				}
				else{
					$text.="\t $text \r";					
				}
			}
			return $text;
		}
		
	}