<?php
	/* basic default controller package */
	Common::Package(MOD."/Interfaces");
	Common::Package(MOD."/Account");	
	if(!isMobile()){
		Common::Package(MOD."/DisplayPC");		
	}
	else{
		Common::Package(MOD."/DisplayMobile");		
	}
