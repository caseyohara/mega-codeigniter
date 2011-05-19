Application.Interface = function(){
	
	var self = this;
	
	self.initialize = function() {
		self.build();
		self.observe();
		return self;
	};
	
	
	self.build = function() {
		return self;
	};
	
	
	self.observe = function() {
		return self;
	};

	
	return self.initialize();
};