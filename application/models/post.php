<?php

class Post extends Application_Model {

  public function __construct() {
    parent::initialize();
    $this->has_many('comments');
  }

}

?>