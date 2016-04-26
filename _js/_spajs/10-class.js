var Class = function(methods) {   
    var _Class = function() {    
        this.__construct.apply(this, arguments);          
    };  
    
    for (var property in methods) { 
       _Class.prototype[property] = methods[property];
    }
          
    if (!_Class.prototype.__construct) _Class.prototype.__construct = function(){};      
    
    return _Class;    
};