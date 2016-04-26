var Login = Class({
	
	oForm : null,
	
	InitForm : function(){
		this.oForm = document.getElementById('login');
		this.PreloadForm();
		this._SpaForm = new SpaForm({
			formID : 'login'			
		});
	},
	
	PreloadForm : function(){
		cookieArray = JS.ReadCookie("storyville");
		
	},
	
	SaveFormInputs : function(){
		var username = document.getElementById('username').value;		
	},
	
	Complete : function(json, _SpaForm){
		this._SpaForm = _SpaForm;
		json = JSON.parse(json);
		if(!json.success){ this.DisplayError(json);}
		else {
			this.DisplaySuccess(json);			
			this.StoreUserInfo(json);
		}
	},
	
	DisplaySuccess : function(json){		
		var DisplayComplete = (function(){
			this._SpaForm.oForm.innerHTML = html;			
		}).bind(this);
		var html = "<div><center><p>Logged in, loading user preferences</p><p>&nbsp;</p></center></div>";
		setTimeout(function(){
			DisplayComplete();
		},500);		
	},
	
	DisplayError : function(json){
		alert(JSON.stringify(json));
		var oItem = document.getElementById('password');
		error = "Login incorrect";
		this._SpaForm.PrintError(oItem, error);
	}
	
	
});

function LoginAttempt(json, _SpaForm, callBack){
	_Login = new Login();
	_Login.Complete(json, _SpaForm);
	if(callBack != null){ callBack();}
}
