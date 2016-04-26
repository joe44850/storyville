var Register = Class({
	
	_SpaForm : null,
	
	InitSignup : function(){
		this._SpaForm = new SpaForm({
			formID : 'signup'			
		});
	},
	
	InitConfirmForm : function(){
		var Append = (
			function(){
				this.AppendConfirmationCode();
			}
		).bind(this);
		this._SpaForm = new SpaForm({
			formID : "confirm-code",
			ajax : false,
			beforeSubmit : Append
		});
	},
	
	InitConfirmResend : function(){
		this._SpaForm = new SpaForm({
			formID : 'confirm-resend',
			submitButton : 'sbmit2'
		});
	},

	AppendConfirmationCode : function(){
		var oForm = document.getElementById('confirm-code');		
		var action = oForm.getAttribute("action");
		action += "/"+document.getElementById('token').value;
		oForm.setAttribute("action", action);
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
	
	DisplayError : function(json){
		var error = json.create_error;
		if(error.indexOf("username")!=-1){ this.DisplayUsernameError(json);}
		else if(error.indexOf("email")!=-1){ this.DisplayEmailError(json);}
	},
	
	DisplayUsernameError : function(json){		
		var oItem = document.getElementById('username');
		this._SpaForm.PrintError(oItem, json.create_error);
	},
	
	DisplayEmailError : function(json){
		var oItem = document.getElementById('email');
		this._SpaForm.PrintError(oItem, json.create_error);
	},
	
	DisplaySuccess : function(json){		
		var DisplayComplete = (function(){
			this._SpaForm.oForm.innerHTML = html;			
		}).bind(this);
		var html = "<div><center><p>User created!<br />Please check your email to complete.</p><p>&nbsp;</p></center></div>";
		setTimeout(function(){
			DisplayComplete();
		},500);		
	},
	
	StoreUserInfo : function(json){
		cookie_string = "username="+json["username"]+";"+"token="+json["token"];		
		try{ JS.StoreCookie("storyville", cookie_string, 365);}
		catch(e){ console.log(e);}
	}
	
	
});

function CompleteRegistration(json, _SpaForm, callBack){	
	_Register = new Register();
	_Register.Complete(json, _SpaForm);
	if(callBack != null){ callBack();}
}

function CompleteConfirmation(){
	var url = "../login";
	setTimeout(function(){
		document.location.href=url;
	}, 1000);
}