var SpaForm = Class({
	
	_Spa : null,
	
	__construct : function(vars){
		(vars['formID']) ? this.formID = vars['formID'] : this.formID = "";
		(vars['submitButton']) ? this.submitButton = vars['submitButton'] : this.submitButton = 'sbmit';
		this.submitAjax = true;
		if(vars['ajax'] != null){ this.submitAjax = vars['ajax']; }
		(vars['beforeSubmit']) ? this.beforeSubmit = vars['beforeSubmit'] : "";
		this.oSubmitButton = null;
		this._Spa = new Spa();
		this._Spa.Debug = true;
		this.oForm = document.getElementById(this.formID);
		this.InitSubmitButton();
	},
	
	oFrame : null,

	InitSubmitButton : function(){
		try{
			this.oSubmitButton = document.getElementById(this.submitButton);
			var self = this;
			$(self.oSubmitButton).click(function(){
				self.Submit();
			});
		}
		catch(e){
			console.log("Cannot initialize submit button for form");
			throw e;
		}
	},	 
	
	Submit : function(){
		if(this.Validate()){
			if(this.submitAjax){				
				if(this.oFrame != null){ this._Spa.DeleteFrame(this.oFrame);}
				this.oFrame = this._Spa.CreateFrame();
				this.oForm.setAttribute("target", this.oFrame.name);
				this.FormDisable();
				this.SetCallBack();
			}
			if(this.beforeSubmit != null){
				this.beforeSubmit();
			}			
			this.oForm.submit();
			
		}
		else return false;
	},
	
	Validate : function(){		
		var el;
		var val;
		for(var i = 0; i < this.oForm.elements.length; i++){			
			if(!this.PropertyIsValid(this.oForm.elements[i])){ return false;}
		}
		return true;
	},
	
	PropertyIsValid : function(oItem){
		var retval = { error:null, validated:false };
		if(!oItem.hasAttribute("data-validation")){ return true;}
		var jsonString = oItem.getAttribute("data-validation");
		var jsonRules = JSON.stringify(eval("("+jsonString+")"));
		var jsonObject = JSON.parse(jsonRules);			
		if(!(retval = this.ValidateMin(oItem, jsonObject)).validated){ 			
			return this.ValidateFail(oItem, retval.error);
		}
		if(!(retval = this.ValidateRule(oItem, jsonObject)).validated){			
			return this.ValidateFail(oItem, retval.error);
		}
		
		this.PrintOK(oItem);		
		return true;
	},
	
	ValidateFail : function(oItem, error){		
		this.PrintError(oItem, error);
		oItem.focus();
		return false;
	},
	
	ValidateMin : function(oItem, jsonObject){
		var retval = { error:null, validated:true};
		if(jsonObject.hasOwnProperty("min") && oItem.value.length < jsonObject.min){ 
			retval.error = (jsonObject.min == 1) ? "Required" : "Must be at least "+jsonObject.min+" characters";			
			retval.validated = false;
		}
		return retval;
	},
	
	ValidateRule : function(oItem, jsonObject){		
		var retval = { error:null, validated:true};
		if(!jsonObject.hasOwnProperty("rules")){ return retval;}		
		var key = arrayKey("email", jsonObject.rules);
		if(key < 0){ return retval;}		
		if(jsonObject.rules[key] && !SpaFormRules.Email(oItem.value)){
			retval.error = "Not a valid email address";			
			retval.validated = false;
		}		
		return retval;
	},
	
	PrintError : function(oItem, error){
		var id = oItem.id+"-error";
		self = this;
		var oErrorDiv = document.getElementById(id);
		if(oErrorDiv == null){ 
			$(oItem).after("<span style='color:red;' id='"+id+"' class='input-error'>"+error+"</span>");			
		}
		else{
			oErrorDiv.style.color = "red";
			oErrorDiv.innerHTML = error;
		}
	},
	
	RemoveError : function(oItem){
		var id = oItem.id+"-error";
		$("#"+id).remove();
	},
	
	RemoveCover : function(){
		this._Spa.RemoveCover();
	},
	
	PrintOK : function(oItem){
		
		var id = oItem.id+"-error";
		self = this;
		if(document.getElementById(id) == null){
			$(oItem).after("<span style='color:red;' id='"+id+"' class='input-error'></span>");
		}
		var oError = document.getElementById(id);
		oError.innerHTML = "&#10003;";
		oError.style.color = "green";
		oError.style.weight = "bold";
	},
	
	FormDisable : function(){
		els = this.oForm.elements;
		for(var i=0; i<els.length;i++){
			
		}
	},
	
	SetCallBack : function(){
		self = this;
		var Complete = (function(){			
			this.Complete();
		}).bind(this);
		
		if(this.oForm.hasAttribute("data-callback")){
			var callBackString = this.oForm.getAttribute("data-callback");
			var callBack = eval(callBackString);
			this.oFrame.onload = function(){
				var json = $(self.oFrame).contents().find("body").html();
				callBack(json, self, Complete);				
				
			};
		}
	},
	
	Complete : function(){
		self = this;		
		self._Spa.RemoveCover();
		$(self.oFrame).remove();		
		this.InitSubmitButton();
	}
	
	
	
});