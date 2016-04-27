<?php

	class DisplayMBL implements IDisplayHelper{
		
		private $_IHtml;
		
		public function __construct(IHtml $_IHtml){
			$this->_IHtml = $_IHtml;
		}
		
		function DocType(){
			
		}
		
		function HeadStart(){
			$html = $this->_IHtml->GetDocType();
			$html.= $this->_IHtml->LoadJavascript("_js/common, _js/lib, _js/_spajs");
			$html.= $this->_IHtml->LoadCss("_css/pc");
			return $html;
		}
		
		function GetCss(){
			
		}
		
		function GetJS(){
			
		}
		
		function BodyStart(){
			
		}
		
		function NavBar(){
			
		}		
		
		
	}