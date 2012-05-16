<?php

class Posts extends Application_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function index() {
    $data['posts'] = $this->Post->get();
    $this->render($data);
  }
  
  public function show() {
    $id = $this->uri->rsegment(3);
    $data['post'] = $this->Post->find($id);    
    $this->render($data);
  }
  
  public function build() {
    $this->render();
  }

  public function edit() {
    $id = $this->uri->rsegment(3);
    $data['post'] = $this->Post->find($id);
    $this->render($data);
  }
  
  public function update() {
    $id = $this->Post->update($_POST);
    $this->redirect("posts/$id");
  }

  public function create() {
    $id = $this->Post->save($_POST);
    $this->redirect("posts/$id");
  }  
  
  public function delete() {
    $id = $this->uri->rsegment(3);
    $this->Post->delete($id);
    $this->redirect('/posts');
  }
  
}

?>