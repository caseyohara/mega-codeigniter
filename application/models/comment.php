<?php

class Comment extends Application_Model {

	public function __construct() {
		parent::initialize();
		$this->belongs_to('post');
	}

}

?>