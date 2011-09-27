<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('user/user_m');
		$this->role_list = array('non_user','customer', 'member', 'manager', 'owner');
	}
	
	//php 4 constructor
	function User() {
		parent::__construct();
	}
	
	function index() {
		
	}
	// API //
	function api_roles(){
		return $this->role_list;
	}
	function api_browse($param=false){
		return 	$this->user_m->browse($param);
	}
	function api_getbyid($id){
		return $this->user_m->getbyid($id);
	}
	function api_create($data, $ext_data = false){
		return $this->user_m->create($data, $ext_data);
	}
	function api_update($id, $data, $ext_data = false){
		return $this->user_m->update($id, $data, $ext_data);
	}
	function api_delete($id){
		return $this->user_m->delete($id);
	}

}