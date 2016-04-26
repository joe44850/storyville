<?php
	if(!interface_exists("IHtml")){ require_once("IHtml.php");}

	class Html implements IHtml{
	
		private $site;
		public $title;
		public $cache = false;
		public $loggedin = false;
		public $favicon;
		public $is_mobile = false;
	
		public function __construct(){
			$this->site = SITE;
			$this->favicon = BASE."/_images/site/favicon.png";
			if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) $this->loggedin = true ;	
			$this->is_mobile = isMobile();
		}
	
		//loads every js file in a directory, send a directory that is relative to root, like _js/somejsdir
		public function LoadJavascript($dir_string_array=""){
			$js = "";
			try{	$dir_string_array = preg_replace("/\s/", "", $dir_string_array);}
			catch(Exception $error){ echo "ERROR: $error";}			
			$dirs = explode(",", $dir_string_array);
			foreach($dirs as $dir){
				$root_dir = ROOT."/".$dir;
				$files = Common::LoadFiles($root_dir, "js");
				if(is_array($files)){
					foreach($files as $file){
						//remove root and replace with site	
						$f = $dir."/".$file;
						$js.="\n\t<script type='text/javascript' src='". SITE."/".$f ."'></script>";
					}				
					$js.="\n";
				}
			}
			return $js;
		}
		
		//loads every css file in a directory; send a dir that is relative to root, like _css/some_css_dir
		public function LoadCss($dir){			
			$uncache = (!$this->cache) ? $this->_Uncache() : "";				
			$css = "";
			$root_dir = ROOT."/".$dir;
			$files = Common::LoadFiles($root_dir, "css");
			if(is_array($files)){
				foreach($files as $file){
					//remove root and replace with site	
					$f = $dir."/".$file;
					$css.="\n\t<link rel='stylesheet' type='text/css' href='". SITE."/".$f ."?".$uncache."' />";
				}
				$css.="\n";
			}
			return $css;
		}
		
		public function GetDocType(){
			$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' ".
				" 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>\n ";	
			$html = "<!DOCTYPE html>\n<html>";
			return $html;
		}
		
		public function HeadStart($args=null){
			$css_dir = ($this->is_mobile) ? "_css/mobile" : "_css/pc";
			$html = $this->GetDocType();
			$html.="<head>";
			isset($this->title) ? $title = $this->title : $title = SITE_TITLE;
			$html.="\n<title>$title</title>\n";
			$js = $this->LoadJavascript("_js");			
			$css = $this->LoadCss($css_dir);			
			$html.= $js . $css;
			if($args){
				if(is_array($args)){ 
					foreach($args as $arg){ $html .= "\n\t".$arg;}
				}
				else{
					$html.= $args;
				}
			}
			$html.="\t<link rel='shortcut icon' type='image/png' href='".$this->favicon."' />"; 
			$html.="
					<meta charset=\"utf-8\">
					<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
					";
			return $html;
		}		
		
		public function BodyStart(){
			$html = "
				\n\t</head>
				\n\t<body>
			";
			return $html;
			
		}
		
		private function _Uncache(){
			$t = time();
			return "t=".$t;
		}
		
		/* Static methods */
		public static function OnLoad($javascript=""){
			if(!$javascript){ return;}
			$html = "<img src='".SITE."/_images/blank.gif' onload=\"".$javascript."\" style='height:0px;width:0px;' />";
			return $html;
		}		
		
		
	}	
	
	
	//