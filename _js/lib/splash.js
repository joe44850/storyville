var Splash = Class({
	
	oDiv1 : null,
	oDiv2 : null,
	oDiv11: null,
	oDiv22: null,
	_Spa : null,
	
	__construct : function(){
		this._Spa = new Spa();
	},
	
	InitSplashMenu : function(){
		var jDiv = $('#splashMenuContainer');
		$(window).scroll(function(e){
			console.log($(window).scrollTop());
			if($(window).scrollTop() > 95){				
				jDiv.addClass('splash-fixed');
			}
			else{				
				jDiv.removeClass('splash-fixed');
			}
		});
	},
	
	BgTransition : function(){		
		
	},
	
	DoTransition : function(){
		
	}
	
});