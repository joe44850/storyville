<?php

	class Login {
		
		private $is_logged_in;
		
		public function __get($name){
			return $this->$name;
		}
		
		public function __set($name, $value){
			$this->$name = $value; 
		}
		
	}