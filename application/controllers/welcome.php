<?php

class Welcome extends Application_Controller {

	public function index() {
		$this->load->view('welcome_message');
	}
	
}

?>