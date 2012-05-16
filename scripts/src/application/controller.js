// require application/interface

Application.Controller = function(){
  
  var self = this;
  var interface = new Application.Interface(self);
  
  self.initialize = function() {
    return self;
  };
  
  return self.initialize();
};