/* COMMON FUNCTIONS THAT SHOULD HAVE BEEN IN THE Javascript Specs */

function arrayKey(needle, haystack){
	for(var i=0; i<haystack.length;i++){
		if(haystack[i] == needle){return i;}
	}
	return -1;
}

function isNull(item){
	if(typeof item == "undefined"){ console.log("Item is undefined");return true;}
	else if(item == null){ console.log("Item is null");return true;}
	else if(item == ""){ console.log("Items equals blank");return true;}
}

var JS = {
	
	Now : function(){
		if (!Date.now) {
			Date.now = function() { return new Date().getTime(); }
		}
		else{ return Date.now();}
	},
	
	CreateCookie : function(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	},

	ReadCookie : function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	},

	EraseCookie : function(name) {
		JS.CreateCookie(name,"",-1);
	}
	
}

