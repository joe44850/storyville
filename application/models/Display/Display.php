<?php	
	
	class Display {
		
		private $_Html;
		private $is_mobile;
		private $DisplayHelper;
		public $ext;
		
		public function __construct(\IHtml $ihtml){
			$this->_Html = $ihtml;
			$this->is_mobile = isMobile();
			$this->SetDevice();
		}

		/* What!? No setter injection!? It's just a helper class, take it easy Barbara Liskov */
		public function SetDevice(){
			if($this->is_mobile == FALSE){ 
				$this->DisplayHelper = new DisplayPC($this->_Html);
				$this->ext = "_pc";
			}
			else{
				$this->DisplayHelper = new DisplayMBL($this->_Html);
				$this->ext = "_mbl";
			}
		}
		
		public function HeadStart(){			
			return $this->DisplayHelper->HeadStart();
		}
		
		public function BodyStart($args=""){
			$html = "</head><body $args>";
			return $html;
		}

		public function NavBar($fullsize=false){
			return $this->DisplayHelper->NavBar($fullsize);
		}
		
		
	}