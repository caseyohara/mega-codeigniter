<?php

class Application_Model extends CI_Model {

	public $model;
	public $table;
	public $primary_key;
	public $foreign_key;

	private $order;
	private $parents = array();
	private $children = array();

	
	public function __construct() {
		parent::__construct();
	}
	
	public function initialize(){
		$model_name = strtolower( singular(get_called_class()) );
		$this->table = plural($model_name);
		$this->primary_key = "id";		
		$this->foreign_key = $model_name . "_id";
	}

	// select methods

	public function get($get_relatives = true){
		return $this->ship($get_relatives);
	}

	public function get_where($column, $value, $get_relatives = true){
		$this->db->where( $column, $value);
		return $this->ship($get_relatives);
	}

	public function find($id, $get_relatives = true){
		$this->db->where( $this->primary_key , $id);
		return $this->single($this->ship($get_relatives));
	}

	public function find_by($column, $value, $get_relatives = true){
		$this->db->where( $column, $value);
		return $this->ship($get_relatives);
	}
	

	// insert & update methods

	public function save($data = ''){
		if($data == ''){ $data = $_POST;	}
		$data = $this->presave_clean($data);
		$data['created_at'] = date("Y-m-d H:i:s.u");
		$data['updated_at'] = date("Y-m-d H:i:s.u");
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($data){
		$id = $data[$this->primary_key];
		$this->db->where($this->primary_key, $id);
		$data = $this->presave_clean($data, array("$this->primary_key"));
		$data['updated_at'] = date("Y-m-d H:i:s.u");
		$this->db->update($this->table, $data);
		return $id;
	}

	public function delete($id, $delete_children = false){
		$this->db->where($this->primary_key, $id);
		$this->db->delete($this->table);
		if($delete_children){
			$this->delete_children($id);
		}
		return true;
	}





	// public model setters

	public function has_many($child) {
		$this->children[] = $child;
	}

	public function belongs_to($parent) {
		$this->parents[] = $parent;
	}

	public function sort_by($column, $direction = "asc"){
		$this->order = array(
			'column' => $column,
			'direction' => $direction
		);
	}

	
	
	// private utility methdods

	private function ship($get_relatives = true){
		$this->sort();
		$this->model = $this->db->get($this->table);
		$this->clean();
		if( $get_relatives ) {
			$this->append_children();
			$this->append_parents();			
		}
		return $this->model;	
	}

	private function single(){
		if( sizeof($this->model)){
			$this->model = $this->model[0];
			return $this->model;
		}
	}

	private function clean(){
		$this->model = $this->model->result();
	}

	private function append_children(){
		if ( ! sizeof($this->children) ){
			return false;
		}
		
		$key_column = $this->primary_key;
		foreach ( $this->children as $child ) {
			foreach ( $this->model as $parent ) {
				$key_value = $parent->$key_column;
				$this->db->where( $this->foreign_key, $key_value);
				$parent->$child = $this->db->get($child)->result();
			}
		}
	}


	private function append_parents(){
		if ( ! sizeof($this->parents) ){
			return false;
		}
		
		foreach($this->parents as $parent) {
			$parent_table = strtolower( plural( singular($parent) ));
			foreach ($this->model as $child) {
				$parent_foreign_key = strtolower( singular($parent)) . "_id";
				$this->db->where( "id", $child->$parent_foreign_key);
				$query = $this->db->get($parent_table)->result();
				$child->$parent = $query[0];
			}
		}
	}
	
	private function delete_children($id){
		foreach($this->children as $child) {
			$child_table = strtolower( plural( singular($child) ));
			$this->db->where($this->foreign_key, $id);
			$this->db->delete($child_table);
		}
	}	

	private function presave_clean($data, $extra_clean = ''){
		$wash = array("redirect");
		if ($extra_clean != '') {
			array_merge($wash,$extra_clean);
		}
		foreach ($wash as $key) {
			if (isset($data[$key])) {
				unset($data[$key]);
			}
		}
		return $data;
	}


	private function sort(){
		if(isset($this->order)){
			return $this->db->order_by($this->order['column'],$this->order['direction']);
		}
	}



	
}

?>