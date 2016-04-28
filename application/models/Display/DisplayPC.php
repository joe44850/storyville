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
			$html.= $this->_IHtml->LoadJavascript("_js/common, _js/spajs, _js/lib", false);
			$html.= $this->_IHtml->LoadCss("_css/pc");
			$html.= $this->_IHtml->Favicon();
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
				<div id='navbar-full-container'>
					<div id='navbar-full'>
					
					</div>
				</div>
			";
			return $html;
		}
		
		private function _NavBarMin(){
			$html = "
				<div id='navbar-min-container'>
					<div id='navbar-min'>
					
					</div>
				</div>
			";
			return $html;
		}
		
	}