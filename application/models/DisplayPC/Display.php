<?php

	namespace PC;
	
	class Display implements \IDisplay {
		
		private $_Html;
		
		public function __construct(\IHtml $ihtml){
			$this->_Html = $ihtml;
		}		
		
		public function HeadStart(){
			$html = $this->_Html->GetDocType();
			$html.= $this->_Html->LoadJavascript("_js/common, _js/lib, _js/_spajs");
			$html.= $this->_Html->LoadCss("_css/pc");
			return $html;
		}
		
		public function BodyStart($args=""){
			$html = "</head><body $args>";
			return $html;
		}
		
		
	}