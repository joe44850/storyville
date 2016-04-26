<?php

	interface IHeader {
		
		function DocType();
		function HeadStart();
		function GetCss();
		function GetJS();
		function BodyStart();
		
	}