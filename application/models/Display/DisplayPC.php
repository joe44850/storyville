<?php

	class DisplayPC implements IDisplay {
		
		private $_IHtml;
		private $_logged_in;
		
		public function __construct(IHtml $_IHtml){
			$this->_IHtml = $_IHtml;
		}
		
		public function DocType(){
			
		}
		
		public function HeadStart(){
			$html = $this->_IHtml->GetDocType();
			$html.= $this->_IHtml->LoadJavascript("_js/common, _js/lib, _js/_spajs");
			$html.= $this->_IHtml->LoadCss("_css/pc");
			return $html;
		}
		
		public function GetCss(){
			
		}
		
		public function GetJS(){
			
		}
		
		public function BodyStart(){
			
		}
		
		public function NavBar($fullsize=false){
			if($fullsize){ return $this->_NavBarFullSize();}
			else return $this->_NavBarMin();
		}
		
		private function _NavBarFullSize(){
			$html = "
				<div class='navbar-full-container'>
					<div class='navbar-full'>
					Navbar
					</div>
				</div>
			";
			return $html;
		}
		
		private function _NavBarMin(){
			$html = "
				<div class='navbar-min-container'>
					<div class='navbar-min'>
					Navbar
					</div>
				</div>
			";
		}
		
	}