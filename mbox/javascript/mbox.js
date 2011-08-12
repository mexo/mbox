if (!window.MBOX) {
    window.MBOX = {};
}

(function(mbox){
	
	var mboxVars = {};
	
	mbox.init = function(){
		
		mbox.setVariables();
		
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
	
	mbox.getUrl = function( action, parameters ){
		var path = this.getVar('applicationPath');
		if(action){
			path += '?action='+action;
		}
		for( var property in parameters){
			path += '&'+property+'='+parameters[property]
		}
		return path;
	}; 
	
	mbox.getQueryStringObj = function(){

		var params = window.location.search.split("?"),
			queryStringObj = {},
			splittedParam =[];
		
		if(params.length > 1){
			params = params[1].split("&");
			for(var i = 0; i < params.length; i++){
				splittedParam = params[i].split("=");
				queryStringObj[splittedParam[0]] = splittedParam[1];
			}
		}
		return queryStringObj;
		
	};
	

	
	mbox.jsonRPC = function( config ){
	
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
				url: this.getUrl('jsonrpc')
			};
			delete config.context;
			delete config.api;
			delete config.method;
			delete config.data;
			$.ajax($.extend({},base, config));
	};

})(MBOX);
MBOX.init();
