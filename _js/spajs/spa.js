var Spa = Class({
	Debug : true,	
	
	CreateFrame : function(frameID){
		vis = "hidden";
		h = 0;
		w = 0;
		
		if(this.Debug){
			vis = "visible";
			h = 200;
			w = 400;
		}
		
		if(frameID == null){			
			this.frameID = "spa-frame-"+JS.Now();
		}
			this.oFrame = document.createElement("iframe");
			this.oFrame.id = this.frameID;
			this.oFrame.setAttribute("name", this.frameID);
			this.oFrame.width = h;
			this.oFrame.height = w;
			this.oFrame.style.width = w + "px";
			this.oFrame.style.height = h + "px";
			this.oFrame.style.visibility = vis;
			document.body.appendChild(this.oFrame);
			return this.oFrame;
		
	},
	
	DeleteFrame : function(oFrame){
		if(this.oFrame == null){ return;}
		oFrame.parentNode.removeChild(oFrame);
	},
	
	DivCover : function(oDiv){		
		oDiv.innerHTML = "<div id='spa-cover-parent' style='position:relative;'></div>"+oDiv.innerHTML;	
				
		var jDiv = $(oDiv);
		var position = jDiv.position();
		var CoverDiv = document.createElement("div");
		var bgcolor = "#000";
		console.log(oDiv);
		if(!isNull(oDiv.style.backgroundColor)){ bgcolor = oDiv.style.backgroundColor;}
		else if(!isNull(oDiv.style.background)){ bgcolor = oDiv.style.background;}
		
		CoverDiv.style.position = "absolute";
		CoverDiv.style.left = "0px";
		CoverDiv.style.top = "0px";
		CoverDiv.style.height = jDiv.height()+"px";
		CoverDiv.style.width = jDiv.width()+"px";
		CoverDiv.style.opacity = 0;				
		CoverDiv.style.zIndex = 1000;
		CoverDiv.id = "spa-cover";
		CoverDiv.style.backgroundColor = bgcolor;
		document.getElementById('spa-cover-parent').appendChild(CoverDiv);
		/* fade in quickly */
		$(CoverDiv).animate({opacity:.3},250);
	},
	
	/* DivClone({oDiv : 'yourdiv', id : 'newdivid', copycontent : false}) */
	DivClone : function(vars){
		if(vars["oDiv"] == null){ return;}
		var oDiv = vars["oDiv"];		
		clone = oDiv.cloneNode(true);
		if(typeof vars["id"] != "undefined"){ clone.id = vars["id"]; }		
		if(vars["copycontent"] != null && vars["copycontent"] == false){
			clone.innerHTML = "&nbsp;";
		}
		document.body.appendChild(clone);
		return oDiv;
	},
	
	RemoveCover : function(){			
		var jCover = $("#spa-cover");
		jCover.animate({opacity:0},250, function(){
			jCover.remove();
			$("#spa-cover-parent").remove();
		});
		this.oFrame = null;
	}
	
});