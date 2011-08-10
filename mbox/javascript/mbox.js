if (!window.MBOX) {
    window.MBOX = {};
}

(function(mbox){
	
	var mboxVars = {};
	
	mbox.init = function(){
		
		mbox.setVariables();
		mbox.Application.init();
		
	};

	mbox.setVariables = function(){
		mboxVars.applicationPath		= mbox.applicationPath;	
		mboxVars.javascriptPath			= mbox.javascriptPath;
		mboxVars.javascriptLibraryPath	= mbox.javascriptLibraryPath;
		mboxVars.javascriptModulePath	= mbox.javascriptModulePath;
		mboxVars.stylePath				= mbox.stylePath;
		mboxVars.styleLibraryPath		= mbox.styleLibraryPath;
		mboxVars.imagePath				= mbox.imagePath;
		mboxVars.action					= mbox.action;
		mboxVars.actionVars				= mbox.yActionJson;
		delete(mbox.applicationPath);
		delete(mbox.javascriptPath);
		delete(mbox.javascriptLibraryPath);
		delete(mbox.javascriptModulePath);
		delete(mbox.stylePath);
		delete(mbox.styleLibraryPath);
		delete(mbox.imagePath);
		delete(mbox.action);
		delete(mbox.yActionJson);
	};
			
	mbox.getVars = function(){ return mboxVars; }
	
	mbox.getVar = function(key){ return mboxVars[key]; }

	mbox.getActionVars = function(){ return mbox.yActionJson; }

	mbox.Application = {};
	mbox.Application.Path  =  '';
	mbox.Application.File  =  'index.php';
	mbox.Application.init  =  function(){ this.Path = mbox.applicationPath;  };
	mbox.Application.GetApplicationURL = function(action, parameters){

		var valuePairs = [];
	    if (action) { valuePairs.push('action='+action); }
	    for (var property in parameters) { valuePairs.push(property + '=' + parameters[property]);  }
	    var getString = '';
	    if (valuePairs.length) { getString = '?' + valuePairs.join('&'); }
	    return this.Path  + this.File + getString;
	                
	};    

	
	mbox.Application.QueryStringObject = function(){    
	         
	    var params = window.location.search.split("?"); 
	    if (params.length <= 1){return false;}
	    params = params[1].split("&");  
	    if (params.length == 0){return false;}   
	    var newParam = new Object();  
	    for ( var i = 0 ; i < params.length ; i++){
	        data  = params[i].split("=");
	        newParam[data[0]] = data[1]  ;
	    }        
	    return  newParam;
	    
	}    
	
	
	mbox.jsonRPC =  function( config ){
	
			var base = {
				context: config.scope || document.body,
				data:{
					api: config.api,
					method: config.method,
					config: config.data
				},
				dataType: 'json',
				type: 'POST',
				context: config.scope || document.body,
				url: $_LITE_.Application.GetApplicationURL('jsonrpc')
			};
			delete config.context;
			delete config.api;
			delete config.method;
			delete config.data;
			$.ajax($.extend({},base, config));
	};

})(MBOX);
MBOX.init();


