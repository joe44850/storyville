<?php

	interface IHtml {
		
		public function LoadJavascript($dir);
		public function LoadCss($dir);
		public function GetDocType();
		public function BodyStart();		
		
	}