<?php

class Comments extends Application_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function create() {
		$id = $this->Comment->save($_POST);
		$this->redirect("posts");
	}	
	
}

?>