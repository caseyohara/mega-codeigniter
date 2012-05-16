<?php

class Application_Controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
  }

  public function render($data = array(), $ext = "html", $options = array()){
    $class = $this->router->class;
    $method = $this->router->method;
    $view_path = APPPATH . "views/";
    $layouts_path = "layouts/";
    $default_layout = "application." . $ext . ".php";
    $class_layout = "$class." . $ext . ".php";

    if( file_exists($view_path . $layouts_path . $class_layout) ){
      $layout = $layouts_path . $class_layout;
    }
    else {
      $layout = $layouts_path . $default_layout;
    }
    
     $data['view'] = "$class/$method.$ext.php";
     $this->load->view($layout, $data);
  }

  public function redirect($default = "maps"){
    $redirect = $this->input->post('redirect');
    if( $redirect != ''){
      redirect($redirect);
    }
    else {
      redirect($default);
    }  
  }
  
}

?>